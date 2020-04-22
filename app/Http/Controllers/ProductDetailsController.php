<?php

namespace App\Http\Controllers;

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

use App\Http\Controllers\frontend\UserVccController;
use App\Model\frontend\users_offer_purchase_products;
use App\Model\frontend\users_offer_purchase_check_asins;
use App\Model\frontend\users_offer_purchase_4rt_steps;
use App\Model\frontend\users_offer_purchase_5th_steps;
use App\Model\frontend\users_offer_purchase_6th_steps;
use App\Model\frontend\user_rebate_transaction;


class ProductDetailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	 
	 
	public function __construct()
    {
		$this->middleware('auth');
    }
 	
 	 public function campaign_productdetails(Request $request,$id='')
	{
		

		$images =  array();
		$user_id =  $request->user()->id;
	
		$select ="offer_settings.*,t2.product_id as user_product_id,t2.product_price as user_product_price,t2.product_discount_label as user_product_discount_label,t2.product_discount as user_product_discount";
	
		$offerdetails = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_setting_prices as t2','t2.offer_id','=','offer_settings.id')
		->where('t2.status','=','active')
		->where('offer_settings.id','=',$id)
		->groupby('offer_settings.id')
		->get();
		
		$images = offer_images::where('offer_id',$id)->get();
		
		
		$offer_last_date =unserialize($offerdetails[0]->offer_daily_order);
	    $lastElement = end($offer_last_date);
	    $lastElement = $lastElement['date'];
	    $datex =  (explode("-",$lastElement));
	    $datexxx = $datex[0].'/'.$datex[1].'/'.$datex[2];
		
	
		return view('frontend.productdetails',array('images'=>$images,'offerdetails'=>$offerdetails,'last_date_offer'=>$datexxx,'GetTotalAvailableSchedule'=>$this->GetTotalAvailableSchedule($id)));	
	}
	
	
	public function GetTotalAvailableSchedule($offer_id)
	{
		 $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		
		$currentdate_str = strtotime($currentdate);
		
		$dt = Carbon::now()->format('m/d/Y H:i:s');
		$datenow_str = strtotime($dt);

		$offerdetails = offer_settings::where('id',$offer_id)->first();
		
		$schedtaken = users_offer_2_get_schedules::where('offer_id',$offer_id)->get();
		
		$array_schedule = array();
	
		
		foreach($schedtaken as $row) 
		{
			$datetime = $row->sched_date.' '. $row->sched_time;
			
			array_push($array_schedule,$datetime);
		}
		
		
		//print_r($array_schedule);
		
	   
		
		$latest_shed  = $offerdetails->start_date.' '.$offerdetails->start_time;
		$carbon_date = Carbon::parse($latest_shed);
		$first_date_time = $carbon_date->addMinutes(30);
		
	
		$date_unserialize = unserialize($offerdetails->offer_daily_order);
		
	 	$events = array();
		$result = [];
		$slotperday = [];
		
		$sched_array = array();
		$status ="";
		
		
		
		
		
		if(!empty($date_unserialize))
		{	
			
		   $count = 0;
		   
			foreach($date_unserialize as $key => $row) 
			{
		
				$availabledate = trim($row['date']);
				$availabledate = explode('-',$availabledate);
				$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
				$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
				$availabledate_str = strtotime($availabledate);
				
				
				if($currentdate_str <= $availabledate_str)
				{
				
				
    					$eventsArray['id_date']  =  $id_date;
    					$eventsArray['date']  =  $availabledate;					
    					$eventsArray['value'] =  $row['value'];
    			
					
    					for($i = 1; $i <= $row['value']; $i++)
    					{

        						@$getCountsched = \DB::table('users_offer_2_get_schedules')
    							->select(\DB::raw('*'))
    							->where('offer_id', $offer_id)
    							->where('sched_date', $currentdate)
    							->get();
    				
        						$getCountsched = count($getCountsched);
        						$getotalavailble_fortoday =   $row['value'] -  $getCountsched;
    					}
				
					
    					$eventsArray['available_slot']	= $getotalavailble_fortoday;
    					$count += $eventsArray['available_slot'];
				
				
				}

               
	
				$getotalavailble_fortoday = 0;
				 
			}
		
		} 
		
		return  $count;
	}

	
	
	
	###########################################################################################################################
	
	public function get_product_photos(Request $request,$id="")
    {
		$campaign_photo =  offer_images::where('offer_id', $id)->get();
        return view('frontend.offer_dashboard.view_details_modal.product_photo',array('campaign_photo'=>$campaign_photo));   
    } 
	
	
	
	public function get_product_information(Request $request)
	{
		
		$user_id =  $request->user()->id;
		$id = $request->id;
	
		$select ="offer_settings.*,t2.product_id as new_product_id,t2.product_price as new_product_price,t2.product_discount_label as new_product_discount_label,t2.product_discount as new_product_discount";
	
		$offerdetails = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_setting_prices as t2','t2.offer_id','=','offer_settings.id')
		->where('t2.status','=','active')
		->where('offer_settings.id','=',$id)
		->groupby('offer_settings.id')
		->get();
		
		$data = array();
		
		if(!empty($offerdetails))
		{
			foreach ($offerdetails as $key => $datas) 
			{
					$row = array();	
					$data[$key] = $datas;
			}
		
			
			$data['confirmButton'] = $this->GetproductButton($id,$user_id);
		}
		else
		{
			$data = [];
		}
			
		
		$output = array("campaign_info" => $data);
		
		return $output;
		
		
	}
	
	public function GetproductButton($campaign_id,$user_id)
	{
		
			$confirmButton = '';
			$Text_sold ='';
			$Button_sold ='';
		
			$available_product = $this->GetTotalAvailableScheduleToday($campaign_id);
			$checkif_availabletoyou = $this->checkIFproduct_isavailabletoyou($campaign_id,$user_id);

			$Button_available = '<a  data-campaign_id='.$campaign_id.'      class="btn btn-primary btn-block mb-2-5 py-1 getcampaign"   >Get this campaign</a>';
			$Text_available =  '<p class="text-center mb-1">Only <b>'.$available_product.'</b> left   available product today, Hurry up and grab this !</p>';
			
			$Button_sold =  '<a  class="btn btn-warning btn-block mb-2-5 py-1">SOLD OUT</a>';	
			$Text_sold = '<p class="text-center mb-1">Sorry, 0ther reviewers beat you to it.<br>We will notify you once slots are available again.</p>';
			
			
		    $campaignFuture =   $this->CheckIfCampaign_isAvailableFuture($campaign_id);
    		if(!empty($campaignFuture))
    		{
    		    //echo $campaignFuture['msg'] . ' == '. $campaignFuture['date_available'];
    		   
    		    $date_available_format  = Carbon::parse($campaignFuture['date_available'])->format('F j, Y');
    		    
    		    $Text_sold = '<p class="text-center mb-1">Sorry, it looks like other reviewers beat you to it. The next available slot will be available on <b>'.$date_available_format.'</b> </p>';
    		}
    


			
			// return exit once Zero product available today
			if($available_product == 0)
			{
				$confirmButton  = $Button_sold;
				$confirmButton .= $Text_sold;
				return $confirmButton;
				exit;
			}
			
			// Check/Verify if product is available to your account and we have a product in inventory
			else if($available_product >  0 && $checkif_availabletoyou == "proceed" )
			{
				$confirmButton  =  $Button_available;
				$confirmButton .=  $Text_available;
				return $confirmButton;
				exit;
			}
			
			// We have a product but blocked your account
			else if($available_product >  0 && $checkif_availabletoyou == "blocked")
			{
				
					//check if threshold is run and if its allow to your account
					if($this->CampaignThresholdLogic($campaign_id) == 'allow')
					{
						$confirmButton  = $Button_available;
						$confirmButton .= $Text_available;	
						return $confirmButton;
						exit;
					}
					else
					{
						$confirmButton  = $Button_sold;
						$confirmButton .= $Text_sold;
						return $confirmButton;
						exit;
					}
			}
					
	}
	
	
	public function CheckIfCampaign_isAvailableFuture($offer_id)
	{
	    
	     $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
	    
	    
	    $offerdetails = offer_settings::where('id',$offer_id)->first();
	    $startDate_campaign  = $offerdetails->start_date;
	    
	    $data = array();
	    
	    if(strtotime($currentdate) <  strtotime($startDate_campaign) )
	    {
	        $data = array('msg'=>'future_campaign', 'date_available'=>$startDate_campaign);
	        

	    }
        else
        {
            $data = [];
        }
        
        
        return $data;
	    exit;
	    
	}
	
	public function GetTotalAvailableScheduleToday($offer_id)
	{
		 $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		
		$currentdate_str = strtotime($currentdate);
		
		$dt = Carbon::now()->format('m/d/Y H:i:s');
		$datenow_str = strtotime($dt);

		$offerdetails = offer_settings::where('id',$offer_id)->first();
		$schedtaken = users_offer_2_get_schedules::where('offer_id',$offer_id)->get();
		
		$array_schedule = array();
	
		
		foreach($schedtaken as $row) 
		{
			$datetime = $row->sched_date.' '. $row->sched_time;
			
			array_push($array_schedule,$datetime);
		}
		
		
		$latest_shed  = $offerdetails->start_date.' '.$offerdetails->start_time;
		$carbon_date = Carbon::parse($latest_shed);
		$first_date_time = $carbon_date->addMinutes(30);
		
	
		$date_unserialize = unserialize($offerdetails->offer_daily_order);
		
	 	$events = array();
		$result = [];
		$slotperday = [];
		
		$sched_array = array();
		$status ="";
		
		
		
		
		if(!empty($date_unserialize))
		{	
			
		   $count = 0;
		   $getotalavailble_fortoday=0;
			foreach($date_unserialize as $key => $row) 
			{
		
				$availabledate = trim($row['date']);
				$availabledate = explode('-',$availabledate);
				$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
				$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
				$availabledate_str = strtotime($availabledate);
				
				
				// if($currentdate_str <= $availabledate_str) /* change muna get All available slot for all campaign period */
				if($currentdate_str == $availabledate_str) /* change ko muna sa specific date today , kuning ang available slot sa araw lang na ito*/
				{
				
				
    					$eventsArray['id_date']  =  $id_date;
    					$eventsArray['date']  =  $availabledate;					
    					$eventsArray['value'] =  $row['value'];
    			
					
    					for($i = 1; $i <= $row['value']; $i++)
    					{

        						@$getCountsched = \DB::table('users_offer_2_get_schedules')
    							->select(\DB::raw('*'))
    							->where('offer_id', $offer_id)
    							->where('sched_date', $currentdate)
    							->get();
    				
        						$getCountsched = count($getCountsched);
        						$getotalavailble_fortoday =   $row['value'] -  $getCountsched;
    					}
				
					
    					$eventsArray['available_slot']	= $getotalavailble_fortoday;
    					$count += $eventsArray['available_slot'];
				
				
				}

               
	
				$getotalavailble_fortoday = 0;
				 
			}
		
		} 
		
		return  $count;
	}
	
	
	
	public function checkIFproduct_isavailabletoyou($product_id,$user_id)
	{	
	
		$user_who_claimedThiscampaign = array();
		$getallCampaign_and_users = array();
	
		### 
		/* step 1)
		/* search all users who claimed this campaign*/
		###
		$selectUser ="t2.user_id";
		$getUserWhogetThisCampaign = \DB::table('offer_settings')
		->select(\DB::raw($selectUser))
		->join('users_offer_2_get_schedules as t2','t2.offer_id','=','offer_settings.id')
		->where('offer_settings.id','=',$product_id)
		->get();
		if(!empty($getUserWhogetThisCampaign ))
		{
			$dd = array();
			foreach ($getUserWhogetThisCampaign as $keys => $datass) 
			{
				$dd[] = $datass->user_id;	
			}
			
			$user_who_claimedThiscampaign =($dd);
		}
		
		
		//*** ****//
		#######################################
		
		
		
		### 
		/* step 2)
		/* search all campaign related to you and others */
		###
		
		$selectCampaign ="users_offer_2_get_schedules.offer_id";
		$getCampaign_claimedbyUser = \DB::table('users_offer_2_get_schedules')
		->select(\DB::raw($selectCampaign))
		->where('users_offer_2_get_schedules.user_id','=',$user_id)
		->get();
		
		$ret = array();
		if(!empty($getCampaign_claimedbyUser ))
		{
			foreach ($getCampaign_claimedbyUser as $key => $datas) 
			{
				
				$selectUser ="t2.user_id";
				$getUser_related = \DB::table('offer_settings')
				->select(\DB::raw($selectUser))
				->join('users_offer_2_get_schedules as t2','t2.offer_id','=','offer_settings.id')
				->where('offer_settings.id','=',$datas->offer_id)
				->get();
				
					$i = 0;
					foreach ($getUser_related as $keyx => $userdata) 
					{
						$retrieve[$i] = $userdata->user_id;
						$i++;
					}
					
					
					$getallCampaign_and_users[$datas->offer_id] = $retrieve;
					$retrieve = array();

			}
		}
		#######################################
		
		
		### 
		/* step 3)
		/*loop and  compare all  data1 and data2 if we have related to each other  and return the result*/
		if(!empty($user_who_claimedThiscampaign ) &&  !empty($getCampaign_claimedbyUser))
		{
			$keys = array_keys($getallCampaign_and_users);
			for($i = 0; $i < count($getallCampaign_and_users); $i++) {
				$keys[$i];
				
				$result_vv = (array_intersect($getallCampaign_and_users[$keys[$i]],$user_who_claimedThiscampaign));
				$final_results = array_values($result_vv);
				
				if(!empty($final_results))
				{
					return 'blocked';
					exit;
					
				}
				
		
			}
		}
		
		return 'proceed';
		#############################
	}
	
	public function CampaignThresholdLogic($campaign_id)
	{
		
		$select ="campaign_thresholds.*";
		$getThreshold = \DB::table('campaign_thresholds')
		->select(\DB::raw($select))
		->where('campaign_thresholds.status','=','active')
		->where('campaign_thresholds.campaign_id','=',$campaign_id)
		->first();
		
		if(!empty($getThreshold))
		{
			 $no_of_allow = $getThreshold->no_of_allow;
			 $list_of_users = $getThreshold->list_of_users;
			  $no_userClaimed = count(explode(',', $list_of_users));
			
			if($no_of_allow >= $no_userClaimed + 1)
			{
				return 'allow';
				exit;
			}
			else
			{
				return "blocked";
				exit;
			}
			
		}
		else
		{
			return "blocked";
			exit;
		}
		
	
	}
	
	
	
}            