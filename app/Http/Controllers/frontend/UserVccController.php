<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\frontend\user_vcc;
use App\Model\frontend\user_vcc_historypays;
use App\Model\frontend\user_notifications;

use App\Model\frontend\users_offer_1_sent_campaigns as SentCampaign;
use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\frontend\users_offer_3_continue_accepts;
use App\Model\frontend\users_offer_4_submit_tracking_numbers;
use App\Model\frontend\users_offer_5_completeds;

use App\Model\offer_settings;
use App\Model\frontend\User;
use Auth;

use App\Http\Controllers\frontend\SendEmailController;

class UserVccController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     

	protected $SendEmailController;

	
	public function __construct(SendEmailController $SendEmailController)
    {
		 $this->SendEmailController = $SendEmailController;

    }
     
    public function index()
    {
        //
    }
    
    
    public function transaction(Request $request)
    {
     
        $data = array();
	    $select ="user_vcc_historypays.*,t2.product_name";
	    $pay_method ="";
	
		$getallData = \DB::table('user_vcc_historypays')
		->select(\DB::raw($select))
				 ->leftJoin('offer_settings as t2','t2.id','=','user_vcc_historypays.offer_id')
				->where('user_vcc_historypays.user_id',$request->id)
				->get();
				
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
			    if($person->pay_method == "purchased_product")
			    {
			         $pay_method = "purchased product";
			    }
			    else if($person->pay_method == "leave product review")
			    {
			         $pay_method = "product review";
			    }
			    else if($person->pay_method == "return_product")
			    {
			         $pay_method = "product returned";
			    }
			    else if($person->pay_method == "active account")
			    {
			         $pay_method = "active account";
			    }
			    
			    $out = strlen($person->product_name) > 25 ? substr($person->product_name,0,25)."..." : $person->product_name;
			    
			   	$row = array();
				$row['id'] = $person->id;
				$row['product_name'] =   $out; //str_limit($person->product_name, 0, 15, "..."); 
				$row['virtual_amount'] =  "$".  number_format((float)$person->virtual_amount, 2, '.', '');
				$row['pay_method'] =  $pay_method;
				$row['created_at'] = $person->created_at;
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
    
    public function SendEmailVccinformation(Request $request)
    {
        
        
            $cardnumber_cvv = $request->cardnumber_cvv;
            $expiration =  $request->expiration;
            $cvv =  $request->cvv;
        
        	$user_id = $request->user()->id;
    
        	$user = Auth::user();
            $email   =  $user->email;
            $name   =  $user->name;
            
            $this->SendEmailController->SendEmailVccinformation($user_id,$name,$email,$cardnumber_cvv,$expiration,$cvv);
            
            echo 'This information has been sent to the email in your profile';
        	
    }
	
	
	
	public static function getVCC_id()
	{
		$user = Auth::user();
		$user_id   =  $user->id;
		@$data = user_vcc::where('user_id',$user_id)->first(); 
		return @$data->cc_id; 
	}
	
	
	public static function GetCurrentAmount()
	{
		
		$user = Auth::user();
		$user_id = $user->id;
	
		if(user_vcc::where('user_id', $user_id)->exists())
		{	
			$virtual_amount = user_vcc::select('virtual_amount')->where('user_id',$user_id)->first();
			return $virtual_amount->virtual_amount;
		}
		else
		{
			return "0.00";
		}
		
	}
	
	
	// use for pay tracking number
	public static function get_amount_tracking_price($user_id,$offer_id)
	{
		
		//$user_id = $request->user()->id;
		//$offer_id = $request->offer_id;
		
		
		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
					
		$product_info = offer_settings::where('id',$offer_id)->first();			
					
					
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		$original_product_price = sprintf('%0.2f', $product_price);
		
	
		$purchase_rebate 		= $product_info->purchase_rebate;
		$purchase_rebate_amount = $product_info->purchase_rebate_amount;
		
		if($purchase_rebate == "Percentage")
		{
			$rebate_percent = $purchase_rebate_amount / 100;
			$rebate_amount =  $original_product_price * $rebate_percent;
		
		}
		else if($purchase_rebate == "Dollar")
		{
			//$rebate_amount = $product_sale_amount - $purchase_rebate_amount;
			$rebate_amount =   $purchase_rebate_amount;
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $purchase_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	public static function get_amount_tracking_price_product_return($user_id,$offer_id)
	{
	
		
		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
					
		$product_info = offer_settings::where('id',$offer_id)->first();			
					
					
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
	
		$return_product_rebate 		= $product_info->return_product_rebate;
		$return_product_rebate_amount = $product_info->return_product_rebate_amount;
		
		if($return_product_rebate == "Percentage")
		{
			$rebate_percent = $return_product_rebate_amount / 100;
			$rebate_amount =  $product_sale_amount * $rebate_percent;
		
		}
		else if($return_product_rebate == "Dollar")
		{
			$rebate_amount = $product_sale_amount - $return_product_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $return_product_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	
	public static function get_amount_amazonupload_file($user_id,$offer_id)
	{
		

		
		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
					
		$product_info = offer_settings::where('id',$offer_id)->first();			
					
					
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
	
		$amazon_rebate 		= $product_info->amazon_rebate;
		$amazon_rebate_amount = $product_info->amazon_rebate_amount;
		
		if($amazon_rebate == "Percentage")
		{
			$rebate_percent = $amazon_rebate_amount / 100;
			$rebate_amount =  $product_sale_amount * $rebate_percent;
		
		}
		else if($amazon_rebate == "Dollar")
		{
			$rebate_amount = $product_sale_amount - $amazon_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $amazon_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	public static function get_amount_submitproductreview($user_id,$offer_id)
	{
		

		
		$getinfo = users_offer_2_get_schedules::where('user_id',$user_id)
					->where('offer_id',$offer_id)
					->first();
					
		$product_info = offer_settings::where('id',$offer_id)->first();			
					
					
		$product_price 			= $getinfo->product_price;
		$product_discount_label = $getinfo->product_discount_label;	
		$product_discount 		= $getinfo->product_discount;

		$discount_percent = $product_discount / 100;
		$discounted_amount = $product_price * $discount_percent;
		$product_sale_amount   =  $product_price - $discounted_amount;
		
	
		$amazon_rebate 		= $product_info->amazon_rebate;
		$amazon_rebate_amount = $product_info->amazon_rebate_amount;
		
		if($amazon_rebate == "Percentage")
		{
			$rebate_percent = $amazon_rebate_amount / 100;
			$rebate_amount =  $product_sale_amount * $rebate_percent;
		
		}
		else if($amazon_rebate == "Dollar")
		{
			$rebate_amount = $product_sale_amount - $amazon_rebate_amount;
			
			// check if negative value return the exact amount;
			if($rebate_amount < 0)
			{
				$rebate_amount = $amazon_rebate_amount;
			}
		}
		
		return   sprintf('%0.2f', $rebate_amount);
		
	}
	
	
	
	
	
	
	
	public function checkifuser_alreadypaidforpurchasedproduct(Request $request)
	{
	
		$user_id = $request->user()->id;
		$offer_id = $request->offer_id;
		$pay_method = $request->pay_method;
		
		if(user_vcc_historypays::where('user_id', $user_id)->where('offer_id', $offer_id)->where('pay_method', $pay_method)->exists())
		{	
			return 'already_paid';
			exit;
		}
		else
		{
			return 'notyet_paid';
			exit;
		}
		
	}
	
	public function saving_virtualcc_historypay(Request $request)
	{
	
		$user_id = $request->user()->id;
		$offer_id = $request->offer_id;
		$pay_method = $request->pay_method;
		$cc_id = $request->cc_id;
		$rebate_amount = $request->rebate_amount;
		$total_amount = $request->total_amount;
		
		
		
		$user_vcc_historypays = new user_vcc_historypays();
		$user_vcc_historypays->user_id  		=  $user_id;
		$user_vcc_historypays->cc_id 			=  $cc_id;
		$user_vcc_historypays->virtual_amount  	=  $rebate_amount;
		$user_vcc_historypays->offer_id  		=  $offer_id;
		$user_vcc_historypays->pay_method  		=  $pay_method;
		$user_vcc_historypays->save(); 
		
		
		
		if(user_vcc::where('user_id', $user_id)->where('cc_id', $cc_id)->exists())
		{	
			user_vcc::where('user_id', $user_id)->where('cc_id', $cc_id)->update([
					'virtual_amount'  =>  $total_amount,
								
				]);
		}
		
		echo "success";
			
				
	}
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUserVirtualcc(Request $request)
    {	
			$user_id = $request->user()->id;
			
			$user_vcc = new user_vcc();
			$user_vcc->cc_id 			=  $request->cc_id;
			$user_vcc->user_id  		=  $user_id;
			$user_vcc->virtual_amount  	=  $request->virtual_amount;
			$user_vcc->save(); 
				
			echo 'success';
			 
    }
	
	
	
	public function checkVirtualCCamount(Request $request)
    {	
			$user_id =  $request->user()->id;
			$data = user_vcc::where('user_id',$user_id)->get(); 
			return response()->json($data);
			
    }
	
	public function checkifhaveAlreadyVcc(Request $request)
    {	
			$user_id =  $request->user()->id;

			//if exist account
			if(user_vcc::where('user_id', $user_id)->exists())
			{	
				$data = user_vcc::where('user_id',$user_id)->first(); 	
				return response()->json(array('status'=>'existAccount','cc_id'=>$data['cc_id']));
			}
			else
			{
				return response()->json(array('status'=>'noAccount'));
			}
    }
	
	
	
	public function checkifhaveAlreadyVcc2(Request $request)
    {	
			$user_id =  $request->user()->id;

			//if exist account
			if(user_vcc::where('user_id', $user_id)->exists())
			{	
				$data = user_vcc::where('user_id',$user_id)->first(); 	
				echo 'existaccount';
			}
			else
			{
				echo 'noaccount';
			}
    }
	
	
	public function checkifuserhaveVcc($user_id)
    {	
			//if exist account
			if(user_vcc::where('user_id', $user_id)->exists())
			{
				// get cc_id of user
				$cardid = user_vcc::select('cc_id','virtual_amount')->where('user_id',$user_id)->first();
				
				$cardID = $cardid->cc_id;
				//$virtual_amount = $cardid->virtual_amount;
				
				// get Vcc Acount
				$getamount = $this->getVccAccountofuser($cardID);
				 
				 
				return array('cardID' => $cardID, 'amount' => $getamount->amount, 'src' => 'exist account' );
				//temporary
				//return array('cardID' => $cardID, 'amount' => $virtual_amount, 'src' => 'exist account' );
				
				exit;
			}
			else
			{
				//create new vcc account in bento
				$data_record = User::where('id',$user_id)->first();
				$return_data = $this->CreateNewVccAccount($data_record->name,$data_record->lastname,$data_record->zipcode);
				
				// save vcc account in user_vcc table
				$user_vcc = new user_vcc();
				$user_vcc->cc_id 			=  $return_data['cardID'];
				$user_vcc->user_id  		=  $user_id;
				$user_vcc->virtual_amount  	=  $return_data['amount'];
				$user_vcc->save();
				
				// save vcc history
        		$user_vcc_historypays = new user_vcc_historypays();
        		$user_vcc_historypays->user_id  		=  $user_id;
        		$user_vcc_historypays->cc_id 			=  $return_data['cardID'];
        		$user_vcc_historypays->virtual_amount  	=  $return_data['amount'];
        		$user_vcc_historypays->offer_id  		=  "";
        		$user_vcc_historypays->pay_method  		=  "active account";
        		$user_vcc_historypays->save();
        		//
				
				return array('cardID' => $return_data['cardID'], 'amount' => $return_data['amount'], 'src' => 'new account' );
				
				exit;
			}
    }
	
	public function getCardID(/*Request $request*/$user_id)
    {	
			//$user_id = $request->user()->id;
			$cardID = user_vcc::select('cc_id')->where('user_id',$user_id)->first();
			return  $cardID->cc_id;
			 
    }
	
	
	public function getCardID2(Request $request)
    {	
			$user_id = $request->user()->id;
			$cardID = user_vcc::select('cc_id')->where('user_id',$user_id)->first();
			return  $cardID->cc_id;
			 
    }
	
	//create new account vcc
	public function CreateNewVccAccount($name,$lastname,$zipcode)
	{
		
		$data = array(
		
					"fname"   => $name,					
					"lname"   => $lastname, 			  
					"strt"    => "Street",				  
					"city"    => "CITY",				 
					"state"   => "AL",				  
					"zip"	  => $zipcode,				  
					"amount"  => 1
		);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://fncc.herokuapp.com/api/runmanualgen");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// execute!
		$response = curl_exec($ch);

		curl_close ($ch);
		
		$info = json_decode($response, true);
		
		return $info;
		
		exit;
	}
	
	
	
	//get the vcc account
	public function getVccAccountofuser($cardID)
	{
	
		
		$data = array("cardid" => $cardID);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://fncc.herokuapp.com/api/getinfo");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// execute!
		$response = curl_exec($ch);

		curl_close ($ch);
		
		$info = json_decode($response, true);
		
		//return $info;
		
		$result 	= (object) $info;
		$infos 		= $result->infos;
		$userinfo	= $infos['data'];
		$spend 		= (object)$userinfo['spendingLimit'];
		
		return $spend;
		
		exit;
		
	}
	
	
	//update user vcc
	public function UpdateVccAccountofuser($cardID,$amount)
	{
	
		
		$data = array("cardid" => $cardID, "amount" => $amount);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://fncc.herokuapp.com/api/updatecard");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// execute!
		$response = curl_exec($ch);

		curl_close ($ch);
		
		$info = json_decode($response, true);
		
		/* //return $info;
		
		$result 	= (object) $info;
		$infos 		= $result->infos;
		$userinfo	= $infos['data'];
		$spend 		= (object)$userinfo['spendingLimit']; */
		
		return $info['spendingLimit'];
		
		exit;
		
	}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user_vcc  $user_vcc
     * @return \Illuminate\Http\Response
     */
    public function show(user_vcc $user_vcc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user_vcc  $user_vcc
     * @return \Illuminate\Http\Response
     */
    public function edit(user_vcc $user_vcc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user_vcc  $user_vcc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user_vcc $user_vcc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user_vcc  $user_vcc
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_vcc $user_vcc)
    {
        //
    }
	
}
