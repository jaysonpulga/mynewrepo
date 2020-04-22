<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\amazon_review_answers;
use App\Model\amazon_review_questions;
use App\Model\frontend\users_offer_6_amazon_upload_files;
use App\Model\frontend\user_submit_survey;
use App\Model\frontend\user_rebate_transaction;
use App\Model\offer_settings;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


use App\Http\Controllers\frontend\UserPaymentVccController;

class AmazonsurveyController extends Controller
{
	
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	 public function __construct(UserPaymentVccController $UserPaymentVccController)
    {
		 $this->UserPaymentVccController = $UserPaymentVccController;

    }
	 
	 
    public function index()
    {
        //
    }
	
	public function  upload_file($answer_filename)
	{
		
	
		// file storage
		$fileRoute = "/amazon_product_survey/";
		
		// Allowed extentions.
		$allowedExts = array("gif","jpeg","jpg","png","mp4","mp3","wma","vlc");
		
		// Get filename.
		$temp = explode(".",$answer_filename);
		
		// Get extension.
		$extension = end($temp);
		
		
		if(in_array($extension, $allowedExts)){
					// Generate new random name.
					$name = sha1(microtime()) . "." . $extension;
					
					//$name = $_FILES["file"]["name"];
					// Save file in the uploads folder.
					move_uploaded_file($answer_filename, getcwd() . $fileRoute . $name);
					
					// Check server protocol and load resources accordingly.
					  if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off") {
						$protocol = "https://";
					  } else {
						$protocol = "http://";
					  }
					
			
					 // Generate response.
					  $response = new \StdClass();
					  $response->link = $protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).$fileRoute . $name;
					 
					  // Send response.
					  echo stripslashes(json_encode($response));
					
		}
		
		
	
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
	
	
	public function uploadimages($image)
	{
		
				//get the type of file
				preg_match("/^data:(.*);base64/",$image, $match);
				$file_ext = explode("/",$match[1]);
				$typeof_file = $file_ext[0];
				
				// save the file into folder
				preg_match("/data:".$typeof_file."\/(.*?);/",$image,$image_extension); // extract the image extension
				$image = preg_replace('/data:'.$typeof_file.'\/(.*?);base64,/','',$image); // remove the type part
				$image = str_replace(' ', '+', $image);
				$imageName = $this->generateRandomString(10) . '.' . $image_extension[1]; //generating unique file name;
				\Storage::disk('amazon_product_survey')->put($imageName,base64_decode($image),'public'); //  file  config/filesystems.php
				 
				$fileRoute = '/public/amazon_product_survey/';
				//Check server protocol and load resources accordingly.
				if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off")
				{
				   $protocol = "https://";
				}
				else 
				{
					$protocol = "http://";
				}
				  
				// Generate response
				return $response =  $protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).$fileRoute.$imageName;
					
				
	}
	
	public function submit_amazonsesurvey(Request $request)
	{
	
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offerid;
		$amazon_rebate = $request->amazon_rebate;
	
		foreach($request->answersamazonList as $amazon)
		{
		
			if(amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$amazon['questionId'])->exists())
			{
				if($amazon['fieldtype'] == "file")
				{
					if(!empty($amazon['answer']))
					{
						$answer = $this->uploadimages($amazon['answer']);
						
						amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$amazon['questionId'])->update([
						'answer'	=> $answer,
						]);
					}	
				}
				else
				{	
					amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$amazon['questionId'])->update([
						'answer'	=> $amazon['answer'],
					]);
				}
			}
			else
			{
				$answer = $amazon['answer'];
				if($amazon['fieldtype'] == "file")
				{
					if(!empty($amazon['answer']))
					{
						$answer = $this->uploadimages($amazon['answer']);
					}
				}
				$amazon_review_answers = new amazon_review_answers();
				$amazon_review_answers->offer_id		=  $offer_id;
				$amazon_review_answers->user_id 		=  $user_id;
				$amazon_review_answers->questionId 		=  $amazon['questionId'];
				$amazon_review_answers->form 			=  $amazon['fieldtype'];
				$amazon_review_answers->answer 			=  (!empty($answer) ? $answer : ""); 
				$amazon_review_answers->save(); 
			}
		}
		return response()->json(array('success' => 'success'));
	}
	
	
	public function submit_your_amazon_ss_file(Request $request)
	{
		
		 $user_id  =  $request->user()->id;
		 $offer_id =  $request->offerid;
         $amazon_rebate = $request->amazon_rebate;
	
		$fileRoute = "/public/amazon_ss_file/";
	
		// Allowed extentions.
		$allowedExts = array("pjpeg","jpg","jpeg","gif","png","PNG");

		// Get filename.
		$temp = explode(".", $_FILES["upload_file_amazon"]["name"]);

		// Get extension.
		$extension = end($temp);


		// An image check is being done in the editor but it is best to
		// check that again on the server side.

		switch ($_FILES["upload_file_amazon"]["type"]) {
			case 'image/pjpeg':
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/gif':
			case 'image/png':
			case 'image/PNG':
				if(in_array($extension, $allowedExts)){
					// Generate new random name.
					$name = $offer_id. "." . $extension;
					//$name = $_FILES["file"]["name"];
					// Save file in the uploads folder.
					move_uploaded_file($_FILES["upload_file_amazon"]["tmp_name"], getcwd() . $fileRoute . $name);
					
					
					$users_offer_6_amazon_upload_files = users_offer_6_amazon_upload_files::where('user_id',$user_id)->where('offer_id',$offer_id)->first();
					if (!$users_offer_6_amazon_upload_files)
					{
						$users_offer_6_amazon_upload_files = new users_offer_6_amazon_upload_files();
						$users_offer_6_amazon_upload_files->offer_id			=  $offer_id;
						$users_offer_6_amazon_upload_files->user_id 			=  $user_id;
						$users_offer_6_amazon_upload_files->file_path 	 	=  $fileRoute.$name;
						$users_offer_6_amazon_upload_files->status 	 		=  'pending';
						$users_offer_6_amazon_upload_files->save();
					}
					else
					{
							users_offer_6_amazon_upload_files::where('user_id',$user_id)->where('offer_id',$offer_id)->update([
								'file_path'  =>  $fileRoute.$name,
							]);
						
					}
					$get_product_id = offer_settings::where('id',$offer_id)->get();
					$check = user_rebate_transaction::where('user_id',$user_id)->where('campaign_id',$offer_id)->where('pay_method','answer_survey')->get();
					if(empty($check[0])){
        				$user_rebate_transaction = new user_rebate_transaction();
        				$user_rebate_transaction->user_id       =   $user_id;
        				$user_rebate_transaction->campaign_id   =   $offer_id;
        				$user_rebate_transaction->product_id    =   $get_product_id[0]->product_id;
        				$user_rebate_transaction->amount        =   $amazon_rebate;
        				$user_rebate_transaction->pay_method    =   'answer_survey';
        				$user_rebate_transaction->status        =   'unpaid';
        				$user_rebate_transaction->transaction_date  =   date('Y-m-d H:i:s');
        				$user_rebate_transaction->seller_id     =   $get_product_id[0]->created_by;
        				$user_rebate_transaction->save();
					}else{
					    $update = user_rebate_transaction::where('user_id',$user_id)->where('campaign_id',$offer_id)->where('pay_method','answer_survey')
					    ->update([
					        'user_id'   =>  $user_id,
					        'campaign_id'   =>  $offer_id,
					        'product_id'    =>  $get_product_id[0]->product_id,
					        'amount'        =>  $amazon_rebate,
					        'status'        =>  'unpaid',
					        'transaction_date'  =>  date('Y-m-d H:i:s'),
					        'seller_id'     =>  $get_product_id[0]->created_by
					        ]);
					}
					
					return response()->json(array('success' => 'success'));
				}
				break;
			default:
				echo '{"error":"could not match file type video"}';
				
		}
		
	}
	
	
	
	public function checkif_alreadysubmitedamazonsurvey_file(Request $request)
	{
		
		 $user_id = $request->user()->id;
		 $offer_id = $request->offer_id;
	
		if(users_offer_6_amazon_upload_files::where('user_id', $user_id)->where('offer_id', $offer_id)->exists())
		{	
			$submited_data = users_offer_6_amazon_upload_files::where('user_id', $user_id)->where('offer_id', $offer_id)->first();
			return response()->json(array('status' => 'already_submited','data'=>$submited_data));
			exit;
		}
		else
		{
			return response()->json(array('status' => 'notyet_submited','data'=>[]));
			exit;
		}
		
	}
	
	public function submit_survey_amazon_continue(Request $request)
	{
		
		
		$user_id  			  =  $request->user()->id;
		$offer_id			  =  $request->offer_id;
		$didyoupost_in_amazon =  $request->didyoupost_in_amazon;
		
		$user_submit_survey = new users_offer_6_amazon_upload_files();
		$user_submit_survey->didyoupost_in_amazon   =  $didyoupost_in_amazon;
		$user_submit_survey->user_id 				=  $user_id;
		$user_submit_survey->offer_id 	 			=  $offer_id;
		$user_submit_survey->save();
		
		echo $didyoupost_in_amazon;

	}
	
	
	public function check_survey_amazon_to_earn(Request $request)
	{
		 $user_id = $request->user()->id;
		 $offer_id = $request->offer_id;
		 
		 
		 if(user_submit_survey::where('user_id', $user_id)->where('offer_id', $offer_id)->exists())
		{	
			//return 'already_submited';
			$user_submit_survey = user_submit_survey::where('user_id', $user_id)->where('offer_id', $offer_id)->first();
			
			return response()->json(array('status' => 'already_submited','data'=>$user_submit_survey));
			exit;
		}
		else
		{
			return response()->json(array('status' => 'notyet_submited','data'=>[]));
			//return 'notyet_submited';
			exit;
		}
		
	}
	
	
	
	
	
	
	
	
	public function submit_survey_amazon_to_earn(Request $request)
	{
		
		
		$user_id  			  =  $request->user()->id;
		$offer_id			  =  $request->offer_id;
		$willyoupost_in_5days =  $request->willyoupost_in_5days;
		$didyoupost_in_amazon =  $request->didyoupost_in_amazon;
		$earn 				  =  ($didyoupost_in_amazon == 'yes' ?  $request->earn : ""  );
		

		if(user_submit_survey::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			user_submit_survey::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'willyoupost_in_5days'	=> $willyoupost_in_5days,
					'earned'				=> $request->earn2,
					
			]);
			
			
			// proceed to pay user if didyoupost value is yes
			if($willyoupost_in_5days == "yes")
			{
				$batch_id = $offer_id;
				$pay_method			=  "leave product review";
				$data = $this->UserPaymentVccController->proceedtoPayUser_submitproductreview($offer_id,$user_id,$batch_id,$pay_method);
				
				echo "paid";
				exit;
				
			}
			
			echo 'not paid';
			exit;
			
			
		}
		else
		{
			$user_submit_survey = new user_submit_survey();
			$user_submit_survey->didyoupost_in_amazon   =  $didyoupost_in_amazon;
			$user_submit_survey->user_id 				=  $user_id;
			$user_submit_survey->offer_id 	 			=  $offer_id;
			$user_submit_survey->earned 	 			=  (!empty($earn) ? $earn : "" );
			$user_submit_survey->save();
			
			// proceed to pay user if didyoupost value is yes
			if($didyoupost_in_amazon == "yes")
			{
				$batch_id = $offer_id;
				$pay_method			=  "leave product review";
				$data = $this->UserPaymentVccController->proceedtoPayUser_submitproductreview($offer_id,$user_id,$batch_id,$pay_method);
				
				echo "paid";
				exit;
				
			}
			
			echo 'not paid';
			exit;
		
		}
		
		
		
	}
	
	

}