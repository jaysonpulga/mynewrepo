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

use App\Http\Controllers\frontend\UserVccController;
use App\Model\frontend\users_offer_purchase_products;
use App\Model\frontend\users_offer_purchase_check_asins;
use App\Model\frontend\users_offer_purchase_4rt_steps;
use App\Model\frontend\users_offer_purchase_5th_steps;
use App\Model\frontend\users_offer_purchase_6th_steps;
use App\Model\frontend\user_rebate_transaction;
use App\Model\frontend\user_offer_denies;



class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $UserVccController;
	protected $notificationsController;
	protected $OfferTrackingReturnProductsController;
	
	
	
	public function __construct(UserVccController $UserVccController,NotificationsController $notificationsController,OfferTrackingReturnProductsController $OfferTrackingReturnProductsController)
    {
        $this->UserVccController = $UserVccController;
		$this->middleware('auth');
		$this->notificationsController = $notificationsController;
		$this->OfferTrackingReturnProductsController = $OfferTrackingReturnProductsController;
    }
	
	
	 public function index(Request $request)
    {
		
		 $id =  $request->user()->id;
		 $interest = Auth::user()->interest;
		
		 $verification_status = Auth::user()->verification_status;
		 $verification_date = Auth::user()->verification_date;
		 
		 $messenger = \DB::table('social_facebook_psid_users')
		 ->select('id')
		 ->where([['user_id','=',$id],['status','=','verified']])
		 ->get();
		 
		 $paypal = \DB::table('users_a_paypal_statuses')
		 ->select('id')
		 ->where([['user_id','=',$id],['paypal_email_status','=','verified']])
		 ->get();
		 
		 $whitelist = \DB::table('users')
		 ->select('id')
		 ->where([['whitelist','=',1],['id','=',$id]])
		 ->get();
	

		
		if($verification_status == 0 )
		{
		    return view('frontend.verifymyemail',['messenger' => $messenger,'paypal' => $paypal, 'whitelist' => $whitelist , 'verification_status' => $verification_status ]);
		    exit;
		}
		
		$featured_offer = users_offer_1_sent_campaigns::where('user_id',$id)->get();
		$featured_offer = count($featured_offer);
		
		$current_offer = users_offer_2_get_schedules::where('user_id',$id)->get();
		$current_offer = count($current_offer);
		
		//return view('frontend.offer_current',array('user_countoffer'=>$user_countoffer, 'campaign_offer' =>  $campaign_offer));
		
		
			$new_price  = "price.product_price as new_product_price";
			$new_price .= ",price.product_discount_label as new_product_discount_label";
			$new_price .= ",price.product_discount as new_product_discount";
			
			
			$data_user = User::where('id',$id)->first();
			$ineterst_val = explode("|", $interest); 
			
			/*
			 $sqlData = \DB::table('offer_settings')->whereIn('group_interest',$ineterst_val)->get();
			
            	foreach($sqlData as $dd)
            	{
            	    echo $dd->Title;
            	    echo '<br>';
            	}
    		*/
	
			
			//print_r($ineterst_val);
			//exit;
			
		
			/*
			$user_price  = "schedule.product_id as user_product_id";
			$user_price .= ",schedule.product_price as user_product_price";
			$user_price .= ",schedule.product_discount_label as user_product_discount_label";
			$user_price .= ",schedule.product_discount as user_product_discount";
			*/
			
			
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
				->orderBy('t2.created_at', 'DESC')
				->get();
		
		

		return view('frontend.offer_dashboard',array('featured_offer'=>count($sqlData), 'current_offer' => $current_offer ) );
		
	}
	
	public function campaign_addtocart(Request $request,$id='')
	{
	    $user_id = $request->user()->id;
	    @$offer_img = \DB::table('offer_images')
	    ->select('*')
	    ->where('offer_id','=',$id)
	    ->get();
	    @$keyword = \DB::table('users_offer_2_get_schedules')
	    ->select('addtocart_keyword')->where('offer_id','=',$id)->where('user_id','=',$user_id)->get();
	    @$ASIn = \DB::table('offer_addtocart_check_asins')
	    ->select('*')->where('offer_id','=',$id)->where('user_id','=',$user_id)->get();
	    @$steps_done = \DB::table('offer_addtocart_steps_done')
	    ->select('*')->where('offer_id','=',$id)->where('user_id','=',$user_id)->get();
	    
	    return view('frontend.addtocart_productdetails',['offer_id' => $id,'images' => @$offer_img[0]->image_path,'keyword' => @$keyword[0]->addtocart_keyword,'ASIN' => @$ASIn,'steps_done' => @$steps_done]);
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
	

	public function campaign_compare_productdetails(Request $request,$id='')
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
		
	
		return view('frontend.productdetails_compare',array('images'=>$images,'offerdetails'=>$offerdetails,'last_date_offer'=>$datexxx,'GetTotalAvailableSchedule'=>$this->GetTotalAvailableSchedule($id)));	
	}
	
	
	
	
	
	
	public function congrats_site()
	{
		return view('frontend.congrats_site');
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify_account(Request $request)
    {
        $user_id = $request->user()->id;
        $messenger_code = $request->messenger;
        $whitelist = $request->whitelist;
        $paypal = $request->paypal;
        @$check_messenger_code = \DB::table('social_facebook_psid_users')
        ->select('*')
        ->where('subscriber_id','=',$messenger_code)
        ->get();
        if($whitelist != ''){
            $save = \DB::table('users')
            ->where('id','=',$user_id)
            ->update(['verification_status' => 1,
            'verification_date' => date('Y-m-d H:i:s'),
            'whitelist' => $whitelist]);
        }
        if($paypal != ''){
            $save = \DB::table('users_a_paypal_statuses')
            ->insert([['user_id' => $user_id,
            'paypal_email' => $paypal,
            'paypal_email_status' => 'verified',
            'active' => 1,
            'date_verified' => date('Y-m-d H:i:s')]]);
        }
        
        if($messenger_code != ''){
            if(@$check_messenger_code[0] != null){
                $save =\DB::table('social_facebook_psid_users')
                ->where('subscriber_id','=',$messenger_code)
                ->update(['status' => 'verified',
                'verified_date' => date('Y-m-d H:i:s'),
                'user_id' => $user_id]);
                //return json_encode(['success' => true,'message' => 'Verification Successfully Updated']);
            }else{
                //return json_encode(['success' => false,'message' => 'Incorrect Verification Code']);
            }
        }
        return json_encode(['success' => true,'message' => 'Verification Successfully Updated']);
        
        
    }
    
    
   
	public static function getWalletAmount()
	{
	    @$user = Auth::user();
		@$user_id = $user->id;
	    @$wallet = \DB::table('user_rebate_transactions')
	    ->select(\DB::raw('SUM(amount) as total'))
	    ->where([['user_id','=',$user_id],['status','=','unpaid']])
	    ->get();
	    if($wallet[0]->total == ''){
	        return '0.00';
	    }else{
	        return $wallet[0]->total;
	    }
	}
	 public function index2(Request $request)
    {
		
		$id =  $request->user()->id;
		$sent_campaign = users_offer_1_sent_campaigns::where('user_id',$id)->get();
		$user_countoffer = count($sent_campaign);
		
		$campaign_offer = users_offer_3_continue_accepts::where('user_id',$id)->get();
		$campaign_offer = count($campaign_offer);
		
		//return view('frontend.offer_current',array('user_countoffer'=>$user_countoffer, 'campaign_offer' =>  $campaign_offer));
		
		//return view('frontend.offer_dashboard',array('user_countoffer'=>$user_countoffer, 'campaign_offer' =>  $campaign_offer));
	}
	
	
	
	public function acceptedofferpage(Request $request)
    {
		return view('frontend.offer_accepted');
	}
	
	public function offerdetails(Request $request,$id="")
	{
		$offerdetails = offer_settings::where('id',$id)->get();
		$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
		
		return view('offerdetails',array('offerdetails'=>$offerdetails,'amazonreview'=>$amazonreview,'purchare_review_questions'=>$purchare_review_questions));	
	}
	
	

	
	public function viewofferdetails(Request $request,$id="")
	{
		$offerdetails = offer_settings::where('id',$id)->get();
		//$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		//$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
		
		return view('viewofferdetails',array('offerdetails'=>$offerdetails));	
	}
	
	
	

	
	public function saveAnswer(Request $request)
	{
		
		$id =  $request->user()->id;
		
		foreach($request->answersproductList as $product)
		{
			
			$purchare_review_answers = new purchare_review_answers();
			$purchare_review_answers->offer_id		=  $request->offerid;
			$purchare_review_answers->user_id 		=  $id;
			$purchare_review_answers->questionId 	=  $product['questionId'];
			$purchare_review_answers->form 			=  $product['fieldtype'];
			$purchare_review_answers->answer 		=  $product['answer'];
			$purchare_review_answers->save(); 
			
		}
		
		foreach($request->answersamazonList as $amazondata)
		{
		
			
			$amazon_review_answers = new amazon_review_answers();
			$amazon_review_answers->offer_id		=  $request->offerid;
			$amazon_review_answers->user_id 		=  $id;
			$amazon_review_answers->questionId 		=  $amazondata['questionId'];
			$amazon_review_answers->form 			=  $amazondata['fieldtype'];
			$amazon_review_answers->answer 			=  $amazondata['answer'];
			$amazon_review_answers->save();
			
		}
		
		/* 		
		$offer_completed = new offer_completed();
		$offer_completed->offer_id		=  $request->offerid;
		$offer_completed->user_id 		=  $id;
		$offer_completed->save();
		 */
		
		return response()->json(array('success' => 'success'));
		
	}
	
	
	public function canceloffer(Request $request)
	{
		

		offer_accept::where('offer_id',$request->offerid)->update([
			'cancel_offer'		=> 1,
			'cancel_date' 		=> date('Y-m-d H:i:s'),
		]);
		return response()->json(array('success' => 'success'));
	}
	
	
	public function offerdetails_byid($id)
	{
		echo $id;
	}
	
	
	
	public function currentoffer_old632019(Request $request)
	{
			$id =  $request->user()->id;
			$menudata =  $request->menudata;
			$group_category =  $request->group_category;
		
			$new_price  = "price.product_price as new_product_price";
			$new_price .= ",price.product_discount_label as new_product_discount_label";
			$new_price .= ",price.product_discount as new_product_discount";
			
		
			/*
			$user_price  = "schedule.product_id as user_product_id";
			$user_price .= ",schedule.product_price as user_product_price";
			$user_price .= ",schedule.product_discount_label as user_product_discount_label";
			$user_price .= ",schedule.product_discount as user_product_discount";
			*/
			
			
			$select = "offer_settings.*,$new_price,stat.offer_status";

		
			 $sqlData = \DB::table('offer_settings')

				->select(\DB::raw($select))
				->join('users_offer_1_sent_campaigns as t2','t2.offer_id','=','offer_settings.id')
				->join('offer_status as stat','stat.id','=','offer_settings.status')		
				/* 
				->leftJoin('users_offer_2_get_schedules as schedule', function($sqlData) use ($id)   
				{
					$sqlData->on('offer_settings.id', '=', 'schedule.offer_id');
					$sqlData->on('schedule.user_id','=',\DB::raw("'$id'"));
					
				}) 
				*/
				
				
				->leftJoin('offer_setting_prices as price', function($sqlData) 
				{
					$sqlData->on('offer_settings.id', '=', 'price.offer_id');
					$sqlData->on('price.product_id', '=', 'offer_settings.product_id');
					$sqlData->on('price.status','=',\DB::raw("'active'"));
				})
				
				->where('t2.user_id', '=', $id)
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
				->orderBy('t2.created_at', 'DESC')
				//->groupBy('img.offer_id')
				->get(); 
				
			$datetoday = Carbon::now()->format('m/d/Y H:i:s');
			$ddyesterday = Carbon::yesterday()->format('m/d/Y');
			$timenow = Carbon::now()->format('H:i:s');
			
			
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
					
					$schedule_offer = \DB::table('users_offer_2_get_schedules')
					->select(\DB::raw('*'))
					->where('offer_id', $row->id)
					->where('user_id', $id)
					->where('is_old_sched', '!=' , 1)
					->first();
					
					if(!empty($schedule_offer))
					{
						
						$schedule = $schedule_offer->sched_date.' '.$schedule_offer->sched_time;
						$yesterdayPattern = $ddyesterday.' '.$timenow;
						
						//$yesterdayreadble = $ddyesterday.' '.$schedule_offer->sched_time;
						
						
						$humandate = Carbon::parse($schedule)->format('F d, Y H:i:A');
						
						
						$untilvalidDate = date('m/d/Y H:i:s',strtotime($schedule . "+1 days"));
						
						$humadate_untilvalid = Carbon::parse($untilvalidDate)->format('F d, Y H:i:A');
						
						if($datetoday >= $schedule )
						{
							
							if($yesterdayPattern >= $schedule)
							{
								$sched_array['status_message'] = '<div style="color:white;font-size:12px;background-color:#e26858;line-height:1.6;padding:2px;border:3px solid #ca4838;" ><span>You have missed your schedule offer, would you like to get another schedule? <br><center><button onclick="getothershed('.$schedule_offer->id.','.$schedule_offer->offer_id.')" type="button" class="btn  btn-success">get another schedule</button></center></span></div><br>';
								$sched_array['button_action'] = "disabled_continue";
							}
							else
							{
								$sched_array['status_message'] = '<div style="color:white;font-size:12px;background-color:#2c962c;line-height:1.6;padding:5px" ><span>The offer is ready please click continue to proceed the transaction </span></div><br>';
								$sched_array['status_message'] .= '<div style="color:#000;font-size:13px;line-height:1.6;padding:5px;border-style: dashed;" ><i class="fa fa-fw fa-info-circle"></i><span>Note: schedule offer is valid within 24 hours, the expiration date is '.$humadate_untilvalid.' </span></div>';
								$sched_array['button_action'] = "enabled_continue";
							}

						}
						else
						{
							$sched_array['status_message'] = '<div style="color:white;font-size:12px;background-color:#3c99d0;line-height:1.6;padding:5px;" ><span>Your schedule to continue this offer  will be on '.$humandate.' </span></div>';
							$sched_array['button_action'] = "enabled_continue";
						}
						
					
						
						//converty stdclass object into array form
						$schedule_offer22 = json_decode(json_encode($schedule_offer),true);
						//merger to array
						$result = array_merge($sched_array,$schedule_offer22);
					}
					else
					{
						$result = null;
					}
					
					$eventsArray['campaign_data']  = $row;					
					$eventsArray['image_path'] 	   =  $imageData;
					$eventsArray['schedule_offer'] =  $result;					

					$events[] = $eventsArray;	
					
				}
					
				
			}
		
		
		return $events;
		
	}
	
	
	
	
	public function acceptedoffer_old632019(Request $request)
	{
		$id =  $request->user()->id;
		$menudata =  $request->menudata;
		$group_category =  $request->group_category;
		
		/* 
		$offerdata = offer_settings::getAcceptedOffer($id,$menudata,$group_category);
		return $offerdata;
		*/
		
		/*
		$product  = "(SELECT product_id FROM users_offer_2_get_schedules  WHERE offer_id = offer_settings.id AND user_id = ".$id.") as user_product_id";
		$product  .= ",(SELECT product_price FROM users_offer_2_get_schedules  WHERE offer_id = offer_settings.id AND user_id = ".$id.") as user_product_price";
		$product  .= ",(SELECT product_discount_label FROM users_offer_2_get_schedules  WHERE offer_id = offer_settings.id AND user_id = ".$id.") as user_product_discount_label";
		$product  .= ",(SELECT product_discount FROM users_offer_2_get_schedules  WHERE offer_id = offer_settings.id AND user_id = ".$id.") as user_product_discount";
		*/	
		
		$user_price  = "schedule.product_id as user_product_id";
		$user_price .= ",schedule.product_price as user_product_price";
		$user_price .= ",schedule.product_discount_label as user_product_discount_label";
		$user_price .= ",schedule.product_discount as user_product_discount";
			
		
		$select ="offer_settings.*,$user_price,(SELECT status FROM users_offer_5_completeds WHERE offer_id = offer_settings.id  AND user_id = ".$id." ) as status,stat.offer_status";
		
		$sqlData = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('users_offer_3_continue_accepts as t2','t2.offer_id','=','offer_settings.id')
		->join('offer_status as stat','stat.id','=','offer_settings.status')			
		->leftJoin('users_offer_2_get_schedules as schedule', function($sqlData) use ($id)   
		{
			$sqlData->on('offer_settings.id', '=', 'schedule.offer_id');
			$sqlData->on('schedule.user_id','=',\DB::raw("'$id'"));
			$sqlData->on('schedule.confirm_status','=',\DB::raw("'1'"));
			$sqlData->on('schedule.is_offer_missed','=',\DB::raw("'0'"));
			
		}) 
		->where('t2.user_id', '=', $id)
		->where('t2.cancel_offer', '!=', 1)
		->when(!empty($menudata), function ($res) use ($menudata)  {
					return $res->where('offer_settings.campaign_type','=',$menudata);
		})
		->when(!empty($group_category), function ($sqlData) use ($group_category)  {
					return $sqlData->where('offer_settings.group_interest','=',$group_category);
		})
		->whereNotExists( function ($query) use ($id) 
			{
				$query->select(\DB::raw(1))
				
				->from('users_offer_5_completeds')
				->whereRaw('offer_settings.id = users_offer_5_completeds.offer_id')
				->where('users_offer_5_completeds.admin_approved', '=', '1')
				->where('users_offer_5_completeds.user_id', '=', $id);

			}
		)
		->orderBy('t2.created_at', 'DESC')
		->get();
		
		//return 	$res;
		
		
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
					$link = asset("campaign/getdata/insight/offerdetails/".$row->id);
				}
				
				else if($row->campaign_type == "compare campaign")
				{
					$link = asset("campaign/getdata/compare/offerdetails/".$row->id);
				}
				
				else if($row->campaign_type == "fullbuy campaign")
				{
					$link = asset("campaign/getdata/fullbuy/offerdetails/".$row->id);
				}
				
				
				$sched_array['link'] = $link;
				
				
				//converty stdclass object into array form
				$row2 = json_decode(json_encode($row),true);
				//merger to array
				$result = array_merge($sched_array,$row2);


				$eventsArray['campaign_data']  = $result;					
				$eventsArray['image_path'] 	   =  $imageData;
			

				$events[] = $eventsArray;	
				
			}
			return $events;
			exit;			
			
		}
		 return NULL;
	}
	
	
	
	
	
	public static function GetCurrentNotifcationDashboard()
	{
		
		$user = Auth::user();
		$id = $user->id;
		
		
		$sqlData = user_dashboard_notifications::where('user_id', $id)->where('notif_status',0)->get();
		
		$events = array();
		$eventsArray  = array();
		if(!empty($sqlData))
		{
		    foreach($sqlData as $row) 
			{
			    
			        $eventsArray['id']  = $row->id;
					$eventsArray['offer_id']  = $row->offer_id;
					$eventsArray['notif_id']  = $row->notif_id;
					$eventsArray['action_status']  = $row->action_status; 
			        $events[] = $eventsArray;
			}
			
				
		    
		}
		
	    return  $events;
		
	    
	    /*
		$schedule_user  = "schedule.sched_date as sched_date,schedule.is_done";
		
		$select ="offer_settings.*,stat.offer_status,$schedule_user";
		
		$sqlData = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_status as stat','stat.id','=','offer_settings.status')
		->leftJoin('users_offer_2_get_schedules as schedule', function($sqlData) use ($id)   
		{
			$sqlData->on('offer_settings.id', '=', 'schedule.offer_id');
			$sqlData->on('schedule.user_id','=',\DB::raw("'$id'"));
			$sqlData->on('schedule.is_offer_missed','=',\DB::raw("'0'"));
		})
		->where('schedule.user_id', '=', $id)
		->get();
		
		$eventsArray  = array();
		$events = array();
		$result = array();
		$sched_array = array();
		if(!empty($sqlData))
		{
			foreach($sqlData as $row) 
			{
				
						
				// check the current status of campaign 
				if($row->is_done == 0)
				{
					$eventsArray['offer_id']  = $row->id;
					$eventsArray['action']  = 'schedule_campaign';
					$eventsArray['action_status']  = "Buy product on amazon on ".Carbon::parse($row->sched_date)->format('F d, Y'); 
				}
				else if(UserDashboardController::check_if_tracking_submitted($row->id,$id) == false)
				{	
						$eventsArray['offer_id']  = $row->id;
						$eventsArray['action']  = 'verify product';
						$eventsArray['action_status']  = 'verify tracking purchase status';
				}
				
				 
				#else if($this->checking_purchase_review_question($row->id,$id) == false)
				#{		
				#		$eventsArray['offer_id']  = $row->id;
				#		$eventsArray['action']  = 'leave review';
				#		$eventsArray['action_status']  = 'Leave review on  purchase experience';
				#} 
				
				
				else if(UserDashboardController::checking_amazon_review_question($row->id,$id) == false)
				{
						$eventsArray['offer_id']  = $row->id;
						$eventsArray['action']  = 'leave review';
						$eventsArray['action_status']  = 'Leave review on  purchase experience';
				} 
		
				else 
				{		
						$eventsArray['offer_id']  = $row->id;
						$eventsArray['action']  = 'product comppleted';
						$eventsArray['action_status']  = 'Process Completed';
				} 
			
				$events[] = $eventsArray;	
				
			}
			
	        
		
		    
		    
		}
		return  $events;
		*/
		
		
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
	
	
	
	
	/*
	public function checking_purchase_review_question($offer_id,$user_id)
	{
		//if exist tracking_number
		if(purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			$eventsArray  = true;
		}
		else
		{
			$eventsArray  = false;
		}
	
		return $eventsArray;
		
	}
	*/
	
	
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
	
	
	public function compare_redirecting(Request $request,$id="")
	{
	    $user_id = $request->user()->id;
	    $check_current_steps = \DB::table('offer_competitors_steps_dones')
	    ->select('*')->where('offer_id',$id)->where('user_id',$user_id)->get();
	    if($check_current_steps[0]->product_check_asin == 0){
	        return redirect('campaign/getdata/compare/offerdetails/'.$id.'#step-2');
	    }else if($check_current_steps[0]->upload_screenshot == 0){
	        return redirect('campaign/offerdetails/finish/'.$id);
	    }else if($check_current_steps[0]->confirm_main_product == 0){
	        return redirect('campaign/offerdetails/finish/'.$id);
	    }else if($check_current_steps[0]->submit_order_id == 0){
	        return redirect('campaign/offerdetails/thankyou/'.$id);
	    }else if($check_current_steps[0]->tracking_number == 0){
	        return redirect('campaign/compare/tracking_number/'.$id);
	    }
	    else if($check_current_steps[0]->completed_process == 1){
	        return redirect('campaign/thankyou/done/'.$id);
	    }
	    echo 'null';
	}
	
	
	
	
	public function StartThisjob(Request $request,$id="")
	{
		$user_id =  $request->user()->id;
		
		$select ="offer_settings.*,t2.product_id as user_product_id,t2.product_price as user_product_price,t2.product_discount_label as user_product_discount_label,t2.product_discount as user_product_discount,t2.fullbuy_keyword,t2.confirm_date,t2.confirm_time,t2.id as transact_id";
		$offerdetails = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('users_offer_2_get_schedules as t2','t2.offer_id','=','offer_settings.id')
		->where('t2.user_id', '=', $user_id)
		->where('offer_settings.id','=',$id)
		->groupby('offer_settings.id')
		->get();
		
		########## Step1
		$job1 = users_offer_purchase_products::where('offer_id',$id)->where('user_id', $user_id)->where('product_id',$offerdetails[0]->product_id)->first();  	
		$condition1 = (@$job1->step1 == 0 ||  @$job1->step2 == 0 ||  @$job1->step3 == 0 || @$job1->step4 == 0 || @$job1->step5 == 0 || @$job1->step6 == 0); 
		###########
		
		
		######## Step 2
		$fee_product_purchased = @$this->OfferTrackingReturnProductsController->fee_amount_purcahsed_product($user_id,$id);
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
			
		$trackingdata2 = array();
		$availDate = "";
		$proceed = false;
		
		if(users_offer_4_submit_tracking_numbers::where('offer_id',$id)->where('user_id', $user_id)->exists())
		{
		
			$tracking_status = users_offer_4_submit_tracking_numbers::where('offer_id',$id)->where('user_id', $user_id)->first(); 
		    $trackingData = json_decode($tracking_status);
			if($trackingData->remarks == "Delivered")
			{
				$date_availbale = Carbon::parse($trackingData->active_survey_date);
				$today = Carbon::now();
				$continue = ($today >= $date_availbale  ? true : false);
				if($continue == true)
				{
					$availDate = "Product review is active please proceed to next step";
					$proceed = true;
				}
				else
				{
					$availDate =  "Product review will be available on ".date("F d, Y H:i A", strtotime($date_availbale));
					$proceed = false;
				}
			}
		
			if(!empty(@$trackingData))
			{
				
				
					$row = array();			
					$row['id'] 						= $trackingData->id;
				 	$row['shipment_company'] 		= $trackingData->shipment_company;
					$row['tracking_number']  		= $trackingData->tracking_number;
					$row['status'] 					= $trackingData->status;
					$row['remarks'] 				= $trackingData->remarks;
					$row['statusWithDetails']		= $trackingData->statusWithDetails;
					$row['completed']				= $trackingData->completed;
					$row['active_date_delivered']	= $trackingData->active_date_delivered;
					$row['active_survey_date']		= $trackingData->active_survey_date;
					$row['isactive_product_review']	= $trackingData->isactive_product_review;
					$row['status_msg']				= $availDate; 
					$row['proceed']					= $proceed; 
					$row['notes']					= $trackingData->notes;
			
					
					$trackingdata2[] = (object) $row;
				
			}
			else
			{
				$trackingdata2 = (object) [];
			}
		
		}
		#################################
	
										
		if(empty(@$job1) ||  $condition1 )
		{
			
			$users_offer_purchase_check_asins = users_offer_purchase_check_asins::where('offer_id',$id)->where('user_id', $user_id)->first(); 
			$users_offer_purchase_4rt_steps = users_offer_purchase_4rt_steps::where('offer_id',$id)->where('user_id', $user_id)->first(); 
			$users_offer_purchase_5th_steps = users_offer_purchase_5th_steps::where('offer_id',$id)->where('user_id', $user_id)->first(); 
			$users_offer_purchase_6th_steps = users_offer_purchase_6th_steps::where('offer_id',$id)->where('user_id', $user_id)->first();
			$images = offer_images::where('offer_id',$id)->get();
			
			return view('frontend.offer_instruction.JobStep1',array(
															'offerdetails'=>($offerdetails),
															'images'=>$images,
															'users_offer_purchase_products'=>$job1,
															'users_offer_purchase_check_asins' => $users_offer_purchase_check_asins,
															'users_offer_purchase_4rt_steps'   => $users_offer_purchase_4rt_steps,
															'users_offer_purchase_5th_steps'   => $users_offer_purchase_5th_steps,
															'users_offer_purchase_6th_steps'   => $users_offer_purchase_6th_steps,
															));
			exit;												
		}
		else if(empty($trackingdata2) || $trackingdata2[0]->remarks !="Delivered")
		{
			
			return view('frontend.offer_instruction.JobStep2',array(
															'offerdetails'=>($offerdetails),
															'fee_product_purchased'=>$fee_product_purchased,
															'purchare_review_questions'=>$purchare_review_questions,
															'tracking_status'=>$trackingdata2,
															));
			exit;
		}
		else if(!empty($trackingdata2) || $trackingdata2[0]->remarks =="Delivered")
		{
			
			$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
			$amazon_review_answers = amazon_review_answers::where('offer_id',$id)->where('user_id',$user_id)->get();
			$fee_amazon_rebate	   = @$this->OfferTrackingReturnProductsController->fee_amount_amazon_rebate($user_id,$id);
			return view('frontend.offer_instruction.JobStep3',array(
															'offerdetails'=>($offerdetails),
															'amazonreview'=>$amazonreview,
															'amazon_review_answers'=>$amazon_review_answers,
															'fee_amazon_rebate'=>$fee_amazon_rebate,
															));
			exit;
		}
		
		
		
	}
	
	
	public function campaign_offerdetails(Request $request,$id="")
	{
		$images =  array();
		$user_id =  $request->user()->id;
		
		//validate if product is denied
		$check_denied = \DB::table('user_offer_denies');
		

		
		$select ="offer_settings.*,t2.product_id as user_product_id,t2.product_price as user_product_price,t2.product_discount_label as user_product_discount_label,t2.product_discount as user_product_discount,t2.fullbuy_keyword";
		$offerdetails = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('users_offer_2_get_schedules as t2','t2.offer_id','=','offer_settings.id')
		->where('t2.user_id', '=', $user_id)
		->where('offer_settings.id','=',$id)
		->groupby('offer_settings.id')
		->get();
		
		$images = offer_images::where('offer_id',$id)->get();
		
		$trackingdata2 = array();
		$availDate = "";
		$proceed = false;
		
		if(users_offer_4_submit_tracking_numbers::where('offer_id',$id)->where('user_id', $user_id)->exists())
		{
		
			$tracking_status = users_offer_4_submit_tracking_numbers::where('offer_id',$id)->where('user_id', $user_id)->first(); 
		    $trackingData = json_decode($tracking_status);
			if($trackingData->remarks == "Delivered")
			{
				$date_availbale = Carbon::parse($trackingData->active_survey_date);
				$today = Carbon::now();
				$continue = ($today >= $date_availbale  ? true : false);
				if($continue == true)
				{
					$availDate = "Product review is active please proceed to next step";
					$proceed = true;
				}
				else
				{
					$availDate =  "Product review will be available on ".date("F d, Y H:i A", strtotime($date_availbale));
					$proceed = false;
				}
			}
		
			if(!empty($trackingData))
			{
				
				
					$row = array();			
					$row['id'] 						= $trackingData->id;
				 	$row['shipment_company'] 		= $trackingData->shipment_company;
					$row['tracking_number']  		= $trackingData->tracking_number;
					$row['status'] 					= $trackingData->status;
					$row['remarks'] 				= $trackingData->remarks;
					$row['statusWithDetails']		= $trackingData->statusWithDetails;
					$row['completed']				= $trackingData->completed;
					$row['active_date_delivered']	= $trackingData->active_date_delivered;
					$row['active_survey_date']		= $trackingData->active_survey_date;
					$row['isactive_product_review']	= $trackingData->isactive_product_review;
					$row['status_msg']				= $availDate; 
					$row['proceed']					= $proceed; 
					$row['notes']					= $trackingData->notes;
			
					
					$trackingdata2[] = (object) $row;
				
			}
			else
			{
				$trackingdata2 = (object) [];
			}
		
		}
		
		
		$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		$amazon_review_answers = amazon_review_answers::where('offer_id',$id)->where('user_id',$user_id)->get();
		
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
		$user_vcc_historypays = user_vcc_historypays::where('offer_id',$id)->where('user_id',$user_id)->where('pay_method','purchased_product')->first();
		
		$fee_product_purchased = @$this->OfferTrackingReturnProductsController->fee_amount_purcahsed_product($user_id,$id);
		$fee_amazon_rebate	   = @$this->OfferTrackingReturnProductsController->fee_amount_amazon_rebate($user_id,$id);
		$fee_return_product    = @$this->OfferTrackingReturnProductsController->fee_amount_retun_product($user_id,$id);
	    
		$offer_last_date =unserialize($offerdetails[0]->offer_daily_order);
	    $lastElement = end($offer_last_date);
	    $lastElement = $lastElement['date'];
	    $datex =  (explode("-",$lastElement));
	    $date_last_offer = $datex[0].'/'.$datex[1].'/'.$datex[2];
		
        $users_offer_purchase_products = users_offer_purchase_products::where('offer_id',$id)->where('user_id', $user_id)->where('product_id',$offerdetails[0]->product_id)->first(); 
        $users_offer_purchase_check_asins = users_offer_purchase_check_asins::where('offer_id',$id)->where('user_id', $user_id)->first(); 
        $users_offer_purchase_4rt_steps = users_offer_purchase_4rt_steps::where('offer_id',$id)->where('user_id', $user_id)->first(); 
        $users_offer_purchase_5th_steps = users_offer_purchase_5th_steps::where('offer_id',$id)->where('user_id', $user_id)->first(); 
        $users_offer_purchase_6th_steps = users_offer_purchase_6th_steps::where('offer_id',$id)->where('user_id', $user_id)->first();
        $getschedule = users_offer_2_get_schedules::where('offer_id',$id)->where('user_id', $user_id)->first();
		
        $datetoday = Carbon::now()->format('m/d/Y');
		
		
        
		$status_step2 = ( ( strtotime($datetoday) >= strtotime($getschedule->sched_date) ) ? "active_step2" : "inactive_step2" );
        if(!empty($users_offer_purchase_products) && $users_offer_purchase_products->step1 == 1 && $users_offer_purchase_products->step2 == 1  && $users_offer_purchase_products->step3 == 1  && $users_offer_purchase_products->step4 == 1  && $users_offer_purchase_products->step5 == 1 && $users_offer_purchase_products->step6 == 1   )
        {
             $status_step3 = "active_step3";
        }
        else
        {
              $status_step3 = "inactive_step3";
        }
        $status_step4 = (( !empty($trackingdata2) && @$trackingdata2[0]->remarks == "Delivered" ) ? "active_step4" : "inactive_step4" );
        $status_step5 = (( !empty($amazon_review_answers) && count($amazon_review_answers) > 0  ) ? "active_step5" : "inactive_step5" );
	    if($offerdetails[0]->campaign_type == "insight campaign")
	    {
	        $src = "insight";
	    }
	    else if($offerdetails[0]->campaign_type == "fullbuy campaign")
	    {
	        $src = "fullbuy";
	    }
		
		// miles code
	    else if($offerdetails[0]->campaign_type == 'compare campaign')
	    {
	       // $competitor = \DB::table('offer_competitors')
	       // ->select('*')
	       // ->where('offer_id','=',$id)->get();
	        $competitor_status = \DB::table('offer_competitors_check_asins as a')
	        ->leftjoin('offer_competitor_products as b',[['b.offer_id','=','a.offer_id'],['b.competitor_product_row','=','a.competitor_product_row']])
	        ->select('a.*','b.competitor_image_path')
	        ->where('a.offer_id','=',$id)
	        ->where('a.user_id','=',$user_id)
	        ->orderBy('a.competitor_id','ASC')
	        ->groupBy('a.competitor_id')
	        ->get();
	        $primary = \DB::table('offer_set_key_primaries')->where('offer_id',$id)->get();
    	    if(!empty($primary[0])){
    	        $array = [];
        	    foreach($primary as $val){
        	        $array[] =$val->p_keyword;
        	    }
        	    $random = array_rand($array,1);
    	    }
	       return view('frontend.compare_offerdetails',array
											(
											    'primary' => @$array[$random],
											    'offer_id' => $id,
											    'competitors' => $competitor_status,
    											'images'=>$images,
    											'offerdetails'=>$offerdetails,
    											'offer_last_date'=>$date_last_offer,
    											'amazonreview'=>$amazonreview,
    											'amazon_review_answers'=>$amazon_review_answers,
    											'purchare_review_questions'=>$purchare_review_questions,
    											'tracking_status'=>$trackingdata2,
    											'user_vcc_historypays'=>$user_vcc_historypays,
    											'fee_product_purchased'=>$fee_product_purchased,
    											'fee_amazon_rebate'=>$fee_amazon_rebate,
    											'fee_return_product' =>$fee_return_product,
    											'users_offer_purchase_check_asins' => $users_offer_purchase_check_asins,
											    'users_offer_purchase_products'    => $users_offer_purchase_products,
											    'users_offer_purchase_4rt_steps'   => $users_offer_purchase_4rt_steps,
											    'users_offer_purchase_5th_steps'   => $users_offer_purchase_5th_steps,
											    'users_offer_purchase_6th_steps'   => $users_offer_purchase_6th_steps,
											    'status_step2'   => $status_step2,
											    'status_step3'   => $status_step3,
											    'status_step4'   => $status_step4,
											    'status_step5'   => $status_step5,
											    'getschedule'        =>  $getschedule,
											    'source_campaign'    =>  @$src,
											)
					);
	    }
		
		
		return view('frontend.offerdetails',array
		
											(
											    
											    
    											'images'=>$images,
    											'offerdetails'=>$offerdetails,
    											'offer_last_date'=>$date_last_offer,
    											
    											
    											'amazonreview'=>$amazonreview,
    											'amazon_review_answers'=>$amazon_review_answers,
    											
    											'purchare_review_questions'=>$purchare_review_questions,
    											
    											'tracking_status'=>$trackingdata2,
    											'user_vcc_historypays'=>$user_vcc_historypays,
    											
    											'fee_product_purchased'=>$fee_product_purchased,
    											'fee_amazon_rebate'=>$fee_amazon_rebate,
    											'fee_return_product' =>$fee_return_product,
    											
    											'users_offer_purchase_check_asins' => $users_offer_purchase_check_asins,
											    'users_offer_purchase_products'    => $users_offer_purchase_products,
											    'users_offer_purchase_4rt_steps'   => $users_offer_purchase_4rt_steps,
											    'users_offer_purchase_5th_steps'   => $users_offer_purchase_5th_steps,
											    'users_offer_purchase_6th_steps'   => $users_offer_purchase_6th_steps,
											    
											    'status_step2'   => $status_step2,
											    'status_step3'   => $status_step3,
											    'status_step4'   => $status_step4,
											    'status_step5'   => $status_step5,
											    
											    
											    'getschedule'        =>  $getschedule,
											    
											    'source_campaign'    =>  @$src, 
											)
					);	
	}
	public function update_compare_addtocart(Request $request){
	    $user_id = $request->user()->id;
	    $offer_id = $request->offer_id;
	    $row = $request->row;
	    $update = \DB::table('offer_competitors_check_asins')
	    ->where([['offer_id','=',$offer_id],['competitor_product_row','=',$row],['user_id','=',$user_id]])
	    ->update(['addtocart' => 1]);
	   // if(!empty($request->last)){
	   //     \DB::table('offer_competitors_steps_dones')
	   //     ->where('user_id','=',$user_id)->where('offer_id','=',$offer_id)
	   //     ->update(['product_check_asin' => 1]);
	   // }
	    return array('success' => true);
	}
	public function check_asin_competitor(Request $request)
	{
	    $user_id = $request->user()->id;
	    $offer_id = $request->offer_id;
	    $ASIN = $request->ASIN;
	    $competitor_row = $request->competitor_row;
	    if(!empty($competitor_row)){
	        $check_asin = \DB::table('offer_competitors_check_asins')
	        ->select('product_id')->where([['offer_id','=',$offer_id],['competitor_product_row','=',$competitor_row],['product_id','=',$ASIN],['user_id','=',$user_id]])->get();
	        if(@!empty($check_asin[0]->product_id)){
	            \DB::table('offer_competitors_check_asins')
	            ->where([['offer_id','=',$offer_id],['competitor_product_row','=',$competitor_row],['product_id','=',$ASIN]])
	            ->update(['verified' => 1]);
	            return array('success' => true, 'message' => 'ASIN has been validated');
	        }else{
	            return array('success' => false, 'message' => 'Invalid ASIN !');
	        }
	    }
	}
	public function competitor_finish(Request $request,$id=""){
	    $user_id = $request->user()->id;
	    $validation = \DB::table('offer_competitors_steps_dones')
	    ->select('*')->where('offer_id','=',$id)->where('user_id','=',$user_id)->get();
	    foreach(json_decode($validation) as $value){
	        if($value->product_check_asin == 0){
	            return redirect('campaign/getdata/compare/offerdetails/'.$id);
	        }
	    }
	    $images = offer_images::where('offer_id',$id)->get();
	    $screenshot = \DB::table('offer_competitors_screenshots')
	    ->select('*')->where('offer_id','=',$id)->where('user_id','=',$user_id)->get();
	    $competitors = \DB::table('offer_competitors_check_asins as a')
	    ->leftjoin('offer_competitor_products as b',[['b.offer_id','=','a.offer_id'],['a.competitor_product_row','=','b.competitor_product_row']])
	    ->select('*')->where('a.offer_id','=',$id)->where('a.user_id','=',$user_id)->get();
	    $select ="offer_settings.*,t2.product_id as user_product_id,t2.product_price as user_product_price,t2.product_discount_label as user_product_discount_label,t2.product_discount as user_product_discount,t2.fullbuy_keyword";
		
		$offerdetails = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('users_offer_2_get_schedules as t2','t2.offer_id','=','offer_settings.id')
		->where('t2.user_id', '=', $user_id)
		->where('offer_settings.id','=',$id)
		->groupby('offer_settings.id')
		->get();
		$product_details = $this->product_details($id);
	    return view('frontend.compare_finish_offerdetails',array('offer_id' => $id,'screenshot' => $validation,'competitors' => $competitors,'images' => $images,'offer_details' => $offerdetails,'product_details' => $product_details));
	}
		public function product_details($offer_id){
			$new_price  = "price.product_price as new_product_price";
			$new_price .= ",price.product_discount_label as new_product_discount_label";
			$new_price .= ",price.product_discount as new_product_discount";
			$select = "offer_settings.*,$new_price,stat.offer_status";
			 $sqlData = \DB::table('offer_settings')
				->select(\DB::raw($select))
			//->join('users_offer_1_sent_campaigns as t2','t2.offer_id','=','offer_settings.id')
				->join('offer_status as stat','stat.id','=','offer_settings.status')
				
				->leftJoin('offer_setting_prices as price', function($sqlData) 
				{
					$sqlData->on('offer_settings.id', '=', 'price.offer_id');
					$sqlData->on('price.product_id', '=', 'offer_settings.product_id');
					$sqlData->on('price.status','=',\DB::raw("'active'"));
				})
				->where('offer_settings.offer_daily_order','!=','')
				->where('offer_settings.campaign_type','=','compare campaign')
				->where('offer_settings.id','=',$offer_id)
				->orderBy('offer_settings.updated_at', 'DESC')
				//->groupBy('img.offer_id')
				->get(); 
			$datetoday = Carbon::now()->format('m/d/Y');
			$ddyesterday = Carbon::yesterday()->format('m/d/Y');
			$timenow = Carbon::now()->format('H:i:s');
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
							if(strtotime($datetoday) == strtotime($availabledate))
							{
									$availadate['z_date']		 = 	$rows['date'];	
									$availadate['z_nameofday']	 = 	$rows['nameofday'];	
									$availadate['z_value'] 	 	= 	$rows['value'];
									$datax['offer_available_spot']  =  $availadate['z_value'] -  count($getCountsched);
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
	            	$purchase_rebate 		= $row->purchase_rebate;
            		$purchase_rebate_amount = $row->purchase_rebate_amount;
            		if($purchase_rebate == "Percentage")
            		{
            			$rebate_percent = @$purchase_rebate_amount / 100;
            			$rebate_amount =  $sales_discounted * $rebate_percent;
            		}
            		else if($purchase_rebate == "Dollar")
            		{
            			$rebate_amount = $sales_discounted - $purchase_rebate_amount;
            			
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
	public function update_steps_done(Request $request){
	    $user_id = $request->user()->id;
	    $offer_id = $request->offer_id;
	    $update = \DB::table('offer_competitors_steps_dones')
	    ->where('offer_id','=',$offer_id)->where('user_id','=',$user_id)
	    ->update(['confirm_main_product' => 1]);
	    if($update){
	        return array('success' => true);
	    }
	}
	public function next_step_done(Request $request){
	    $offer_id = $request->offer_id;
	    $user_id = $request->user()->id;
	    $update = \DB::table('offer_competitors_steps_dones')
	    ->where('offer_id','=',$offer_id)->where('user_id','=',$user_id)
	    ->update(['product_check_asin' => 1]);
	    if($update){
	        return array('success' => true);
	    }
	}
	public function order_num(Request $request){
	    $user_id = $request->user()->id;
	    $offer_id = $request->offer_id;
	    $order_num = $request->order_num;
	    @$get_product_id = \DB::table('offer_settings')
	    ->select('*')->where('id','=',$offer_id)->get();
	    $save = \DB::table('offer_competitors_amazon_order_ids')
	    ->insert([['user_id' => $user_id,
	    'product_id' => @$get_product_id[0]->product_id,
	    'offer_id' => $offer_id,
	    'order_number' => $order_num,
	    'status' => 'pending']]);
	    if($save){
	        \DB::table('offer_competitors_steps_dones')
		    ->where('offer_id','=',$offer_id)->where('user_id','=',$user_id)
		    ->update(['submit_order_id' => 1]);
	        return array('success' => true);
	    }else{
	        return array('success' => false);
	    }
	}
	public function compare_track_number(Request $request,$id=""){
	    $user_id = $request->user()->id;
	    $check_tracking = \DB::table('users_offer_4_submit_tracking_numbers')->select('*')->where('user_id',$user_id)->where('offer_id',$id)->get();
	    $earn_points = \DB::table('offer_settings')->select('*')->where('id',$id)->get();
	    $price = $this->UserVccController->get_amount_tracking_price($user_id,$id);
	    return view('frontend.compare_tracking_number',array('id' => $id,'tracking_status' => $check_tracking,'cashback' => $price,'points' => $earn_points[0]->earn_points));
	}
// 	public function save_tracking_number(Request $request){
	    
// 	}
	public function thankyou(Request $request, $id=""){
	    $user_id = $request->user()->id;
	    $select ="offer_settings.*,t2.product_id as user_product_id,t2.product_price as user_product_price,t2.product_discount_label as user_product_discount_label,t2.product_discount as user_product_discount,t2.fullbuy_keyword";
		$images = offer_images::where('offer_id',$id)->get();
		$offerdetails = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('users_offer_2_get_schedules as t2','t2.offer_id','=','offer_settings.id')
		->where('t2.user_id', '=', $user_id)
		->where('offer_settings.id','=',$id)
		->groupby('offer_settings.id')
		->get();
		@$validation = \DB::table('offer_competitors_steps_dones')
		->select('*')->where('offer_id','=',$id)->where('user_id','=',$user_id)->get();
		if($validation[0]->confirm_main_product == 0){
		    return redirect('campaign/offerdetails/finish/'.$id);
		}
		$order_num = \DB::table('users_offer_purchase_6th_steps')->select('order_number')->where('offer_id','=',$id)->where('user_id','=',$user_id)->get();
	    return view('frontend.compare_thankyou_offerdetails',array('offer_id' => $id,'images' => $images,'offer_details' => $offerdetails,'order_num' => @$order_num[0]->order_number));
	}
	public function thankyou_done(Request $request,$id=""){
	    $user_id = $request->user()->id;
	    $offer_id = $id;
	    @$status = \DB::table('offer_competitors_steps_dones')
	    ->select('*')
	    ->where('user_id','=',$user_id)->where('offer_id','=',$offer_id)->get();
	    $price = $this->UserVccController->get_amount_tracking_price($user_id,$offer_id);
	    $points = \DB::table('offer_settings')->select('*')->where('id',$id)->get();
	    return view('frontend.compare_thankyou_done',array('status' => @$status,'offer_id' => $offer_id,'cashback' => $price,'points' => @$points[0]->earn_points));
	}
	public function upload_screenshot(Request $request){
	    $user_id = $request->user()->id;
	    $img_competitor1 = $request->file;
	    $offer_id = $request->offer_id;
	    $new_name = $this->generateRandomString(10) . '.' . $img_competitor1->getClientOriginalExtension();
		 $img_competitor1->move(public_path('screenshot'), $new_name);
		 $imagepath = $new_name;
		$save = \DB::table('offer_competitors_screenshots')
		->insert([['offer_id' => $offer_id,
		'user_id' => $user_id,
		'screenshot' => $imagepath]]);
		if($save){
		    \DB::table('offer_competitors_steps_dones')
		    ->where('offer_id','=',$offer_id)->where('user_id','=',$user_id)
		    ->update(['upload_screenshot' => 1]);
		    return array('success' => true);
		}else{
		    return array('success' => false);
		}
	}
	function generateRandomString($length = 10) 
    {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function compare_offerdetails(Request $request,$id="")
	{
		$offerdetails = offer_settings::where('id',$id)->get();
		$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
	
		return view('frontend.offerdetails',array('offerdetails'=>$offerdetails,'amazonreview'=>$amazonreview,'purchare_review_questions'=>$purchare_review_questions));	
	}
	
	public function addtocart_offerdetails(Request $request,$id="")
	{
		$offerdetails = offer_settings::where('id',$id)->get();
		return view('frontend.offerdetails_addtocart',array('offerdetails'=>$offerdetails));	
	}
	
	
	public function completedoffer(Request $request)
    {		
		return view('frontend.comptedoffer');	
	}
	
	
	public function archived(Request $request)
    {		
		return view('frontend.archived');	
	}
	
	
	public function activity(Request $request)
    {		
		return view('frontend.activity');	
	}
	
	public function notificationlist(Request $request)
    {	
		$user_id =  $request->user()->id;
		$notifications  = $this->notificationsController->getAll_notificationData($user_id);
	
		
		return view('frontend.notificationlist',array('notifications'=>$notifications));	
	}
	
	
	public function listofferdata(Request $request)
	{
		
		$id =  $request->user()->id;
		$offer_settings = offer_settings::getallCompletedData($id);
		return response()->json($offer_settings);	
	}
	
	public function markasoffercompleted(Request $request)
	{
		$user_id =  $request->user()->id;
		$offer_id =  $request->offer_id;
		

		$users_offer_5_completeds = new users_offer_5_completeds();
		$users_offer_5_completeds->offer_id				=  $offer_id;
		$users_offer_5_completeds->user_id 				=  $user_id;
		$users_offer_5_completeds->status 				=  '';
		$users_offer_5_completeds->admin_approved 		=  '';
		$users_offer_5_completeds->save(); 
		
		return response()->json(array('result'=>'success'));
	}
	
	
	public function expired_campaign(Request $request)
	{
		 $user_id =  $request->user()->id;
		 $offer_id =  $request->offer_id;
		 $get_sched_id =  $request->get_sched_id;
		 
		$user_offer_denies = new user_offer_denies();
		$user_offer_denies->offer_id			=  $offer_id;
		$user_offer_denies->user_id 			=  $user_id;
		$user_offer_denies->get_sched_id 		=  $get_sched_id;
		$user_offer_denies->status 				=  '3';
		$user_offer_denies->reason 				=  'expired this campaign';
		$user_offer_denies->save(); 
		
		users_offer_2_get_schedules::where('offer_id',$offer_id)->where('user_id', $user_id)->where('id', $get_sched_id)->update([
			'is_dinied' =>  'Expired',
		]);
		
	}
	
	public function cancel_campaign(Request $request)
	{
		  $user_id =  $request->user()->id;

		  $offer_id =  $request->offer_id;

		  $get_sched_id =  $request->get_sched_id;
		 
		 
	
		 
		$user_offer_denies = new user_offer_denies();
		$user_offer_denies->offer_id			=  $offer_id;
		$user_offer_denies->user_id 			=  $user_id;
		$user_offer_denies->get_sched_id 		=  $get_sched_id;
		$user_offer_denies->status 				=  '1';
		$user_offer_denies->reason 				=  'cancel this campaign';
		$user_offer_denies->save(); 
		
		users_offer_2_get_schedules::where('offer_id',$offer_id)->where('user_id', $user_id)->where('id', $get_sched_id)->update([
			'is_dinied' =>  'Cancel',
		]);
		
		return response()->json(array('result'=>'success'));
		
	}
	

	
}                                                                                                                                                
