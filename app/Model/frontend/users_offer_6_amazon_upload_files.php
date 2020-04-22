<?php

namespace App\Model\frontend;

use Illuminate\Database\Eloquent\Model;

class users_offer_6_amazon_upload_files extends Model
{
    //
	
		public static function getSubmitsurvey()
	{
		$data = array();
		
		$select ="t3.id as campaign_id,t2.id as customerid,t2.name,t3.Title,t3.product_name,t1.approved_by,t1.status";	
				
		$getallData = \DB::table('users_offer_6_amazon_upload_files as t1')
				->select(\DB::raw($select))
				->join('users as t2','t2.id','=','t1.user_id')
				->join('offer_settings as t3','t3.id','=','t1.offer_id')
				->where('t1.didyoupost_in_amazon','=','yes')
				->groupBy('t1.user_id', 't3.id' , 't2.id')
				->get(); 
		
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$row['id'] = $person->campaign_id;
				$row['product_name'] 	= $person->product_name;
				$row['Title'] 			= $person->Title;
				$row['name'] 			= $person->name;
				$row['status'] 			= $person->status;
				
				/* 
				if($person->admin_approved == 1)
				{
					$stat = "completed";
				}
				else if($person->admin_approved == 0)
				{
					$stat = "pending";
				}
				$row['admin_approved'] 	= $stat; 
				*/
							
				$route = asset('admin/viewsubmitedoffer/'.$person->campaign_id."/customer/".$person->customerid);
				
				$row['action'] = "<a class='btn btn-raised btn-primary button_width'  href='$route'  title='view details'><i class='fa fa-fw fa-list-alt'></i> View Details</a>&nbsp;";
				
			
				$data[] = $row;
			}
		}
		else
		{
			$data = [];
		}
		
		$output = array(
						
						"data" => $data,
				);
		
		return $output;
	}
}
