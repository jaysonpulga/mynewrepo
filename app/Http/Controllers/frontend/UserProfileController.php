<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\frontend\User;
use App\Model\frontend\users_a_paypal_status;
use Auth;
use Hash;
use Validator;


use App\Model\frontend\social_facebook_psid_users;


use Carbon\Carbon;

use App\Http\Controllers\frontend\SendEmailController;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $SendEmailController;
	public function __construct(SendEmailController $SendEmailController)
    {
        
        $this->middleware('auth');
		 $this->SendEmailController = $SendEmailController;

    }
    public function verification_code(Request $request)
	{
	    

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
    
    
    public function webhook(Request $request)
    {
        
          $data =[
            
            'fname' => $request->fname,
            'lastname' => $request->lastname,
            'subscriber_id' => $request->subscriber_id
            
            
            ];
        
        
        echo response()->json(array($data));
  
      /*
        $data =[
            
            'fname' => $request->fname,
            'lastname' => $request->lastname,
            'subscriber_id' => $request->subscriber_id
            
            
            ];
        
        */      
                /*
                    $user_id = $request->user()->id;
            
                    $social_facebook_psid_users = new social_facebook_psid_users();
    				$social_facebook_psid_users->user_id 		    =  $user_id;
    				$social_facebook_psid_users->subscriber_id  	=  $request->subscriber_id;
    				$social_facebook_psid_users->save();
                */
        
        
       
        
    }
    
    
    function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
    
    public function Sendverifyemail(Request $request)
    {
    
        
        	$user_id = $request->user()->id;
    
        	$user = Auth::user();
        	$user_id   =  $user->id;
            $email   =  $user->email;
            $name   =  $user->name;
            $verifycode = $this->generateRandomString(10);
            
            User::where('id',$user_id)->update([
		
		    	'verification_code'	=>  $verifycode,

		    ]);	
            
            
            
            
            $this->SendEmailController->Sendverifyemail($user_id,$name,$email,$verifycode);
            
            echo 'This information has been sent to the email in your profile';
        	
    }
    
    
	 
    public function index()
    {
        //
    }
	
	
	
	public function useravatar(Request $request)
	{
		$user_id    =  $request->user()->id;
		$data = User::where('id',$user_id)->first(); 
		return view('frontend.user_upload_avatar',array('task'=>'profile','data'=>$data));	
	}

	

	
	public function updateavatar(Request $request)
	{
		$user_id  =  $request->user()->id;
	    $image = $request->image;
	    
	    
	    
	
	    $get_image = User::where('id',$user_id)->get();
	    if(!empty($get_image[0]->avatar))
	    {
	     $last_image_path = base_path().'/public/azmproject_images/avatar/'.$get_image[0]->avatar;
	     unlink($last_image_path);
	    }
	    
	  	preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
		 $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
		 $image = str_replace(' ', '+', $image);
		 $imageName = $this->generateRandomString(10) . '.' . $image_extension[1]; //generating unique file name;
		 \Storage::disk('avatar_images')->put($imageName,base64_decode($image)); //  file  config/filesystems.php
		 
		if(User::where('id',$user_id)->exists())
		{
			User::where('id',$user_id)->update([
				'avatar'		=>  $imageName,
			]);
		}
		
		
		echo $route_image = asset('public/azmproject_images/avatar/'.$imageName);
		
		//echo '<img src="'.$route_image.'" class="img-thumbnail" />';
		
	}
	
	
	
	
	public function userprofile(Request $request)
	{
		$user_id    =  $request->user()->id;
		
		$data = User::where('id',$user_id)->first();
		$paypal = users_a_paypal_status::where('user_id',$user_id)->first();
		$fb_messenger = social_facebook_psid_users::where('user_id',$user_id)->first();
		
		
		
	
		return view('frontend.userprofile',array('task'=>'profile','data'=>$data, 'paypal' => $paypal, 'fb_messenger' => $fb_messenger));	
	}
	
	public function edituserprofile(Request $request)
	{
		$user_id =  $request->user()->id;
		$data = User::where('id',$user_id)->first();
		$paypal = users_a_paypal_status::where('user_id',$user_id)->first();
		return view('frontend.userprofile_edit',array('task'=>'profile','data'=>$data,'paypal'=>$paypal));	
	}
	
	public function changepassword(Request $request)
	{

		return view('frontend.changepassword');	
	}
	
	public function updateinterest(Request $request)
	{
		$user_id    =  $request->user()->id;
		$data = User::where('id',$user_id)->first(); 
		
		return view('frontend.user_interest',array('data'=>$data));	
	}
	
	
	public function myWallet(Request $request)
	{
	    
	    $user_id = $request->user()->id;
	    $wallet = \DB::table('user_rebate_transactions')
	    ->select(\DB::raw('SUM(amount) as total'))
	    ->where([['user_id','=',$user_id],['status','=','unpaid']])
	    ->get();
	   // $points = \DB::table('user_rebate_points_converts')
	   // ->select(\DB::raw('SUM(amount_converted) as amount'))
	   // ->where([['buyer_id','=',$user_id],['status','=',0]])
	   // ->get();
	    if($wallet[0]->total == ''){
	        $total = '0.00';
	    }else{
	        $total = $wallet[0]->total + @$points[0]->amount;
	    }
	    return view('frontend.mywallet',array('wallet_amount' => $total));
	    //return view('frontend.mywallet',array('data'=>$data,'status' => $stat,'wallet_amount' => $wallet));	
	}
	public function campaign_details(Request $request,$id){
	   //return view('frontend.campaign_details');
	   $user_id = $request->user()->id;
	   $product_id = \DB::table('user_rebate_transactions as a')
	   ->leftjoin('offer_settings as b','a.campaign_id','=','b.id')
	   ->leftjoin('offer_setting_prices as x','x.offer_id','=','a.campaign_id')
	   ->leftjoin('offer_images as c','c.offer_id','=','a.campaign_id')
	   ->leftjoin('users_offer_2_get_schedules as d','d.offer_id','a.campaign_id')
	   ->leftjoin('users_offer_4_submit_tracking_numbers as e','e.offer_id','=','a.campaign_id')
	   ->leftjoin('users_offer_purchase_6th_steps as f','f.offer_id','=','a.campaign_id')
	   ->leftjoin('offer_competitors_amazon_order_ids as z','z.offer_id','=','a.campaign_id')
	   ->leftjoin('users as g','g.id','=','a.user_id')
	   ->leftjoin('admins as h','h.id','=','a.seller_id')
	   ->select('a.campaign_id','a.status','a.product_id','a.amount','b.product_name','c.image_path','d.sched_date','f.order_number','z.order_number as amazon_order_number','e.statusWithDetails','b.product_description',
	   'a.transaction_date','b.title','g.name','g.lastname','a.sender_batch_id','a.paypal_account','a.payout_processed_date','h.name as seller_name','a.sender_item_id','e.remarks','e.created_at','x.product_price','x.product_discount','x.product_discount_label',
	   'a.pay_method','b.earn_points')
	   ->where([['a.id','=',$id],['a.user_id','=',$user_id]])
	   ->get();
	   $check_points = \DB::table('user_rebate_points')->where('offer_id',$product_id[0]->campaign_id)->where('buyer_id',$user_id)->get();
	   return view('frontend.campaign_details',['product_info' => $product_id,'img_url' => cdn_asset('offer_images'),'points' => $check_points]);
	   
	}
	
	public function unpaid_campaign(Request $request){
	    $user_id = $request->user()->id;
	    $data =[];
	    $unpaid_campaign = \DB::table('user_rebate_transactions as a')
	    ->leftjoin('offer_images as b','b.offer_id','=','a.campaign_id')
	    //->leftjoin('users_offer_2_get_schedules as d','d.offer_id','a.campaign_id')
    	->leftJoin('users_offer_2_get_schedules as d', function($join)  use ($user_id)
		{
			$join->on('d.offer_id', '=', 'a.campaign_id');
			$join->on('d.user_id','=',\DB::raw($user_id));
		})
	    ->leftjoin('offer_settings as c','c.id','=','a.campaign_id')
	    ->select('a.id','a.status','a.transaction_date','c.product_name','b.image_path','a.amount','a.pay_method','d.sched_date','d.sched_time')
	    ->where([['a.user_id','=',$user_id],['a.status','=','unpaid'],['a.product_id','!=','']])
	    ->groupBy('a.id')
	    ->get();
	    $unpaid_campaign_decode = json_decode($unpaid_campaign);
	    $img = cdn_asset('offer_images');
	    foreach($unpaid_campaign_decode as $value){
	        $data['data'][] = ['id' => $value->id,
	        //'image' => '<img src="$img."/".$value->image_path."><small>'.$value->product_name.'</small>',
	        'image' => '<img class="direct-chat-img" style="border: 1px solid lightgray; margin-right: 25px;" src='.$img."/".$value->image_path.'><small>'.$value->product_name.'</small>',
	        'product_name' => '<small>'.$value->product_name.'</small>',
	        'amount' => $value->amount,
	        'status' => $value->status,
	        'pay_method' => $value->pay_method,
	        'transaction_date' => '<small>'.\Carbon\Carbon::parse($value->transaction_date)->format("F j, Y").'</small>',
	        'claimed_at' => '<small>'.\Carbon\Carbon::parse($value->sched_date)->format("F j, Y").'</small>'];

	    }
	   // $data['data'] = $unpaid_campaign;
	    return json_encode($data);
	}
	public function paid_campaign_product(Request $request){
	    $user_id = $request->user()->id;
	    $data =[];
	    $paid_campaign = \DB::table('user_rebate_transactions as a')
	    ->leftjoin('offer_images as b','b.offer_id','=','a.campaign_id')
	    //->leftjoin('users_offer_2_get_schedules as d','d.offer_id','a.campaign_id')
    	->leftJoin('users_offer_2_get_schedules as d', function($join)  use ($user_id)
		{
			$join->on('d.offer_id', '=', 'a.campaign_id');
			$join->on('d.user_id','=',\DB::raw($user_id));
		})
	    ->leftjoin('offer_settings as c','c.id','=','a.campaign_id')
	    ->select('a.id','a.status','a.transaction_date','c.product_name','b.image_path','a.amount','a.pay_method','d.sched_date','d.sched_time')
	    ->where([['a.user_id','=',$user_id],['a.status','=','paid'],['a.product_id','!=','']])
	    ->groupBy('a.id')
	    ->get();
	    $paid_campaign_decode = json_decode($paid_campaign);
	    
	    $img = cdn_asset('offer_images');
	    foreach($paid_campaign_decode as $value){
	        
	        $data['data'][] = ['id' => $value->id,
	        
	        
	        //'image' => '<img src="$img."/".$value->image_path."><small>'.$value->product_name.'</small>',
	        'image' => '<img class="direct-chat-img" style="border: 1px solid lightgray; margin-right: 25px;" src='.$img."/".$value->image_path.'><small>'.$value->product_name.'</small>',
	        'product_name' => '<small>'.$value->product_name.'</small>',
	        'amount' => $value->amount,
	        'status' => $value->status,
	        'pay_method' => $value->pay_method,
	        'transaction_date' => '<small>'.\Carbon\Carbon::parse($value->transaction_date)->format("F j, Y").'</small>',
	        'claimed_at' => '<small>'.\Carbon\Carbon::parse($value->sched_date)->format("F j, Y").'</small>'];

	    }
	   // $data['data'] = $unpaid_campaign;
	    return json_encode($data);
	}
	public function paid_campaign(Request $request){
	    $user_id = $request->user()->id;
	    $batch_details = \DB::table('payout_rebate_logs')
                    ->select('sender_item_id','sender_batch_id','status','process_date','unique',\DB::raw('COUNT(user_id) as count'),\DB::raw('SUM(amount) as total'))
                    ->where('user_id','=',$user_id)
                    ->groupBy('sender_batch_id','status','process_date','unique')
                    ->get(); 
        $batch_details_decode = json_decode($batch_details);
        $data = [];
        $img = cdn_asset('offer_images');
        foreach($batch_details_decode as $batch_detail){
            $batch_details_total = \DB::table('payout_rebate_logs')
                        ->select(\DB::raw('SUM(amount) as total'))
                        ->where([['user_id','=',$user_id],['sender_batch_id','=',$batch_detail->sender_batch_id]])
                        ->get();
                        $get_product_by_batch = \DB::table('payout_rebate_logs as c')
                        ->join('user_rebate_transactions as a',[['a.user_id','=','c.user_id'],['a.product_id','=','c.product_id']])
                        ->join('offer_images as d','d.offer_id','=','a.campaign_id')
                        ->join('users_offer_2_get_schedules as g','g.offer_id','a.campaign_id')
                        ->join('offer_settings as e','e.id','=','a.campaign_id')
                        ->join('admins as b','b.id','=','a.seller_id')
                        ->select('*','a.status as rebate_status','a.pay_method')
                        ->where([['c.sender_batch_id','=',$batch_detail->sender_batch_id],['a.user_id','=',$user_id]])
                        ->groupBy('a.id')
                        ->get();
                        $get_product_by_batch_decode = json_decode($get_product_by_batch);
                        $by_batch_nested = [];
                        foreach($get_product_by_batch_decode as $by_batch){
                            if($batch_detail->sender_item_id == $by_batch->sender_item_id){
                                $by_batch_nested[] = [
                                                //'product' => '<img src="https://reviewers.club/vip_beta/public/'.$by_batch->image_path.'"><small>'.$by_batch->product_name.'</small>',
                                                'id' => $by_batch->rebate_id,
                                                 'product' => '<img class="direct-chat-img" style="border: 1px solid lightgray; margin-right: 25px;" src='.$img."/".$by_batch->image_path.'><small>'.$by_batch->product_name.'</small>',
                                                'claimed_at' => '<small>'.$by_batch->sched_date.'</small>',
                                                'payment_status' => '<small>'.$by_batch->rebate_status.' at '.\Carbon\Carbon::parse($by_batch->payout_processed_date)->format("F j, Y").'</small>',
                                                'sender_item_id' => '<small>'.$by_batch->sender_item_id.'</small>',
                                                'pay_method' => $by_batch->pay_method];
                                                
                            }
                        }
                        $data['data'][] = ['sender_batch_id' => $batch_detail->sender_batch_id,
                                        'status' => $batch_detail->status,
                                        'process_date' => $batch_detail->process_date,
                                        'count' => $batch_detail->count,
                                        'unique' => $batch_detail->unique,
                                        'total' => $batch_detail->total,
                                        'product_details' => $by_batch_nested];
        }
        return json_encode($data);
	}
	public function getpaypalverified(Request $request)
	{
	    
	        $ch = curl_init();

            $ppUserID = "sb-03439s132615_api1.business.example.com"; //Take it from   sandbox dashboard for test mode or take it from paypal.com account in production mode, help: https://developer.paypal.com/docs/classic/api/apiCredentials/
            $ppPass = "G57C4KWEMC5PSLN5"; //Take it from sandbox dashboard for test mode or take it from paypal.com account in production mode, help: https://developer.paypal.com/docs/classic/api/apiCredentials/
            $ppSign = "AJshOW6s434qQjH2e9sQcKpDHnKxApQsBl6vFPj-wSafkv8Pn1NKusuQ"; //Take it from sandbox dashboard for test mode or take it from paypal.com account in production mode, help: https://developer.paypal.com/docs/classic/api/apiCredentials/
            $ppAppID = "APP-80W284485P519543T"; //if it is sandbox then app id is always: APP-80W284485P519543T
            $sandboxEmail = "sb-03439s132615_api1.business.example.com"; //comment this line if you want to use it in production mode.It is just for sandbox mode
            $emailAddress = $request->email; //The email address you wana verify
            
            //parameters of requests
            $nvpStr = 'emailAddress='.$emailAddress.'&matchCriteria=NONE';
            
            // RequestEnvelope fields
            $detailLevel    = urlencode("ReturnAll");
            $errorLanguage  = urlencode("en_US");
            $nvpreq = "requestEnvelope.errorLanguage=$errorLanguage&requestEnvelope.detailLevel=$detailLevel&";
            $nvpreq .= "&$nvpStr";
            curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
            
            $headerArray = array(
            "X-PAYPAL-SECURITY-USERID:$ppUserID",
            "X-PAYPAL-SECURITY-PASSWORD:$ppPass",
            "X-PAYPAL-SECURITY-SIGNATURE:$ppSign",
            "X-PAYPAL-REQUEST-DATA-FORMAT:NV",
            "X-PAYPAL-RESPONSE-DATA-FORMAT:JSON",
            "X-PAYPAL-APPLICATION-ID:$ppAppID",
            "X-PAYPAL-SANDBOX-EMAIL-ADDRESS:$sandboxEmail" //comment this line in production mode. IT IS JUST FOR SANDBOX TEST 
            );
            
            $url="https://svcs.sandbox.paypal.com/AdaptiveAccounts/GetVerifiedStatus";
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
            $paypalResponse = curl_exec($ch);
            //echo $paypalResponse;   //if you want to see whole PayPal response then uncomment it.
            curl_close($ch);
            
            $value = json_decode($paypalResponse,true);
            if($value['responseEnvelope']['ack'] == 'Success'){
                echo 'verified_email';
                \DB::table('users_a_status')
                ->insert([['user_id' => $request->user()->id,
                            'paypal_email' => $emailAddress,
                            'paypal_email_status' => 'verified',
                            'active' => 1,
                            'date_verified' => now()]]);
            }else{
                echo 'this email is not valid';
            }
	    
	   
	}
	
	public function updateuserinterest(Request $request)
	{
        $tags = implode('|',$request->group_interest);
        $user_id  =  $request->user()->id;
        
        if(User::where('id',$user_id)->exists())
		{
			User::where('id',$user_id)->update([
				'interest'		=> $tags,
				
				
			]);
			
			return response()->json(array('success' => 'success'));
			
		}
   
	}
	
	
	
	
	
	public function updateprofile(Request $request)
	{
		$user_id  =  $request->user()->id;
		
		$dob = $request->month.'/'.$request->year;
		
		if(User::where('id',$user_id)->exists())
		{
			User::where('id',$user_id)->update([
				'name'	            	=> $request->name,
				'lastname'          	=> $request->lastname,
				'email'	            	=> $request->email,
				'mnumber'           	=> $request->mnumber,
				'gender'	            => $request->gender,
				'address'           	=> $request->address,
				'zipcode'	            => $request->zipcode,
				'allow_email_subscribe'	=> $request->allow_email_subscribe,
				'dob'		=> $dob,
				
				
			]);
			
			if(users_a_paypal_status::where('user_id',$user_id)->exists()){
			    users_a_paypal_status::where('user_id',$user_id)->update([
				    'paypal_email'	            	=> $request->paypal_address,
			    ]);
			}else{
			    \DB::table('users_a_paypal_statuses')
			    ->insert([['user_id' => $user_id,
			    'paypal_email' => $request->paypal_address,
			    'paypal_email_status' => 'verified',
			    'active' => 1,
			    'date_verified' => date('Y-m-d H:i:s')]]);
			}
			
			
			return response()->json(array('success' => 'success'));
			
		}
	}
	
	 public function updatepassword(Request $request)
	 {
		 
		
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) 
		{
			return response()->json(array('success' => false, 'error' => true,'message' => 'Your current password does not matches with the password you provided. Please try again.'));
        }
        if(strcmp($request->get('current_password'), $request->get('newpassword')) == 0)
		{
			return response()->json(array('success' => false, 'error' => true,'message' => 'New Password cannot be same as your current password. Please choose a different password.'));
        }
		
        $request_data = $request->All();
		$validator = $this->admin_credential_rules($request_data);
		if($validator->fails())
		{
			return response()->json(array('message' => $validator->getMessageBag()->toArray(),'success' => false, 'error' => true , 'object' => true));
		}
		
		
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();
		return response()->json(array('success' => true, 'error' => false));
    }
	
	
	public function admin_credential_rules(array $data)
	{
	  $messages = [
		'current_password.required' => 'Please enter current password',
		'newpassword.required' => 'Please enter new  password',
		'confirmpassword.required' => 'Please enter confirm  password',
	  ];

	  $validator = Validator::make($data, [
		'current_password' => 'required',
		'newpassword' => 'required|string|min:6',
		'confirmpassword'  =>  'required|same:newpassword',    
	  ], $messages);

	  return $validator;
	} 
	

    
    ################## MY POINTS FUNCTIONS #########################
    
    public function mypoints(Request $request)
	{
	    
	    $user_id = $request->user()->id;
	    @$points = \DB::table('user_rebate_points')
	    ->select(\DB::raw('SUM(points) as points'))
	    ->where([['buyer_id','=',$user_id],['status','=',0]])
	    ->get();
	    if($request->data == 'points_counts')
	    {
	        echo @$points[0]->points;
	    }else{
	        return view('frontend.mypoints',array('points_amount' => @$points[0]->points));
	    }
	  	
	}
	public function avail_points(Request $request){
	    $user_id = $request->user()->id;
	    $get_data = \DB::table('user_rebate_points')
	    ->select('*')
	    ->where([['buyer_id','=',$user_id],['status','=',0]])
	    ->get();
	    return json_encode(['data' => $get_data]);
	}
	public function transac_success(Request $request){
	    $user_id = $request->user()->id;
	    $get_data = \DB::table('user_rebate_points_converts')
	    ->select('*')
	    ->where([['buyer_id','=',$user_id],['status','=',0]])
	    ->get();
	    $data = [];
	    foreach(json_decode($get_data) as $val){
	        $converted_details = \DB::table('user_rebate_points')
	        ->select('*')
	        ->where([['transfer_id','=',$val->transfer_id],['status','=',1]])
	        ->get();
	        $data[] = ['transfer_id' => $val->transfer_id,
	        'converted_points' => $val->converted_points,
	        'amount_converted' => $val->amount_converted,
	        'date_converted' => $val->date_converted,
	        'converted_details' => $converted_details];
	    }
	    return json_encode(['data' => $data]);
	}
	public function paid_points(Request $request){
	    $user_id = $request->user()->id;
	    $get_data = \DB::table('user_rebate_points_converts as a')
	    ->leftjoin('user_rebate_transactions as b','b.transfer_id','=','a.transfer_id')
	    ->select('a.*','b.status','b.payout_processed_date','b.sender_batch_id')
	    ->where([['a.buyer_id','=',$user_id],['a.status','=',1]])
	    ->groupBy('a.transfer_id')
	    ->get();
	    $data = [];
	    foreach(json_decode($get_data) as $val){
	        $converted_details = \DB::table('user_rebate_points')
	        ->select('*',\DB::raw('COUNT(transfer_id) as count'))
	        ->where([['transfer_id','=',$val->transfer_id],['status','=',1]])
	        ->get();
	        $data[] = ['transfer_id' => $val->transfer_id,
	        'batch_id' => $val->sender_batch_id,
	        'converted_points' => $val->converted_points,
	        'amount_converted' => $val->amount_converted,
	        'status' => $val->status,
	        'process_date' => $val->payout_processed_date,
	        'count' => $converted_details[0]->count,
	        'date_converted' => $val->date_converted,
	        'converted_details' => $converted_details];
	    }
	    return json_encode(['data' => $data]);
	}
	public function transfer_points(Request $request){
	    $user_id = $request->user()->id;
	    $points = $request->mypoints;
	    $convert = $points / 100;
	    $transfer_id = $this->generateRandomString(10);
	    $insert = \DB::table('user_rebate_points_converts')
	    ->insert([['buyer_id' => $user_id,
	    'converted_points' => $points,
	    'transfer_id' => $transfer_id,
	    'amount_converted' => $convert,
	    'date_converted' => date('Y-m-d H:i:s')]]);
	    $update = \DB::table('user_rebate_points')
	    ->where([['buyer_id','=',$user_id],['status','=',0]])
	    ->update(['status' => 1,'transfer_id' => $transfer_id]);
	    $rebate_transactions = \DB::table('user_rebate_transactions')
	    ->insert([['user_id' => $user_id,
	    'transfer_id' => $transfer_id,
	    'status' => 'unpaid',
	    'amount' => $convert,
	    'transaction_date' => date('Y-m-d H:i:s')]]);
	   if($update == true && $insert == true){
	       echo 'success';
	   }
	}
    
    
}
