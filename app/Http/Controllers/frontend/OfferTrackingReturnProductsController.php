<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;

use App\Model\frontend\users_offer_7_submit__return_products_tracking_numbers;
use App\Model\frontend\user_vcc_historypays;
use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\offer_settings;


use App\functions\scrap_trackingnumber;
use App\functions\getShipmentStatus\getStatus;
use App\Http\Controllers\frontend\UserPaymentVccController;

use Illuminate\Http\Request;

class OfferTrackingReturnProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	protected $UserPaymentVccController;
		 
	public function __construct(UserPaymentVccController $UserPaymentVccController)
    {
		 $this->UserPaymentVccController = $UserPaymentVccController;

    }
	 
	public function submit_return_product(Request $request)
	{
		
		$tracknumber 			=  $request->trucking_number;
		$shipment_company 		=  $request->shipment_company;
		$tracking_notes_return 	=  $request->tracking_notes_return;
		
		
		$offer_id 			=  $request->offer_id;
		$user_id 			=  $request->user()->id;
		$pay_method			=  "return_product";
		
	
		//if exist tracking_number
		if(users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			
			$data = users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->first();
			
		
			
			// check if tracking number is not yet delivered
			if($data->remarks != "Delivered")
			{
				
				users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'notif_status'   =>  1,
			
				]);
				
				//call the update tracking number once save the data
				$this->UpdateStatusoftrackingNumber($shipment_company,$tracknumber,$offer_id,$user_id,$pay_method);
				
			
			}
			
	
		}
		else
		{
			
		
			
		 	$savetruckingnumber = new users_offer_7_submit__return_products_tracking_numbers();
			$savetruckingnumber->offer_id 		  =  $offer_id;
			$savetruckingnumber->user_id  		  =  $user_id;
			$savetruckingnumber->shipment_company =  $shipment_company;
			$savetruckingnumber->tracking_number  =  $tracknumber;
			$savetruckingnumber->status  		  =  0;
			$savetruckingnumber->notes  		  =  $tracking_notes_return;
			$savetruckingnumber->save(); 
			
			//call the update tracking number once save the data
			$this->UpdateStatusoftrackingNumber($shipment_company,$tracknumber,$offer_id,$user_id,$pay_method);
			
	
				
		}
		

		return response()->json(array('success' => 'success'));
		
		
	}
	
	
	
	public function CallCronjob_tracking_return_product_number($id,$shipment_company,$tracknumber,$offer_id,$user_id,$pay_method)
	{
		if(users_offer_7_submit__return_products_tracking_numbers::where('id',$id)->where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			
			$data = users_offer_7_submit__return_products_tracking_numbers::where('id',$id)->where('offer_id',$offer_id)->where('user_id', $user_id)->first();
			
		
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
		if(users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'remarks' =>  ucfirst($returnData->status),
				'statusWithDetails' =>  $returnData->statusWithDetails,
			]);
			
		}
		
		// update delivery information if status is delivered
		$remarks_status2 = ucfirst(preg_replace('/\s+/', '',$returnData->status));
		if($remarks_status2 == "Delivered")
		{
			$tracknumber = users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->first();
			
			if(empty($tracknumber->active_date_return))
			{

				$datenow = date('Y-m-d H:i:s');

				users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'active_date_return'  =>  $datenow,
					'status'	 			 =>  1,						
				]);
				
			}

		}
		
		//if status is Delivered then pay user
		
		if($remarks_status2 == "Delivered")
		{
			$batch_id = $tracknumber->id;
			$data = $this->UserPaymentVccController->proceedtoPayUserproduct_return($offer_id,$user_id,$batch_id,$pay_method);
		}
		
		
			
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
		
		$getStatus = new GetStatus();
		$html =  $getStatus->getAction($shipment_company,$tracknumber);
		
		$newdata = (json_decode($html));
		
		
		 $status = array(

				'status' => $newdata->status,
				'statusWithDetails' =>  $newdata->description,
				'isDelivered'  => $newdata->isDelivered,
			);
		
	
		
		return json_encode($status);
		
	}
	
	

	
	public function return_product_checking_tracking_number(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		$data = users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	 
	public function return_update_status_tracking_number(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offer_id;
		$remarks =  $request->remarks;
		$statusWithDetails =  $request->statusWithDetails;
		
		
	
		
		//if exist tracking_number
		if(users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			users_offer_7_submit__return_products_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'remarks' =>  $remarks,
				'statusWithDetails' =>  $statusWithDetails,
				
			]);
			
		}
	
		return response()->json(array('success' => 'success'));
		
	} 
	
	
	public function checkifuser_alreadypaidforproductreturn(Request $request)
	{
		
		$user_id = $request->user()->id;
		$offer_id = $request->offer_id;
		$pay_method = $request->pay_method;
		
		if(user_vcc_historypays::where('user_id', $user_id)->where('offer_id', $offer_id)->where('pay_method', $pay_method)->exists())
		{	
			return 'already_paid';
			exit;
		}
		else
		{
			return 'notyet_paid';
			exit;
		}
		
		
	}
	
	
	
	
	public static function get_amount_retun_product(Request $request)
	{
		
		$user_id = $request->user()->id;
		$offer_id = $request->offer_id;
		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
					
		$product_info = offer_settings::where('id',$offer_id)->first();			
					
					
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
	
		$return_product_rebate 		= $product_info->return_product_rebate;
		$return_product_rebate_amount = $product_info->return_product_rebate_amount;
		
		if($return_product_rebate == "Percentage")
		{
			$rebate_percent = $return_product_rebate_amount / 100;
			$rebate_amount =  $product_sale_amount * $rebate_percent;
		
		}
		else if($return_product_rebate == "Dollar")
		{
			$rebate_amount = $product_sale_amount - $return_product_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $return_product_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	
	
	
	public static function fee_amount_purcahsed_product($user_id,$offer_id)
	{
		

		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
							
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;
		
		
		$product_info = offer_settings::where('id',$offer_id)->first();		

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
		$original_product_price = sprintf('%0.2f', $product_price);
		
	
		$purchase_rebate 		= $product_info->purchase_rebate;
		$purchase_rebate_amount = $product_info->purchase_rebate_amount;
		
		if($purchase_rebate == "Percentage")
		{
			$rebate_percent = $purchase_rebate_amount / 100;
			$rebate_amount =  $original_product_price * $rebate_percent;
		
		}
		else if($purchase_rebate == "Dollar")
		{
			//$rebate_amount = $product_sale_amount - $purchase_rebate_amount;
			
			$rebate_amount =  $purchase_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $purchase_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	public static function fee_amount_amazon_rebate($user_id,$offer_id)
	{
		

		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
							
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;
		
		
		$product_info = offer_settings::where('id',$offer_id)->first();		

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
		$original_product_price = sprintf('%0.2f', $product_price);
	
		$amazon_rebate 		= $product_info->amazon_rebate;
		$amazon_rebate_amount = $product_info->amazon_rebate_amount;
		
		if($amazon_rebate == "Percentage")
		{
			$rebate_percent = $amazon_rebate_amount / 100;
			$rebate_amount =  $original_product_price * $rebate_percent;
		
		}
		else if($amazon_rebate == "Dollar")
		{
			//$rebate_amount = $product_sale_amount - $amazon_rebate_amount;
			
			$rebate_amount =  $amazon_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $amazon_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	public static function fee_amount_retun_product($user_id,$offer_id)
	{

		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
				
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;
		
		
		$product_info = offer_settings::where('id',$offer_id)->first();	

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
	
		$return_product_rebate 		= $product_info->return_product_rebate;
		$return_product_rebate_amount = $product_info->return_product_rebate_amount;
		
		if($return_product_rebate == "Percentage")
		{
			$rebate_percent = $return_product_rebate_amount / 100;
			$rebate_amount =  $product_sale_amount * $rebate_percent;
		
		}
		else if($return_product_rebate == "Dollar")
		{
			$rebate_amount = $product_sale_amount - $return_product_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $return_product_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	
	 
	 
	
}
