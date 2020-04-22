<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Validator;

use App\Model\frontend\User;

use Illuminate\Routing\UrlGenerator;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be resent if the user did not receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    
    
    protected $url;

    public function __construct(UrlGenerator $url)
    {
         //$this->middleware('auth');
        //$this->middleware('signed')->only('verify');
        //$this->middleware('throttle:6,1')->only('verify', 'resend');
        $this->url = $url;
    }
    
    
     protected function validator(array $data)
    {
        return Validator::make($data, [
            'verificationcode' => 'required|string|',
            'email' => 'required|string|email',
        ]);
    }
    
    
    public function check_email_validation(Request $request)
    {
        
       
       $this->validator($request->all())->validate();
        
        $email = $request->email;
        $verificationcode = $request->verificationcode;
        
       $url =  $this->url->to('/login');
        
         if(User::where('email',$email)->where('verification_code', $verificationcode)->exists())
		{
		   
		   
		   
		   
		   if(User::where('email',$email)->where('verification_code', $verificationcode)->where('verification_status', '0')->exists())
		   {
		        User::where('email',$email)->where('verification_code', $verificationcode)->update([
		
		    	'verification_status'	=>  1,
		    	'verification_date'	=>  date("Y/m/d H:i:s"),

		        ]);	
		        
		        return redirect()->back()->with('message', 'Congratulation your email has been veryfied, you may continue your process and  login your account');
		       
		   }
		   else
		   {
		       return redirect()->back()->with('message', 'your email has been verified, you may login your account');
		   }
		   
		   
		   
		}
		else
		{
		     
               
               return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'No details found! please check your email or verification code!');
		}
        
    }
    
    public function verifyemail()
    {
        return view('auth.verifyemail');
    }
    
    
    
    
    
    
    
    
}
