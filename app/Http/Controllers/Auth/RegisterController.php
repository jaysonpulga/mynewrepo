<?php

namespace App\Http\Controllers\Auth;

use App\Model\frontend\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Http\Controllers\frontend\SendEmailController;
use App\Http\Controllers\frontend\UserVccController;

use App\Model\frontend\user_vcc_historypays;
use App\Model\frontend\z_temporary_emails;
use App\Model\frontend\z_test_codes;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/congrats_site';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
 
	protected $SendEmailController;
	protected $UserVccController;
	
	
	public function __construct(SendEmailController $SendEmailController,UserVccController $UserVccController)
    {
		$this->middleware('guest'); 
		$this->SendEmailController = $SendEmailController;
		$this->UserVccController = $UserVccController;
    }
	
	

	
	

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    
    
    
    public function verify_invite_code(Request $request)
    {
        
         $invite_code =  $request->invite_code;
         
     
		if(z_test_codes::where('code',$invite_code)->exists())
		{
		    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                //ip from share internet
                $user_ip = $_SERVER['HTTP_CLIENT_IP'];
            }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                //ip pass from proxy
                $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }else{
                $user_ip = $_SERVER['REMOTE_ADDR'];
            }
            $user_ip;
            $output = NULL;
            $ip = $user_ip;
            $purpose = 'country';
            $deep_detect = true;
            if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
                $ip = $_SERVER["REMOTE_ADDR"];
                if ($deep_detect) {
                    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                }
            }
            $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
            $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
            $continents = array(
                "AF" => "Africa",
                "AN" => "Antarctica",
                "AS" => "Asia",
                "EU" => "Europe",
                "OC" => "Australia (Oceania)",
                "NA" => "North America",
                "SA" => "South America"
            );
            if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
                $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
                if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                    switch ($purpose) {
                        case "location":
                            $output = array(
                                "city"           => @$ipdat->geoplugin_city,
                                "state"          => @$ipdat->geoplugin_regionName,
                                "country"        => @$ipdat->geoplugin_countryName,
                                "country_code"   => @$ipdat->geoplugin_countryCode,
                                "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                                "continent_code" => @$ipdat->geoplugin_continentCode
                            );
                            break;
                        case "address":
                            $address = array($ipdat->geoplugin_countryName);
                            if (@strlen($ipdat->geoplugin_regionName) >= 1)
                                $address[] = $ipdat->geoplugin_regionName;
                            if (@strlen($ipdat->geoplugin_city) >= 1)
                                $address[] = $ipdat->geoplugin_city;
                            $output = implode(", ", array_reverse($address));
                            break;
                        case "city":
                            $output = @$ipdat->geoplugin_city;
                            break;
                        case "state":
                            $output = @$ipdat->geoplugin_regionName;
                            break;
                        case "region":
                            $output = @$ipdat->geoplugin_regionName;
                            break;
                        case "country":
                            $output = @$ipdat->geoplugin_countryName;
                            break;
                        case "countrycode":
                            $output = @$ipdat->geoplugin_countryCode;
                            break;
                    }
                }
            }
            $get_code_id = \DB::table('z_test_codes')->select('id')->where('code',$invite_code)->get();
            $save = \DB::table('z_test_used_codes')
            ->insert([['ip' => $user_ip,
            'country_ip' => $output,
            'code_id' => $get_code_id[0]->id,
            'domain_origin' => request()->server->get('SERVER_NAME')
            ]]);
            if($save){
                return response()->json(array('result' => 'exist'));
            }
		}
		else
		{
	        return response()->json(array('result' => 'not exist'));
		}
         
        exit();
         
       

    }
    
    
    public function submit_email_temporary(Request $request)
    {
        $email =  $request->email;
        
        
        if (z_temporary_emails::where('email','=',$email )->exists()) {
            
            
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'already-exist');
        }
        else
        {
            $z_temporary_emails = new z_temporary_emails();
    		$z_temporary_emails->email 		= $email;
    		$z_temporary_emails->domain_origin = request()->server->get('SERVER_NAME');
    		$z_temporary_emails->save();
    		 return redirect()->back()->with('message', 'thank-you');
        }
                
        
        
    }
    
    
    
    public function testkomuna(Request $request)
    {
      // $this->validator($request->all())->validate();
      //echo 'good';
      
      $validator = \Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'lastname' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6|confirmed',
        ]);
       
        /*
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        */
        
      //$validator = $this->validator($request->all())->validate();
        
        if ($validator->fails())
        {
            //return response()->json(['errors'=>$validator->errors()->all()]);
             $errors = $validator->errors()->getMessages();
             return response()->json($errors);

            //return redirect()->back()->withInput($request->input())->withErrors($errors);
        }
        
        
        return response()->json(['result'=>'success']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		
		
		$dob =  $data['month'].'/'.$data['year'];
		$tags = implode('|', $data['group_interest']);
		$fullname = $data['name'].' '.$data['lastname'];
		
        $server_name =     request()->server->get('SERVER_NAME');
	
	    $veryfication_code =$this->generateRandomString(10);
		$newuser = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'user_domain_origin' => $server_name,
            'email' => $data['email'],
			'zipcode' => $data['zipcode'],
			'dob' => $dob,
			'interest' => $tags,
			'verification_code'=>$veryfication_code,
            'password' => Hash::make($data['password']),
            
        ]);
		
	
		//Get The user ID and send Email
		$userid = $newuser->id;
		$this->SendEmailController->NewRegisterAccount_sendemail($fullname,$data['email'],$userid,$veryfication_code);
		
		//create vcc account
		//$data = $this->UserVccController->checkifuserhaveVcc($userid);
			
		// save vcc history
		/*
		$user_vcc_historypays = new user_vcc_historypays();
		$user_vcc_historypays->user_id  		=  $userid;
		$user_vcc_historypays->cc_id 			=  $data['cardID'];
		$user_vcc_historypays->virtual_amount  	=  $data['amount'];
		$user_vcc_historypays->offer_id  		=  '';
		$user_vcc_historypays->pay_method  		=  'initial payment';
		$user_vcc_historypays->save();
	    */
	    
		return $newuser;
	
		
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
	
	
	
}
