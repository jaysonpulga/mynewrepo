<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\frontend\User;
use Carbon\Carbon;
use App\Model\offer_addtocart_settings;
use App\Model\offer_addtocart_claim_gigs;
use App\Model\offer_addtocart_check_asins;
use App\Model\offer_addtocart_screenshots;
use App\Model\user_rebate_points;
class GigController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
		$get_gig = offer_addtocart_settings::where('offer_addtocart_settings.status',1)
		->whereNotExists(function ($query) use ($user_id)
		{
			$query->select(\DB::raw(1))
                      ->from('offer_addtocart_claim_gigs')
                      ->whereRaw('offer_addtocart_settings.id = offer_addtocart_claim_gigs.offer_id')
                      ->where('offer_addtocart_claim_gigs.step1','=',1)
                      ->where('offer_addtocart_claim_gigs.step3','=',1)
                      ->where('offer_addtocart_claim_gigs.user_id','=',$user_id)
                      ->orWhere('offer_addtocart_claim_gigs.display_campaign',1);
		})->get();
		$gig_array =[];
		$avail_product_count = 0;
		foreach($get_gig as $value){
		    $continue = offer_addtocart_claim_gigs::where('user_id',$user_id)->where('offer_id',$value->id)->where('display_campaign',0)->get();
		    $start_date_time = $value->start_date.' '.$value->start_time;
		    $exp_date = date('m-d-Y H:i:s',strtotime($start_date_time.' +'.$value->offer_duration.' day'));
		    if($exp_date > date('m-d-Y H:i:s')){
		        $available_count = $this->available_today($value->offer_daily_order,$value->id);
		        if(@$value->image_path == ""){
		            $img = 'default_product.jpg';
		        }else{
		            $img = $value->image_path;
		        }
		        $avail_product_count++;
		        $gig_array[] = ['id' => $value->id,
    		    'vote_image' => $img,
    		    'points' => $value->earn_points,
    		    'seller_id' => $value->created_by,
    		    'available_today' => $available_count,
    		    'product_price' => $value->product_price,
    		    'exp_date' => $exp_date,
    		    'continue' => @$continue[0]];
		    }
		}
		$get_count = offer_addtocart_claim_gigs::select(\DB::raw('COUNT(id) as count'))
		->where('user_id','=',$user_id)
		->where(\DB::raw("DATE(date_claimed) = '".date('m/d/Y')."'"))
		->get();
        return view('frontend.gig.gig_home',array('vote_products' => $gig_array,'vote_threshold' => $get_count[0]->count,'avail_counts' => $avail_product_count));
    }
    public function avail_gig_count(Request $request){
        $user_id = $request->user()->id;
        $get_gig = offer_addtocart_settings::where('status',1)
        ->whereNotExists(function ($query) use ($user_id)
		{
			$query->select(\DB::raw(1))
                      ->from('offer_addtocart_claim_gigs')
                      ->whereRaw('offer_addtocart_settings.id = offer_addtocart_claim_gigs.offer_id')
                      ->where('offer_addtocart_claim_gigs.step1','=',1)
                      ->where('offer_addtocart_claim_gigs.step3','=',1)
                      ->where('offer_addtocart_claim_gigs.user_id','=',$user_id)
                      ->orWhere('offer_addtocart_claim_gigs.display_campaign',1);
		})->get();
        $count = 0;
        foreach(json_decode($get_gig) as $val){
            $start_date_time = $val->start_date.' '.$val->start_time;
            $exp_date = date('m-d-Y H:i:s',strtotime($start_date_time.' +'.$val->offer_duration.' day'));
            $used_count = offer_addtocart_claim_gigs::select('*')->where('user_id',$user_id)->where('offer_id',$val->id)->where('step3','=',1)->where('step1','=',1)->get();
            if($exp_date > date('m-d-Y H:i:s') && @$used_count[0] == null){
                $count++;
            }
        }
		return array('count' => $count);
    }
    public function update_to_expired(Request $request){
        $offer_id = $request->offer_id;
        $user_id = $request->user()->id;
        $update = offer_addtocart_claim_gigs::where('user_id',$user_id)->where('offer_id',$offer_id)
        ->update(['status' => 'expired']);
        if($update){
            return 'expired now';
        }
    }
    public function update_to_reject(Request $request){
        $offer_id = $request->offer_id;
        $user_id = $request->user()->id;
        $update = offer_addtocart_claim_gigs::where('user_id',$user_id)->where('offer_id',$offer_id)
        ->update(['display_campaign' => 1]);
        if($update){
            return 'expired now';
        }
    }
    public function cancel_gig(Request $request){
        $offer_id = $request->offer_id;
        $user_id = $request->user()->id;
        $cancel = offer_addtocart_claim_gigs::where('offer_id',$offer_id)->where('user_id',$user_id)
        ->update(['status' => 'cancelled']);
        if($cancel== true){
            return array('success' => true);
        }else{
            return array('success' => false);
        }
    }
    public function campaign_gig_productdetails(Request $request,$id='')
	{
		$images =  array();
		$user_id =  $request->user()->id;
	    $offerdetails = offer_addtocart_settings::where('id',$id)->where('status',1)->get();
		$offer_last_date =unserialize($offerdetails[0]->offer_daily_order);
	    $lastElement = end($offer_last_date);
	    $lastElement = $lastElement['date'];
	    $datex =  (explode("-",$lastElement));
	    $datexxx = $datex[0].'/'.$datex[1].'/'.$datex[2];
		return view('frontend.productdetails_gig',array('images'=>$offerdetails[0]->image_path,'offerdetails'=>$offerdetails,'last_date_offer'=>$datexxx));	
	}
	public function addtocart_getconfirm(Request $request){
	    $user_id = $request->user()->id;
	    $offer_id = $request->offer_id;
	    $schedDate = date('m/d/Y');
	    $schedtime = '00:00:00';
	    $validation = offer_addtocart_claim_gigs::where('offer_id',$offer_id)->where('user_id',$user_id)->get();
	    if(!empty($validation[0])){
	        return array('success' => false);
	    }
	    //insert data offer_addtocart_claim_gigs
	    $offer_addtocart_claim_gigs = new offer_addtocart_claim_gigs();
	    $offer_addtocart_claim_gigs->user_id    =   $user_id;
	    $offer_addtocart_claim_gigs->offer_id   =   $offer_id;
	    $offer_addtocart_claim_gigs->date_claimed   =   date('m/d/Y H:i:s');
	    $offer_addtocart_claim_gigs->step1      =   0;
	    $offer_addtocart_claim_gigs->step3      =   0;
	    $offer_addtocart_claim_gigs->remarks    =   'claimed';
	    $offer_addtocart_claim_gigs->status     =   'active';
	    $offer_addtocart_claim_gigs->save();
		return array('success' => true);
	}
	public function campaign_offerdetails(Request $request,$id="")
	{
		$offer_id = $id;
		$user_id =  $request->user()->id;
		$offerdetails = offer_addtocart_settings::where('id',$offer_id)->get();
	    $steps_done = offer_addtocart_claim_gigs::where('offer_id',$offer_id)->where('user_id',$user_id)->get();
	    $primary = \DB::table('offer_gig_key_primaries')->where('offer_id',$id)->get();
	    if($steps_done[0]->status == 'cancelled'){
	        return redirect('user/gig');
	    }
	    $array = [];
	    foreach($primary as $val){
	        $array[] =$val->p_keyword;
	    }
	    $random = array_rand($array,1);
	    return view('frontend.addtocart_productdetails',array('primary' => $array[$random],'offer_id' => $id,'images'=>$offerdetails[0]->image_path,'steps_done' => $steps_done,'offerdetails' => $offerdetails));
	}
	public function upload_screenshot_addtocart(Request $request){
        $user_id = $request->user()->id;
	    $img = $request->file;
	    $offer_id = $request->offer_id;
	    $new_name = $this->generateRandomString(10) . '.' . $img->getClientOriginalExtension();
    	$img->move(public_path('screenshot'), $new_name);
    	$imagepath = $new_name;
    	$offer_addtocart_screenshots = new offer_addtocart_screenshots();
    	$offer_addtocart_screenshots->offer_id =   $offer_id;
    	$offer_addtocart_screenshots->user_id  =   $user_id;
    	$offer_addtocart_screenshots->image_path   =   $imagepath;
    	$offer_addtocart_screenshots->save();
    	if($offer_addtocart_screenshots){
            $update_steps = offer_addtocart_claim_gigs::where('user_id',$user_id)->where('offer_id',$offer_id)
            ->update(['step3' => 1,'status' => 'done']);
    	    $offer_settings = offer_addtocart_settings::where('id',$offer_id)->first(); 
    	    $get_id = offer_addtocart_claim_gigs::select('id')->where('offer_id',$offer_id)->where('user_id',$user_id)->get();
    	    $check = user_rebate_points::where('buyer_id',$user_id)->where('offer_id',$offer_id)->get();
    	    if(!empty($check[0])){
    	        $update = user_rebate_points::where('buyer_id',$user_id)->where('transaction_id',$get_id[0]->id)
    	        ->update(['buyer_id' => $user_id,
    	        'seller_id' => $offer_settings->created_by,
    	        'transaction_label' => 'Earned Points For Gig',
    	        'transaction_table' => 'offer_addtocart_claim_gigs',
    	        'transaction_id' => $get_id[0]->id,
    	        'offer_id' => $offer_id,
    	        'points' => $offer_settings->earn_points,
    	        'remarks' => 'claimed',
    	        'status' => 0,
    	        'date_claimed' => date('Y-m-d H:i:s')]);
    	        return array('success' => true,'points' => $offer_settings->earn_points);
    	    }
    	    $grant_points = new user_rebate_points();
    	    $grant_points->buyer_id =   $user_id;
    	    $grant_points->seller_id    =   $offer_settings->created_by;
    	    $grant_points->transaction_label    =   'Earned Points For Gig';
    	    $grant_points->transaction_table    =   'offer_addtocart_claim_gigs';
    	    $grant_points->transaction_id   =   $get_id[0]->id;
    	    $grant_points->points   =   $offer_settings->earn_points;
    	    $grant_points->offer_id =   $offer_id;
    	    $grant_points->remarks  =   'claimed';
    	    $grant_points->status   =   0;
    	    $grant_points->date_claimed =   date('Y-m-d H:i:s');
            $grant_points->save();
		    return array('success' => true,'points' => $offer_settings->earn_points);
		}else{
		    return array('success' => false);
		}
    }
	public function addtocart_check_asin(Request $request){
        $user_id = $request->user()->id;
        $offer_id = $request->offer_id;
        $ASIN = $request->asin;
        $check_asin = offer_addtocart_settings::where('id','=',$offer_id)->where('product_id','=',$ASIN)->get();
        if(!empty($check_asin[0])){
            $update = offer_addtocart_claim_gigs::where('offer_id',$offer_id)->where('user_id',$user_id)
            ->update(['step1' => 1]);
            if($update){
                return array('success' => true);
            }
        }else{
            return array('success' => false);
        }
    }
    public function available_today($offer_daily_order,$offer_id){
            $datetoday = Carbon::now()->format('m/d/Y');
			$ddyesterday = Carbon::yesterday()->format('m/d/Y');
			$timenow = Carbon::now()->format('H:i:s');
			$date_unserialize = unserialize($offer_daily_order);
			foreach($date_unserialize as $key => $row) 
			{
				$availabledate = trim($row['date']);
				$availabledate = explode('-',$availabledate);
				$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
				$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
				if(strtotime($datetoday) == strtotime($availabledate))
				{
						$datax['date']		 = 	$row['date'];	
						$datax['nameofday']	 = 	$row['nameofday'];	
						$datax['value'] 	 = 	$row['value'];	
				}
			}
			$events = array();
			$result = array();
			$sched_array = array();
			if(!empty($offer_daily_order))
			{
				$datax = array();
						$availadate = array();
						@$date_unserialize = unserialize($offer_daily_order);
						$lastElement = end($date_unserialize);
						$lastElement = $lastElement['date'];
						@$datex =  (explode("-",$lastElement));
						$datexxx = $datex[0].'/'.$datex[1].'/'.$datex[2];
					if(strtotime($datetoday) <= strtotime($datexxx))
					{
						$datax['offer_date_today']  =  $datetoday;
						$datax['offer__date_last']  =  $datexxx;
						
						if(strtotime($datetoday) > strtotime($datexxx))
						{
							$datax['offer_result']  =  'lapsed';
						}
						else
						{
							$datax['offer_result']  =  'continue';
						}
						$getCountsched = \DB::table('offer_addtocart_claim_gigs')
							->select(\DB::raw('*'))
							->where('offer_id', $offer_id)
				 			->where(\DB::raw("DATE(date_claimed) = '".$datetoday."'"))
							->get();
						$datax['offer_count_shed_campaign']  =   count($getCountsched);
						$datax['offer_available_spot'] = "SOLD OUT";
						foreach($date_unserialize as $key => $rows) 
						{
							$availabledate = trim($rows['date']);
							$availabledate = explode('-',$availabledate);
							$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
							$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
							if(strtotime($datetoday) == strtotime($availabledate))
							{
									$availadate['z_date']		 = 	$rows['date'];	
									$availadate['z_nameofday']	 = 	$rows['nameofday'];	
									$availadate['z_value'] 	 	= 	$rows['value'];
									$datax['offer_available_spot']  =  $availadate['z_value'] -  count($getCountsched);
							}
							$datax['available_value']  =  $availadate;
						}
					}
			}
			return $datax['offer_available_spot'];
			
    }
    function generateRandomString($length = 10) 
    {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
?>