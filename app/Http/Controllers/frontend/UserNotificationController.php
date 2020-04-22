<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\frontend\User;
use App\frontend\social_facebook_psid_users;
use Auth;
use Hash;
use Validator;

class UserNotificationController extends Controller
{


	public function verification_code(Request $request)
	{
	    
	    echo $verification_code =  $request->verification_code;
	    exit;
	    
		$user_id =  $request->user()->id;
		$verification_code =  $request->verification_code;
	
		//if exist subscriber_id
		if(social_facebook_psid_users::where('subscriber_id',$verification_code)->exists())
		{
				
				social_facebook_psid_users::where('subscriber_id',$verification_code)->update([
				
					'user_id' 	 =>  $user_id,
					'status' 	 =>  'verified',
					'verified_date' 	 =>  Carbon::now()->format('Y-m-d H:i:s')

				]);
				
			return response()->json(array('result'=>'success'));
			exit;
		}
		else
		{
			return response()->json(array('result'=>'error'));
			exit;
		}
		
			
		
			
			
	
		
	}
	
	
	


}