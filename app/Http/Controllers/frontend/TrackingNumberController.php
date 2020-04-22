<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Model\frontend\users_offer_4_submit_tracking_numbers;
use App\Model\frontend\users_offer_2_get_schedules;


use App\Model\purchare_review_answers;


use App\functions\scrap_trackingnumber;

//use App\functions\getShipmentStatus\getStatus;


require_once 'vendor/autoload.php';
use Sauladam\ShipmentTracker\ShipmentTracker;


use App\Http\Controllers\frontend\UserPaymentVccController;
use App\Http\Controllers\frontend\UserRebateTransactionController;
use App\Model\user_rebate_points;
class TrackingNumberController extends Controller
{
	
	
	protected $UserPaymentVccController;
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function __construct(UserPaymentVccController $UserPaymentVccController, UserRebateTransactionController $UserRebateTransactionController)
    {
		 $this->UserPaymentVccController = $UserPaymentVccController;
         $this->UserRebateTransactionController =  $UserRebateTransactionController;
    }
  
	
	
	
	
	public function submit_tracking_number_and_survey(Request $request)
	{
	
	 	$tracknumber 		=  $request->trucking_number;
	 	$shipment_company 	=  $request->shipment_company;
		$tracking_notes 	=  $request->tracking_notes;
		
		
		$offer_id 			=  $request->offer_id;
	 	$user_id 			=  $request->user()->id;
	 	$pay_method			=  "purchased_product";
	 	
		

		$answersproductList = $request->answersproductList;
		
		// submit data in purchase survey
		/* 
		if(!empty($answersproductList))
		{
			$this->submit_purchasesurvey($answersproductList,$user_id,$offer_id);
		}
		*/
		
		//if exist tracking_number
		if(users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			$data = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->first();
			
	 
			// check if tracking number is not yet delivered
			if($data->remarks != "Delivered")
			{
			
				users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'tracking_number' =>  $tracknumber,
					'shipment_company' =>  $shipment_company,
					'notes' => (@$tracking_notes  != '') ? @$tracking_notes  : "",
					
				]);
			
				//call the update tracking number once save the data
			$res = $this->UpdateStatusoftrackingNumber($shipment_company,$tracknumber,$offer_id,$user_id,$pay_method);
		
			}
			else{
			    if($request->type != ''){
			        $update = \DB::table('offer_competitors_steps_dones')->where('offer_id',$offer_id)->where('user_id',$user_id)
            		 ->update(['tracking_number' => 1,'completed_process' => 1]);
            		 if($update){
            		     return array('result' => 'verified');
            		 }
			    }
			}
		}
		else
		{
		 	$savetruckingnumber = new users_offer_4_submit_tracking_numbers();
			$savetruckingnumber->offer_id 		  =  $offer_id;
			$savetruckingnumber->user_id  		  =  $user_id;
			$savetruckingnumber->shipment_company =  $shipment_company;
			$savetruckingnumber->tracking_number  =  $tracknumber;
			$savetruckingnumber->notes  		  =  (@$tracking_notes  != '') ? @$tracking_notes  : "";
			$savetruckingnumber->status  		  =  0;
			$savetruckingnumber->completed  	  =  0;
			$savetruckingnumber->remarks  		  =  '';
			$savetruckingnumber->save(); 
			
			// update users_offer_2_get_schedules table  column is_done to 1  if user filled the tracking number
				users_offer_2_get_schedules::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'is_done' =>  1,
					'is_done_date' => date('Y-m-d H:i:s')
				]);
			//call the update tracking number once save the data
			$res = $this->UpdateStatusoftrackingNumber($shipment_company,$tracknumber,$offer_id,$user_id,$pay_method);
			$data = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->first();
// 			if($data->remarks == "Delivered"){
//     			if($request->type == 'compare'){
//         		    if(!empty($res)){
//         		      //  $update = \DB::table('offer_competitors_steps_done')->where('offer_id',$offer_id)->where('user_id',$user_id)
//         		      //  ->update(['tracking_number' => 1,'completed_process' => 1]);
//                         $price = $this->get_amount_tracking_price($user_id,$offer_id);
//                         $offer_settings = \DB::table('offer_settings')->select('*')->where('id',$offer_id)->get();
//                         $get_id = \DB::table('offer_competitors_steps_done')->select('*')->where('user_id',$user_id)->where('offer_id',$offer_id)->get();
//                         $grant_points = \DB::table('user_rebate_points')
//                 	    ->insert([['buyer_id' => $user_id,'seller_id' => $offer_settings[0]->created_by,
//                 	    'transaction_label' => 'Earned Points For Compare','transaction_table' => 'offer_competitors_steps_done',
//                 	    'transaction_id' => $get_id[0]->id,'points' => $offer_settings[0]->earn_points,'remarks' => 'claimed',
//                 	    'status' => 0,'date_claimed' => date('Y-m-d H:i:s')]]);
//                         if($grant_points == true){
//                             return response()->json(array('result' => $res,'points' => $offer_settings[0]->earn_points,'cashback' => $price));
//                         }
//         		    }
//         		}
// 			}
		}
		return response()->json(array('result' => $res));
		
		
		
	}
	
	public function get_amount_tracking_price($user_id,$offer_id){
        $getinfo = \DB::table('users_offer_2_get_schedules')->select('*')->where('user_id','=',$user_id)->where('offer_id','=',$offer_id)->get();
        
		$product_price 			= $getinfo[0]->product_price;
		$product_discount_label = $getinfo[0]->product_discount_label;	
		$product_discount 		= $getinfo[0]->product_discount;

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
	    $product_info = \DB::table('offer_settings')->select('*')->where('id',$offer_id)->get();;
		$purchase_rebate 		= $product_info[0]->purchase_rebate;
		$purchase_rebate_amount = $product_info[0]->purchase_rebate_amount;
		
		if($purchase_rebate == "Percentage")
		{
			$rebate_percent = $purchase_rebate_amount / 100;
			$rebate_amount =  $product_sale_amount * $rebate_percent;
		
		}
		else if($purchase_rebate == "Dollar")
		{
			$rebate_amount = $product_sale_amount - $purchase_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $purchase_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
    }
	public function CallCronjob_tracking_number($id,$shipment_company,$tracknumber,$offer_id,$user_id,$pay_method)
	{
		
		if(users_offer_4_submit_tracking_numbers::where('id',$id)->where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			
			$data = users_offer_4_submit_tracking_numbers::where('id',$id)->where('offer_id',$offer_id)->where('user_id', $user_id)->first();
			
		
			// check if tracking number is not yet delivered
			if($data->remarks != "Delivered")
			{
				//call the update tracking number once save the data
				$this->UpdateStatusoftrackingNumber($shipment_company,$tracknumber,$offer_id,$user_id,$pay_method);
				
			}
			
		}
		
		echo 'success';
		
	}
	public function UpdateStatusoftrackingNumber($shipment_company,$tracknumber,$offer_id,$user_id,$pay_method)
	{
			switch ($shipment_company) 
			{
				case "FEDEX":
					$response = $this->Fedex($tracknumber);
				break;
				
				case "USPS":
					$response = $this->USPS($tracknumber);
				break;
				
				default:
					$response = $this->getStatusTrackingNumber($tracknumber,$shipment_company);
				break;
			}
		$returnData = (json_decode($response));
		// Update Status of delivery
		if(users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'remarks' =>  ucfirst($returnData->status),
				'statusWithDetails' =>  $returnData->statusWithDetails,
			]);
		}
		// update delivery information if status is delivered
		$remarks_status2 = ucfirst(preg_replace('/\s+/', '',$returnData->status));
		if($remarks_status2 == "Delivered")
		{
			$tracknumber = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->first();
			
			if(empty($tracknumber->active_date_delivered) && empty($tracknumber->active_survey_date))
			{
				//get 7 days and random date
				$datenow = date('Y-m-d H:i:s');
				$first_date = date('Y-m-d', strtotime('+7 days', strtotime($datenow)));
				$second_date = date('Y-m-d', strtotime('+7 days', strtotime($first_date)));
				
				$randon_date =  $this->random_date_in_range($first_date, $second_date);
			
				users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'active_date_delivered'  =>  $datenow,
					'active_survey_date'	 =>  $randon_date,	
					'status'	 			 =>  1,						
				]);
				
			}

		}
		
		
		//miles update function
		//if status is Delivered then pay user
		if($remarks_status2 == "Delivered")
		{
			$batch_id = $tracknumber->id;
			//$data = $this->UserPaymentVccController->proceedtoPayUser($offer_id,$user_id,$batch_id,$pay_method);
			
			$data = $this->UserRebateTransactionController->proceedtoPayUser_miles($offer_id,$user_id,$batch_id,$pay_method);
			$check_points = \DB::table('offer_settings')->select('*')->where('id',$offer_id)->get();
			$check_transaction_id = \DB::table('offer_competitors_steps_dones')->select('*')->where('offer_id',$offer_id)->where('user_id',$user_id)->get();
			if($check_points[0]->earn_points > 0){
			    $check_old_inserted = user_rebate_points::where('buyer_id',$user_id)->where('offer_id',$offer_id)->get();
			    if(empty($check_old_inserted[0])){
    			    $insert = new user_rebate_points();
    			    $insert->buyer_id = $user_id;
    			    $insert->offer_id = $offer_id;
    			    $insert->seller_id = $check_points[0]->created_by;
    			    $insert->transaction_label = 'Bonus Points Compare Campaign';
    			    $insert->transaction_table = 'offer_competitors_steps_done';
    			    $insert->transaction_id = $check_transaction_id[0]->id;
    			    $insert->points = $check_points[0]->earn_points;
    			    $insert->remarks = 'claimed';
    			    $insert->status = 0;
    			    $insert->save();
			    }else{
			        $update = user_rebate_points::where('buyer_id',$user_id)->where('offer_id',$offer_id)
			        ->update(['buyer_id' => $user_id,
			        'offer_id' => $offer_id,
			        'seller_id' => $check_points[0]->created_by,
			        'transaction_label' => 'Bonus Points Compare Campaign',
			        'transaction_table' => 'offer_competitors_steps_done',
			        'points' => $check_points[0]->earn_points,
			        'remarks' => 'claimed',
			        'status' => 0]);
			    }
			    
			}
		}
		
		
		return 	$returnData;
		
			
	}
	
	
	public function Fedex($tracknumber)
	{
		$tracknumber = preg_replace('/\s+/', '', $tracknumber);
		
		$data = '{"TrackPackagesRequest":{"appType":"WTRK","appDeviceType":"","supportHTML":true,"supportCurrentLocation":true,"uniqueKey":"","processingParameters":{},"trackingInfoList":[{"trackNumberInfo":{"trackingNumber":'.$tracknumber.',"trackingQualifier":"","trackingCarrier":""}}]}}';	
		$response = file_get_contents('https://www.fedex.com/trackingCal/track?action=trackpackages&data='.$data);
		$response = json_decode($response);
		$moreinfo = $response->TrackPackagesResponse->packageList;
			
		$statusWithDetails = $moreinfo[0]->statusWithDetails;	
		
		if($moreinfo[0]->keyStatus == "In transit")
		{
			$statusWithDetails = "This tracking number cannot be found, please check the tracking number or contact the sender.";
		}	

			
		$status = array(
						'status' => $moreinfo[0]->keyStatus,
						'statusWithDetails' =>  $statusWithDetails,
						'isDelivered'  => $moreinfo[0]->isDelivered,
					);
		
		return json_encode($status);
	
			
	}
	
	public function USPS($tracknumber)
	{
		
		$tracknumber = preg_replace('/\s+/', '', $tracknumber);
		
	
		$scrap_trackingnumber = new scrap_trackingnumber();
		$urlko = "https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels='".$tracknumber."'";
		$html =  $scrap_trackingnumber->file_get_html($urlko);
		
		// Find all article blocks
		foreach($html->find('div#tracked-numbers') as $article) 
		{
			$item['tracking_number'] = $article->find('h3.tracking_number', 0)->plaintext;
			$item['delivery_status'] = $article->find('div.delivery_status', 0)->plaintext;
			$item['text_explanation']= $article->find('span.text_explanation', 0)->plaintext;
			$object[] = $item;
			
			
		}
		

		$status = array(
		
						'status' => $object[0]['text_explanation'],
						'statusWithDetails' =>  preg_replace('/\s+/', ' ', $object[0]['delivery_status']),
						'isDelivered'  => $object[0]['text_explanation'],
						'tracking_number'  => $object[0]['tracking_number'],
					);
		
		return json_encode($status);
		
	}
	
	public function getStatusTrackingNumber($tracknumber,$shipment_company)
	{
		$tracknumber = preg_replace('/\s+/', '', $tracknumber);
		
		/*
		$getStatus = new GetStatus();
		$html =  $getStatus->getAction($shipment_company,$tracknumber);
		$html =  $getStatus->getAction("DHL",$tracknumber);
		$newdata = (json_decode($html));
		*/
		
		//$dhlTracker = ShipmentTracker::get('UPS');
		
		$dhlTracker = ShipmentTracker::get($shipment_company);
		$track = $dhlTracker->track($tracknumber);
		$latestEvent = $track->latestEvent();
		$array = array();
		
		
		
		if(!empty($latestEvent))
		{
			
			if($track->delivered()){
			  $array['isDelivered'] = "Delivered to " . $track->getRecipient();
			}
			else{
				$array['isDelivered'] = "Not delivered yet, The current status is " . $track->currentStatus();
				$array['status']  =  $track->currentStatus();
			}
			

			$array['status'] = $latestEvent->getStatus();

			$array['description'] =  "The parcel was last seen in " . $latestEvent->getLocation() . " on " . $latestEvent->getDate()->format('Y-m-d') . " " . $latestEvent->getDescription(); 
		}
		else
		{
			$array['isDelivered'] = "";
			$array['status'] =  "The current status is " . $track->currentStatus();
			$array['description'] = 'This tracking number cannot be found, please check the number or contact the sender.';
			
		}
		
		//return  json_encode($array);
		
		 $status = array(

				'status' => $array['status'],
				'statusWithDetails' =>  $array['description'],
				'isDelivered'  => 	$array['isDelivered'],
			);
		
	
		
		return json_encode($status);
		
	}
	
	
	
	
	
	public function submit_purchasesurvey($answersproductList,$user_id,$offer_id)
	{
		
		foreach($answersproductList as $product)
		{
			
			if(!empty($product['answer']))
			{
		
				if(purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$product['questionId'])->exists())
				{
					purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$product['questionId'])->update([
						'answer'	=> $product['answer'],
					]);
				}
				else
				{
				
					$purchare_review_answers = new purchare_review_answers();
					$purchare_review_answers->offer_id		=  $offer_id;
					$purchare_review_answers->user_id 		=  $user_id;
					$purchare_review_answers->questionId 	=  $product['questionId'];
					$purchare_review_answers->form 			=  $product['fieldtype'];
					$purchare_review_answers->answer 		=  $product['answer'];
					$purchare_review_answers->save(); 
				}
		
			}
		
		}
	

	}
	
	
	public function getpurchasedData(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		$data = purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	
	public function checking_tracking_number(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		$data = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	
	public function update_status_tracking_number(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offer_id;
		$remarks =  $request->remarks;
		$statusWithDetails =  $request->statusWithDetails;
		
		
	
		
		//if exist tracking_number
		if(users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'remarks' =>  $remarks,
				'statusWithDetails' =>  $statusWithDetails,
				
			]);
			
		}
		
		
		if($remarks == "Delivered" || $remarks == "delivered")
		{
			$tracknumber = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->get();
			
			
			
			
			if(empty($tracknumber[0]->active_date_delivered) && empty($tracknumber[0]->active_date_delivered))
			{
				//get 7 days and random date
				$datenow = date('Y-m-d H:i:s');
				$first_date = date('Y-m-d', strtotime('+7 days', strtotime($datenow)));
				$second_date = date('Y-m-d', strtotime('+7 days', strtotime($first_date)));
				
				$randon_date =  $this->random_date_in_range($first_date, $second_date);
			
				users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'active_date_delivered'  =>  $datenow,
					'active_survey_date'	 =>  $randon_date,	
					'status'	 			 =>  1,						
				]);
				
			}
		}
	
		return response()->json(array('success' => 'success'));
		
	}
	
	
	
	function random_date_in_range( $date1, $date2 )
	{
		  // Convert to timetamps
			$min = strtotime($date1);
			$max = strtotime($date2);

			// Generate random number using above bounds
			$val = rand($min, $max);

			// Convert back to desired date format
			return date('Y-m-d H:i:s', $val);
	}
	
	
	public function checkifallreadyansweredsurvey(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offerid;
	
		
		//if exist account
		if(purchare_review_answers::where('user_id', $user_id)->where('offer_id', $offer_id)->exists())
		{	
			echo 'done';
			exit;
		}
		else
		{
			echo 'notyet';
		}
	
	}
	
	
	public function GetStatusDateAvailable(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offer_id;
		
		if(users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
		
			$data = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
			return response()->json($data);
			exit;
		}
		
		return response()->json([]);
		
	}



}
