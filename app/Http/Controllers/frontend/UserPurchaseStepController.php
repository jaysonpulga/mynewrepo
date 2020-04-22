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


class UserPurchaseStepController extends Controller
{
    
    public function submit_step6(Request $request)
    {
         $user_id =  $request->user()->id;
         $offer_id =  $request->offer_id;
         $product_id =  $request->product_id;
         $order_number =  $request->order_number;
        
         if(users_offer_purchase_6th_steps::where('offer_id',$offer_id)->where('user_id', $user_id)->where('product_id', $product_id)->exists())
		{
			
				return json_encode(array('result'=>'exit')); 
			exit;
		}
		else
		{
			
		
			
		 	$users_offer_purchase_6th_steps = new users_offer_purchase_6th_steps();
			$users_offer_purchase_6th_steps->offer_id 		=  $offer_id;
			$users_offer_purchase_6th_steps->user_id  		=  $user_id;
			$users_offer_purchase_6th_steps->product_id     =  $product_id;
			$users_offer_purchase_6th_steps->order_number   =  $order_number;
			$users_offer_purchase_6th_steps->save(); 
			
			$url = asset("campaign/instruction/offerdetails/".$offer_id);
			return json_encode(array('result'=>'success','url'=>$url));
			exit;

 
		}
 
        
        
    }
    
    
    
    public function submit_step5(Request $request)
    {
         $user_id =  $request->user()->id;
         $offer_id =  $request->offer_id;
         $product_id =  $request->product_id;
    
        $question1 =  $request->question1;
        $question2 =  $request->question2;
        
         if(users_offer_purchase_5th_steps::where('offer_id',$offer_id)->where('user_id', $user_id)->where('product_id', $product_id)->exists())
		{
			
		
				
		}
		else
		{
			
		
			
		 	$users_offer_purchase_5th_steps = new users_offer_purchase_5th_steps();
			$users_offer_purchase_5th_steps->offer_id 		=  $offer_id;
			$users_offer_purchase_5th_steps->user_id  		=  $user_id;
			$users_offer_purchase_5th_steps->product_id     =  $product_id;
			$users_offer_purchase_5th_steps->question1      =  $question1;
			$users_offer_purchase_5th_steps->question2      =  $question2;


			$users_offer_purchase_5th_steps->save(); 
			
			echo 'success';
			
 
		}
 
        
        
    }
    
    
    
     public function submit_step4(Request $request)
    {
        $user_id =  $request->user()->id;
        $offer_id =  $request->offer_id;
        $product_id =  $request->product_id;
      
        @$idealist_name =  $request->$idealist_name;
        $is_idealist =  $request->is_idealist;
        $idealist_product_count =  $request->idealist_product_count;
        $idealist_public =  $request->idealist_public;
        $url =  $request->url;
        
    
        if(users_offer_purchase_4rt_steps::where('offer_id',$offer_id)->where('user_id', $user_id)->where('product_id', $product_id)->exists())
		{
			
		
				
		}
		else
		{
			
		
			
		 	$users_offer_purchase_4rt_steps = new users_offer_purchase_4rt_steps();
			$users_offer_purchase_4rt_steps->offer_id 		           =  $offer_id;
			$users_offer_purchase_4rt_steps->user_id  		           =  $user_id;
			$users_offer_purchase_4rt_steps->product_id                =  $product_id;
			
			$users_offer_purchase_4rt_steps->idealist_name             =  (!empty(@$idealist_name) ? @$idealist_name : "0");
			$users_offer_purchase_4rt_steps->is_idealist               =  $is_idealist;
			$users_offer_purchase_4rt_steps->idealist_product_count    =  $idealist_product_count;
			$users_offer_purchase_4rt_steps->idealist_public           =  $idealist_public;
			$users_offer_purchase_4rt_steps->url                       =  $url;
			$users_offer_purchase_4rt_steps->save(); 
			
			echo 'success';
			
 
		}
      
        
        
    }
    
    
    
    public function checkasin(Request $request)
    {
        $user_id =  $request->user()->id;
        $offer_id =  $request->offer_id;
        $product_id =  $request->product_id; 
        $asin =  $request->asin; 
        
        
        if(offer_settings::where('id',$offer_id)->where('product_id', $asin)->where('product_id', $product_id)->exists())
		{
		    
		    $users_offer_purchase_check_asins = new users_offer_purchase_check_asins();
			$users_offer_purchase_check_asins->offer_id 		 =  $offer_id;
			$users_offer_purchase_check_asins->user_id  		 =  $user_id;
			$users_offer_purchase_check_asins->product_id        =  $product_id;
			$users_offer_purchase_check_asins->product_asin      =  $asin;
			$users_offer_purchase_check_asins->save(); 
		    
		  
		 
		    return response()->json(array('result' => 'success'));
	
		}
        else
        {
            return response()->json(array('result' => 'notfound'));
        }
        
        
    }
    
    
    
    
    public function LoadStep(Request $request)
    {
        
        
        $user_id =  $request->user()->id;
        $offer_id =  $request->offer_id;
        $product_id =  $request->product_id;
        
        $select ="*";

        $stepDetails = \DB::table('users_offer_purchase_products')
		->select(\DB::raw($select))
		->where('offer_id',$offer_id)
		->where('user_id', $user_id)
		->where('product_id', $product_id)
		->first();
		
		

		
		return response()->json(array('data' => $stepDetails));
		
        
    }
    
    
    
    public function update_purchase_product_steps(Request $request)
    {
        
        $user_id =  $request->user()->id;
        $offer_id =  $request->offer_id;
        $product_id =  $request->product_id;
        $step =  $request->step;
        
        
        

		if(users_offer_purchase_products::where('offer_id',$offer_id)->where('user_id', $user_id)->where('product_id', $product_id)->exists())
		{
			
		
			    switch ($step) 
			    {
                    case '1':
                        $array = array('step1'=>'1');
                        break;
                    case '2':
                         $array = array('step2'=>'1');
                        break;
                    case '3':
                         $array = array('step3'=>'1');
                        break;
                    case '4':
                         $array = array('step4'=>'1');
                        break;
                    case '5':
                         $array = array('step5'=>'1');
                        break;
                    case '6':
                         $array = array('step6'=>'1');
                        break;
                }
		
	          
				
				users_offer_purchase_products::where('offer_id',$offer_id)->where('user_id', $user_id)->where('product_id', $product_id)->update($array);
				
		}
		else
		{
			
		
			
		 	$users_offer_purchase_products = new users_offer_purchase_products();
			$users_offer_purchase_products->offer_id 		  =  $offer_id;
			$users_offer_purchase_products->user_id  		  =  $user_id;
			$users_offer_purchase_products->product_id        =  $product_id;
			$users_offer_purchase_products->step1             =  1;
			$users_offer_purchase_products->save(); 
			
 
		}
  	}
    
    
}