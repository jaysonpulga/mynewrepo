<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;

use App\Model\frontend\user_notifications;
use App\Model\offer_images;
use Illuminate\Http\Request;
use Pusher\Pusher;


use App\Model\frontend\user_dashboard_notifications;



class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	
	 
    public function index()
    {
        //
    }
    
    
    
    public function item_notification(Request $request)
    {
          $user_id       =  $request->user()->id;
          $notif_id =  $request->notif_id;
          $offer_id =  $request->offer_id;
          $idx      =  $request->idx;
          
          
          	//check if notif 
    		if(user_dashboard_notifications::where('offer_id',$offer_id)->where('id',$idx)->where('user_id',$user_id)->where('notif_id',$notif_id)->exists())
    		{
    		
    				user_dashboard_notifications::where('offer_id',$offer_id)->where('id',$idx)->where('user_id',$user_id)->where('notif_id',$notif_id)->update([
					'notif_status'   =>  1,
			
				]);
    			
    		
    			
        
        	}
        	
        	echo 'save';
        
    }
	
	
	
	public function getdashboard_notofication(Request $request)
	{
	 
	    $id =  $request->user()->id;
		
		
		$sqlData = user_dashboard_notifications::where('user_id', $id)->where('notif_status',0)->get();
		
		$events = array();
		$eventsArray  = array();
		
		/*
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
		*/
		
		
		
		$outputData = array();
		
		if(!empty($sqlData))
		{
		
			foreach ($sqlData as $row) 
			{	
				
				 $eventsArray['id']  = $row->id;
				$eventsArray['offer_id']  = $row->offer_id;
				$eventsArray['notif_id']  = $row->notif_id;
				$eventsArray['action_status']  = $row->action_status; 
		        $outputData[] = $eventsArray;
				
				
			
				
			
			}
		}
		else
		{
			$outputData = [];
		}
		
	
		return response()->json(array('all_notif' => $outputData));
		
		
		
	}

	
	public function notifation_newcampaign($campaign_id,$user_id,$batch_id)
	{
		
			$notification_batch ="new campaign";
			$notif_message = "you are invited for a new campaign";
			$data = offer_images::select('image_path')->where('offer_id',$campaign_id)->first();
			$icon = "<span id='images_div'><img src='path_url/offer_images/".$data->image_path."' class='user-image'></span>";
			$url =  asset('dashboard');
		
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $campaign_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 			 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message  	 = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 			 = 0;
			$user_notifications->save();	
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
	}
	
	
	
	
	public function notifation_product_review_available($offer_id,$user_id,$batch_id)
	{
		
			$notification_batch ="available product review";
			$notif_message = "Product Review is available on";
			$url = asset('campaign/getdata/insight/offerdetails/'.$offer_id.'#step-2');
			$icon = "<span id='icon_div'<i class='fa fa-fw fa-calendar-check-o'></i></span>";
			
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $offer_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 				 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message  		 = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 			 = 0;
			$user_notifications->save();	
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
	}
	
	
	
	public function notifation_product_proceed_continue($offer_id,$user_id,$batch_id)
	{
		
			$notification_batch ="schedule continue product";
			$notif_message = "your campaign and product is now available on";
			$url =  asset('dashboard');
			$icon = "<span id='icon_div'<i class='fa fa-fw fa-calendar'></i></span>";
		
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $offer_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 				 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message  		 = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 			 = 0;
			$user_notifications->save();	
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
		
	}
	
	
	
	public function notifation_product_readyfor_tomorrow($offer_id,$user_id,$batch_id)
	{
		
			$notification_batch ="schedule ready for tomorrow";
			$notif_message = "it reminds you that your campaign schedule will be available tomorrow";
			$url =  asset('dashboard');
			$icon = "<span id='icon_div'<i class='fa fa-fw fa-calendar-minus-o'></i></span>";
		
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $offer_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 				 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message  		 = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 			 = 0;
			$user_notifications->save();	
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
			
			
			
		
	}
	
	
	public function notifation_missed_offer($offer_id,$user_id,$batch_id)
	{
		
			$notification_batch ="missed offer";
			$notif_message = "you missed the campaign offer";
			$url =  asset('dashboard');
			$icon = "<span id='icon_div'<i class='fa fa-fw fa-calendar-minus-o'></i></span>";
		
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $offer_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 				 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message  		 = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 			 = 0;
			$user_notifications->save();
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
			
			
	}
	
	
	
	public function notifation_product_delivered($offer_id,$user_id,$batch_id)
	{
		
			$notification_batch ="product delivered";
			$notif_message = "your product has been delivered";
			$url = asset('campaign/getdata/insight/offerdetails/'.$offer_id.'#step-2');
			$icon = "<span id='icon_div'<i class='fa fa-fw fa-cube'></i></span>";
		
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $offer_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 			 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message       = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 			 = 0;
			$user_notifications->save();
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
		
	}
	
	
	public function notifation_return_product_delivered($offer_id,$user_id,$batch_id)
	{
		
			$notification_batch ="return product delivered";
			$notif_message = "your product return  has been delivered";
			$url = asset('campaign/getdata/insight/offerdetails/'.$offer_id.'#step-4');
			$icon = "<span id='icon_div'<i class='fa fa-fw fa-reply-all'></i></span>";
		
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $offer_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 			 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message       = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 		 = 0;
			$user_notifications->save();
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
		
	}
	
	
	
	
	
	
	
	public function notifation_upload_product_survey($offer_id,$user_id,$batch_id,$status)
	{
			
			
			
			$notification_batch ="upload product review survey";
			if($status == "approved")
			{
				$notif_message = "Congratulation, your file has been approved";
				$icon = "<span id='icon_div'<i class='fa fa-fw fa-check-square-o'></i></span>";
			}
			else
			{
				$notif_message = "Sorry, your file is rejected";
				$icon = "<span id='icon_div'<i class='fa fa-fw fa-times-circle'></i></span>";
			}
			
			$url = asset('campaign/getdata/insight/offerdetails/'.$offer_id.'#step-3');
			
			
			
			$user_notifications = new user_notifications();
			$user_notifications->offer_id 		   	 = $offer_id;
			$user_notifications->user_id 		   	 = $user_id;
			$user_notifications->batch_id 		   	 = $batch_id;
			$user_notifications->url	 				 = $url;
			$user_notifications->notification_batch	 = $notification_batch;
			$user_notifications->notif_message  		 = $notif_message;
			$user_notifications->icon  		 		 = $icon;
			$user_notifications->notif_read 			 = 0;
			$user_notifications->save();	
			
			$channel = $user_id."_channel";
			$event = $user_id."_event";
			$data = "new_notification";
			
		    $this->makeEventObject()->trigger($channel,$event,$data);
	}
	
	
	
	
	
	
	
	
	public function get_notification(Request $request)
	{
		
		$user_id  =  $request->user()->id; 
		
		$notif = "t1.batch_id,t1.notification_batch,t1.notif_message,t1.notif_read"; 
		$select ="t2.Title,t2.id as offer_id,".$notif;
		$countNewNotif = \DB::table('user_notifications as t1')
		->select(\DB::raw($select))
		->join('offer_settings as t2','t2.id','=','t1.offer_id')
		->where('t1.user_id',$user_id)
		->where('t1.notif_read',0)
		->get();
		
		
		$offer_accepts = "(SELECT offer_id  FROM users_offer_3_continue_accepts  WHERE offer_id = t2.id) as accept_offer_id";
		$notif = "t1.id,t1.user_id,t1.batch_id,t1.notification_batch,t1.notif_message,t1.notif_read,t1.url,t1.icon"; 
		$select ="t2.Title,t2.id as offer_id,".$notif.",".$offer_accepts;
		$getallData = \DB::table('user_notifications as t1')
		->select(\DB::raw($select))
		->join('offer_settings as t2','t2.id','=','t1.offer_id')
		->where('t1.user_id',$user_id)
		->orderBy('t1.id', 'DESC')
		->orderByRaw('t1.notif_read= 0', 'DESC', 't1.notif_read')
		->take(10)
		->get();
		
		
	
		$outputData = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $newdata) 
			{	
				
				if($newdata->notification_batch == "new campaign" ||  $newdata->notification_batch == "schedule continue product")
				{
					
					/* 
					if($newdata->accept_offer_id)
					{
						$url =  asset('dashboard/acceptedoffer');
					}
					else
					{
						$url =  asset('dashboard');
					} 
					*/
					
					$url =  asset('dashboard');
					$path = asset("");
					$icon = str_replace('path_url/',$path,$newdata->icon);
					
			
				}
				else
				{
					$url  = $newdata->url;
					$icon = $newdata->icon;
				}
				
				
			
				
				
				$row = array();
				$row['accept_offer_id'] 	= $newdata->accept_offer_id;
				$row['id'] 					= $newdata->id;
				$row['user_id'] 			= $newdata->user_id;
				$row['batch_id'] 			= $newdata->batch_id;
				$row['notification_batch'] 	= $newdata->notification_batch;
				$row['notif_message'] 		= $newdata->notif_message;
				$row['icon'] 				= $icon;
				$row['notif_read'] 			= $newdata->notif_read;
				$row['Title'] 				= $newdata->Title;
				$row['offer_id'] 			= $newdata->offer_id;
				$row['url'] 				= $url;
			
			
				$outputData[] = $row;
			}
		}
		else
		{
			$outputData = [];
		}
		
	
		return response()->json(array('all_notif' => $outputData, 'count_new_notif' => $countNewNotif));

	}
	
	
	
	public function getAll_notificationData($user_id)
	{
		
		$offer_accepts = "(SELECT offer_id  FROM users_offer_3_continue_accepts  WHERE offer_id = t2.id) as accept_offer_id";
		$notif = "t1.id,t1.user_id,t1.batch_id,t1.notification_batch,t1.notif_message,t1.notif_read,t1.url,t1.icon"; 
		$select ="t2.Title,t2.id as offer_id,".$notif.",".$offer_accepts;
		$getallData = \DB::table('user_notifications as t1')
		->select(\DB::raw($select))
		->join('offer_settings as t2','t2.id','=','t1.offer_id')
		->where('t1.user_id',$user_id)
		->orderBy('t1.id', 'DESC')
		->orderByRaw('t1.notif_read= 0', 'DESC', 't1.notif_read')
		->get();
		
		
	
		$outputData = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $newdata) 
			{
				if($newdata->notification_batch == "new campaign" ||  $newdata->notification_batch == "schedule continue product")
				{
					
					if($newdata->accept_offer_id)
					{
						$url =  asset('dashboard/acceptedoffer');
					}
					else
					{
						$url =  asset('dashboard');
					}
					
					$path = asset("");
					$icon = str_replace('path_url/',$path,$newdata->icon);
					
			
				}
				else
				{
					$url  = $newdata->url;
					$icon = $newdata->icon;
				}
				
				
				$row = array();
				$row['accept_offer_id'] 	= $newdata->accept_offer_id;
				$row['id'] 					= $newdata->id;
				$row['user_id'] 			= $newdata->user_id;
				$row['batch_id'] 			= $newdata->batch_id;
				$row['notification_batch'] 	= $newdata->notification_batch;
				$row['notif_message'] 		= $newdata->notif_message;
				$row['icon'] 				= $icon;
				$row['notif_read'] 			= $newdata->notif_read;
				$row['Title'] 				= $newdata->Title;
				$row['offer_id'] 			= $newdata->offer_id;
				$row['url'] 				= $url;
			
			
				$outputData[] = $row;
			}
		}
		else
		{
			$outputData = [];
		}
		
		return $outputData;
		
	}


	public function read_notification(Request $request)
	{	
		$offer_id  =  $request->offer_id;
		$user_id  =  $request->user_id;
		
		user_notifications::where('offer_id',$offer_id)->where('user_id',$user_id)->update([
			'notif_read' 		=>  1
		]);	
		
		return response()->json(array('status' => 'success'));
	}
	
	// Method used to create instance of Pusher class's instance or object
    private function makeEventObject()
    {
        $options = array(
			   'cluster' => 'ap1',
			   'encrypted' => true
		);
 
        // You can get all this keys from pusher.com. After register of your app.
        return new Pusher(
					'44f094e6f806a4e2fe69',
					'dcbd670b992111b226be',
					'591725',
	
				$options
        );
    }


    
}
