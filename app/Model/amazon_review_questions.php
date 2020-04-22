<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class amazon_review_questions extends Model
{
    //
	
	
	public static function amazonsurveydata()
	{
		
		$select ="t3.id,t2.name,t2.id as customerid,t3.Title,t3.product_name,(SELECT COUNT(*) FROM amazon_review_questions WHERE offer_id = t3.id GROUP by offer_id) as total_question";	
				
		$getallDataamazon = \DB::table('amazon_review_answers as t1')
				->select(\DB::raw($select))
				->join('users as t2','t2.id','=','t1.user_id')
				->join('offer_settings as t3','t3.id','=','t1.offer_id')
				->groupBy('t1.user_id', 't3.id')
				->get(); 
		
		
		if(!empty($getallDataamazon))
		{
		
			foreach ($getallDataamazon as $person) 
			{
				$row = array();
				$row['id'] = $person->id;
				$row['product_name'] 	= $person->product_name;
				$row['Title'] 			= $person->Title;
				$row['name'] 			= $person->name;
				$row['total_question'] 	= $person->total_question;
				
				
				$route = asset('admin/viewamazonanswer/'.$person->id."/customer/".$person->customerid);
				
				$row['action'] = "<a class='btn btn-raised btn-primary button_width' href=".$route."  title='modify data'><i class='fa fa-fw fa-pencil-square-o'></i> view answer</a>&nbsp;";
				
			
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
	
	
	
	public static function getAmazonSurveyAnswer($id,$customerid)
	{
		
		$select ="question.*,
				(SELECT answer FROM amazon_review_answers WHERE questionId = question.id  AND user_id = ".$customerid." ) as answer";	
				
		$getallData = \DB::table('amazon_review_questions AS question')
				->select(\DB::raw($select))
				->where('question.offer_id',$id)
				->get(); 
				
		return $getallData;		
	
	}
	

}
