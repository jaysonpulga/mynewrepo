<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\frontend\user_offer_archives;
use App\Model\frontend\users_offer_2_get_schedules;
use Carbon\Carbon;



class UserArchivedController extends Controller
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
	
	public function check_offeraccept_duedate(Request $request)
	{
		
		 $user_id =  $request->user()->id;
		 $offerdetails = users_offer_2_get_schedules::where('user_id',$user_id)->where('archived_status',0)->get();
		 $data_to_archived = array();
		 
		 $currentdate = Carbon::now();
		 
		 foreach($offerdetails as $datetime)
		 {
			 $row=array();
			 $row['user_id'] = $user_id;
			 $row['id'] = $datetime->id;
			 $row['offer_id'] = $datetime->offer_id;
			 $row['datetime'] = $datetime->sched_date." ".$datetime->sched_time;
			 $datedefine = $datetime->sched_date." ".$datetime->sched_time; 
			 
			 $daystoAdd = '1';
			 $duedate = date('Y-m-d H:i:s', strtotime($datedefine.' + '.$daystoAdd.' days'));
			 $row['duedate'] = $duedate;
			 
			 if($currentdate >= $duedate)
			 {
				  $row['status'] = 'going to archived';
				  $data_to_archived[] = $row;
			 }
			 
			 
			 
		 }
		 
		 
		 if(!empty($data_to_archived))
		 {
			 $this->SaveArchivedDataOfferAcceptDueDate($data_to_archived);
		 }
		 
	
	
	}
	
	public function SaveArchivedDataOfferAcceptDueDate($data_to_archived)
	{
		

		
		foreach($data_to_archived as $data)
		{
			
				$user_offer_archives = new user_offer_archives();
				$user_offer_archives->offer_id 		=  $data['offer_id'];
				$user_offer_archives->user_id  		=  $data['user_id'];
				$user_offer_archives->task  			=  'Offer Accept';
				$user_offer_archives->task_id  		=  $data['id'];
				$user_offer_archives->save();
				
				users_offer_2_get_schedules::where('id',$data['id'])->where('offer_id',$data['offer_id'])->where('user_id',$data['user_id'])->update([
					'archived_status'	=>  '1'
				]);
				
			
		}
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

	public function GetUserArchived(Request $request)
	{
		
		$user_id =  $request->user()->id;
		$user_offer_archives = user_offer_archives::where('user_id',$user_id)->get();
		
		$select ="t2.id,t2.campaign_type,t2.Title,t2.product_name";
		$user_offer_archives = \DB::table('user_offer_archives as t1')
		->select(\DB::raw($select))
				->join('offer_settings as t2','t2.id','=','t1.offer_id')
				->where('t1.user_id',$user_id)
				->get();
		
		
		$data = array();
		
		if(!empty($user_offer_archives))
		{
		
			foreach ($user_offer_archives as $dataarchived) 
			{
			
				$row = array();
				$row['id'] = $dataarchived->id;
				$row['campaign_type'] = $dataarchived->campaign_type;
				$row['Title'] = $dataarchived->Title;
				$row['product_name'] = $dataarchived->product_name;
				$row['activity'] = 'Accept Offer';
				
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
