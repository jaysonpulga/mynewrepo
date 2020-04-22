<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\frontend\User;
use Auth;
use Hash;
use Validator;




class UserThresholdController extends Controller
{
	public function index(Request $request)
	{
		$user_id    =  $request->user()->id;
		$vote_product = \DB::table('product_vote_settings')
		->select('*')
		->where('status','=',1)
		->get();
		$vote_array =[];
		$avail_product_count = 0;
		foreach(json_decode($vote_product) as $val){
		    ## check if user already voted to this product ##
		    @$check_product = \DB::table('product_vote_claims')
		    ->select('*')
		    ->where('buyer_id','=',$user_id)
		    ->where('vote_id','=',$val->id)
		    ->get();
		    ## get image path #
		    @$get_image_path = \DB::table('product_vote_images')
		    ->select('image_path')
		    ->where('setting_id','=',$val->id)
		    ->get();
		    ## check if this product has reached the total votes ##
		    @$check_total_votes = \DB::table('product_vote_claims')
		    ->select(\DB::raw('COUNT(vote_id) as count'))
		    ->where('vote_id','=',$val->id)
		    ->get();
		    ## Count voted to this product and substract to daily votes ##
		    $start_date_time = $val->start_date.' '.$val->start_time;
		    $total_votes = $val->total_votes / $val->daily_votes;
		    $exp_date = date('m-d-Y H:i:s',strtotime($start_date_time.' +'.round($total_votes).' day'));
		    ## if product is expired and haven't reach the maximum votes it will added another days ##
		    if($exp_date < date('m-d-Y H:i:s') && $check_total_votes[0]->count != $val->total_votes){
		        $additional_days = 0;
		        do{
		            $additional_days++;
    		        $exp_date = date('m-d-Y H:i:s',strtotime($start_date_time.' +'.$additional_days.' day'));
    		        if($exp_date > date('m-d-Y H:i:s')){
    		            break;
    		        }
		        }while($exp_date < date('m-d-Y H:i:s'));
		        
		    }
		    ## get the number of voted to this product today ##
		    $count_voted = \DB::table('product_vote_claims')
		    ->select(\DB::raw('COUNT(vote_id) as count'))
		    ->where('vote_id','=',$val->id)
		    ->whereDate('date_voted','=',date('Y-m-d'))
		    ->get();
		    $daily_votes = $val->daily_votes - $count_voted[0]->count;
		    
		    ###########################################################
		    if($exp_date > date('m-d-Y H:i:s') && @$check_product[0] == null && $daily_votes != 0 && $check_total_votes[0]->count != $val->total_votes){
		        $avail_product_count++;
		        $vote_array[] = ['id' => $val->id,
    		    'vote_image' => $get_image_path[0]->image_path,
    		    'points' => $val->points,
    		    'survey_question_1' => $val->survey_question_1,
    		    'survey_question_2' => $val->survey_question_2,
    		    'seller_id' => $val->seller_id,
    		    'daily_votes' => $daily_votes,
    		    'exp_date' => $exp_date];
		    }
		}
		$get_count = \DB::table('product_vote_claims')
		->select(\DB::raw('COUNT(id) as count'))
		->where('buyer_id','=',$user_id)
		->whereDate('date_voted','=',date('Y-m-d'))
		->get();
		if($request->data == 'vote_counts'){
		    echo $avail_product_count;
		}else{
		    return view('frontend.user_threshold_points',array('vote_products' => $vote_array,'vote_threshold' => $get_count[0]->count,'avail_counts' => $avail_product_count));	
		}
	}
	public function survey_form(Request $request,$id){
	    $user_id = $request->user()->id;
	    @$vote_validation = \DB::table('product_vote_claims')
	    ->select('*')
	    ->where('buyer_id','=',$user_id)
	    ->where('vote_id','=',$id)
	    ->get();
	    if(@$vote_validation[0] != null){
	        return redirect('user/daily_thresholds');
	    }
	    $get_preview = \DB::table('product_vote_settings as a')
	    ->leftjoin('product_vote_images as b','b.setting_id','=','a.id')
	    ->select('*','b.image_path','a.id as vote_id')
	    ->where('a.id','=',$id)
	    ->get();
	    $get_count = \DB::table('product_vote_claims')
		->select(\DB::raw('COUNT(id) as count'))
		->where('buyer_id','=',$user_id)
		->whereDate('date_voted','=',date('Y-m-d'))
		->get();
	    return view('frontend.user_survey',['preview' => $get_preview,'vote_threshold' => $get_count[0]->count]);
	}
	public function avail_votes(){
	}
	public function submit_vote(Request $request){
	    $vote_id = $request->vote_id;
	    $user_id = $request->user()->id;
	    $seller_id = $request->seller_id;
	    $points = $request->points;
	    $image_id = $request->image_id;
	    $image_path = $request->image_path;
	    $explain = $request->explain;
	    $insert = \DB::table('product_vote_claims')
	    ->insert([['vote_id' => $vote_id,
	    'seller_id' => $seller_id,
	    'buyer_id' => $user_id,
	    'image_id' => $image_id,
	    'image_path' => $image_path,
	    'survey_explain' => $explain,
	    'date_voted' => date('Y-m-d H:i:s')]]);
	    $insert_points = \DB::table('user_rebate_points')
	    ->insert([['transaction_id' => $vote_id,
	    'transaction_label' => 'Earned Points For Votes',
	    'transaction_table' => 'product_vote_claims',
	    'status' => 0,
	    'remarks' => 'Earned points for votes',
	    'buyer_id' => $user_id,
	    'seller_id' => $seller_id,
	    'points' => $points,
	    'remarks' => 'claimed',
	    'date_claimed' => date('Y-m-d H:i:s')]]);
	    
	    @$check_total_counts = \DB::table('product_vote_claims')
		    ->select(\DB::raw('COUNT(vote_id) as count'))
		    ->where('vote_id','=',$vote_id)
		    ->get();
		 @$get_total_votes = \DB::table('product_vote_settings')
		 ->select('total_votes')
		 ->where('id','=',$vote_id)
		 ->get();
	    if($insert){
	        $total_counts = @$get_total_votes[0]->total_votes - @$check_total_counts[0]->count;
		    if($total_counts <= 0){
		        \DB::table('product_vote_settings')
		        ->where('id','=',$vote_id)
		        ->update(['status' => 2]);
		    }
	        echo 'success';
	    }
	}
}
