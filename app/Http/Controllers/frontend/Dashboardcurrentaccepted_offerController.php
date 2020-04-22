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



class Dashboardcurrentaccepted_offerController extends Controller
{
	
	protected $notificationsController;
	protected $OfferTrackingReturnProductsController;
	
	
	
	public function __construct(NotificationsController $notificationsController,OfferTrackingReturnProductsController $OfferTrackingReturnProductsController)
    {
		$this->middleware('auth');
		$this->notificationsController = $notificationsController;
		$this->OfferTrackingReturnProductsController = $OfferTrackingReturnProductsController;
    }


	public function currentacceptedoffer(Request $request)
	{
		
		$id =  $request->user()->id;
		$menudata =  $request->menudata;
		$group_category =  $request->group_category;
		
		$schedule_user  = "schedule.sched_date as sched_date,schedule.is_done";
		
		$select ="offer_settings.*,stat.offer_status,$schedule_user";
		
		$sqlData = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_status as stat','stat.id','=','offer_settings.status')
		->leftJoin('users_offer_2_get_schedules as schedule', function($sqlData) use ($id)   
		{
			$sqlData->on('offer_settings.id', '=', 'schedule.offer_id');
			$sqlData->on('schedule.user_id','=',\DB::raw("'$id'"));
			//$sqlData->on('schedule.confirm_status','=',\DB::raw("'1'"));
			$sqlData->on('schedule.is_offer_missed','=',\DB::raw("'0'"));

			
		})
		->where('offer_settings.campaign_type','!=','gig')
		->where('schedule.user_id', '=', $id)
		->whereNotExists( function ($query) use ($id) 
		{
			$query->select(\DB::raw(1))
			
			->from('users_offer_5_completeds')
			->whereRaw("offer_settings.id = users_offer_5_completeds.offer_id")
			->where('users_offer_5_completeds.user_id', '=' ,$id);
					

		})
		->whereNotExists( function ($query) use ($id) 
		{
			$query->select(\DB::raw(1))
			
			->from('user_offer_denies')
			->whereRaw('offer_settings.id = user_offer_denies.offer_id')
			->where('user_offer_denies.user_id', '=', $id);

		})
		->get();
		
		$events = array();
		$result = array();
		$sched_array = array();
		if(!empty($sqlData))
		{
			foreach($sqlData as $row) 
			{
				
				
				$imageData = \DB::table('offer_images')
				->select(\DB::raw('*'))
				->where('offer_id', $row->id)
				->get();
				
				
				if($row->campaign_type == "addtocart campaign")
				{
					$link = asset("campaign/getdata/addtocart/offerdetails/".$row->id);
				}
				
				else if($row->campaign_type == "insight campaign")
				{
					$link = asset("campaign/instruction/offerdetails/".$row->id);
				}
				
				else if($row->campaign_type == "compare campaign")
				{
					$link = asset("campaign/getdata/compare/offerdetails/".$row->id);
				}
				
				else if($row->campaign_type == "fullbuy campaign")
				{
					$link = asset("campaign/instruction/offerdetails/".$row->id);
				}
				
				
				$sched_array['link'] = '';
				
				
				
				
				
				//converty stdclass object into array form
				$row2 = json_decode(json_encode($row),true);
				//merger to array
				$result = array_merge($sched_array,$row2);
				
				
				$data_link='';
				// check the current status of campaign 
				
			   $user_purchase = users_offer_purchase_products::where('offer_id',$row->id)->where('user_id', $id)->first();
			   $users_offer_2_get_schedules = users_offer_2_get_schedules::where('offer_id',$row->id)->where('user_id', $id)->first();
			    
			    if(empty($users_offer_2_get_schedules->confirm_date) && empty($users_offer_2_get_schedules->confirm_date))
				{
				     $currentdate = Carbon::now();
            		// pag format sa current date m/d/Y format
            		$currentdate =	$currentdate->toDateString(); 
            		$currentdate = explode('-',$currentdate);
            		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
            		
            		$day ="";
            		
            		if(strtotime($currentdate) == strtotime($row->sched_date) )
            		{
            		    $day = "Today";
            		}
            		else
            		{
            		     $day =  Carbon::parse($row->sched_date)->format('F d, Y'); 
            		}
				    
				    $url_link = "campaign/getdata/continue/productdetails/".$row->id;
				    $eventsArray['action']  = 'schedule_campaign';
					$eventsArray['action_status']  = "Buy product on amazon on ".$day; 
					$eventsArray['action_button']  = "<a href=".$url_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Purchase Product</span></div></a>"; 
					$eventsArray['action_id']  = '1';
				    
				}
			    else if(empty($user_purchase))
				{
					$data_link = $link.'#step-2';
					
					$eventsArray['action']  = 'schedule_campaign';
					$eventsArray['action_status']  = "Continue to Purchase Product"; 
					$eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Proceed this campaign</span></div></a>"; 
					$eventsArray['action_id']  = '1';
					
					
					if($row->campaign_type == "compare campaign"){
					    $eventsArray['action_status']  = "Compare Product on ".Carbon::parse($row->sched_date)->format('F d, Y');
					    $eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Compare Product</span></div></a>";
					}
					
					
				}
				
				else if(@$user_purchase->step1 == 0 || @$user_purchase->step2 == 0 || @$user_purchase->step3 == 0 || @$user_purchase->step4 == 0 || @$user_purchase->step5 == 0 || $user_purchase->step6 == 0)
				{
					$data_link = $link.'#step-2';
					
					$eventsArray['action']  = 'schedule_campaign';
					$eventsArray['action_status']  = "Buy product on amazon on ".Carbon::parse($row->sched_date)->format('F d, Y'); 
					$eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Purchase Product</span></div></a>"; 
					$eventsArray['action_id']  = '1';
					
					
				}
				
				else if($this->check_if_tracking_submitted($row->id,$id) == false)
				{
						$data_link = $link.'#step-3';
						$eventsArray['action']  = 'verify product';
						$eventsArray['action_status']  = 'verify tracking purchase status';
						$eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Verify tracking</span></div></a>";
				        $eventsArray['action_id']  = '2';
				    
				}
				
				/* 
				else if($this->checking_purchase_review_question($row->id,$id) == false)
				{
						$eventsArray['action']  = 'leave review';
						$eventsArray['action_status']  = 'Leave review on  purchase experience';
				} 
				*/
				
				else if($this->checking_amazon_review_question($row->id,$id) == false)
				{
						$data_link = $link.'#step-4';
						$eventsArray['action']  = 'leave review';
						$eventsArray['action_status']  = 'Leave review on  purchase experience';
						$eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Product Leave Review</span></div></a>";
				        $eventsArray['action_id']  = '3';
				    
				} 
				
				else 
				{
					
						$data_link = $link.'#step-5';
						$eventsArray['action']  = 'process completed';
						$eventsArray['action_status']  = 'process completed';
						$eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Product completed offer</span></div></a>";
				        $eventsArray['action_id']  = '4';
				    
				} 
				
				
				
				
				if($row->campaign_type == "compare campaign"){
				    @$compare_steps_done = \DB::table('offer_competitors_steps_dones')
				    ->select("*")->where('offer_id','=',$row->id)->where('user_id','=',$id)->get();
				    if(@$compare_steps_done[0]->product_check_asin == 0)
				    {
				        $data_link = $link.'#step-2';
    				    $eventsArray['action_status']  = "Compare Product on ".Carbon::parse($row->sched_date)->format('F d, Y');
    				    $eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Compare Product</span></div></a>";
				    }
				    else if(@$compare_steps_done[0]->upload_screenshot == 0 || @$compare_steps_done[0]->confirm_main_product == 0){
				        $data_link = asset('campaign/offerdetails/finish/'.$row->id);
				        if(@$compare_steps_done[0]->upload_screenshot == 0 ){
				            $eventsArray['action_status']  = "Upload ScreenShot !";
				        }else{
				            $eventsArray['action_status']  = "Confirm Main Product !";
				        }
    				    $eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Compare Product</span></div></a>";
				    }else if(@$compare_steps_done[0]->submit_order_id == 0){
				        $data_link = asset('campaign/offerdetails/thankyou/'.$row->id);
    				    $eventsArray['action_status']  = "Submit Amazon Order ID !";
    				    $eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Compare Product</span></div></a>";
				    }
				    else if(@$compare_steps_done[0]->tracking_number == 0){
				        $data_link = asset('campaign/compare/tracking_number/'.$row->id);
				        $check_tracking_number = \DB::table('users_offer_4_submit_tracking_numbers')->where('offer_id',$row->id)->where('user_id',$id)->get();
				        if(empty($check_tracking_number[0])){
        				    $eventsArray['action_status']  = "Verifying tracking number";
        				    $eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Verifying</span></div></a>";
				        }else{
				            $eventsArray['action_status']  = "Verified tracking number";
        				    $eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Verified</span></div></a>";
				        }
				    }
				    else{
				        $data_link = asset('campaign/thankyou/done/'.$row->id);
    				    $eventsArray['action_status']  = "Completed this offer";
    				    $eventsArray['action_button']  = "<a href=".$data_link."><div class='pull-right button_c'><span class='label label-success' style='font-size:12px'>Compare Product Completed Offer</span></div></a>";
				    }
				}
				
				
				
				//check if notif 
        		if(user_dashboard_notifications::where('offer_id',$row->id)->where('user_id',$id)->where('user_id',$id)->exists())
        		{
        		
        			
        			
        		
        			
            	
            	}
            	else
            	{
            			
            		
            			
            		 	$user_dashboard_notifications = new user_dashboard_notifications();
            			$user_dashboard_notifications->offer_id 		  =  $row->id;
            			$user_dashboard_notifications->notif_id 		  =  $eventsArray['action_id'];
            			$user_dashboard_notifications->user_id  		  =  $id;
            			$user_dashboard_notifications->action_status      =  $eventsArray['action_status'];
            			$user_dashboard_notifications->notif_status       =  0;
            			$user_dashboard_notifications->save(); 
            		
            
            	}
    		
			
		
				$eventsArray['test']  = $this->check_if_tracking_submitted($row->id,$id);
				$eventsArray['campaign_data']  = $result;					
				$eventsArray['image_path'] 	   =  $imageData;
				$eventsArray['user_purchase'] 	   =  $user_purchase;
			

				$events[] = $eventsArray;	
				
			}
			
			

			 
		}
		
		
		return  $events;	
		
	 
	}
	
	
	
	public static function check_if_tracking_submitted($offer_id,$user_id)
	{
		
			//if exist tracking_number
			if(users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
			{
				
				$data = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->first();
				
				// check if tracking number is not yet delivered
				if($data->remarks != "Delivered")
				{
					$eventsArray  = false;
				}
				else if($data->remarks == "Delivered")
				{
					$eventsArray  = true;
				}
	
			}
			else
			{
				$eventsArray  = false;
			}
		
			return $eventsArray;
			
		
	}
	
	public static function checking_amazon_review_question($offer_id,$user_id)
	{
		//if exist tracking_number
		if(amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			$eventsArray  = true;
		}
		else
		{
			$eventsArray  = false;
		}
	
		return $eventsArray;
		
	}
	

}