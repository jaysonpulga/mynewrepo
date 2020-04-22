<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Model\amazon_review_answers;
use App\Model\purchare_review_answers;
use App\Model\offer_settings;

use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\frontend\users_offer_3_continue_accepts;
use App\Model\frontend\users_offer_4_submit_tracking_numbers;
use App\Model\frontend\users_offer_5_completeds;



class OfferAcceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
	
	
	
	public function continue_accept_offer(Request $request)
    {
		$user_id =  $request->user()->id;
		$offer_id = $request->offer_id;
		$sched_id = $request->sched_id;
		
		$data = offer_settings::select('*')->where('id',$offer_id)->first();
	   
	   	$users_offer_3_continue_accepts = new users_offer_3_continue_accepts();
		$users_offer_3_continue_accepts->offer_id  				= $offer_id;
		$users_offer_3_continue_accepts->confirm_id  				= $sched_id;
		$users_offer_3_continue_accepts->user_id  				= $user_id;
		$users_offer_3_continue_accepts->product_id 				= $data->product_id;
		$users_offer_3_continue_accepts->cancel_offer 			= 0;
		$users_offer_3_continue_accepts->cancel_date  			= '';
		$users_offer_3_continue_accepts->save();
		
		
		users_offer_2_get_schedules::where('offer_id',$offer_id)->where('user_id', $user_id)->where('id', $sched_id)->update([
			'confirm_status'	=>  1,
		]);
		
		
		
		echo 'success';
	   
    }
	
	
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Model\users_offer_3_continue_accepts  $users_offer_3_continue_accepts
     * @return \Illuminate\Http\Response
     */
    public function show(users_offer_3_continue_accepts $users_offer_3_continue_accepts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\users_offer_3_continue_accepts  $users_offer_3_continue_accepts
     * @return \Illuminate\Http\Response
     */
    public function edit(users_offer_3_continue_accepts $users_offer_3_continue_accepts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\users_offer_3_continue_accepts  $users_offer_3_continue_accepts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, users_offer_3_continue_accepts $users_offer_3_continue_accepts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\users_offer_3_continue_accepts  $users_offer_3_continue_accepts
     * @return \Illuminate\Http\Response
     */
    public function destroy(users_offer_3_continue_accepts $users_offer_3_continue_accepts)
    {
        //
    }
	
	
	
	public function getfirststep(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		$data = offer_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	public function getsecondstep(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		$data = purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	
	public function admin_getsecondstep(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->customer_id;
		$data = purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	public function admin_getthirdstep(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->customer_id;
		$data = amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	public function getthirdstep(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		$data = amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	public function checkifcomplete(Request $request)
	{
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		$data = users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
		return response()->json($data);
	}
	
	
	public function submit_truckingnumber(Request $request)
	{
		
		$tracknumber =  $request->trucking_number;
		$shipment_company =  $request->shipment_company;
		$offer_id =  $request->offer_id;
		$user_id =  $request->user()->id;
		
	
		//if exist tracking_number
		if(offer_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			offer_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'tracking_number' =>  $tracknumber,
				'shipment_company' =>  $shipment_company
			]);
			
		}
		else
		{
			$savetruckingnumber = new offer_tracking_numbers();
			$savetruckingnumber->offer_id 		  =  $offer_id;
			$savetruckingnumber->user_id  		  =  $user_id;
			$savetruckingnumber->shipment_company =  $shipment_company;
			$savetruckingnumber->tracking_number  =  $tracknumber;
			$savetruckingnumber->status  		  =  0;
			$savetruckingnumber->completed  	  =  0;
			$savetruckingnumber->remarks  		  =  '';
			$savetruckingnumber->save(); 
		}
		
		
		// save in users_offer_5_completeds
		if(users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'status'	=>  'processing',
			]);
		}
		else
		{
			$users_offer_5_completeds = new users_offer_5_completeds();
			$users_offer_5_completeds->offer_id		=  $offer_id;
			$users_offer_5_completeds->user_id 		=  $user_id;
			$users_offer_5_completeds->status 		=  'processing';
			$users_offer_5_completeds->admin_approved =   0;
			$users_offer_5_completeds->save();
		}
	
	
		return response()->json(array('success' => 'success'));
		
	}
	

	public function submit_purchasesurvey(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offerid;
		
		foreach($request->answersproductList as $product)
		{
		
			if(purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$product['questionId'])->exists())
			{
				purchare_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$product['questionId'])->update([
					'answer'	=> $product['answer'],
				]);
			}
			else
			{
			
				$purchare_review_answers = new purchare_review_answers();
				$purchare_review_answers->offer_id		=  $offer_id;
				$purchare_review_answers->user_id 		=  $user_id;
				$purchare_review_answers->questionId 	=  $product['questionId'];
				$purchare_review_answers->form 			=  $product['fieldtype'];
				$purchare_review_answers->answer 		=  $product['answer'];
				$purchare_review_answers->save(); 
			}
		}
	

		
		return response()->json(array('success' => 'success'));
		
	}
	
	
	public function checkif_purchasesurveyisTrue(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offerid;
	
		
		//if exist account
		if(purchare_review_answers::where('user_id', $user_id)->where('offer_id', $offer_id)->exists())
		{	
			echo 'existingdata';
		}
		else
		{
			echo 'nodata';
		}
	
	
	}
	
	public function checkifallreadycompleted(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offerid;
	
		
		//if exist account
		if(users_offer_5_completeds::where('user_id', $user_id)->where('offer_id', $offer_id)->exists())
		{	
			$data = users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->get();

			return $data[0]->status;
			exit;
		}
		
		echo 'nodata';
		
		exit;
	
	
	}
	
	
	
	
	

	public function submit_amazonsesurvey(Request $request)
	{
		
		 $user_id  =  $request->user()->id;
		 $offer_id =  $request->offerid;
		
		
		
	
		foreach($request->answersamazonList as $amazon)
		{
		
			if(amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$amazon['questionId'])->exists())
			{
				amazon_review_answers::where('offer_id',$offer_id)->where('user_id', $user_id)->where('questionId',$amazon['questionId'])->update([
					'answer'	=> $amazon['answer'],
				]);
			}
			else
			{
			
				$amazon_review_answers = new amazon_review_answers();
				$amazon_review_answers->offer_id		=  $offer_id;
				$amazon_review_answers->user_id 		=  $user_id;
				$amazon_review_answers->questionId 		=  $amazon['questionId'];
				$amazon_review_answers->form 			=  $amazon['fieldtype'];
				$amazon_review_answers->answer 			=  $amazon['answer'];
				$amazon_review_answers->save(); 
			}
		}
		
		if(users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'status'	=>  'completed',
			]);
		}
	

		
		return response()->json(array('success' => 'success'));
		
	}
	
	public function checkif_amazonsurveyisTrue(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offerid;
	
		
		//if exist account
		if(amazon_review_answers::where('user_id', $user_id)->where('offer_id', $offer_id)->exists())
		{	
			echo 'existingdata';
		}
		else
		{
			echo 'nodata';
		}
		
		
	}
	
	
	
	
	
	public function accept_offer(Request $request)
	{
		
		$user_id  =  $request->customer_id;
		$offer_id =  $request->offer_id;
		
	
		
		if(users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
				'admin_approved'	=>  '1',
			]);
		}
	
		return response()->json(array('success' => 'success'));
		
	}
	
	function random_date_in_range( $date1, $date2 )
	{
		  // Convert to timetamps
			$min = strtotime($date1);
			$max = strtotime($date2);

			// Generate random number using above bounds
			$val = rand($min, $max);

			// Convert back to desired date format
			return date('Y-m-d H:i:s', $val);
	}
	
	
	
	
	
	
	
	public function GetStatusDateAvailable(Request $request)
	{
		
		$user_id  =  $request->user()->id;
		$offer_id =  $request->offer_id;
		
		if(offer_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
		{
			//upate completed table
			if(users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->exists())
			{
				users_offer_5_completeds::where('offer_id',$offer_id)->where('user_id', $user_id)->update([
					'status'	=>  'review',
				]);
			}
			else
			{
				$users_offer_5_completeds = new users_offer_5_completeds();
				$users_offer_5_completeds->offer_id		=  $offer_id;
				$users_offer_5_completeds->user_id 		=  $user_id;
				$users_offer_5_completeds->status 		=  'review';
				$users_offer_5_completeds->admin_approved =   0;
				$users_offer_5_completeds->save();
			}	
			
			
			
			$data = offer_tracking_numbers::where('offer_id',$offer_id)->where('user_id', $user_id)->get(); 
			return response()->json($data);
			exit;
		}
		
		return response()->json([]);
		
	}
	
	
	
	
}
