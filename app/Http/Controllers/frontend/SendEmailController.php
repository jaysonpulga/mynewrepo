<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Model\frontend\user_notifications;
use App\Model\offer_images;
use App\Model\offer_settings;

use App\Model\frontend\user_mailboxes;

use App\Model\frontend\users_offer_4_submit_tracking_numbers;
use App\Model\frontend\users_offer_6_amazon_upload_files;

use App\Model\frontend\User;

use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;

use Illuminate\Routing\UrlGenerator;


ini_set('memory_limit', '3000M');
ini_set('max_execution_time', '0');


//require_once 'vendor/autoload.php';
use Sauladam\ShipmentTracker\ShipmentTracker;

class SendEmailController extends Controller
{
	
	 protected $url;
	 
	 
	 protected $email_deafult = "donotreply@shopmonkey.club";

    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }
    
    
    
    public function testTracker()
	{
			$dhlTracker = ShipmentTracker::get('UPS');

			/* track with the standard settings */
			$track = $dhlTracker->track('1ZF17Y320327363694');
			// scrapes from http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=00340434127681930812

			/* override the standard language */
			//$track = $dhlTracker->track('00340434127681930812', 'en');
			// scrapes from http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=en&idc=00340434127681930812

			/* pass additional params to the URL (or override the default ones) */
			//$track = $dhlTracker->track('00340434127681930812', 'en', ['zip' => '12345']);
			
			if($track->delivered())
			{
				echo "Delivered to " . $track->getRecipient();
			}
			else
			{
				echo "Not delivered yet, The current status is " . $track->currentStatus();
			}
	}
    
     public function Sendverifyemail($user_id,$name,$email,$verifycode)
    {
        
        

        $message = "You're Email verification details <br>";
		$message .= "verification code <b>".$verifycode."</b><br>";
        $urlpath =  $this->url->to('/verifyemail');


		$data = array(
		  
			'email' => $this->email_deafult,
			'subject' => 'Hi '.$name,
			'name' => $name,
			'bodyMessage' => $message,
			'postersemail' => $email,
			'urlpath' => $urlpath,
        );
		
		//Send email to user who register
		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
		$beautymail->send('template_email.email_verification_code', $data, function($message) use ($data){ 
			$message->from($data['email']);
			$message->to( $data['postersemail'] );
			$message->subject($data['subject']);
		});
        
      
    
    
    }
    
    
    public function SendEmailVccinformation($user_id,$name,$email,$cardnumber_cvv,$expiration,$cvv)
    {
        
        

        $message = "You're Credit Card Infomation <br>";
		$message .= "Card Number <b>".$cardnumber_cvv."</b><br>";
		$message .= "cvv code: <b>".$cvv."</b><br>";
		$message .= "expiration date: <b>".$expiration."</b><br>";

	

		$data = array(
		  
			'email' => $this->email_deafult,
			'subject' => 'Hi '.$name,
			'name' => $name,
			'bodyMessage' => $message,
			'postersemail' => $email,
        );
		
		//Send email to user who register
		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
		$beautymail->send('template_email.email_cc_info', $data, function($message) use ($data){ 
			$message->from($data['email']);
			$message->to( $data['postersemail'] );
			$message->subject($data['subject']);
		});
        
        
    }
	
	
	

	public function invite_newcampaign($id,$name,$email,$campaign_id,$urlpath)
	{
		
		
		$data = User::where('id',$id)->first(); 
		if($data->allow_email_subscribe == 0)
		{
		
        		//Select campign detail on offer table
        		$offer = offer_settings::where('id',$campaign_id)->first();
        		$campaign_name = $offer->Title;
        		$product_title = $offer->product_name;
        		
        		$message = "You are invited to this campaign and offer <br>";
        		$message .= "campaign name <b>".$campaign_name."</b><br>";
        		$message .= "Product name: <b>".$product_title."</b><br><br>";
        		$message .= "For more details you may visit our site and login your account <br><br>";
        		
        
        		$data = array(
        		  
        			'email' => $this->email_deafult,
        			'subject' => 'Hi '.$name.", you are invited to campaign ".$campaign_name,
        			'name' => $name,
        			'bodyMessage' => $message,
        			'postersemail' => $email,
        			'urlpath' => $urlpath
                );
        		
        		//Send email to user who register
        		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        		$beautymail->send('template_email.invited_newcampaign', $data, function($message) use ($data){ 
        			$message->from($data['email']);
        			$message->to( $data['postersemail'] );
        			$message->subject($data['subject']);
        		});
        		
		}
		
	}
	
	
	
	public function NewRegisterAccount_sendemail($name,$email,$userid,$veryfication_code)
	{
	
		$message = "";
		$message = "You're Email verification details <br>";
		$message .= "verification code <b>".$veryfication_code."</b><br>";
        $urlpath =  $this->url->to('/verifyemail');
	
  
		$data = array(
		  
			'email' => $this->email_deafult,
			'subject' => 'Welcome to Reviewers.Club',
			'name' => $name,
			'bodyMessage' => $message,
			'postersemail' => $email,
	        'urlpath' => $urlpath,
			
        );
		
		//Send email to user who register
		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
		$beautymail->send('template_email.new_register', $data, function($message) use ($data){ 
			$message->from($data['email']);
			$message->to( $data['postersemail'] );
			$message->subject($data['subject']);
		});
		
		// SEND INBOX TEMPLATE IN AZM PROJECT
		$mailbox = new user_mailboxes();
		$mailbox->user_id		=  $userid;
		$mailbox->sender 		=  $data['email'];
		$mailbox->subject 		=  $data['subject'];
		$mailbox->message 		=  $data['bodyMessage'];
		$mailbox->message_type 	=  'inbox';
		$mailbox->status 		=  'unread';
		$mailbox->save();
		
	}
	

		
	
	public function MailsentforTomorrow($id,$name,$email,$campaign_id,$date,$urlpath)
	{
		
		
		$data = User::where('id',$id)->first(); 
		if($data->allow_email_subscribe == 0)
		{	
    		$offer = offer_settings::where('id',$campaign_id)->first();
    		$campaign_name = $offer->Title;
    		$product_title = $offer->product_name;	
    			
    			
    		$message = "Please active your campaign offer  <br>";
    		$message .= "campaign name <b>".$campaign_name."</b><br>";
    		$message .= "Product name: <b>".$product_title."</b><br><br>";
    		$message .= "For more details you may visit our site and login your account <br><br>";
    	
      
    		$data = array(
    		  
    			'email' => $this->email_deafult,
    			'subject' => 'Hi '.$name.", your schedule to active campaign is tomorrow ".$date,
    			'name' => $name,
    			'bodyMessage' => $message,
    			'postersemail' => $email,
    			'urlpath' => $urlpath
            );
    		
    		//Send email to user who register
    		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
    		$beautymail->send('template_email.notify_for_tomorrow', $data, function($message) use ($data){ 
    			$message->from($data['email']);
    			$message->to( $data['postersemail'] );
    			$message->subject($data['subject']);
    		});
			
		}
		
		
	}
	
	
	
	
	public function Mailsent_product_delivered($user_id,$name,$email,$offer_id,$amount)
	{
	    
	   	$data = User::where('id',$user_id)->first(); 
		if($data->allow_email_subscribe == 0)
		{ 
        	    
        		$offer = offer_settings::where('id',$offer_id)->first();
        		$tracking = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id',$user_id)->first();
        		
        		$campaign_name = $offer->Title;
        		$product_title = $offer->product_name;
        		
        		$urlpath =  $this->url->to('/');
        		
        		
        		$message = "<b>campaign details</b><br>";
        		$message .= "campaign name :<b>".$campaign_name."</b><br>";
        		$message .= "Product name: <b>".$product_title."</b><br><br>";
        		
        		$message .= "<b>tracking details</b><br>";
        		$message .= "Shipping  Company : <b>".$tracking->shipment_company."</b><br>";
        		$message .= "Tracking Number :  <b>".$tracking->tracking_number."</b><br><br>";
        		
        		
        		$message .= "For more details you may visit our site and login your account <br><br>";
        	
          
        		$data = array(
        		  
        			'email' => $this->email_deafult,
        			'subject' => 'Hi '.$name.", your product has been delivered",
        			'name' => $name,
        			'bodyMessage' => $message,
        			'postersemail' => $email,
        			'urlpath' => $urlpath,
        			'amount' => $amount
                );
        		
        		//Send email to user who register
        		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        		$beautymail->send('template_email.notify_product_delivered', $data, function($message) use ($data){ 
        			$message->from($data['email']);
        			$message->to( $data['postersemail'] );
        			$message->subject($data['subject']);
        		});
        		
        		
        		$msg = "<b>You have received this email to let you know that your product has beed delivered and you get amount <b> $".$amount."</b><br>";
        		
        		$msg .= "<b>campaign details</b><br>";
        		$msg .= "campaign name :<b>".$campaign_name."</b><br>";
        		$msg .= "Product name: <b>".$product_title."</b><br><br>";
        		
        		$msg .= "<b>tracking details</b><br>";
        		$msg .= "Shipping  Company : <b>".$tracking->shipment_company."</b><br>";
        		$msg .= "Tracking Number :  <b>".$tracking->tracking_number."</b><br><br>";
        		
        		// SEND INBOX TEMPLATE IN AZM PROJECT
        		$mailbox = new user_mailboxes();
        		$mailbox->user_id		=  $user_id;
        		$mailbox->sender 		=  $data['postersemail'];
        		$mailbox->subject 		=  $data['subject'];
        		$mailbox->message 		=  $msg;
        		$mailbox->message_type 	=  'inbox';
        		$mailbox->status 		=  'unread';
        		$mailbox->save();
		
		}
		
	}
	
	
	
	public function Mailsent_return_product_delivered($user_id,$name,$email,$offer_id,$amount)
	{
	    
	    $data = User::where('id',$user_id)->first(); 
		if($data->allow_email_subscribe == 0)
		{ 
		    
        		$offer = offer_settings::where('id',$offer_id)->first();
        		$tracking = users_offer_4_submit_tracking_numbers::where('offer_id',$offer_id)->where('user_id',$user_id)->first();
        		
        		$campaign_name = $offer->Title;
        		$product_title = $offer->product_name;
        		
        		$urlpath =  $this->url->to('/');
        		
        		
        		$message = "<b>campaign details</b><br>";
        		$message .= "campaign name :<b>".$campaign_name."</b><br>";
        		$message .= "Product name: <b>".$product_title."</b><br><br>";
        		
        		$message .= "<b>tracking details</b><br>";
        		$message .= "Shipping  Company : <b>".$tracking->shipment_company."</b><br>";
        		$message .= "Tracking Number :  <b>".$tracking->tracking_number."</b><br><br>";
        		
        		
        		$message .= "For more details you may visit our site and login your account <br><br>";
        	
          
        		$data = array(
        		  
        			'email' =>$this->email_deafult,
        			'subject' => 'Hi '.$name.", your product return  has been delivered",
        			'name' => $name,
        			'bodyMessage' => $message,
        			'postersemail' => $email,
        			'urlpath' => $urlpath,
        			'amount' => $amount
                );
        		
        		//Send email to user who register
        		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        		$beautymail->send('template_email.notify_return_product_delivered', $data, function($message) use ($data){ 
        			$message->from($data['email']);
        			$message->to( $data['postersemail'] );
        			$message->subject($data['subject']);
        		});
        		
        		
        		$msg = "<b>You have received this email to let you know that your product return has beed delivered and you get amount <b> $".$amount."</b><br>";
        		
        		$msg .= "<b>campaign details</b><br>";
        		$msg .= "campaign name :<b>".$campaign_name."</b><br>";
        		$msg .= "Product name: <b>".$product_title."</b><br><br>";
        		
        		$msg .= "<b>tracking details</b><br>";
        		$msg .= "Shipping  Company : <b>".$tracking->shipment_company."</b><br>";
        		$msg .= "Tracking Number :  <b>".$tracking->tracking_number."</b><br><br>";
        		
        		// SEND INBOX TEMPLATE IN AZM PROJECT
        		$mailbox = new user_mailboxes();
        		$mailbox->user_id		=  $user_id;
        		$mailbox->sender 		=  $data['postersemail'];
        		$mailbox->subject 		=  $data['subject'];
        		$mailbox->message 		=  $msg;
        		$mailbox->message_type 	=  'inbox';
        		$mailbox->status 		=  'unread';
        		$mailbox->save();
        		
		}
		
	}
	
	
	
	
	
	
	public function MailsentReady_product_proceed_continue($user_id,$name,$email,$offer_id,$dtavailble,$sched_date,$urlpath)
	{
	    
	     $data = User::where('id',$user_id)->first(); 
		if($data->allow_email_subscribe == 0)
		{ 
		    
        		$offer = offer_settings::where('id',$offer_id)->first();
        		$campaign_name = $offer->Title;
        		$product_title = $offer->product_name;
        		
        		
        		$message = "Please active your campaign offer now <br>";
        		$message .= "your offer is available with 24 hours , please proceed on or before ".$dtavailble."<br><br>";
        		$message .= "campaign name <b>".$campaign_name."</b><br>";
        		$message .= "Your Campaign Schedule : <b>".$sched_date."</b><br>";
        		$message .= "Product name: <b>".$product_title."</b><br><br>";
        		$message .= "For more details you may visit our site and login your account <br><br>";
        	
          
        		$data = array(
        		  
        			'email' => $this->email_deafult,
        			'subject' => 'Hi '.$name.", your campaign offer is active ".$sched_date,
        			'name' => $name,
        			'bodyMessage' => $message,
        			'postersemail' => $email,
        			'urlpath' => $urlpath,
        			'available_date' => $dtavailble
                );
        		
        		//Send email to user who register
        		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        		$beautymail->send('template_email.notify_activeoffer', $data, function($message) use ($data){ 
        			$message->from($data['email']);
        			$message->to( $data['postersemail'] );
        			$message->subject($data['subject']);
        		});
		
		}
		
	}
	
	public function Mailsent_missed_offer($user_id,$name,$email,$offer_id,$dtavailble,$urlpath)
	{
	    
         $data = User::where('id',$user_id)->first(); 
    	if($data->allow_email_subscribe == 0)
    	{ 
    	    
    		$offer = offer_settings::where('id',$offer_id)->first();
    		$campaign_name = $offer->Title;
    		$product_title = $offer->product_name;
    		
    		
    		$message = " you have missed your schedule offer <br>";
    		$message .= "your offer schedule was  ".$dtavailble."<br><br>";
    		$message .= "campaign name <b>".$campaign_name."</b><br>";
    		$message .= "Product name: <b>".$product_title."</b><br><br>";
    		$message .= "For more details you may visit our site and login your account <br><br>";
    	
      
    		$data = array(
    		  
    			'email' =>$this->email_deafult,
    			'subject' => 'Hi '.$name.", your campaign schedule is end",
    			'name' => $name,
    			'bodyMessage' => $message,
    			'postersemail' => $email,
    			'urlpath' => $urlpath,
    			'available_date' => $dtavailble
            );
    		
    		//Send email to user who register
    		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
    		$beautymail->send('template_email.notify_missed_offer', $data, function($message) use ($data){ 
    			$message->from($data['email']);
    			$message->to( $data['postersemail'] );
    			$message->subject($data['subject']);
    		});
    	
    	    
    	}	
		
	}
	
	
	public function Mailsent_upload_product_survey($user_id,$name,$email,$offer_id,$amount,$status,$remarks)
	{
	     $data = User::where('id',$user_id)->first(); 
    	if($data->allow_email_subscribe == 0)
    	{ 
	    
	    
        		$offer = offer_settings::where('id',$offer_id)->first();
        		$uploaded_file = users_offer_6_amazon_upload_files::where('offer_id',$offer_id)->where('user_id',$user_id)->first();
        		
        		$campaign_name = $offer->Title;
        		$product_title = $offer->product_name;
        		$urlpath =  $this->url->to('/');
        		
        		$message = "<b>campaign details</b><br>";
        		$message .= "campaign name :<b>".$campaign_name."</b><br>";
        		$message .= "Product name: <b>".$product_title."</b><br><br>";
        		
        		if($status == "approved")
        		{
        			$message .= "your uploaded screenshot file from amazon survey   is  approved and you get $".$amount."<br>";
        			$subject_msg = "your uploaded file  has been approved and you get $".$amount;
        			
        		}
        		else if($status == "rejected")
        		{
        			$message .= "Sorry your uploaded file is rejected <br>";
        			$subject_msg = "your uploaded file is rejected";
        		}
        		
        		
        		if(!empty($remarks))
        		{
        			$message .= "remarks ".$remarks."<br><br>";
        		}
        		
        		
        		$message .= "For more details you may visit our site and login your account <br><br>";
        	
          
        		$data = array(
        		  
        			'email' =>$this->email_deafult,
        			'subject' => 'Hi '.$name.",".$subject_msg." ",
        			'name' => $name,
        			'bodyMessage' => $message,
        			'postersemail' => $email,
        			'urlpath' => $urlpath,
        	
                );
        		
        		//Send email to user who register
        		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        		$beautymail->send('template_email.notify_amazon_uploaded_file', $data, function($message) use ($data){ 
        			$message->from($data['email']);
        			$message->to( $data['postersemail'] );
        			$message->subject($data['subject']);
        		});
        		
        		
        		$msg = "<b>You have received this email to let you know the status of your uploaded file / screenshot from amazon survey <br>";
        		
        		$msg .= "<b>campaign details</b><br>";
        		$msg .= "campaign name :<b>".$campaign_name."</b><br>";
        		$msg .= "Product name: <b>".$product_title."</b><br><br>";
        		
        		if($status == "approved")
        		{
        			$msg .= "your uploaded screenshot file from amazon survey   is  approved and you get $".$amount."<br>";
        			
        			
        		}
        		else if($status == "rejected")
        		{
        			$msg .= "Sorry your uploaded file is rejected <br>";
        
        		}
        		
        		if(!empty($remarks))
        		{
        			$msg .= "remarks ".$remarks."<br><br>";
        		}
        
        		
        		// SEND INBOX TEMPLATE IN AZM PROJECT
        		$mailbox = new user_mailboxes();
        		$mailbox->user_id		=  $user_id;
        		$mailbox->sender 		=  $data['email'];
        		$mailbox->subject 		=  $data['subject'];
        		$mailbox->message 		=  $msg;
        		$mailbox->message_type 	=  'inbox';
        		$mailbox->status 		=  'unread';
        		$mailbox->save();
        		
    	}
		
	}
	
	
	


}