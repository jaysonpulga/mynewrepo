<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\offer_settings;
use App\Model\purchare_review_answers;
use App\Model\amazon_review_questions;

use App\Model\frontend\User;

use App\Model\frontend\users_offer_1_sent_campaigns;
use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\frontend\users_offer_3_continue_accepts;
use App\Model\frontend\users_offer_4_submit_tracking_numbers;
use App\Model\frontend\users_offer_5_completeds;
use App\Model\frontend\users_offer_6_amazon_upload_files;
use App\Model\frontend\users_offer_7_submit__return_products_tracking_numbers;

use Carbon\Carbon;
use App\Http\Controllers\frontend\NotificationsController;
use App\Http\Controllers\frontend\SendEmailController;
use App\Http\Controllers\frontend\TrackingNumberController;
use App\Http\Controllers\frontend\OfferTrackingReturnProductsController;


class Cronjob_forCustomerController extends Controller
{
    
	protected $notificationsController;
	protected $SendEmailController;
	protected $TrackingNumberController;
	protected $OfferTrackingReturnProductsController;
	
	
	
	public function __construct(NotificationsController $notificationsController,SendEmailController $SendEmailController,TrackingNumberController $TrackingNumberController,OfferTrackingReturnProductsController $OfferTrackingReturnProductsController)
    {
		 $this->notificationsController = $notificationsController;
		 $this->SendEmailController = $SendEmailController;
		 $this->TrackingNumberController = $TrackingNumberController;
		 $this->OfferTrackingReturnProductsController = $OfferTrackingReturnProductsController;
		 
		 
		 
    }
	
	
	public function testkomuna()
	{
		echo 'test ko muna ha 12345';
	}
	
		

	
	
	public function checkifproductreview_is_available(Request $request)
	{
		

		$datenow  = Carbon::now();
		$all = users_offer_4_submit_tracking_numbers::where('isactive_product_review',0)->get();
		foreach($all as $newData)
		{
		
			
			
			$date_availbale = Carbon::parse($newData->active_survey_date);
			$today = Carbon::now();
			$continue = ($datenow >= $date_availbale  ? true : false);
			if($continue == true)
			{
		$updated = users_offer_4_submit_tracking_numbers::where('id',$newData->id)->where('offer_id',$newData->offer_id)->where('user_id',$newData->user_id)->where('isactive_product_review',0)->update([
						'isactive_product_review'  =>  1,
					]);
					if($updated)
					{	
						$offer_id = $newData->offer_id;
						$user_id = $newData->user_id;
						$batch_id = $newData->id;
						
						$this->notificationsController->notifation_product_review_available($offer_id,$user_id,$batch_id);
					
						echo 'updated';
					}
					
			}
			
		}
		
	}
	
	
	public function checkifcampign_isready_tocontinue(Request $request)
	{
		
		
		$dt = Carbon::now()->format('m/d/Y H:i:s');
		$ddtomorrow = Carbon::tomorrow()->format('m/d/Y');
		
		$alldata = users_offer_2_get_schedules::where('is_send_notification',0)->get();
		
		foreach($alldata as $newData)
		{
		
			$sched_date = trim($newData->sched_date).' '.trim($newData->sched_time);
			$continue = ($dt >= $sched_date  ? 'true' : 'false');
			
		
			
			if($continue == 'true')
			{
				    $updated = users_offer_2_get_schedules::where('id',$newData->id)->where('offer_id',$newData->offer_id)->where('user_id',$newData->user_id)->where('is_send_notification',0)->update([
						'is_send_notification'  =>  1,
					]);
					if($updated)
					{	
						$offer_id = $newData->offer_id;
						$user_id = $newData->user_id;
						$batch_id = $newData->id;
						$urlpath =  $request->root();
						$datauser = User::where('id',$user_id)->first();
						
						$dtavailble = $ddtomorrow.' '.trim($newData->sched_time);
						
						$this->notificationsController->notifation_product_proceed_continue($offer_id,$user_id,$batch_id);
						$this->SendEmailController->MailsentReady_product_proceed_continue($newData->user_id,$datauser->name,$datauser->email,$offer_id,$dtavailble,$sched_date,$urlpath); 
						
						echo 'updated';
					}
					
			} 
			
			
		}
		
		
	}
	
	public function checkifoffer_isreadyfortomorrow(Request $request)
	{
		
		
		$today = Carbon::now()->format('m/d/Y H:i:s');
        $ddtom = Carbon::tomorrow()->format('m/d/Y H:i:s');

		$timenow = Carbon::now()->format('H:i:s');
		$tom = Carbon::tomorrow()->format('m/d/Y');
		$compareTomdate = $tom.' '.$timenow;
		
		
	
		$alldata = users_offer_2_get_schedules::where('sched_date',$tom)->where('is_send_notif_tom',0)->get();
		
		
		
		foreach($alldata as $newData)
		{
			$dtavailble =   $newData->sched_date.' '.$newData->sched_time;
			 $continue = ($compareTomdate >= $dtavailble  ? 'true' : 'false');
			
			
			
			
			
			if($continue == 'true')
			{
				
				
				
				    $updated = users_offer_2_get_schedules::where('id',$newData->id)->where('offer_id',$newData->offer_id)->where('user_id',$newData->user_id)->where('is_send_notif_tom',0)->update([
						'is_send_notif_tom'  =>  1,
					]);
					
					
					if($updated)
					{	
						$offer_id = $newData->offer_id;
						$user_id = $newData->user_id;
						$batch_id = $newData->id;
						$urlpath =  $request->root();
						$datauser = User::where('id',$user_id)->first();
						
						$this->notificationsController->notifation_product_readyfor_tomorrow($offer_id,$user_id,$batch_id);
						$this->SendEmailController->MailsentforTomorrow($newData->user_id,$datauser->name,$datauser->email,$offer_id,$dtavailble,$urlpath);
						
					
						echo 'updated';
					}
					
			}
			
			
		}
		
	}
	
	
	public function checkifoffer_ismissedtoactive(Request $request)
	{
		$today = Carbon::now()->format('m/d/Y H:i:s');
		$ddyesterday = Carbon::yesterday()->format('m/d/Y');
		$timenow = Carbon::now()->format('H:i:s');
		$compareTomdate = $ddyesterday.' '.$timenow;
		
		$alldata = users_offer_2_get_schedules::where('sched_date','<',$ddyesterday)->where('confirm_status',0)->where('is_offer_missed',0)->where('is_send_notif_missed_offer',0)->get();
		
	
		
		foreach($alldata as $newData)
		{
			$continue_accepts =	users_offer_3_continue_accepts::where('offer_id',$newData->offer_id)
													->where('user_id',$newData->user_id)
													->where('confirm_id',$newData->id)
													->get();
			$ifdata = count($continue_accepts);

			if($ifdata == 0)
			{
				
					$updated = users_offer_2_get_schedules::where('id',$newData->id)->where('offer_id',$newData->offer_id)->where('user_id',$newData->user_id)->where('confirm_status',0)->update([
						'is_offer_missed'  =>  1,
						'is_send_notif_missed_offer'  =>  1,
					]);
					
					if($updated)
					{	
						$offer_id = $newData->offer_id;
						$user_id = $newData->user_id;
						$batch_id = $newData->id;
						$urlpath =  $request->root();
						$dtavailble = $newData->sched_date.' '.$newData->sched_time;
						$datauser = User::where('id',$user_id)->first();
						
						$this->notificationsController->notifation_missed_offer($offer_id,$user_id,$batch_id);
						$this->SendEmailController->Mailsent_missed_offer($newData->user_id,$datauser->name,$datauser->email,$offer_id,$dtavailble,$urlpath);
						
					
						echo 'updated';
					}
				
			}

		}
        
	}
	
	
	
	public function checkif_productisdelivered(Request $request)
	{
		$product_delivered  = users_offer_4_submit_tracking_numbers::where('remarks',"!=","Delivered")->get();
		
		if(!empty($product_delivered ))
		{
			
			foreach($product_delivered as $newData)
			{
				
				
				 $id  				= $newData->id;
				 $shipment_company  = $newData->shipment_company;
				 $tracknumber  		= $newData->tracking_number;
				 $offer_id  		= $newData->offer_id;
				 $user_id  			= $newData->user_id;
				 $pay_method		= "purchased_product";
				
				//CallCronjob_tracking_number($id,$shipment_company,$tracknumber,$offer_id,$user_id,$pay_method)
				$this->TrackingNumberController->CallCronjob_tracking_number($id,$shipment_company,$tracknumber,$offer_id,$user_id,$pay_method);
			}
			
		}
	}
	
	
	public function checkif_productreturn_isdelivered(Request $request)
	{
		$product_delivered  = users_offer_7_submit__return_products_tracking_numbers::where('remarks',"!=","Delivered")->get();
		
		if(!empty($product_delivered ))
		{
			
			foreach($product_delivered as $newData)
			{
				
				
				 $id  				= $newData->id;
				 $shipment_company  = $newData->shipment_company;
				 $tracknumber  		= $newData->tracking_number;
				 $offer_id  		= $newData->offer_id;
				 $user_id  			= $newData->user_id;
				 $pay_method		= "return_product";
				
				//CallCronjob_tracking_number($id,$shipment_company,$tracknumber,$offer_id,$user_id,$pay_method)
				$this->OfferTrackingReturnProductsController->CallCronjob_tracking_return_product_number($id,$shipment_company,$tracknumber,$offer_id,$user_id,$pay_method);
			}
			
		}
	}
	
	
	
	

}