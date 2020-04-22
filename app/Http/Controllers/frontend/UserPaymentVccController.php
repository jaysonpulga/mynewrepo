<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\frontend\user_rebate_transaction;

use App\Model\frontend\user_vcc;
use App\Model\frontend\user_vcc_historypays;
use App\Model\frontend\user_notifications;

use App\Model\frontend\users_offer_1_sent_campaigns as SentCampaign;
use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\frontend\users_offer_3_continue_accepts;
use App\Model\frontend\users_offer_4_submit_tracking_numbers;
use App\Model\frontend\users_offer_5_completeds;

use App\Model\offer_settings;
use Auth;

use App\Model\frontend\User;

use App\Http\Controllers\frontend\UserVccController;
use App\Http\Controllers\frontend\NotificationsController;
use App\Http\Controllers\frontend\SendEmailController;

class UserPaymentVccController extends Controller
{
	protected $UserVccController;
	protected $NotificationsController;
	protected $SendEmailController;

	
	public function __construct(UserVccController $UserVccController,NotificationsController $NotificationsController,SendEmailController $SendEmailController)
    {
		 $this->UserVccController = $UserVccController;
		 $this->NotificationsController = $NotificationsController;
		 $this->SendEmailController = $SendEmailController;

    }
	
	public function proceedtoPayUser($offer_id,$user_id,$batch_id,$pay_method)
	{
		
		$data = $this->UserVccController->checkifuserhaveVcc($user_id);
		$price = $this->UserVccController->get_amount_tracking_price($user_id,$offer_id);
		
		$cardID       = $data['cardID'];
		$amount 	  = $data['amount'];
		$total_amount = $amount + $price;
		
		$returntotalAmount =  $this->UserVccController->UpdateVccAccountofuser($cardID,$total_amount);
	    
		
		//update vcc account
		if(user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->exists())
		{	
			user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->update([
					'virtual_amount'  =>  $returntotalAmount['amount'],
								
				]);
		}
		
		// save vcc history
		$user_vcc_historypays = new user_vcc_historypays();
		$user_vcc_historypays->user_id  		=  $user_id;
		$user_vcc_historypays->cc_id 			=  $cardID;
		$user_vcc_historypays->virtual_amount  	=  $price;
		$user_vcc_historypays->offer_id  		=  $offer_id;
		$user_vcc_historypays->pay_method  		=  $pay_method;
		$user_vcc_historypays->save();
		//
		
		//send notification 
		/*$this->NotificationsController->notifation_product_delivered($offer_id,$user_id,$batch_id);*/
		
		//send email
		/*
		$datauser = User::where('id',$user_id)->first();
		$name 	= $datauser->name;
		$email  = $datauser->email;
		$this->SendEmailController->Mailsent_product_delivered($user_id,$name,$email,$offer_id,$price);
		*/
		
	}
	
	
	public function proceedtoPayUserproduct_return($offer_id,$user_id,$batch_id,$pay_method)
	{
		
		$data = $this->UserVccController->checkifuserhaveVcc($user_id);
		$price = $this->UserVccController->get_amount_tracking_price_product_return($user_id,$offer_id);
		
		$cardID       = $data['cardID'];
		$amount 	  = $data['amount'];
		$total_amount = $amount + $price;
		
		$returntotalAmount =  $this->UserVccController->UpdateVccAccountofuser($cardID,$total_amount);
	
		
		//update vcc account
		if(user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->exists())
		{	
			user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->update([
					'virtual_amount'  =>  $returntotalAmount['amount'],
								
				]);
		}
		
		// save vcc history
		$user_vcc_historypays = new user_vcc_historypays();
		$user_vcc_historypays->user_id  		=  $user_id;
		$user_vcc_historypays->cc_id 			=  $cardID;
		$user_vcc_historypays->virtual_amount  	=  $price;
		$user_vcc_historypays->offer_id  		=  $offer_id;
		$user_vcc_historypays->pay_method  		=  $pay_method;
		$user_vcc_historypays->save();
		//
		
		//send notification 
		$this->NotificationsController->notifation_return_product_delivered($offer_id,$user_id,$batch_id);
		
		//send email
		$datauser = User::where('id',$user_id)->first();
		$name 	= $datauser->name;
		$email  = $datauser->email;
		$this->SendEmailController->Mailsent_return_product_delivered($user_id,$name,$email,$offer_id,$price);
		
	}
	
	
	
	
	public function proceedtoPayUser_submitproductreview($offer_id,$user_id,$batch_id,$pay_method)
	{
		
		$data = $this->UserVccController->checkifuserhaveVcc($user_id);
		$price = $this->UserVccController->get_amount_submitproductreview($user_id,$offer_id);
		
		$cardID       = $data['cardID'];
		$amount 	  = $data['amount'];
		$total_amount = $amount + $price;
		
		$returntotalAmount =  $this->UserVccController->UpdateVccAccountofuser($cardID,$total_amount);
	
		
		//update vcc account
		if(user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->exists())
		{	
			user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->update([
					'virtual_amount'  =>  $returntotalAmount['amount'],
								
				]);
		}
		
		// save vcc history
		$user_vcc_historypays = new user_vcc_historypays();
		$user_vcc_historypays->user_id  		=  $user_id;
		$user_vcc_historypays->cc_id 			=  $cardID;
		$user_vcc_historypays->virtual_amount  	=  $price;
		$user_vcc_historypays->offer_id  		=  $offer_id;
		$user_vcc_historypays->pay_method  		=  $pay_method;
		$user_vcc_historypays->save();
		//
		
		//send notification 
		/*$this->NotificationsController->notifation_product_delivered($offer_id,$user_id,$batch_id);*/
		
		//send email
		/*
		$datauser = User::where('id',$user_id)->first();
		$name 	= $datauser->name;
		$email  = $datauser->email;
		$this->SendEmailController->Mailsent_product_delivered($user_id,$name,$email,$offer_id,$price);
		*/
		
	}
	
	
	
	
	
	
	
	public function proceedtoPayUser_amazonuploadfile($offer_id,$user_id,$batch_id,$status,$pay_method,$remarks)
	{
		
		$data = $this->UserVccController->checkifuserhaveVcc($user_id);
		$price = $this->UserVccController->get_amount_amazonupload_file($user_id,$offer_id);
		
		$cardID       = $data['cardID'];
		$amount 	  = $data['amount'];
		$total_amount = $amount + $price;
		
		$returntotalAmount =  $this->UserVccController->UpdateVccAccountofuser($cardID,$total_amount);
	
		
		//update vcc account
		if(user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->exists())
		{	
			user_vcc::where('user_id', $user_id)->where('cc_id', $cardID)->update([
					'virtual_amount'  =>  $returntotalAmount['amount'],
								
				]);
		}
		
		// save vcc history
		$user_vcc_historypays = new user_vcc_historypays();
		$user_vcc_historypays->user_id  		=  $user_id;
		$user_vcc_historypays->cc_id 			=  $cardID;
		$user_vcc_historypays->virtual_amount  	=  $price;
		$user_vcc_historypays->offer_id  		=  $offer_id;
		$user_vcc_historypays->pay_method  		=  $pay_method;
		$user_vcc_historypays->save();
		//
		
		//send notification 
		//$this->NotificationsController->notifation_upload_product_survey($offer_id,$user_id,$batch_id,$status);
		
		
		//send email
		/*
		$datauser = User::where('id',$user_id)->first();
		$name 	= $datauser->name;
		$email  = $datauser->email;
		$this->SendEmailController->Mailsent_upload_product_survey($user_id,$name,$email,$offer_id,$price,$status,$remarks);
		*/
		
	}
	


}