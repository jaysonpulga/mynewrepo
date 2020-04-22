<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\frontend\user_activities;

class UserActivitiesController extends Controller
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
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SaveUserActivities(Request $request)
    {
		
			$user_id       =  $request->user()->id;
			$activities    =   $request->activities;
			$task 		   =  $activities['task'];
			$campaign_id   =  $activities['campaign_id'];
			$activity_info = "";
			
			if($task == "accept_offer")
			{
				$activity_info = $this->AcceptOfferTask($user_id,$campaign_id);
			}
			else if($task == "continue_offer")
			{
				$activity_info = $this->ContinueOfferTask($user_id,$campaign_id);
			}
			
			
			
			$user_activities = new user_activities();
			$user_activities->user_id 		=  $user_id;
			$user_activities->activity_info =  $activity_info;
			$user_activities->save(); 
		
			
		
			
    }
	
	public function AcceptOfferTask($user_id,$campaign_id)
	{
		
		$select ="t1.campaign_type,t1.Title,t1.product_name,t2.sched_date,t2.sched_time";
		$res = \DB::table('offer_settings as t1')
		->select(\DB::raw($select))
		->join('users_offer_2_get_schedules as t2','t2.offer_id','=','t1.id')
		->where('t2.user_id', '=', $user_id)
		->where('t2.offer_id', '=', $campaign_id)
		->first();
		
		if($res->campaign_type == "addtocart campaign")
		{
			$type = "ADD TO CART";
		}
		else if($res->campaign_type == "compare campaign")
		{
			$type = "COMPARE";
		}
		else if($res->campaign_type == "fullbuy campaign")
		{
			$type = "FULLBUY";
		}
		else if($res->campaign_type == "insight campaign")
		{
			$type = "INSIGHT";
		}
		
		$activity_info = "<b>Offer Accept</b><br>";
		$activity_info .= "Campaign Type: ".$type."<br>";
		$activity_info .= "Campaign Name: ".$res->Title."<br>";
		$activity_info .= "Product: ".$res->product_name."<br>";
		$activity_info .= "Offer Schedule will be available on ".$res->sched_date." ".$res->sched_time."<br>";
		
		return $activity_info;
			
		
	}
	
	public function ContinueOfferTask($user_id,$campaign_id)
	{
		
		$select ="t1.campaign_type,t1.Title,t1.product_name";
		$res = \DB::table('offer_settings as t1')
		->select(\DB::raw($select))
		->join('users_offer_3_continue_accepts as t2','t2.offer_id','=','t1.id')
		->where('t2.user_id', '=', $user_id)
		->where('t2.offer_id', '=', $campaign_id)
		->first();
		
		if($res->campaign_type == "addtocart campaign")
		{
			$type = "ADD TO CART";
		}
		else if($res->campaign_type == "compare campaign")
		{
			$type = "COMPARE";
		}
		else if($res->campaign_type == "fullbuy campaign")
		{
			$type = "FULLBUY";
		}
		else if($res->campaign_type == "insight campaign")
		{
			$type = "INSIGHT";
		}
		
		$activity_info = "<b>Confirmed offer</b><br>";
		$activity_info .= "Campaign Type: ".$type."<br>";
		$activity_info .= "Campaign Name: ".$res->Title."<br>";
		$activity_info .= "Product: ".$res->product_name."<br>";

		
		return $activity_info;
			
		
	}
	
	
	
	public function GetUserActivities(Request $request)
	{
		
		$id =  $request->user()->id;
		$user_activities = user_activities::where('user_id',$id)->get();
		$data = array();
		
		if(!empty($user_activities))
		{
		
			foreach ($user_activities as $person) 
			{
			
				$row = array();
				$row['id'] = $person->id;
				$row['activity_info'] = $person->activity_info;
				$row['date_task'] = $person->created_at->toDateTimeString();
				$data[] = $row;
			}
		}
		else
		{
			$data = [];
		}
		
		$output = array( "data" => $data);
		
		return $output;
		
	}
	
	


    
}
