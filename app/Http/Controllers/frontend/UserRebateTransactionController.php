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

class UserRebateTransactionController extends Controller{
    
    protected $UserVccController;
	protected $NotificationsController;
	protected $SendEmailController;
	
	public function __construct(UserVccController $UserVccController,NotificationsController $NotificationsController,SendEmailController $SendEmailController)
    {
		 $this->UserVccController = $UserVccController;
		 $this->NotificationsController = $NotificationsController;
		 $this->SendEmailController = $SendEmailController;

    }
    public function proceedtoPayUser_miles($offer_id,$user_id,$batch_id,$pay_method){
        
	    $price = $this->UserVccController->get_amount_tracking_price($user_id,$offer_id);
	    
	    $offer_settings = offer_settings::where('id',$offer_id)->first(); 
	    $user_rebate_transaction = new user_rebate_transaction();
		$user_rebate_transaction->user_id  		=  $user_id;
		$user_rebate_transaction->campaign_id  	=  $offer_id;
		$user_rebate_transaction->product_id  	=  $offer_settings->product_id;
		$user_rebate_transaction->pay_method  	=  $pay_method;
		$user_rebate_transaction->amount  		=  $price;
		$user_rebate_transaction->status  	    =  'unpaid';
		$user_rebate_transaction->seller_id     =  $offer_settings->created_by;
		$user_rebate_transaction->transaction_date   =  date('Y-m-d H:i:s');
		$user_rebate_transaction->save();
	}
}