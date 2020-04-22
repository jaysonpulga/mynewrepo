<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\offer_settings;
use App\Model\offer_setting_prices;
use App\Model\offer_images;
use App\Model\offer_set_key_primary;
use App\Model\offer_competitors_check_asins;
use App\Model\offer_competitors_steps_dones;
use App\Model\offer_competitor_products;


class ScheduleConfirmUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
	
	
	
	
	function random_date_in_range( $date1, $date2 )
	{
		  // Convert to timetamps
			$min = strtotime($date1);
			$max = strtotime($date2);

			// Generate random number using above bounds
			$val = rand($min, $max);

			// Convert back to desired date format
			return date('m/d/Y H:i:s', $val);
	}
	
	
	function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) 
	{
		$dates = [];
		$current = strtotime( $first );
		$last = strtotime( $last );

		while( $current <= $last ) {

			$dates[] = date( $format, $current );
			$current = strtotime( $step, $current );
		}

		return $dates;
	}
	
	
	
	public function getAvailableSchedule_orderlist($date_unserialize,$offer_id,$start_date,$start_time)
	{
	    $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		$currentdate_str = strtotime($currentdate);
		
		
		

			
		
		foreach($date_unserialize as $newdate)
		{
			$date =  $newdate['date'];
			$required_order_per_day =  $newdate['value'];
			$slot_date_available = "";
		
			 
			$availabledate = trim($date);
			$availabledate = explode('-',$availabledate);
			$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
			  
			//* check if date is available
			$count_numberof_accept = users_offer_2_get_schedules::where('offer_id',$offer_id)
				->where('sched_date',$availabledate)
				->where('is_offer_missed', '!=' , 1)
				->orWhereNull('is_offer_missed')
				->get();

			$count_numberof_accept = $count_numberof_accept->count();
			 
			$availabledate_str = strtotime($availabledate);
			 
			 //echo '<br>';
			 
			 if($currentdate_str <= $availabledate_str)
			 {
				  $availabledate;
				
				 
				 // bilangin ang available na date
				$available_slot = $required_order_per_day - $count_numberof_accept; // bilang nang available na slot
				 //echo "slot per day =  ". $required_order_per_day;
				 //echo "<br>";
				 //echo "available slot =  ". $available_slot; 
				 //echo "<br>";
				 
				  if($required_order_per_day > $count_numberof_accept ) // kunin ang availble na slot date
				  {
						$slot_date_available = $availabledate;
						//echo "available date = ". $slot_date_available = $availabledate;
						//echo "<br>";
						break;
				  }
				  else // ipakita hnd na available ang slot
				  {	
					
						//echo 'sold out ='.$availabledate;
					    //echo "<br>";
				  }
				  
				 
				 
			 }		  
			 else // i display ang lahat na nakalipas na araw ayaw sa date schedule
			 {
				 //echo 'late na ito = '.$availabledate;
				  //echo "<br>";
				 // bilangin ang available na date
				 //$available_slot = $required_order_per_day - $count_numberof_accept;
				 //echo "available slot =  ". $available_slot;
				 //echo "<br>";
			 }
	
		
			
		}
		
	
		if(!empty($slot_date_available))
		{
			$start_date; // araw nang schedule
			$start_date_str = strtotime($start_date);
		
			// check if unang schedule at yung araw na nakasched ay parehas sa available na slot 
			if(($start_date_str == $availabledate_str && $count_numberof_accept == 0))
			{
			
				$slot_date_available =  $slot_date_available.' '.$start_time;
				$return_avaible_sched = date('m/d/Y H:i:s',strtotime($slot_date_available));
			} 
			else // hindi parehas sa araw nang schedule na binigay
			{
					//kunin ang pinaka latest na schedule sa binagay na slot na available
					$latest_shed = \DB::table('users_offer_2_get_schedules')
					->where('offer_id',$offer_id)
					->where('sched_date',$slot_date_available)
					->latest('id')->first();
					
				
					if(!empty($latest_shed)) // may huling record sa available na slot
					{
						$latest_shed  = $latest_shed->sched_date.' '.$latest_shed->sched_time;
						$carbon_date = Carbon::parse($latest_shed);
						$return_avaible_sched = $carbon_date->addMinutes(10);
						$return_avaible_sched = date('m/d/Y H:i:s',strtotime($return_avaible_sched));
						
					}
					else  // gumawa nang bago schedule ayon sa binigay na slot
					{
						$slot_date_available =  $slot_date_available.' '.$start_time="00:00:00";
						$return_avaible_sched = date('m/d/Y H:i:s',strtotime($slot_date_available));
					
						
					}
					
			} 
			
			return $return_avaible_sched;
		
		}
		

			
	}
	
	
	public function getAvailableSchedule_randomlist($offer_duration,$offer_id,$start_date,$start_time)
	{
		
		$campaign_start_date =  $start_date ." ".$start_time;
		$campaign_start_date = date('m/d/Y H:i:s',strtotime($campaign_start_date));
		$second_date = date('m/d/Y H:i:s', strtotime('+ '.$offer_duration.' days', strtotime($campaign_start_date)));
		return $random_date =  $this->random_date_in_range($campaign_start_date, $second_date);
		
	}
	
	
	public function changemyschedule(Request $request)
	{
	    $user_id   =  $request->user()->id;
		$offer_id  =  $request->offer_id;
		
		$val_date  =  $request->val_date;
		$val_time  =  $request->val_time;
		

		
		
		  $users_offer_2_get_schedules = users_offer_2_get_schedules::where('offer_id',$offer_id)->where('user_id',$user_id)
        ->update([
            'sched_date' => $val_date,
            'sched_time' => $val_time,
            ]);
            
        
  
			return json_encode(array('result'=>'save'));     
	    
	}
	
	
	public function getDateConfirmStartNow(Request $request)
	{
	    $user_id   =  $request->user()->id;
		$offer_id  =  $request->offer_id;
		
		$currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);		
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		$timenow = Carbon::now()->format('H:i:s');
		
		
		  $users_offer_2_get_schedules = users_offer_2_get_schedules::where('offer_id',$offer_id)->where('user_id',$user_id)
        ->update([
            'confirm_date' => $currentdate,
            'confirm_time' => $timenow,
            ]);
            
        
            $url=asset("campaign/instruction/offerdetails/".$offer_id);
			return json_encode(array('result'=>'save','url'=>$url));     
	    
	}
	
	public function getDateConfirmToday(Request $request)
	{
		$user_id   =  $request->user()->id;
		$offer_id  =  $request->offer_id;
		$offerdetails = offer_settings::where('id',$offer_id)->first();
		$offer_setting_prices = offer_setting_prices::where('offer_id',$offer_id)->first();
		
		$start_date = $offerdetails->start_date;
		$start_time = $offerdetails->start_time;
		$offer_duration = $offerdetails->offer_duration;
		$offer_daily_order = $offerdetails->offer_daily_order;
		
		
		$select_schdule = $request->select_schdule;
		
		$val_date = $request->val_date;
		$val_time = $request->val_time;
		
		
		 $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);		
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		$timenow = Carbon::now()->format('H:i:s');

		
		//check if user have already have schedule 
		if(users_offer_2_get_schedules::where('user_id',$user_id)->where('offer_id',$offer_id)->where('is_offer_missed', '!=' , 1)->orWhereNull('is_offer_missed')->exists()) 
		{
			$offerdetails = users_offer_2_get_schedules::where('user_id',$user_id)
														->where('offer_id',$offer_id)
														->where('is_offer_missed', '!=' , 1)
														->orWhereNull('is_offer_missed')
														->first();
			$data = array('schedDate'=>$offerdetails->sched_date,'schedtime'=>$offerdetails->sched_time);
			return json_encode(array('result'=>'exist','data'=>$data));
			exit;
		}

		if(!empty($select_schdule))
		{			
			$users_offer_2_get_schedules = new users_offer_2_get_schedules();
			$users_offer_2_get_schedules->offer_id 				 =  $offer_id;
			$users_offer_2_get_schedules->sched_date  			 =  $val_date;
			$users_offer_2_get_schedules->sched_time   			 =  $val_time;
			
			$users_offer_2_get_schedules->confirm_date  		 =  $currentdate;
			$users_offer_2_get_schedules->confirm_time   		 =  $timenow;
			
			$users_offer_2_get_schedules->user_id	  			 =  $user_id;
			$users_offer_2_get_schedules->product_id 			 = $offer_setting_prices->product_id;
			$users_offer_2_get_schedules->product_price 		 = $offer_setting_prices->product_price;
			$users_offer_2_get_schedules->product_discount_label = $offer_setting_prices->product_discount_label;
			$users_offer_2_get_schedules->product_discount 		 = $offer_setting_prices->product_discount;
			$users_offer_2_get_schedules->confirm_status  		 =  0;
			
			if($offerdetails->campaign_type == "fullbuy campaign" )
    		{
    		    $offer_set_key_primary = offer_set_key_primary::where('offer_id',$offer_id)->inRandomOrder()->limit(1)->first();
    		    $users_offer_2_get_schedules->fullbuy_keyword  		 =  $offer_set_key_primary->p_keyword;
    		}
			
			if($offerdetails->campaign_type == "compare campaign")
			{
			    $select_competitors = \DB::table('offer_competitor_products')
        		->select('*')->where('offer_id','=',$offer_id)->get();
        		$select_competitors = offer_competitor_products::where('offer_id','=',$offer_id)->get();
        		
        		foreach($select_competitors as $value){
        		    $offer_competitors_check_asins = new offer_competitors_check_asins();
        		    $offer_competitors_check_asins->user_id                 =   $user_id;
        		    $offer_competitors_check_asins->offer_id                =   $value->offer_id;
        		    $offer_competitors_check_asins->competitor_id           =   $value->id;
        		    $offer_competitors_check_asins->competitor_product_row  =   $value->competitor_product_row;
        		    $offer_competitors_check_asins->product_id              =   $value->product_id;
        		    $offer_competitors_check_asins->verified                =   0;
        		    $offer_competitors_check_asins->addtocart               =   0;
        		    $offer_competitors_check_asins->save();
        		}
        		
        		$offer_competitors_steps_done = new offer_competitors_steps_dones();
        		$offer_competitors_steps_done->offer_id =   $offer_id;
        		$offer_competitors_steps_done->user_id  =   $user_id;
        		$offer_competitors_steps_done->product_check_asin   =   0;
        		$offer_competitors_steps_done->upload_screenshot    =   0;
        		$offer_competitors_steps_done->confirm_main_product =   0;
        		$offer_competitors_steps_done->submit_order_id      =   0;
        		$offer_competitors_steps_done->tracking_number      =   0;
        		$offer_competitors_steps_done->completed_process    =   0;
        		$offer_competitors_steps_done->save();
        		
        		$images = offer_images::where('offer_id',$offer_id)->get();
        		
        		$offer_competitors_check_asins = new offer_competitors_check_asins();
    		    $offer_competitors_check_asins->user_id                 = $user_id;
    		    $offer_competitors_check_asins->offer_id                =   $offer_id;
    		    $offer_competitors_check_asins->competitor_id           =   0;
    		    $offer_competitors_check_asins->competitor_product_row  =   1;
    		    $offer_competitors_check_asins->product_id              =   $offerdetails->product_id;
    		    $offer_competitors_check_asins->verified                =   0;
    		    $offer_competitors_check_asins->addtocart               =   0;
    		    $offer_competitors_check_asins->save();
			}
			
			

			/*
			if($offerdetails->campaign_type == "insight campaign")
			{
				$url = asset("campaign/getdata/insight/offerdetails/".$offer_id."#step-2");
			}
			else if($offerdetails->campaign_type == "insight campaign")
			{
				$url = asset("campaign/getdata/fullbuy/offerdetails/".$offer_id."#step-2");
			}
			else if($offerdetails->campaign_type == "compare campaign")
			{
				$url = asset("campaign/getdata/compare/offerdetails/".$offer_id."#step-2");
			}
			*/
			
			$users_offer_2_get_schedules->save(); 
			$data = array('schedDate'=>$val_date,'schedtime'=>$val_time);
			
			$url=asset("campaign/instruction/offerdetails/".$offer_id."#step-2");
			return json_encode(array('result'=>'save','url'=>$url,'data'=>$data)); 

		}
		else
		{
			return json_encode(array('result'=>'no_schedule_available','data'=>[],)); 

		}
		
	}
	
	
	
	public function getDateSchedule(Request $request)
	{
		$user_id   =  $request->user()->id;
		$offer_id  =  $request->offer_id;
		$offerdetails = offer_settings::where('id',$offer_id)->first();
		$offer_setting_prices = offer_setting_prices::where('offer_id',$offer_id)->first();
		
		$start_date = $offerdetails->start_date;
		$start_time = $offerdetails->start_time;
		$offer_duration = $offerdetails->offer_duration;
		$offer_daily_order = $offerdetails->offer_daily_order;
		
		
		$select_schdule = $request->select_schdule;
		
		$val_date = $request->val_date;
		$val_time = $request->val_time;
		
		
		 $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);		
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		$timenow = Carbon::now()->format('H:i:s');

		
		//check if user have already have schedule 
		if(users_offer_2_get_schedules::where('user_id',$user_id)->where('offer_id',$offer_id)->where('is_offer_missed', '!=' , 1)->orWhereNull('is_offer_missed')->exists()) 
		{
			$offerdetails = users_offer_2_get_schedules::where('user_id',$user_id)
														->where('offer_id',$offer_id)
														->where('is_offer_missed', '!=' , 1)
														->orWhereNull('is_offer_missed')
														->first();
			$data = array('schedDate'=>$offerdetails->sched_date,'schedtime'=>$offerdetails->sched_time);
			return json_encode(array('result'=>'exist','data'=>$data));
			exit;
		}

		if(!empty($select_schdule))
		{			
			$users_offer_2_get_schedules = new users_offer_2_get_schedules();
			$users_offer_2_get_schedules->offer_id 				 =  $offer_id;
			$users_offer_2_get_schedules->sched_date  			 =  $val_date;
			$users_offer_2_get_schedules->sched_time   			 =  $val_time;
			
			$users_offer_2_get_schedules->confirm_date  		 =  '';
			$users_offer_2_get_schedules->confirm_time   		 =  '';
			
			$users_offer_2_get_schedules->user_id	  			 =  $user_id;
			$users_offer_2_get_schedules->product_id 			 = $offer_setting_prices->product_id;
			$users_offer_2_get_schedules->product_price 		 = $offer_setting_prices->product_price;
			$users_offer_2_get_schedules->product_discount_label = $offer_setting_prices->product_discount_label;
			$users_offer_2_get_schedules->product_discount 		 = $offer_setting_prices->product_discount;
			$users_offer_2_get_schedules->confirm_status  		 =  0;
			
			if($offerdetails->campaign_type == "fullbuy campaign" )
    		{
    		    $offer_set_key_primary = offer_set_key_primary::where('offer_id',$offer_id)->inRandomOrder()->limit(1)->first();
    		    $users_offer_2_get_schedules->fullbuy_keyword  		 =  $offer_set_key_primary->p_keyword;
    		}
			
			if($offerdetails->campaign_type == "compare campaign")
			{
			    $select_competitors = \DB::table('offer_competitor_products')
        		->select('*')->where('offer_id','=',$offer_id)->get();
        		$select_competitors = offer_competitor_products::where('offer_id','=',$offer_id)->get();
        		
        		foreach($select_competitors as $value){
        		    $offer_competitors_check_asins = new offer_competitors_check_asins();
        		    $offer_competitors_check_asins->user_id                 =   $user_id;
        		    $offer_competitors_check_asins->offer_id                =   $value->offer_id;
        		    $offer_competitors_check_asins->competitor_id           =   $value->id;
        		    $offer_competitors_check_asins->competitor_product_row  =   $value->competitor_product_row;
        		    $offer_competitors_check_asins->product_id              =   $value->product_id;
        		    $offer_competitors_check_asins->verified                =   0;
        		    $offer_competitors_check_asins->addtocart               =   0;
        		    $offer_competitors_check_asins->save();
        		}
        		
        		$offer_competitors_steps_done = new offer_competitors_steps_dones();
        		$offer_competitors_steps_done->offer_id =   $offer_id;
        		$offer_competitors_steps_done->user_id  =   $user_id;
        		$offer_competitors_steps_done->product_check_asin   =   0;
        		$offer_competitors_steps_done->upload_screenshot    =   0;
        		$offer_competitors_steps_done->confirm_main_product =   0;
        		$offer_competitors_steps_done->submit_order_id      =   0;
        		$offer_competitors_steps_done->tracking_number      =   0;
        		$offer_competitors_steps_done->completed_process    =   0;
        		$offer_competitors_steps_done->save();
        		
        		$images = offer_images::where('offer_id',$offer_id)->get();
        		
        		$offer_competitors_check_asins = new offer_competitors_check_asins();
    		    $offer_competitors_check_asins->user_id                 = $user_id;
    		    $offer_competitors_check_asins->offer_id                =   $offer_id;
    		    $offer_competitors_check_asins->competitor_id           =   0;
    		    $offer_competitors_check_asins->competitor_product_row  =   1;
    		    $offer_competitors_check_asins->product_id              =   $offerdetails->product_id;
    		    $offer_competitors_check_asins->verified                =   0;
    		    $offer_competitors_check_asins->addtocart               =   0;
    		    $offer_competitors_check_asins->save();
			}
			
			
			$url=asset("campaign/instruction/offerdetails/".$offer_id."#step-2");
			/*
			if($offerdetails->campaign_type == "insight campaign")
			{
				$url = asset("campaign/getdata/insight/offerdetails/".$offer_id."#step-2");
			}
			else if($offerdetails->campaign_type == "insight campaign")
			{
				$url = asset("campaign/getdata/fullbuy/offerdetails/".$offer_id."#step-2");
			}
			else if($offerdetails->campaign_type == "compare campaign")
			{
				$url = asset("campaign/getdata/compare/offerdetails/".$offer_id."#step-2");
			}
			*/
			
			$users_offer_2_get_schedules->save(); 
			$data = array('schedDate'=>$val_date,'schedtime'=>$val_time);
			return json_encode(array('result'=>'save','url'=>$url,'data'=>$data)); 

		}
		else
		{
			return json_encode(array('result'=>'no_schedule_available','data'=>[],)); 

		}
		
	}
	
	
	
	public function getDateConfirm(Request $request)
	{

		$user_id   =  $request->user()->id;
		$offer_id  =  $request->offer_id;
		$offerdetails = offer_settings::where('id',$offer_id)->first();
		$offer_setting_prices = offer_setting_prices::where('offer_id',$offer_id)->first();
		$start_date = $offerdetails->start_date;
		$start_time = $offerdetails->start_time;
		$offer_duration = $offerdetails->offer_duration;
		$offer_daily_order = $offerdetails->offer_daily_order;
		if(users_offer_2_get_schedules::where('user_id',$user_id)->where('offer_id',$offer_id)->where('is_offer_missed', '!=' , 1)->orWhereNull('is_offer_missed')->exists()) 
		{
			$offerdetails = users_offer_2_get_schedules::where('user_id',$user_id)
														->where('offer_id',$offer_id)
														->where('is_offer_missed', '!=' , 1)
														->orWhereNull('is_offer_missed')
														->first();
			$data = array('schedDate'=>$offerdetails->sched_date,'schedtime'=>$offerdetails->sched_time);
			echo json_encode(array('result'=>'exist','data'=>$data));
			exit;
		} 
		if($offerdetails->typeofsale == "order_list")
		{	
			$date_unserialize = unserialize($offer_daily_order);
			$available_date = $this->getAvailableSchedule_orderlist($date_unserialize,$offer_id,$start_date,$start_time);
		}
		else if($offerdetails->typeofsale == "random_list")
		{
			$available_date = $this->getAvailableSchedule_randomlist($offer_duration,$offer_id,$start_date,$start_time);
			$newdate = explode(" ",$available_date);
			$schedDate = $newdate[0];
			$schedtime = $newdate[1];
			//check if random  and time is exist
			$shedData2 = users_offer_2_get_schedules::where('offer_id',$offer_id)
						->where('sched_date',$schedDate)
						->where('sched_time',$schedtime)
						->get();
			if(count($shedData2) > 0)
			{
				echo json_encode(array('result'=>'get_other_shedule'));
				exit;
			}
		}
		if(!empty($available_date))
		{
			$newdate = explode(" ",$available_date);
			$schedDate = $newdate[0];
			$schedtime = $newdate[1];
			
			$users_offer_2_get_schedules = new users_offer_2_get_schedules();
			$users_offer_2_get_schedules->offer_id 				 =  $offer_id;
			$users_offer_2_get_schedules->sched_date  			 =  $schedDate;
			$users_offer_2_get_schedules->sched_time   			 =  $schedtime;
			$users_offer_2_get_schedules->user_id	  			 =  $user_id;
			$users_offer_2_get_schedules->product_id 			 = $offer_setting_prices->product_id;
			$users_offer_2_get_schedules->product_price 		 = $offer_setting_prices->product_price;
			$users_offer_2_get_schedules->product_discount_label = $offer_setting_prices->product_discount_label;
			$users_offer_2_get_schedules->product_discount 		 = $offer_setting_prices->product_discount;
			$users_offer_2_get_schedules->confirm_status  		 =  0;
			$users_offer_2_get_schedules->save(); 
			$data = array('schedDate'=>$schedDate,'schedtime'=>$schedtime);
			
			echo json_encode(array('result'=>'save','data'=>$data)); 
		}
		else
		{
			echo json_encode(array('result'=>'no_schedule_available','data'=>[])); 
		}
		 
	
	}
// 	public function addtocart_getconfirm(Request $request){
// 	    $user_id = $request->user()->id;
// 	    $offer_id = $request->offer_id;
// 	    $schedDate = date('m/d/Y');
// 	    $schedtime = '00:00:00';
// 	    $validation = \DB::table('offer_addtocart_steps_done')
// 	    ->select('*')->where('offer_id',$offer_id)->where('user_id',$user_id)->get();
// 	    if(!empty($validation[0])){
// 	        return array('success' => false);
// 	    }
// 	    $offer_setting_prices = offer_setting_prices::where('offer_id',$offer_id)->first();
// 	    $users_offer_2_get_schedules = new users_offer_2_get_schedules();
// 		$users_offer_2_get_schedules->offer_id 				 =  $offer_id;
// 		$users_offer_2_get_schedules->sched_date  			 =  $schedDate;
// 		$users_offer_2_get_schedules->sched_time   			 =  $schedtime;
// 		$users_offer_2_get_schedules->user_id	  			 =  $user_id;
// 		$users_offer_2_get_schedules->product_id 			 = $offer_setting_prices->product_id;
// 		$users_offer_2_get_schedules->product_price 		 = $offer_setting_prices->product_price;
// 		$users_offer_2_get_schedules->product_discount_label = $offer_setting_prices->product_discount_label;
// 		$users_offer_2_get_schedules->product_discount 		 = $offer_setting_prices->product_discount;
// 		$users_offer_2_get_schedules->addtocart_keyword 	 = '';
// 		$users_offer_2_get_schedules->confirm_status  		 =  0;
// 		$users_offer_2_get_schedules->save(); 
// 		\DB::table('offer_addtocart_check_asins')
// 		->insert([['offer_id' => $offer_id,'user_id' => $user_id,'product_id' => $offer_setting_prices->product_id,'verified' => 0]]);
// 		\DB::table('offer_addtocart_steps_done')
// 		->insert([['offer_id' => $offer_id,'user_id' => $user_id,'step1' => 0, 'step3' => 0]]);
// 		return array('success' => true);
// 	}
	
	
	public function update_new_schedule(Request $request)
	{
		
		$offer_id = $request->offer_id;
		$id 	  = $request->id;
		$user_id  =  $request->user()->id;
		
		//check if user have already have schedule 
		if(users_offer_2_get_schedules::where('user_id',$user_id)->where('offer_id',$offer_id)->where('id',$id)->exists()) 
		{	
				
			users_offer_2_get_schedules::where('user_id',$user_id)->where('offer_id',$offer_id)->where('id',$id)->update([
				'is_old_sched'  => 1,
			]);
		
		} 
	}
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\users_offer_2_get_schedules  $users_offer_2_get_schedules
     * @return \Illuminate\Http\Response
     */
    public function show(users_offer_2_get_schedules $users_offer_2_get_schedules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\users_offer_2_get_schedules  $users_offer_2_get_schedules
     * @return \Illuminate\Http\Response
     */
    public function edit(users_offer_2_get_schedules $users_offer_2_get_schedules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\users_offer_2_get_schedules  $users_offer_2_get_schedules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, users_offer_2_get_schedules $users_offer_2_get_schedules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\users_offer_2_get_schedules  $users_offer_2_get_schedules
     * @return \Illuminate\Http\Response
     */
    public function destroy(users_offer_2_get_schedules $users_offer_2_get_schedules)
    {
        //
    }
}
