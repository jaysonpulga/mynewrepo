<?php

namespace App\Model\frontend;

use Illuminate\Database\Eloquent\Model;

class users_offer_1_sent_campaigns extends Model
{
 
	public static function notification($user_id)
	{
		
		$select ="t2.Title,t2.id as offer_id,t1.id as idx";
		$getallData = \DB::table('users_offer_1_sent_campaigns as t1')
		->select(\DB::raw($select))
		->join('offer_settings as t2','t2.id','=','t1.offer_id')
		->where('t1.user_id',$user_id)
		->where('t1.read_notif',0)
		->get();
		
		return $getallData;
	}
	
}
