<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*
* USER / FRONTEND
*
*/ 


Route::get('/testTracker', 'frontend\SendEmailController@testTracker');


Route::get('/clearcache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/runwebsocket', function() {
    $exitCode = Artisan::call('websocket:init');
    return 'RUN'; //Return anything
});

 //Clear config cache:
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 });
 
 
  Route::get('/cache-clear', function() {
     $exitCode = Artisan::call('cache:clear');
     return ' Cache cleared';
 });
 
 
  //Clear config cache:
 Route::get('/route_clear', function() {
     $exitCode = Artisan::call('route:clear');
     return 'route cache cleared';
 });


Route::get('testkomunaito', function () { 

return view('testkomuna');

});


/*
Route::get('signups/{id?}', function () { 

//return view('testcode');
//return view('temporary-close');

});
*/




Route::get('privacy-policy', function () { 

return view('privacy-policy');

});


Route::get('Terms-and-Condition', function () { 

return view('Terms-and-Condition');

});




Route::get('registration-part2', function () { 

return view('registration_part2');

});






Route::get('failedregistration', function () { 

return view('failed_registration');

});

Route::get('congrats_site', function () { 

return view('congratsite');

});


/*
Route::post('webhook', [
	'as' => 'webhook',
	'uses' =>'DashboardController@webhook'
]);
*/

Route::post('webhook', 'DashboardController@webhook');

//Route::get('webhook', 'frontend\UserProfileController@webhook');



Route::post('testkomuna', [
	'as' => 'testkomuna',
	'uses' =>'Auth\RegisterController@testkomuna'
]);


Route::post('submit_email_temporary', [
	'as' => 'submit_email_temporary',
	'uses' =>'Auth\RegisterController@submit_email_temporary'
]);


Route::post('verify_invite_code', [
	'as' => 'verify_invite_code',
	'uses' =>'Auth\RegisterController@verify_invite_code'
]);



Route::get('/', ['middleware' => 'auth', function (){

    //if(Auth::check())
    //{
        return redirect()->action('frontend\UserDashboardController@index');
        //echo 'redirect to login';
        //return route('dashboard');
       /*
       Route::get('/dashboard', [
            'as' => 'index', 
            'uses' => 'frontend\UserDashboardController@index']);
        */
        //	Route::get('/dashboard', 'UserDashboardController@index');
        
      //  echo 'here';
    //}
    
     
	
}]);


Route::group(['middleware' => 'auth'], function() {
      Route::get('/dashboard', 'UserDashboardController@index');
});

Auth::routes();

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('/verifyemail', 'Auth\VerificationController@verifyemail');


Route::post('check_email_validation', [
	'as' => 'check_email_validation',
	'uses' =>'Auth\VerificationController@check_email_validation'
]);



Route::get('get/product_detail/modal/{id?}', 'ProductDetailsController@get_product_photos');
Route::post('get/product/info', 'ProductDetailsController@get_product_information');

Route::get('campaign/getdata/productdetails/{id}/',   'ProductDetailsActionWithButtonController@campaign_productdetails');

Route::get('campaign/getdata/continue/productdetails/{id}',   'ProductDetailsActionWithButtonController@continue_campaign_productdetails');




Route::group(['namespace' => 'frontend'], function () {


    Route::get('user/daily_thresholds', 'UserThresholdController@index');
    Route::get('user/daily_thresholds/survey/{id}', 'UserThresholdController@survey_form');
    Route::post('user/submit_vote', 'UserThresholdController@submit_vote');
    Route::get('user/avail_votes','UserThresholdController@index');
    
    Route::get('user/gig','GigController@index');
    Route::get('user/gig_count','GigController@avail_gig_count');
    Route::POST('campaign/gig/cancel','GigController@cancel_gig');
    
    
	
	Route::get('/dashboard', 'UserDashboardController@index');
	Route::get('/verify_account', 'UserDashboardController@verify_account');
	
	
	Route::get('/dashboard2', 'UserDashboardController@index2');
	
	
	Route::get('/dashboard/acceptedoffer', 'UserDashboardController@acceptedofferpage');
	
	
	// Dashboard get Current and Accepted Offer
	Route::get('campaign/getdata/featured_offer', 'Dashboardfeatured_offerController@featured_offer');
	Route::get('campaign/getdata/compare_offer', 'Dashboardfeatured_offerController@compare_offer');
	Route::get('campaign/getdata/currentacceptedoffer', 'Dashboardcurrentaccepted_offerController@currentacceptedoffer');
	
	
	
	//offer details
	Route::get('campaign/getdata/insight/offerdetails/{id?}/',   'UserDashboardController@campaign_offerdetails');
	Route::get('campaign/getdata/fullbuy/offerdetails/{id?}/',   'UserDashboardController@campaign_offerdetails');
	Route::get('campaign/getdata/gig/offerdetails/{id?}/', 'GigController@campaign_offerdetails');
	Route::get('campaign/getdata/compare/offerdetails/{id?}/',   'UserDashboardController@campaign_offerdetails');
	Route::get('redirecting/{id?}','UserDashboardController@compare_redirecting');
	
	
	Route::get('campaign/instruction/offerdetails/{id?}/',   'UserDashboardController@StartThisjob');
	Route::post('expired_campaign','UserDashboardController@expired_campaign');
	Route::post('cancel_campaign','UserDashboardController@cancel_campaign');
	
	
	
	Route::post('campaign/gig/update_to_expired','GigController@update_to_expired');
	Route::post('campaign/gig/update_to_reject','GigController@update_to_reject');
	
	//Product Details

	Route::get('campaign/getdata/gig/productdetails/{id}/',   'GigController@campaign_gig_productdetails');
	Route::get('campaign/getdata/compare/productdetails/{id}/',   'UserDashboardController@campaign_compare_productdetails');
	
	Route::get('campaign/getdata/addtocart/{id}',   'UserDashboardController@campaign_addtocart');
	Route::post('campaign/addtocart/addtocart_check_asin','GigController@addtocart_check_asin');
	Route::post('campaign/addtocart/gig/upload_screenshot','GigController@upload_screenshot_addtocart');
	
    Route::post('campaign/update/check_asin_competitor','UserDashboardController@check_asin_competitor');
    Route::post('campaign/update/compare/update_compare_addtocart','UserDashboardController@update_compare_addtocart');
    Route::get('campaign/offerdetails/finish/{id}','UserDashboardController@competitor_finish');
    Route::post('campaign/finish/upload_screenshot','UserDashboardController@upload_screenshot');
    Route::post('campaign/compare/update_steps_done','UserDashboardController@update_steps_done');
    Route::get('campaign/offerdetails/thankyou/{id}','UserDashboardController@thankyou');
    Route::get('campaign/thankyou/done/{id}','UserDashboardController@thankyou_done');
    Route::post('campaign/compare/order_num','UserDashboardController@order_num');
    
    Route::get('campaign/compare/tracking_number/{id}','UserDashboardController@compare_track_number');
    Route::post('campaign/compare/save_tracking_number','UserDashboardController@save_tracking_number');
    
    Route::post('campaign/update/compare/next_step_done','UserDashboardController@next_step_done');


Route::post('update_purchase_product_steps', [
	'as' => 'update_purchase_product_steps',
	'uses' =>'UserPurchaseStepController@update_purchase_product_steps'
]);


Route::post('LoadStep', [
	'as' => 'LoadStep',
	'uses' =>'UserPurchaseStepController@LoadStep'
]);


Route::post('checkasin', [
	'as' => 'checkasin',
	'uses' =>'UserPurchaseStepController@checkasin'
]);

Route::post('submit_step4', [
	'as' => 'submit_step4',
	'uses' =>'UserPurchaseStepController@submit_step4'
]);

Route::post('submit_step5', [
	'as' => 'submit_step5',
	'uses' =>'UserPurchaseStepController@submit_step5'
]);


Route::post('submit_step6', [
	'as' => 'submit_step6',
	'uses' =>'UserPurchaseStepController@submit_step6'
]);


Route::get('offerdetails/{id?}/', [
	'as' => 'offerdetails',
	'uses' =>'UserDashboardController@offerdetails'
]);

Route::get('viewdetails/{id?}/', [
	'as' => 'viewdetails',
	'uses' =>'UserDashboardController@offerdetails_byid'
]);


Route::get('viewofferdetails/{id?}/', [
	'as' => 'viewofferdetails',
	'uses' =>'UserDashboardController@viewofferdetails'
]);



Route::post('markasoffercompleted', [
	'as' => 'markasoffercompleted',
	'uses' =>'UserDashboardController@markasoffercompleted'
]);



Route::post('saveAnswer', [
	'as' => 'saveAnswer',
	'uses' =>'UserDashboardController@saveAnswer'
]);

Route::post('canceloffer', [
	'as' => 'canceloffer',
	'uses' =>'UserDashboardController@canceloffer'
]);


Route::get('completedoffer', [
	'as' => 'completedoffer',
	'uses' =>'UserDashboardController@completedoffer'
]);

Route::get('completedoffer', [
	'as' => 'completedoffer',
	'uses' =>'UserDashboardController@completedoffer'
]);

Route::get('archived', [
	'as' => 'archived',
	'uses' =>'UserDashboardController@archived'
]);

Route::get('activity', [
	'as' => 'activity',
	'uses' =>'UserDashboardController@activity'
]);


Route::get('notificationlist', [
	'as' => 'notificationlist',
	'uses' =>'UserDashboardController@notificationlist'
]);


Route::get('listofferdata', [
	'as' => 'listofferdata',
	'uses' =>'UserDashboardController@listofferdata'
]);


});




Route::post('continue/accept/offer', [
	'as' => 'accept',
	'uses' =>'OfferAcceptController@continue_accept_offer'
]);

Route::get('deny/{id?}/', [
	'as' => 'deny',
	'uses' =>'OfferDenyController@deny'
]);


Route::post('checkif_purchasesurveyisTrue', [
	'as' => 'checkif_purchasesurveyisTrue',
	'uses' =>'OfferAcceptController@checkif_purchasesurveyisTrue'
]);




Route::get('admin_getsecondstep', [
	'as' => 'admin_getsecondstep',
	'uses' =>'OfferAcceptController@admin_getsecondstep'
]);


Route::get('admin_getthirdstep', [
	'as' => 'admin_getthirdstep',
	'uses' =>'OfferAcceptController@admin_getthirdstep'
]);



Route::post('checkif_amazonsurveyisTrue', [
	'as' => 'checkif_amazonsurveyisTrue',
	'uses' =>'OfferAcceptController@checkif_amazonsurveyisTrue'
]);

Route::get('getthirdstep', [
	'as' => 'getthirdstep',
	'uses' =>'OfferAcceptController@getthirdstep'
]);


Route::get('checkifcomplete', [
	'as' => 'checkifcomplete',
	'uses' =>'OfferAcceptController@checkifcomplete'
]);



Route::post('getDateConfirm', [
	'as' => 'getDateConfirm',
	'uses' =>'ScheduleConfirmUsersController@getDateConfirm'
]);

Route::post('getDateConfirmToday', [
	'as' => 'getDateConfirmToday',
	'uses' =>'ScheduleConfirmUsersController@getDateConfirmToday'
]);


Route::post('getDateConfirmStartNow', [
	'as' => 'getDateConfirmStartNow',
	'uses' =>'ScheduleConfirmUsersController@getDateConfirmStartNow'
]);

Route::post('changemyschedule', [
	'as' => 'changemyschedule',
	'uses' =>'ScheduleConfirmUsersController@changemyschedule'
]);




Route::post('getDateSchedule', [
	'as' => 'getDateSchedule',
	'uses' =>'ScheduleConfirmUsersController@getDateSchedule'
]);



Route::post('addtocart_getconfirm', [
	'as' => 'addtocart_getconfirm',
	'uses' =>'frontend\GigController@addtocart_getconfirm'
]);



Route::post('getCampaignofferschedule', [
	'as' => 'getCampaignofferschedule',
	'uses' =>'ScheduleCampaignOfferController@getCampaignofferscheduleToday'
]);


Route::post('getCampaignofferALLschedule', [
	'as' => 'getCampaignofferALLschedule',
	'uses' =>'ScheduleCampaignOfferController@getCampaignofferALLschedule'
]);




Route::post('update_new_schedule', [
	'as' => 'update_new_schedule',
	'uses' =>'ScheduleConfirmUsersController@update_new_schedule'
]);




Route::get('SetDate', [
	'as' => 'SetDate',
	'uses' =>'OfferSentmailController@SetDate'
]);


/* 
Route::post('submit_truckingnumber', [
	'as' => 'submit_truckingnumber',
	'uses' =>'OfferAcceptController@submit_truckingnumber'
]);
*/

/*
Route::get('getfirststep', [
	'as' => 'getfirststep',
	'uses' =>'OfferAcceptController@getfirststep'
]);
*/
/*
Route::post('update_status_tracking_number', [
	'as' => 'update_status_tracking_number',
	'uses' =>'OfferAcceptController@update_status_tracking_number'
]);
*/



/* Route::post('submit_purchasesurvey', [
	'as' => 'submit_purchasesurvey',
	'uses' =>'OfferAcceptController@submit_purchasesurvey'
]); 
 */



/* Route::get('getsecondstep', [
	'as' => 'getsecondstep',
	'uses' =>'OfferAcceptController@getsecondstep'
]); */


/* Route::post('checkifallreadycompleted', [
	'as' => 'checkifallreadycompleted',
	'uses' =>'OfferAcceptController@checkifallreadycompleted'
]); */


/* Route::get('GetStatusDateAvailable', [
	'as' => 'GetStatusDateAvailable',
	'uses' =>'OfferAcceptController@GetStatusDateAvailable'
]);
 */







Route::post('saving_virtualcc_historypay', [
	'as' => 'saving_virtualcc_historypay',
	'uses' =>'frontend\UserVccController@saving_virtualcc_historypay'
]);

Route::post('checkifuser_alreadypaidforpurchasedproduct', [
	'as' => 'checkifuser_alreadypaidforpurchasedproduct',
	'uses' =>'frontend\UserVccController@checkifuser_alreadypaidforpurchasedproduct'
]);


Route::post('get_amount_tracking_price', [
	'as' => 'get_amount_tracking_price',
	'uses' =>'frontend\UserVccController@get_amount_tracking_price'
]);


Route::post('createUserVirtualcc', [
	'as' => 'createUserVirtualcc',
	'uses' =>'frontend\UserVccController@createUserVirtualcc'
]);


Route::post('getCardID', [
	'as' => 'getCardID',
	'uses' =>'frontend\UserVccController@getCardID'
]);


Route::post('getCardID2', [
	'as' => 'getCardID2',
	'uses' =>'frontend\UserVccController@getCardID2'
]);



Route::post('transaction', [
	'as' => 'transaction',
	'uses' =>'frontend\UserVccController@transaction'
]);


Route::get('checkVirtualCCamount', [
	'as' => 'checkVirtualCCamount',
	'uses' =>'frontend\UserVccController@checkVirtualCCamount'
]);

Route::post('checkifhaveAlreadyVcc', [
	'as' => 'checkifhaveAlreadyVcc',
	'uses' =>'frontend\UserVccController@checkifhaveAlreadyVcc'
]);

Route::post('checkifhaveAlreadyVcc2', [
	'as' => 'checkifhaveAlreadyVcc2',
	'uses' =>'frontend\UserVccController@checkifhaveAlreadyVcc2'
]);


Route::post('checkifuserhaveVcc', [
	'as' => 'checkifuserhaveVcc',
	'uses' =>'frontend\UserVccController@checkifuserhaveVcc'
]);

Route::post('thischeckifuserhaveVcc', [
	'as' => 'thischeckifuserhaveVcc',
	'uses' =>'frontend\UserVccController@thischeckifuserhaveVcc'
]);



Route::post('SendEmailVccinformation', [
	'as' => 'SendEmailVccinformation',
	'uses' =>'frontend\UserVccController@SendEmailVccinformation'
]);



Route::post('Sendverifyemail', [
	'as' => 'Sendverifyemail',
	'uses' =>'frontend\UserProfileController@Sendverifyemail'
]);




Route::post('submit_survey_amazon_continue', 'frontend\AmazonsurveyController@submit_survey_amazon_continue');


//last update 8/12/2019  
Route::post('submit_survey_amazon_to_earn', 'frontend\AmazonsurveyController@submit_survey_amazon_to_earn');
Route::post('check_survey_amazon_to_earn', 'frontend\AmazonsurveyController@check_survey_amazon_to_earn');
//

Route::post('submit_amazonsesurvey', 'frontend\AmazonsurveyController@submit_amazonsesurvey');
Route::post('submit_your_amazon_ss_file', 'frontend\AmazonsurveyController@submit_your_amazon_ss_file');
Route::post('checkif_alreadysubmitedamazonsurvey_file', 'frontend\AmazonsurveyController@checkif_alreadysubmitedamazonsurvey_file');



Route::post('submit_tracking_number_and_survey', 'frontend\TrackingNumberController@submit_tracking_number_and_survey');
Route::post('checking_tracking_number', 'frontend\TrackingNumberController@checking_tracking_number');
Route::post('update_status_tracking_number', 'frontend\TrackingNumberController@update_status_tracking_number');
Route::post('getpurchasedData', 'frontend\TrackingNumberController@getpurchasedData');
Route::post('checkifallreadyansweredsurvey', 'frontend\TrackingNumberController@checkifallreadyansweredsurvey');
Route::post('GetStatusDateAvailable', 'frontend\TrackingNumberController@GetStatusDateAvailable');


Route::post('submit_return_product', 'frontend\OfferTrackingReturnProductsController@submit_return_product');
Route::post('return_product_checking_tracking_number', 'frontend\OfferTrackingReturnProductsController@return_product_checking_tracking_number');
Route::post('return_update_status_tracking_number', 'frontend\OfferTrackingReturnProductsController@return_update_status_tracking_number');
Route::post('checkifuser_alreadypaidforproductreturn', 'frontend\OfferTrackingReturnProductsController@checkifuser_alreadypaidforproductreturn');
Route::post('get_amount_retun_product', 'frontend\OfferTrackingReturnProductsController@get_amount_retun_product');




Route::post('SaveUserActivities', 'frontend\UserActivitiesController@SaveUserActivities');
Route::get('GetUserActivities', 'frontend\UserActivitiesController@GetUserActivities');
Route::get('GetUserArchived', 'frontend\UserArchivedController@GetUserArchived');
Route::get('check/offer_accept/duedate', 'frontend\UserArchivedController@check_offeraccept_duedate');

Route::get('mail/{task?}', 'frontend\MailboxController@mailbox');
Route::get('mail/getData/inbox', 'frontend\MailboxController@getDatainbox');
Route::get('mail/getData/trash', 'frontend\MailboxController@getDatatrash');

Route::get('mail/getnumber/message/unread', 'frontend\MailboxController@get_unread_message');
Route::get('mail/getData/message/view/id/{id?}/type/{type?}/', 'frontend\MailboxController@view_message');

Route::get('user/profile', 'frontend\UserProfileController@userprofile');
Route::get('user/edit/profile', 'frontend\UserProfileController@edituserprofile');
Route::post('user/update/profile', 'frontend\UserProfileController@updateprofile');




Route::get('user/avatar', 'frontend\UserProfileController@useravatar');
Route::post('user/update/avatar', 'frontend\UserProfileController@updateavatar');

Route::get('user/changepassword', 'frontend\UserProfileController@changepassword');
Route::post('user/update/password', 'frontend\UserProfileController@updatepassword');



Route::get('user/update/interest', 'frontend\UserProfileController@updateinterest');
Route::post('user/update/userinterest', 'frontend\UserProfileController@updateuserinterest');


Route::post('user/verify/verification_code', 'frontend\UserProfileController@verification_code');

############## MY WALLET ############################## 
Route::get('user/mywallet', 'frontend\UserProfileController@myWallet');
Route::get('user/unpaid_campaign', 'frontend\UserProfileController@unpaid_campaign');
Route::get('user/paid_campaign', 'frontend\UserProfileController@paid_campaign');
Route::get('user/paid_campaign_product', 'frontend\UserProfileController@paid_campaign_product');
Route::get('user/getpaypalverified', 'frontend\UserProfileController@getpaypalverified');
Route::get('user/campaign_details/{id}', 'frontend\UserProfileController@campaign_details');

############## gig compare header button count #############
Route::get('user/compare_gig_count', 'frontend\UserProfileController@compare_gig_count');


############ MY POINTS #########################################
Route::get('user/mypoints', 'frontend\UserProfileController@mypoints');
Route::get('user/avail_points', 'frontend\UserProfileController@avail_points');
Route::get('user/transac_success', 'frontend\UserProfileController@transac_success');
Route::get('user/paid_points', 'frontend\UserProfileController@paid_points');
Route::post('user/transfer_points', 'frontend\UserProfileController@transfer_points');


//notification

Route::get('Notification', [
	'as' => 'Notification',
	'uses' =>'OfferSentmailController@Notification'
]);


Route::post('user/get/notification', 'frontend\NotificationsController@get_notification');
Route::post('user/get/read_notification', 'frontend\NotificationsController@read_notification');


Route::post('user/get/getdashboard_notofication', 'frontend\NotificationsController@getdashboard_notofication');
Route::post('user/remove/item_notification', 'frontend\NotificationsController@item_notification');






// routes for conjob frontend //  
Route::group(['namespace' => 'frontend'], function () {
	
	
	Route::get('checkifproductreview_is_available', 'Cronjob_forCustomerController@checkifproductreview_is_available');
	Route::get('checkifcampign_isready_tocontinue', 'Cronjob_forCustomerController@checkifcampign_isready_tocontinue');
	Route::get('checkifoffer_isreadyfortomorrow', 'Cronjob_forCustomerController@checkifoffer_isreadyfortomorrow');
	Route::get('checkifoffer_ismissedtoactive', 'Cronjob_forCustomerController@checkifoffer_ismissedtoactive');
	Route::get('checkif_productisdelivered', 'Cronjob_forCustomerController@checkif_productisdelivered');
	Route::get('checkif_productreturn_isdelivered', 'Cronjob_forCustomerController@checkif_productreturn_isdelivered');
	
	Route::get('testkomuna', 'Cronjob_forCustomerController@testkomuna');
});





