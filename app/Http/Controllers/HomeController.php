<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\OfferSettings;
use App\purchare_review_questions;
use App\amazon_review_questions;


use App\amazon_review_answers;
use App\purchare_review_answers;
use App\offer_completed;
use App\offer_images;

use App\Model\offer_accept;
use App\offer_tracking_numbers;
use App\notifications;
use App\offer_sentmail;

use Carbon\Carbon;
use App\Http\Controllers\frontend\NotificationsController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 
	
	
	protected $notificationsController;
	
	public function __construct(NotificationsController $notificationsController)
    {
		$this->middleware('auth');
		 $this->notificationsController = $notificationsController;
    }
	
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
		/* 
		$id =  $request->user()->id;
		$offerdata = OfferSettings::getAvailableOffer($id);
		$Scheduled_Offer = OfferSettings::getAvailableScheduled_Offer($id);
		return view('home',array('offerdata'=>$offerdata,'Scheduled_Offer'=>$Scheduled_Offer)); 
		*/
		
		$id =  $request->user()->id;
		$offer_sentmail = offer_sentmail::where('user_id',$id)->get();
		$user_countoffer = count($offer_sentmail);
		return view('frontend.offer_current',array('user_countoffer'=>$user_countoffer));
	}
	
	
	public function acceptedofferpage(Request $request)
    {
		return view('frontend.offer_accepted');
	}
	
	
	
	
	
	public function offerdetails(Request $request,$id="")
	{
		$offerdetails = OfferSettings::where('id',$id)->get();
		$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
		
		return view('offerdetails',array('offerdetails'=>$offerdetails,'amazonreview'=>$amazonreview,'purchare_review_questions'=>$purchare_review_questions));	
	}
	
	
	
	
	
	
	
	
	
	
	public function viewofferdetails(Request $request,$id="")
	{
		$offerdetails = OfferSettings::where('id',$id)->get();
		//$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		//$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
		
		return view('viewofferdetails',array('offerdetails'=>$offerdetails));	
	}
	
	
	
	public function listofferdata(Request $request)
	{
		
		$id =  $request->user()->id;
		$OfferSettings = OfferSettings::getallCompletedData($id);
		return response()->json($OfferSettings);	
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
	
	
	
	public function currentoffer(Request $request)
	{
		$id =  $request->user()->id;
		$menudata =  $request->menudata;
		$group_category =  $request->group_category;
		$currentoffer = OfferSettings::getcurrentAvailableOffer($id,$menudata,$group_category);
		return $currentoffer;
	}
	
	
	public function acceptedoffer(Request $request)
	{
		$id =  $request->user()->id;
		$menudata =  $request->menudata;
		$group_category =  $request->group_category;
		$offerdata = OfferSettings::getAcceptedOffer($id,$menudata,$group_category);
		return $offerdata;
	}
	
	
	public function insight_offerdetails(Request $request,$id="")
	{
		//$offerdetails2 = OfferSettings::where('id',$id)->get();
		$images =  array();
		$user_id =  $request->user()->id;
	
		$select ="offer_settings.*,t2.product_id as user_product_id,t2.product_price as user_product_price,t2.product_discount_label as user_product_discount_label,t2.product_discount as user_product_discount";
		
		$offerdetails = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('schedule_confirm_users as t2','t2.offer_id','=','offer_settings.id')
		->where('t2.user_id', '=', $user_id)
		->where('offer_settings.id','=',$id)
		->groupby('offer_settings.id')
		->get();
		
		$images = offer_images::where('offer_id',$id)->get();
		
		
		$trackingdata2 = array();
		$availDate = "";
		$proceed = false;
		if(offer_tracking_numbers::where('offer_id',$id)->where('user_id', $user_id)->exists())
		{
		
			$tracking_status = offer_tracking_numbers::where('offer_id',$id)->where('user_id', $user_id)->first(); 
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
					
					$trackingdata2[] = (object) $row;
				
			}
			else
			{
				$trackingdata2 = (object) [];
			}
		
		}
		
		
	
	
		$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
		$amazon_review_answers = amazon_review_answers::where('offer_id',$id)->where('user_id',$user_id)->get();
		
		

	
		return view('frontend.offerdetails',array
											(
											'images'=>$images,
											'offerdetails'=>$offerdetails,
											'amazonreview'=>$amazonreview,
											'amazon_review_answers'=>count($amazon_review_answers),
											'purchare_review_questions'=>$purchare_review_questions,
											'tracking_status'=>$trackingdata2
											)
					);	
	}
	
	
	public function fullbuy_offerdetails(Request $request,$id="")
	{
		$offerdetails = OfferSettings::where('id',$id)->get();
		$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
	
		return view('frontend.offerdetails',array('offerdetails'=>$offerdetails,'amazonreview'=>$amazonreview,'purchare_review_questions'=>$purchare_review_questions));	
	}
	
	
	public function compare_offerdetails(Request $request,$id="")
	{
		$offerdetails = OfferSettings::where('id',$id)->get();
		$amazonreview = amazon_review_questions::where('offer_id',$id)->get();
		$purchare_review_questions = purchare_review_questions::where('offer_id',$id)->get();
	
		return view('frontend.offerdetails',array('offerdetails'=>$offerdetails,'amazonreview'=>$amazonreview,'purchare_review_questions'=>$purchare_review_questions));	
	}
	
	public function addtocart_offerdetails(Request $request,$id="")
	{
		$offerdetails = OfferSettings::where('id',$id)->get();
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
	
	
	

	
}                                                                                                                                                
