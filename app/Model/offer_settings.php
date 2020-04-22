<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class offer_settings extends Model
{
    //
	
	
	public static function getallData()
	{
		
		$getallData = self::orderBy('id', 'asc')->orderBy('id')->get();
		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$row['id'] = $person->id;
				$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				$row['product_name'] = $person->product_name;
				$row['product_brand'] = $person->product_brand;
				$row['shipping_carrier'] = $person->shipping_carrier;
				
				$row['action'] = "<a class='btn btn-raised btn-primary button_width' onclick=\"editoffer('".$person->id."');\" href='#'  title='modify data'><i class='fa fa-fw fa-pencil-square-o'></i> Edit</a>&nbsp;";
				
			
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
	
	public static function getDataOffer($id,$customer_id)
	{
		/* $getallData = self::where('id',$id)->get();
		return $getallData; */
		
		$select ="t1.*,t2.tracking_number,t2.user_id";
		
		$data = \DB::table('offer_settings as t1')
		->select(\DB::raw($select))
				->join('users_offer_4_submit_tracking_numbers as t2','t2.offer_id','=','t1.id')
				->where('t1.id',$id)
				->get();
				
		return 	$data;
		
	}
	
	public static function amazongetDataOffer($id)
	{
		
		
		$data = \DB::table('amazon_review_questions')
				->where('offer_id',$id)
				->get();
				
		return 	$data;	
	}
	
	public static function purchase_reviewDataOffer($id)
	{
		$data = \DB::table('purchare_review_questions')
				->where('offer_id',$id)
				->get();
				
		return 	$data;	
	}
	
	
	
	public static function getAvailableScheduled_Offer($id)
	{
		$select ="t1.*,(SELECT status FROM users_offer_5_completeds WHERE offer_id = t1.id  AND user_id = ".$id." ) as status";
		
		$res = \DB::table('offer_settings as t1')
		->select(\DB::raw($select))
		->join('offer_accepts as t2','t2.offer_id','=','t1.id')
		->where('t2.user_id', '=', $id)
		->where('t2.cancel_offer', '!=', 1)
		->whereNotExists( function ($query) use ($id) 
			{
				$query->select(\DB::raw(1))
				
				->from('users_offer_5_completeds')
				->whereRaw('t1.id = users_offer_5_completeds.offer_id')
				->where('users_offer_5_completeds.admin_approved', '=', '1')
				->where('users_offer_5_completeds.user_id', '=', $id);

			}
		)
		->get();
		
		return 	$res;
	}
	
	
	public static function getAvailableOffer($id)
	{
		
		$select = "*,(SELECT offer_id  FROM users_offer_2_get_schedules  WHERE offer_id = offer_settings.id) as offerdetails_id";
		
			 $sqlData = \DB::table('offer_settings')
				//->select('*,$host_review')
				->select(\DB::raw($select))
			
				->whereNotExists( function ($query) use ($id) 
					{
						$query->select(\DB::raw(1))
						
						->from('users_offer_3_continue_accepts')
						->whereRaw('offer_settings.id = users_offer_3_continue_accepts.offer_id')
						->where('users_offer_3_continue_accepts.user_id', '=', $id)
						->where('users_offer_3_continue_accepts.cancel_offer', '!=', 1);

					}
		
				)
				->whereNotExists( function ($query) use ($id) 
					{
						$query->select(\DB::raw(1))
						
						->from('user_offer_denies')
						->whereRaw('offer_settings.id = user_offer_denies.offer_id')
						->where('user_offer_denies.user_id', '=', $id);

					}
		
				)
				 ->whereNotExists( function ($query) use ($id) 
					{
						$query->select(\DB::raw(1))
						
						->from('users_offer_5_completeds')
						->whereRaw("offer_settings.id = users_offer_5_completeds.offer_id")
						->where('users_offer_5_completeds.user_id', '=' ,$id);
						

					}
		
				)
				->get(); 
			return 	$sqlData;			
	}
	
	
	
	
	public static function getallCompletedData($id)
	{
		
		//$getallData = self::orderBy('id', 'asc')->orderBy('id')->get();
		
		$data = array();
		
		
		$getallData = \DB::table('offer_settings as t1')
		->select('t1.*')
		->join('users_offer_5_completeds as t2','t2.offer_id','=','t1.id')
		->where('t2.user_id', '=', $id)
		//->where('t2.admin_approved', '=', '1')
		->get();
		
		
		
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				
				$route = asset('viewofferdetails/'.$person->id);
				
				$row = array();
				$row['id'] = $person->id;
				$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				$row['product_name'] = $person->product_name;
				$row['product_brand'] = $person->product_brand;
				$row['shipping_carrier'] = $person->shipping_carrier;
				
				//$row['action'] = "<a class='btn btn-raised btn-primary button_width'  href='$route'  title='view details'><i class='fa fa-fw fa-list-alt'></i> View Details</a>&nbsp;";
				
				$row['action'] = "";
				
			
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
	
	
	public static function getallDatainsight($menudata)
	{
		$currentdate = Carbon::now();
		$currentdate = Carbon::parse($currentdate)->toDateString();
			
		$price = "price.product_price as new_product_price";
		$price .= ",price.product_discount_label as new_product_discount_label";
		$price .= ",price.product_discount as new_product_discount";
		
		$select ="offer_settings.*,t2.offer_status,$price";
		
		
		$select .= ",(SELECT count(id)  FROM users_offer_1_sent_campaigns     		WHERE offer_id = offer_settings.id ) as invites";
		$select .= ",(SELECT count(id)  FROM users_offer_2_get_schedules     	 	WHERE offer_id = offer_settings.id ) as getschedule";
		$select .= ",(SELECT count(id)  FROM users_offer_3_continue_accepts  		WHERE offer_id = offer_settings.id ) as accept";
		$select .= ",(SELECT count(id)  FROM users_offer_4_submit_tracking_numbers  WHERE offer_id = offer_settings.id and remarks = 'Delivered' ) as purchased";
		$select .= ",(SELECT count(id)  FROM users_offer_5_completeds  				WHERE offer_id = offer_settings.id and status = 'completed' ) as completed";
		
		$getallData = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_status as t2','t2.id','=','offer_settings.status')
		->leftJoin('offer_setting_prices as price', function($join) 
		{
			$join->on('offer_settings.id', '=', 'price.offer_id');
			$join->on('price.product_id', '=', 'offer_settings.product_id');
			$join->on('price.status','=',\DB::raw("'active'"));
		})
		->where(function ($getallData) use ($menudata) {
			if($menudata != ""){
			 return $getallData->where('offer_settings.status','=', $menudata);
			}
		})
		->where('campaign_type','insight campaign')
		->orderBy('offer_settings.id', 'DESC')
		
		->get();

		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$html = '';
				$price_discount	 = '';
				$sign = '';
				
				$datetime = $person->created_at;
				$startdatetime  = Carbon::parse($datetime)->toDateString();
				
		
				if($currentdate == $startdatetime)
				{	
					$html .= "<span style='color:blue'>*Latest Campaign </span><br>";
				} 
			
				$html .= $person->invites." - invites  <br>";
				$html .= $person->getschedule." - get schedule <br>";
				$html .= $person->accept." - accept offer <br>";
				$html .= $person->purchased." - purchased product <br>";
				$html .= $person->completed." - completd offer <br>"; 
				
				
				$price_discount	.= "$$person->new_product_price <br>";
				
				if(!empty($person->new_product_discount))
				{
					
					if($person->new_product_discount_label == "Percentage")
					{ 	
						$discount = str_replace('.00', '', $person->new_product_discount);
						 $sign = $discount."% off";
					}
					else if($person->new_product_discount_label == "Dollar")
					{
						 $sign = "$".$person->new_product_discount;
					}
					
					$price_discount	.= "<span style='color:red'>*Discount: </span>".$sign;
									
				} 
			
				switch($person->offer_status){
				case 'pending':
					$status = '<span class="label label-warning">Pending</span>';
				break;
				case 'active':
					$status = '<span class="label label-success">Active</span>';
				break;
				case 'inactive':
					$status = '<span class="label label-primary">Inactive</span>';
				break;
				case 'expired':
					$status = '<span class="label label-danger">Expired</span>';
				break;
				case 'completed':
					$status = '<span class="label label-success">Completed</span>';
				break;
				case 'drafts':
					$status = '<span class="label label-warning">Save as Draft</span>';
				break;
				}
				
				
				$row['id'] = $person->id;
						
				if($person->copy_id == 0){
					$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				else
				{
					$title = self::select('Title')->where('id',$person->copy_id)->first();
					
					$row['Title'] = "<span style='font-size:10px;color:blue'>Copy from ".$title->Title."</span><br>".$person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				
				$row['product_name'] = $person->product_name;
				$row['price_discount'] = $price_discount;
				
				
				$row['remarks'] = $html;
				$row['status'] = $status;
				
				
				$route = asset('admin/update/campaign/insight/'.$person->id);
				$sendlist = asset('admin/sendlist/campaign/insight/'.$person->id);
				$viewdetails = asset('admin/viewdetails/campaign/insight/'.$person->id);
				$clone = asset('admin/clone/campaign/insight/'.$person->id);
				$routedraft = asset('admin/draft/campaign/insight/'.$person->id);
				
			
				$row['action'] =  '<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
									  <span class="caret"></span></button>
									  <ul class="dropdown-menu">';
									  
									  if($person->offer_status != "drafts")
									  {
				$row['action'] .=		'<li><a href="'.$route.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>
										<li style="display:none"><a href="'.$viewdetails.'"><i class="fa fa-fw fa-list-alt"></i>View Details</a></li>
										<li class="divider"></li>
										<li><a href="'.$sendlist.'"><i class="fa fa-fw fa-mail-forward"></i>Send Offer</a></li>
										<li><a href="'.$clone.'"><i class="fa fa-fw fa-copy"></i>Copy this Campaign</a></li>';
										
									  }
									  else
									  {
									    
				$row['action'] .=		'<li><a href="'.$routedraft.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>';
									  }
									  
									  
										
										
			    $row['action'] .=	'</ul>
									</div>';
									
									
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
	
	
	
	
	public static function getallDatafullbuy($menudata)
	{
		
		
		$currentdate = Carbon::now();
		$currentdate = Carbon::parse($currentdate)->toDateString();
		
	
		
		$price = "price.product_price as new_product_price";
		$price .= ",price.product_discount_label as new_product_discount_label";
		$price .= ",price.product_discount as new_product_discount";
		
		$select ="offer_settings.*,t2.offer_status,$price";
		
		
		$select .= ",(SELECT count(id)  FROM users_offer_1_sent_campaigns     		WHERE offer_id = offer_settings.id ) as invites";
		$select .= ",(SELECT count(id)  FROM users_offer_2_get_schedules     	 	WHERE offer_id = offer_settings.id ) as getschedule";
		$select .= ",(SELECT count(id)  FROM users_offer_3_continue_accepts  		WHERE offer_id = offer_settings.id ) as accept";
		$select .= ",(SELECT count(id)  FROM users_offer_4_submit_tracking_numbers  WHERE offer_id = offer_settings.id and remarks = 'Delivered' ) as purchased";
		$select .= ",(SELECT count(id)  FROM users_offer_5_completeds  				WHERE offer_id = offer_settings.id and status = 'completed' ) as completed";
		
		$getallData = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_status as t2','t2.id','=','offer_settings.status')
		->leftJoin('offer_setting_prices as price', function($join) 
		{
			$join->on('offer_settings.id', '=', 'price.offer_id');
			$join->on('price.product_id', '=', 'offer_settings.product_id');
			$join->on('price.status','=',\DB::raw("'active'"));
		})
		->where(function ($getallData) use ($menudata) {
			if($menudata != ""){
			 return $getallData->where('offer_settings.status','=', $menudata);
			}
		})
		->where('campaign_type','fullbuy campaign')
		->orderBy('offer_settings.id', 'DESC')
		->get();

		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$html = '';
				$price_discount	 = '';
				$sign = '';
				
				$datetime = $person->created_at;
				$startdatetime  = Carbon::parse($datetime)->toDateString();
				
		
				if($currentdate == $startdatetime)
				{	
					$html .= "<span style='color:blue'>*Latest Campaign </span><br>";
				} 
			
				$html .= $person->invites." - invites  <br>";
				$html .= $person->getschedule." - get schedule <br>";
				$html .= $person->accept." - accept offer <br>";
				$html .= $person->purchased." - purchased product <br>";
				$html .= $person->completed." - completd offer <br>"; 
				
				
				$price_discount	.= "$$person->new_product_price <br>";
				
				if(!empty($person->new_product_discount))
				{
					
					if($person->new_product_discount_label == "Percentage")
					{ 	
						$discount = str_replace('.00', '', $person->new_product_discount);
						 $sign = $discount."% off";
					}
					else if($person->new_product_discount_label == "Dollar")
					{
						 $sign = "$".$person->new_product_discount;
					}
					
					$price_discount	.= "<span style='color:red'>*Discount: </span>".$sign;
									
				} 
			
				switch($person->offer_status){
				case 'pending':
					$status = '<span class="label label-warning">Pending</span>';
				break;
				case 'active':
					$status = '<span class="label label-success">Active</span>';
				break;
				case 'inactive':
					$status = '<span class="label label-primary">Inactive</span>';
				break;
				case 'expired':
					$status = '<span class="label label-danger">Expired</span>';
				break;
				case 'completed':
					$status = '<span class="label label-success">Completed</span>';
				break;
				case 'drafts':
					$status = '<span class="label label-warning">Save as Draft</span>';
				break;
				}
				
				
				$row['id'] = $person->id;
						
				if($person->copy_id == 0){
					$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				else
				{
					$title = self::select('Title')->where('id',$person->copy_id)->first();
					
					$row['Title'] = "<span style='font-size:10px;color:blue'>Copy from ".$title->Title."</span><br>".$person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				
				$row['product_name'] = $person->product_name;
				$row['price_discount'] = $price_discount;
				
				
				$row['remarks'] = $html;
				$row['status'] = $status;
				
				
				$route = asset('admin/update/campaign/fullbuy/'.$person->id);
				$sendlist = asset('admin/sendlist/campaign/fullbuy/'.$person->id);
				$viewdetails = asset('admin/viewdetails/campaign/fullbuy/'.$person->id);
				$clone = asset('admin/clone/campaign/fullbuy/'.$person->id);
				$routedraft = asset('admin/draft/campaign/fullbuy/'.$person->id);
				
			
				$row['action'] =  '<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
									  <span class="caret"></span></button>
									  <ul class="dropdown-menu">';
									  
									  if($person->offer_status != "drafts")
									  {
				$row['action'] .=		'<li><a href="'.$route.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>
										<li style="display:none"><a href="'.$viewdetails.'"><i class="fa fa-fw fa-list-alt"></i>View Details</a></li>
										<li class="divider"></li>
										<li><a href="'.$sendlist.'"><i class="fa fa-fw fa-mail-forward"></i>Send Offer</a></li>
										<li><a href="'.$clone.'"><i class="fa fa-fw fa-copy"></i>Copy this Campaign</a></li>';
										
									  }
									  else
									  {
									    
				$row['action'] .=		'<li><a href="'.$routedraft.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>';
									  }
									  
									  
										
										
			    $row['action'] .=	'</ul>
									</div>';
				
			
									
									
									
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
		
		
		
		
		
	/*	
		$getallData = self::where('campaign_type','fullbuy campaign')->orderBy('id', 'DESC')->get();
		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$row['id'] = $person->id;
				$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				$row['product_name'] = $person->product_name;
				$row['product_brand'] = $person->product_brand;
				$row['shipping_carrier'] = $person->shipping_carrier;
				
				$route = asset('admin/update/campaign/fullbuy/'.$person->id);
				$sendlist = asset('admin/sendlist/campaign/fullbuy/'.$person->id);
				$viewdetails = asset('admin/viewdetails/campaign/fullbuy/'.$person->id);
				$clone = asset('admin/clone/campaign/fullbuy/'.$person->id);
				//$row['action'] = "<a class='btn btn-raised btn-primary button_width' onclick=\"editoffer('".$person->id."');\" href='#'  title='modify data'><i class='fa fa-fw fa-pencil-square-o'></i> Edit</a>&nbsp;";
				
				$row['action'] =  '<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
									  <span class="caret"></span></button>
									  <ul class="dropdown-menu">
										<li><a href="'.$route.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>
										<li><a href="'.$viewdetails.'"><i class="fa fa-fw fa-list-alt"></i>View Details</a></li>
										<li class="divider"></li>
										<li><a href="'.$sendlist.'"><i class="fa fa-fw fa-mail-forward"></i>Send Offer</a></li>
										<li><a href="'.$clone.'"><i class="fa fa-fw fa-copy"></i>Copy this Campaign</a></li>
									  </ul>
									</div>';
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
		
	*/	
		
	}
	
	public static function getallDataaddtocart($menudata)
	{
		$currentdate = Carbon::now();
		$currentdate = Carbon::parse($currentdate)->toDateString();
		
	
		
		$price = "price.product_price as new_product_price";
		$price .= ",price.product_discount_label as new_product_discount_label";
		$price .= ",price.product_discount as new_product_discount";
		
		$select ="offer_settings.*,t2.offer_status,$price";
		
		
		$select .= ",(SELECT count(id)  FROM users_offer_1_sent_campaigns     		WHERE offer_id = offer_settings.id ) as invites";
		$select .= ",(SELECT count(id)  FROM users_offer_2_get_schedules     	 	WHERE offer_id = offer_settings.id ) as getschedule";
		$select .= ",(SELECT count(id)  FROM users_offer_3_continue_accepts  		WHERE offer_id = offer_settings.id ) as accept";
		$select .= ",(SELECT count(id)  FROM users_offer_4_submit_tracking_numbers  WHERE offer_id = offer_settings.id and remarks = 'Delivered' ) as purchased";
		$select .= ",(SELECT count(id)  FROM users_offer_5_completeds  				WHERE offer_id = offer_settings.id and status = 'completed' ) as completed";
		
		$getallData = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_status as t2','t2.id','=','offer_settings.status')
		->leftJoin('offer_setting_prices as price', function($join) 
		{
			$join->on('offer_settings.id', '=', 'price.offer_id');
			$join->on('price.product_id', '=', 'offer_settings.product_id');
			$join->on('price.status','=',\DB::raw("'active'"));
		})
		->where(function ($getallData) use ($menudata) {
			if($menudata != ""){
			 return $getallData->where('offer_settings.status','=', $menudata);
			}
		})
		->where('campaign_type','addtocart campaign')
		->orderBy('offer_settings.id', 'DESC')
		->get();

		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$html = '';
				$price_discount	 = '';
				$sign = '';
				
				$datetime = $person->created_at;
				$startdatetime  = Carbon::parse($datetime)->toDateString();
				
		
				if($currentdate == $startdatetime)
				{	
					$html .= "<span style='color:blue'>*Latest Campaign </span><br>";
				} 
			
				$html .= $person->invites." - invites  <br>";
				$html .= $person->getschedule." - get schedule <br>";
				$html .= $person->accept." - accept offer <br>";
				$html .= $person->purchased." - purchased product <br>";
				$html .= $person->completed." - completd offer <br>"; 
				
				
				$price_discount	.= "$$person->new_product_price <br>";
				
				if(!empty($person->new_product_discount))
				{
					
					if($person->new_product_discount_label == "Percentage")
					{ 	
						$discount = str_replace('.00', '', $person->new_product_discount);
						 $sign = $discount."% off";
					}
					else if($person->new_product_discount_label == "Dollar")
					{
						 $sign = "$".$person->new_product_discount;
					}
					
					$price_discount	.= "<span style='color:red'>*Discount: </span>".$sign;
									
				} 
			
				switch($person->offer_status){
				case 'pending':
					$status = '<span class="label label-warning">Pending</span>';
				break;
				case 'active':
					$status = '<span class="label label-success">Active</span>';
				break;
				case 'inactive':
					$status = '<span class="label label-primary">Inactive</span>';
				break;
				case 'expired':
					$status = '<span class="label label-danger">Expired</span>';
				break;
				case 'completed':
					$status = '<span class="label label-success">Completed</span>';
				break;				
				}
				
				
				$row['id'] = $person->id;
						
				if($person->copy_id == 0){
					$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				else
				{
					$title = self::select('Title')->where('id',$person->copy_id)->first();
					
					$row['Title'] = "<span style='font-size:10px;color:blue'>Copy from ".$title->Title."</span><br>".$person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				
				$row['product_name'] = $person->product_name;
				$row['price_discount'] = $price_discount;
				
				
				$row['remarks'] = $html;
				$row['status'] = $status;
				
				
				$route = asset('admin/update/campaign/addtocart/'.$person->id);
				$sendlist = asset('admin/sendlist/campaign/addtocart/'.$person->id);
				$viewdetails = asset('admin/viewdetails/campaign/addtocart/'.$person->id);
				$clone = asset('admin/clone/campaign/addtocart/'.$person->id);
				
				
				//$row['action'] = "<a class='btn btn-raised btn-primary button_width' onclick=\"editoffer('".$person->id."');\" href='#'  title='modify data'><i class='fa fa-fw fa-pencil-square-o'></i> Edit</a>&nbsp;";
				
				$row['action'] =  '<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
									  <span class="caret"></span></button>
									  <ul class="dropdown-menu">
										<li><a href="'.$route.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>
										<li><a href="'.$viewdetails.'"><i class="fa fa-fw fa-list-alt"></i>View Details</a></li>
										<li class="divider"></li>
										<li><a href="'.$sendlist.'"><i class="fa fa-fw fa-mail-forward"></i>Send Offer</a></li>
										<li><a href="'.$clone.'"><i class="fa fa-fw fa-copy"></i>Copy this Campaign</a></li>
									  </ul>
									</div>';
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
		
		
		/*$getallData = self::where('campaign_type','addtocart campaign')->orderBy('id', 'DESC')->get();
		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$row['id'] = $person->id;
				$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				$row['product_name'] = $person->product_name;
				$row['product_brand'] = $person->product_brand;
				$row['shipping_carrier'] = $person->shipping_carrier;
				$route = asset('admin/update/campaign/addtocart/'.$person->id);
				$sendlist = asset('admin/sendlist/campaign/addtocart/'.$person->id);
				$viewdetails = asset('admin/viewdetails/campaign/addtocart/'.$person->id);
				$clone = asset('admin/clone/campaign/addtocart/'.$person->id);
				//$row['action'] = "<a class='btn btn-raised btn-primary button_width' onclick=\"editoffer('".$person->id."');\" href='#'  title='modify data'><i class='fa fa-fw fa-pencil-square-o'></i> Edit</a>&nbsp;";
				
				$row['action'] =  '<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
									  <span class="caret"></span></button>
									  <ul class="dropdown-menu">
										<li><a href="'.$route.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>
										<li><a href="'.$viewdetails.'"><i class="fa fa-fw fa-list-alt"></i>View Details</a></li>
										<li class="divider"></li>
										<li><a href="'.$sendlist.'"><i class="fa fa-fw fa-mail-forward"></i>Send Offer</a></li>
										<li><a href="'.$clone.'"><i class="fa fa-fw fa-copy"></i>Copy this Campaign</a></li>
									  </ul>
									</div>';
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
		*/
	}
	
	
	public static function getallDatacompare($menudata)
	{
		
		$currentdate = Carbon::now();
		$currentdate = Carbon::parse($currentdate)->toDateString();
			
		$price = "price.product_price as new_product_price";
		$price .= ",price.product_discount_label as new_product_discount_label";
		$price .= ",price.product_discount as new_product_discount";
		
		$select ="offer_settings.*,t2.offer_status,$price";
		
		
		$select .= ",(SELECT count(id)  FROM users_offer_1_sent_campaigns     		WHERE offer_id = offer_settings.id ) as invites";
		$select .= ",(SELECT count(id)  FROM users_offer_2_get_schedules     	 	WHERE offer_id = offer_settings.id ) as getschedule";
		$select .= ",(SELECT count(id)  FROM users_offer_3_continue_accepts  		WHERE offer_id = offer_settings.id ) as accept";
		$select .= ",(SELECT count(id)  FROM users_offer_4_submit_tracking_numbers  WHERE offer_id = offer_settings.id and remarks = 'Delivered' ) as purchased";
		$select .= ",(SELECT count(id)  FROM users_offer_5_completeds  				WHERE offer_id = offer_settings.id and status = 'completed' ) as completed";
		
		$getallData = \DB::table('offer_settings')
		->select(\DB::raw($select))
		->join('offer_status as t2','t2.id','=','offer_settings.status')
		->leftJoin('offer_setting_prices as price', function($join) 
		{
			$join->on('offer_settings.id', '=', 'price.offer_id');
			$join->on('price.product_id', '=', 'offer_settings.product_id');
			$join->on('price.status','=',\DB::raw("'active'"));
		})
		->where(function ($getallData) use ($menudata) {
			if($menudata != ""){
			 return $getallData->where('offer_settings.status','=', $menudata);
			}
		})
		->where('campaign_type','compare campaign')
		->orderBy('offer_settings.id', 'DESC')
		
		->get();

		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$html = '';
				$price_discount	 = '';
				$sign = '';
				
				$datetime = $person->created_at;
				$startdatetime  = Carbon::parse($datetime)->toDateString();
				
		
				if($currentdate == $startdatetime)
				{	
					$html .= "<span style='color:blue'>*Latest Campaign </span><br>";
				} 
			
				$html .= $person->invites." - invites  <br>";
				$html .= $person->getschedule." - get schedule <br>";
				$html .= $person->accept." - accept offer <br>";
				$html .= $person->purchased." - purchased product <br>";
				$html .= $person->completed." - completd offer <br>"; 
				
				
				$price_discount	.= "$$person->new_product_price <br>";
				
				if(!empty($person->new_product_discount))
				{
					
					if($person->new_product_discount_label == "Percentage")
					{ 	
						$discount = str_replace('.00', '', $person->new_product_discount);
						 $sign = $discount."% off";
					}
					else if($person->new_product_discount_label == "Dollar")
					{
						 $sign = "$".$person->new_product_discount;
					}
					
					$price_discount	.= "<span style='color:red'>*Discount: </span>".$sign;
									
				} 
			
				switch($person->offer_status){
				case 'pending':
					$status = '<span class="label label-warning">Pending</span>';
				break;
				case 'active':
					$status = '<span class="label label-success">Active</span>';
				break;
				case 'inactive':
					$status = '<span class="label label-primary">Inactive</span>';
				break;
				case 'expired':
					$status = '<span class="label label-danger">Expired</span>';
				break;
				case 'completed':
					$status = '<span class="label label-success">Completed</span>';
				break;				
				}
				
				
				$row['id'] = $person->id;
						
				if($person->copy_id == 0){
					$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				else
				{
					$title = self::select('Title')->where('id',$person->copy_id)->first();
					
					$row['Title'] = "<span style='font-size:10px;color:blue'>Copy from ".$title->Title."</span><br>".$person->Title ."<br>". $person->start_date.' '.$person->start_time;
				}
				
				$row['product_name'] = $person->product_name;
				$row['price_discount'] = $price_discount;
				
				
				$row['remarks'] = $html;
				$row['status'] = $status;
				
				
				$route = asset('admin/update/campaign/compare/'.$person->id);
				$sendlist = asset('admin/sendlist/campaign/compare/'.$person->id);
				$viewdetails = asset('admin/viewdetails/campaign/compare/'.$person->id);
				$clone = asset('admin/clone/campaign/compare/'.$person->id);
				
				
				//$row['action'] = "<a class='btn btn-raised btn-primary button_width' onclick=\"editoffer('".$person->id."');\" href='#'  title='modify data'><i class='fa fa-fw fa-pencil-square-o'></i> Edit</a>&nbsp;";
				
				$row['action'] =  '<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
									  <span class="caret"></span></button>
									  <ul class="dropdown-menu">
										<li><a href="'.$route.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>
										<li><a href="'.$viewdetails.'"><i class="fa fa-fw fa-list-alt"></i>View Details</a></li>
										<li class="divider"></li>
										<li><a href="'.$sendlist.'"><i class="fa fa-fw fa-mail-forward"></i>Send Offer</a></li>
										<li><a href="'.$clone.'"><i class="fa fa-fw fa-copy"></i>Copy this Campaign</a></li>
									  </ul>
									</div>';
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
		
		
		/*
		$getallData = self::where('campaign_type','compare campaign')->orderBy('id', 'DESC')->get();
		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				$row = array();
				$row['id'] = $person->id;
				$row['Title'] = $person->Title ."<br>". $person->start_date.' '.$person->start_time;
				$row['product_name'] = $person->product_name;
				$row['product_brand'] = $person->product_brand;
				$row['shipping_carrier'] = $person->shipping_carrier;
				$route = asset('admin/update/campaign/compare/'.$person->id);
				$sendlist = asset('admin/sendlist/campaign/compare/'.$person->id);
				$viewdetails = asset('admin/viewdetails/campaign/compare/'.$person->id);
				$clone = asset('admin/clone/campaign/compare/'.$person->id);
				//$row['action'] = "<a class='btn btn-raised btn-primary button_width' onclick=\"editoffer('".$person->id."');\" href='#'  title='modify data'><i class='fa fa-fw fa-pencil-square-o'></i> Edit</a>&nbsp;";
				
				$row['action'] =  '<div class="dropdown">
									  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
									  <span class="caret"></span></button>
									  <ul class="dropdown-menu">
										<li><a href="'.$route.'"><i class="fa fa-fw fa-pencil-square"></i>Edit Details</a></li>
										<li><a href="'.$viewdetails.'"><i class="fa fa-fw fa-list-alt"></i>View Details</a></li>
										<li class="divider"></li>
										<li><a href="'.$sendlist.'"><i class="fa fa-fw fa-mail-forward"></i>Send Offer</a></li>
										<li><a href="'.$clone.'"><i class="fa fa-fw fa-copy"></i>Copy this Campaign</a></li>
									  </ul>
									</div>';
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
		
		*/
	}
	
	
	public static function getDataCampaign($id,$customer_id)
	{
		
		$price = "price.product_price as new_product_price";
		$price .= ",price.product_discount_label as new_product_discount_label";
		$price .= ",price.product_discount as new_product_discount";
		
		$select ="offer_settings.*,$price";
		$data = \DB::table('offer_settings')
		->select(\DB::raw($select))
				 ->leftJoin('offer_setting_prices as price', function($join) 
					{
						$join->on('offer_settings.id', '=', 'price.offer_id');
						$join->on('price.product_id', '=', 'offer_settings.product_id');
						$join->on('price.status','=',\DB::raw("'active'"));
					})
					->where('offer_settings.id',$id)
					->get();
				
		return 	$data;
		
	}
	
	
	
	
	
}
