<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\offer_settings;
use App\Model\purchare_review_questions;
use App\Model\purchare_review_answers;
use App\Model\amazon_review_questions;
use App\Model\amazon_review_answers;
use App\Model\offer_images;
use App\Model\frontend\user_notifications;
use App\Model\frontend\users_offer_1_sent_campaigns;
use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\frontend\users_offer_3_continue_accepts;
use App\Model\frontend\users_offer_4_submit_tracking_numbers;
use App\Model\frontend\users_offer_5_completeds;
use App\Model\frontend\users_offer_7_submit__return_products_tracking_numbers;
use App\Model\frontend\user_dashboard_notifications;
use App\Model\frontend\user_vcc_historypays;
use App\Model\frontend\User;
use Carbon\Carbon;
use App\Http\Controllers\frontend\NotificationsController;
use App\Http\Controllers\frontend\OfferTrackingReturnProductsController;
use Auth;


use App\Model\frontend\users_offer_purchase_products;
use App\Model\frontend\users_offer_purchase_check_asins;
use App\Model\frontend\users_offer_purchase_4rt_steps;
use App\Model\frontend\users_offer_purchase_5th_steps;
use App\Model\frontend\users_offer_purchase_6th_steps;

use App\Http\Controllers\ProductDetailsActionWithButtonController;

class Dashboardfeatured_offerController extends Controller
{
	protected $ProductDetailsActionWithButtonController;
	
	public function __construct(ProductDetailsActionWithButtonController $ProductDetailsActionWithButtonController)
    {
		$this->middleware('auth');
		$this->ProductDetailsActionWithButtonController = $ProductDetailsActionWithButtonController;
    }
	
	
	public function featured_offer(Request $request)
	{
			$id =  $request->user()->id;
			$menudata =  $request->menudata;
			$group_category =  $request->group_category;
			
			$new_price  = "price.product_price as new_product_price";
			$new_price .= ",price.product_discount_label as new_product_discount_label";
			$new_price .= ",price.product_discount as new_product_discount";
			
			
			$data_user = User::where('id',$id)->first();
			$ineterst_val = explode("|", $data_user->interest); 
			
			$days_delay = 0;
			
			if($data_user->customer_level == 2)
			{
				$days_delay = 2;
			}
			else if($data_user->customer_level == 3)
			{
				$days_delay = 3;
			}
	
			
	
			
			$select = "offer_settings.*,$new_price,stat.offer_status";

		
			 $sqlData = \DB::table('offer_settings')

				->select(\DB::raw($select))
		
				->join('offer_status as stat','stat.id','=','offer_settings.status')
					
				->leftJoin('users_offer_1_sent_campaigns as t2', function($sqlData)  use  ($id)
				{
					$sqlData->on('t2.offer_id', '=', 'offer_settings.id');
					$sqlData->on('t2.user_id','=',\DB::raw("'$id'"));
				})
				
				->leftJoin('offer_setting_prices as price', function($sqlData) 
				{
					$sqlData->on('offer_settings.id', '=', 'price.offer_id');
					$sqlData->on('price.product_id', '=', 'offer_settings.product_id');
					$sqlData->on('price.status','=',\DB::raw("'active'"));
				})
				
				->whereIn('offer_settings.group_interest',$ineterst_val)
	
				->where('offer_settings.offer_daily_order','!=','')
				->where('offer_settings.campaign_type','!=','gig')
				->where('offer_settings.campaign_type','!=','compare campaign')
				->where('offer_settings.status','=',1)
				// ->where('offer_settings.status','!=',0)
				// ->where('offer_settings.status','!=',2)
				// ->where('offer_settings.status','!=',4)
				// ->where('offer_settings.status', '!=', 5) // is not equal to draft mode
				// ->where('offer_settings.status', '!=', 3) // is not equal to inactive status
				
				->when(!empty($menudata), function ($sqlData) use ($menudata)  {
					return $sqlData->where('offer_settings.campaign_type','=',$menudata);
				})
				->when(!empty($group_category), function ($sqlData) use ($group_category)  {
					return $sqlData->where('offer_settings.group_interest','=',$group_category);
				})
	
				->whereNotExists( function ($query) use ($id) 
				{
						$query->select(\DB::raw(1))
						
						->from('users_offer_2_get_schedules')
						->whereRaw('offer_settings.id = users_offer_2_get_schedules.offer_id')
						->where('users_offer_2_get_schedules.user_id', '=', $id);

				})
				->whereNotExists( function ($query) use ($id) 
				{
						$query->select(\DB::raw(1))
						
						->from('users_offer_3_continue_accepts')
						->whereRaw('offer_settings.id = users_offer_3_continue_accepts.offer_id')
						->where('users_offer_3_continue_accepts.user_id', '=', $id)
						->where('users_offer_3_continue_accepts.cancel_offer', '!=', 1);

				})
				->whereNotExists( function ($query) use ($id) 
					{
						$query->select(\DB::raw(1))
						
						->from('user_offer_denies')
						->whereRaw('offer_settings.id = user_offer_denies.offer_id')
						->where('user_offer_denies.user_id', '=', $id);

					})
				 ->whereNotExists( function ($query) use ($id) 
					{
						$query->select(\DB::raw(1))
						
						->from('users_offer_5_completeds')
						->whereRaw("offer_settings.id = users_offer_5_completeds.offer_id")
						->where('users_offer_5_completeds.user_id', '=' ,$id);
						

					})
				->where('offer_settings.campaign_type', '!=', 'compare campaign')
				->orderBy('offer_settings.updated_at', 'DESC')
				->get();
				
				
			if(!empty($sqlData))
			{
    			$datetoday = Carbon::now()->format('m/d/Y');
    			$ddyesterday = Carbon::yesterday()->format('m/d/Y');
    			$timenow = Carbon::now()->format('H:i:s');
				$currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
				
    			$events = array();
    			$result = array();
    			$sched_array = array();
				foreach($sqlData as $row) 
				{
					$datax = array();
					$availadate = array();
					@$date_unserialize = unserialize($row->offer_daily_order);
					$lastElement = end($date_unserialize);
					$lastElement = $lastElement['date'];
					@$datex =  (explode("-",$lastElement));
					$datexxx = $datex[0].'/'.$datex[1].'/'.$datex[2];
					
					$carbon_date = Carbon::parse($row->approved_date);
					//$approved_date = $carbon_date->addHours($hours_delay);
					$approved_date = $carbon_date->addDays($days_delay);
					
					
					//check if mag show ang campaign base sa customer level
					if(strtotime($approved_date) <= strtotime($currentDateTime))
					{	
						    
						    // filter if date today less than or equal to date schedule
							if(strtotime($datetoday) <= strtotime($datexxx))
							{
    								$datax['offer_date_today']  =  $datetoday;
    								$datax['offer__date_last']  =  $datexxx;
    								
    								if(strtotime($datetoday) > strtotime($datexxx))
    								{
    									$datax['offer_result']  =  'lapsed';
    								}
    								else
    								{
    									$datax['offer_result']  =  'continue';
    								}
    								
    								$getCountsched = \DB::table('users_offer_2_get_schedules')
    									->select(\DB::raw('*'))
    									->where('offer_id', $row->id)
    									->where('sched_date', $datetoday)
    									->get();
    								$datax['offer_count_shed_campaign']  =   count($getCountsched);
    								$datax['offer_available_spot'] = "CLOSED";
    							
    								foreach($date_unserialize as $key => $rows) 
    								{
    									$availabledate = trim($rows['date']);
    									$availabledate = explode('-',$availabledate);
    									$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
    									$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
    									
    									if(strtotime($datetoday) == strtotime($availabledate))
    									{
    											
    											$availadate['z_date']		 = 	$rows['date'];	
    											$availadate['z_nameofday']	 = 	$rows['nameofday'];	
    											$availadate['z_value'] 	 	= 	(int)$rows['value'];
    											
    											$getotalavailble_fortoday =   $availadate['z_value'] -  count($getCountsched);
    											$datax['offer_available_spot']   = ($getotalavailble_fortoday == 0 ? "CLOSED" : $getotalavailble_fortoday );
    											
    									
    									}
    									
    									$datax['available_value']  =  $availadate;
    									
    								}
    								
        							$imageData = \DB::table('offer_images')
        							->select(\DB::raw('*'))
        							->where('offer_id', $row->id)
        							->first();
        							
        							
        							$getinfo = \DB::table('offer_setting_prices')
        							->select(\DB::raw('*'))
        							->where('offer_id', $row->id)
        							->where('product_id', $row->product_id)
        							->where('status', 'active')
        							->get();
        
        							$product_price 			= $getinfo[0]->product_price;
        							$product_discount_label = $getinfo[0]->product_discount_label;	
        							$product_discount 		= $getinfo[0]->product_discount;
        							$discount_percent = $product_discount / 100;
        							$discounted_amount = $product_price * $discount_percent;
        							$product_sale_amount   =  $product_price - $discounted_amount;
        							$sales_discounted = sprintf('%0.2f', $product_sale_amount);
        							$original_product_price = sprintf('%0.2f', $product_price);
        							
        							$purchase_rebate 		= $row->purchase_rebate;
        							$purchase_rebate_amount = $row->purchase_rebate_amount;
        							
        							if($purchase_rebate == "Percentage")
        							{
        								
        								$rebate_percent = @$purchase_rebate_amount / 100;
        								$rebate_amount =  $original_product_price * $rebate_percent;
        							
        							}
        							else if($purchase_rebate == "Dollar")
        							{
        								//$rebate_amount = $sales_discounted - $purchase_rebate_amount;
        								
        								$rebate_amount = $purchase_rebate_amount;
        								// check if negative value return the exact amount;
        								if($rebate_amount < 0)
        								{
        									$rebate_amount = $purchase_rebate_amount;
        								}
        							}
        
        
        							$getpaid = sprintf('%0.2f', $rebate_amount);
        							$da['product_sale_amount'] = 	$sales_discounted;	
        							$da['purchase_rebate'] = 	$purchase_rebate;
        							$da['purchase_rebate_amount'] = 	$purchase_rebate_amount;
        							$da['get_paid'] = $getpaid;
        							$eventsArray['campaign_data']  = $row;
        							$eventsArray['image_path'] 	   =  $imageData;
        							$eventsArray['product_price_data']  =  $da;
        							$eventsArray['offer_data']  =  $datax;
        							$eventsArray['offer_available']  =  $this->IsthisAvailableproduct($row->id,$id);
        							
        							$events[] = $eventsArray;	
							
						}
					
					}// end nang ag verify sa customer level at pag show nang campaign
					
				}	
				
			}
			else
			{
			    $events = [];
			}
			
			
		return $events;
		
	}
	
	
	
	
	public function IsthisAvailableproduct($campaign_id,$user_id)
	{

	    $available_product = $this->ProductDetailsActionWithButtonController->GetTotalALLAvailableSchedule($campaign_id);
	    $checkif_availabletoyou = $this->ProductDetailsActionWithButtonController->checkIFproduct_isavailabletoyou($campaign_id,$user_id);
	    
	    $data = array();
	    
    	// return exit once Zero product available today
		if($available_product == 0)
		{

			$data['available_spots']  = $available_product;
			$data['remarks']          = 'SOLD_PRODUCT';
			$data['status']           = 'CLOSED';
 			
			return $data;
			exit;
		}
		
		// Check/Verify if product is available to your account and we have a product in inventory
		else if($available_product >  0 && $checkif_availabletoyou == "proceed" )
		{
		
			$data['available_spots']  = $available_product;
			$data['remarks']          = 'AVAILABLE_PRODUCT';
			$data['status']           = 'AVAILABLE';
			return $data;
			exit;
		}
		
		// We have a product but blocked your account
		else if($available_product >  0 && $checkif_availabletoyou == "blocked")
		{
			
				//check if threshold is run and if its allow to your account
				if($this->ProductDetailsActionWithButtonController->CampaignThresholdLogic($campaign_id) == 'allow')
				{
					
					$data['available_spots']  = $available_product;
        			$data['remarks']          = 'THRESHOLD_RUN_AVAILABLE';
        			$data['status']           = 'AVAILABLE';
        			return $data;
        			exit;
				}
				else
				{
					
					$data['available_spots']  = $available_product;
        			$data['remarks']          = 'BLOCKED_ACCOUNT';
        			$data['status']           = 'CLOSED';
        			return $data;
        			exit;
				}
		}
		
		
		
	}
	
	
	

	public function compare_offer(Request $request){
			$id =  $request->user()->id;
			$menudata =  $request->menudata;
			$group_category =  $request->group_category;
			
			$new_price  = "price.product_price as new_product_price";
			$new_price .= ",price.product_discount_label as new_product_discount_label";
			$new_price .= ",price.product_discount as new_product_discount";
			
			
			$data_user = User::where('id',$id)->first();
			$ineterst_val = explode("|", $data_user->interest); 
			$select = "offer_settings.*,$new_price,stat.offer_status";

		
			 $sqlData = \DB::table('offer_settings')

				->select(\DB::raw($select))
			//->join('users_offer_1_sent_campaigns as t2','t2.offer_id','=','offer_settings.id')
				->join('offer_status as stat','stat.id','=','offer_settings.status')
				
				/* 
				->leftJoin('users_offer_2_get_schedules as schedule', function($sqlData) use ($id)   
				{
					$sqlData->on('offer_settings.id', '=', 'schedule.offer_id');
					$sqlData->on('schedule.user_id','=',\DB::raw("'$id'"));
					
				}) 
				*/
				
				->leftJoin('users_offer_1_sent_campaigns as t2', function($sqlData)  use  ($id)
				{
					$sqlData->on('t2.offer_id', '=', 'offer_settings.id');
					$sqlData->on('t2.user_id','=',\DB::raw("'$id'"));
				})
				
				
				->leftJoin('offer_setting_prices as price', function($sqlData) 
				{
					$sqlData->on('offer_settings.id', '=', 'price.offer_id');
					$sqlData->on('price.product_id', '=', 'offer_settings.product_id');
					$sqlData->on('price.status','=',\DB::raw("'active'"));
				})
				
				->whereIn('offer_settings.group_interest',$ineterst_val)
				
				
				//->where('t2.user_id', '=', $id)
				->where('offer_settings.offer_daily_order','!=','')
				->where('offer_settings.campaign_type','!=','gig')
				->where('offer_settings.status', '=', 1) // is not equal to draft mode
				// ->where('offer_settings.status', '!=', 3) // is not equal to inactive status
				// ->where('offer_settings.status', '!=', 0) // is not equal to inactive status
				
				->when(!empty($menudata), function ($sqlData) use ($menudata)  {
					return $sqlData->where('offer_settings.campaign_type','=',$menudata);
				})
				->when(!empty($group_category), function ($sqlData) use ($group_category)  {
					return $sqlData->where('offer_settings.group_interest','=',$group_category);
				})
				
				
			 	/* ->whereNotExists( function ($query) use ($id) 
				{
						$query->select(\DB::raw(1))
						
						->from('users_offer_1_sent_campaigns as t1')
						->join('users_offer_3_continue_accepts as t2','t2.product_id','=','t1.product_id')
						->whereRaw('t2.product_id = t1.product_id')
						->where('t2.cancel_offer', '!=', 1);
				})  
				*/
				->whereNotExists( function ($query) use ($id) 
				{
						$query->select(\DB::raw(1))
						
						->from('users_offer_2_get_schedules')
						->whereRaw('offer_settings.id = users_offer_2_get_schedules.offer_id')
						->where('users_offer_2_get_schedules.user_id', '=', $id);

				})
				->whereNotExists( function ($query) use ($id) 
				{
						$query->select(\DB::raw(1))
						
						->from('users_offer_3_continue_accepts')
						->whereRaw('offer_settings.id = users_offer_3_continue_accepts.offer_id')
						->where('users_offer_3_continue_accepts.user_id', '=', $id)
						->where('users_offer_3_continue_accepts.cancel_offer', '!=', 1);

				})
				->whereNotExists( function ($query) use ($id) 
					{
						$query->select(\DB::raw(1))
						
						->from('user_offer_denies')
						->whereRaw('offer_settings.id = user_offer_denies.offer_id')
						->where('user_offer_denies.user_id', '=', $id);

					})
				 ->whereNotExists( function ($query) use ($id) 
					{
						$query->select(\DB::raw(1))
						
						->from('users_offer_5_completeds')
						->whereRaw("offer_settings.id = users_offer_5_completeds.offer_id")
						->where('users_offer_5_completeds.user_id', '=' ,$id);
						

					})
				->where('offer_settings.campaign_type', 'compare campaign')	
				->orderBy('offer_settings.updated_at', 'DESC')
				//->groupBy('img.offer_id')
				->get(); 
				
			$datetoday = Carbon::now()->format('m/d/Y');
			$ddyesterday = Carbon::yesterday()->format('m/d/Y');
			$timenow = Carbon::now()->format('H:i:s');
			
			
			
			
			/*
			$date_unserialize = unserialize($sqlData[0]->offer_daily_order);
			foreach($date_unserialize as $key => $row) 
			{
				$availabledate = trim($row['date']);
				$availabledate = explode('-',$availabledate);
				$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
				$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
				
				if(strtotime($datetoday) == strtotime($availabledate))
				{
						$datax['date']		 = 	$row['date'];	
						$datax['nameofday']	 = 	$row['nameofday'];	
						$datax['value'] 	 = 	$row['value'];	
				}
				
				
			}
			*/
			
			
			$events = array();
			$result = array();
			$sched_array = array();
			
		
			if(!empty($sqlData))
			{
				
				
				
				
				foreach($sqlData as $row) 
				{
						$datax = array();
						$availadate = array();
						
						$date_unserialize = unserialize($row->offer_daily_order);
						$lastElement = end($date_unserialize);
						$lastElement = $lastElement['date'];
						$datex =  (explode("-",$lastElement));
						$datexxx = $datex[0].'/'.$datex[1].'/'.$datex[2];
						
					if(strtotime($datetoday) <= strtotime($datexxx))
					{
					
							
						
						
						$datax['offer_date_today']  =  $datetoday;
						$datax['offer__date_last']  =  $datexxx;
						
						if(strtotime($datetoday) > strtotime($datexxx))
						{
							$datax['offer_result']  =  'lapsed';
						}
						else
						{
							$datax['offer_result']  =  'continue';
						}
						
						
						@$getCountsched = \DB::table('users_offer_2_get_schedules')
							->select(\DB::raw('*'))
							->where('offer_id', $row->id)
							->where('sched_date', $datetoday)
							->get();
						
						$datax['offer_count_shed_campaign']  =   count($getCountsched);
						
						$datax['offer_available_spot'] = "SOLD OUT";
					
						foreach($date_unserialize as $key => $rows) 
						{
							$availabledate = trim($rows['date']);
							$availabledate = explode('-',$availabledate);
							$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
							$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
				// 			echo $availabledate.' '.$id_date.' '.$rows['date'].' '.$rows['nameofday'].' '.$rows['value'];
				// 			exit;
							if(strtotime($datetoday) == strtotime($availabledate))
							{
									
									$availadate['z_date']		 = 	$rows['date'];	
									$availadate['z_nameofday']	 = 	$rows['nameofday'];	
									$availadate['z_value'] 	 	= 	(int)$rows['value'];
									//$datax['offer_available_spot']  =  $availadate['z_value'] -  count($getCountsched);
									$getotalavailble_fortoday =   $availadate['z_value'] -  count($getCountsched);
									$datax['offer_available_spot']   = ($getotalavailble_fortoday == 0 ? "SOLD OUT" : $getotalavailble_fortoday );
							}
							
							$datax['available_value']  =  $availadate;
							
						}
						
						
					$imageData = \DB::table('offer_images')
					->select(\DB::raw('*'))
					->where('offer_id', $row->id)
					->get();
					
					
					
				    $getinfo = \DB::table('offer_setting_prices')
					->select(\DB::raw('*'))
					->where('offer_id', $row->id)
					->where('product_id', $row->product_id)
					->where('status', 'active')
					->get();
					
					
					$product_price 			= $getinfo[0]->product_price;
	            	$product_discount_label = $getinfo[0]->product_discount_label;	
	            	$product_discount 		= $getinfo[0]->product_discount;
	            	
	            	
	            	$discount_percent = $product_discount / 100;
	            	$discounted_amount = $product_price * $discount_percent;
		            $product_sale_amount   =  $product_price - $discounted_amount;
		            
		            
		            $sales_discounted = sprintf('%0.2f', $product_sale_amount);
		            
		            $original_product_price = sprintf('%0.2f', $product_price);
	            	
	            	$purchase_rebate 		= $row->purchase_rebate;
            		$purchase_rebate_amount = $row->purchase_rebate_amount;
            		
            		if($purchase_rebate == "Percentage")
            		{
            			$rebate_percent = @$purchase_rebate_amount / 100;
            			$rebate_amount =  $original_product_price * $rebate_percent;
            		
            		}
            		else if($purchase_rebate == "Dollar")
            		{
            			//$rebate_amount = $sales_discounted - $purchase_rebate_amount;
            			
            			$rebate_amount =  $purchase_rebate_amount;
            			
            			// check if negative value return the exact amount;
            			if($rebate_amount < 0)
            			{
            				$rebate_amount = $purchase_rebate_amount;
            			}
            		}
            		
            	    
            	    $getpaid = sprintf('%0.2f', $rebate_amount);
            	
            		
					
					$da['product_sale_amount'] = 	$sales_discounted;	
					$da['purchase_rebate'] = 	$purchase_rebate;
					$da['purchase_rebate_amount'] = 	$purchase_rebate_amount;
					$da['get_paid'] = $getpaid;
					$eventsArray['campaign_data']  = $row;
					$eventsArray['image_path'] 	   =  $imageData;
					$eventsArray['product_price_data']  =  $da;
					$eventsArray['offer_data']  =  $datax;
					$events[] = $eventsArray;	
					
				}	
				}	
			}
		
		
		return $events;
		
	}
	
	


}