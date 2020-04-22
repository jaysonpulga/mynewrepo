<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\OfferSettings;
use App\purchare_review_questions;
use App\amazon_review_questions;

use App\Model\frontend\social_facebook_psid_users;

class DashboardController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$offerdata = OfferSettings::all();
		return view('dashboard',array('offerdata'=>$offerdata));

	   
    }
	
	public function webhook(Request $request)
    {
     
         if(social_facebook_psid_users::where('subscriber_id',$request->subscriber_id)->exists())
		{
		    
		}
        else
        {
            
              $social_facebook_psid_users = new social_facebook_psid_users();
                $social_facebook_psid_users->fullname           =  $request->fullname;
        		$social_facebook_psid_users->subscriber_id  	=  $request->subscriber_id;
        		$social_facebook_psid_users->save();
            
        }
        
        

 
    }

}
