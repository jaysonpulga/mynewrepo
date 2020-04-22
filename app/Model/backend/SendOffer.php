<?php

namespace App\Model\backend;

use Illuminate\Database\Eloquent\Model;
use App\Model\frontend\User;
class SendOffer extends Model
{
    
	public static function getallusersnotyetinvited($campaign_id)
	{
		
			$getusernotinvited = \DB::table('users')
			
						->whereNotExists( function ($getusernotinvited) use ($campaign_id)
						{
							$getusernotinvited->select(\DB::raw(1))
							->from('users_offer_1_sent_campaigns as sent')
							->whereRaw('users.id = sent.user_id')
							->where('sent.offer_id', '=' ,$campaign_id);

						})
						->get();
						
			$data = array();			
			if(!empty($getusernotinvited))
			{
				foreach ($getusernotinvited as $post)
				{					

					$nestedData['id'] = "{$post->id}";
					$nestedData['name'] = $post->name;
					$nestedData['email'] = $post->email;
					$data[] = $nestedData;

				}
			}			
						
			return  $data;			
		
	}
	
	
	public static function getusernotyetinvited($campaign_id,$draw,$limit,$start,$order,$dir,$search)
	{
		
	
			$columns = array( 
                            0 =>'users.id', 
                            1 =>'users.name',
                            2=> 'users.email',
                            3=> 'users.created_at',
                        );
  
			
			$totalData = \DB::table('users')
						->whereNotExists( function ($totalData) use ($campaign_id)
						{
							$totalData->select(\DB::raw(1))
							->from('users_offer_1_sent_campaigns as sent')
							->whereRaw('users.id = sent.user_id')
							->where('sent.offer_id', '=' ,$campaign_id);

						})->count();
		
			$totalFiltered = $totalData; 
			
			if(empty($search))
			{            
				
				
				$posts = \DB::table('users')
					->whereNotExists( function ($posts) use ($campaign_id)
					{
							$posts->select(\DB::raw(1))
							->from('users_offer_1_sent_campaigns as sent')
							->whereRaw('users.id = sent.user_id')
							->where('sent.offer_id', '=' ,$campaign_id);

					})
					->offset($start)
					->limit($limit)
					->orderBy($order,$dir)
					->groupby('users.id')
					->get();
				
				
				
			}
			else 
			{
										
				$posts = \DB::table('users')
							->whereNotExists( function ($posts)  use ($campaign_id)
							{
									$posts->select(\DB::raw(1))
									->from('users_offer_1_sent_campaigns as sent')
									->whereRaw('users.id = sent.user_id')
									->where('sent.offer_id', '=' ,$campaign_id);

							})
							->where('users.id','LIKE',"%{$search}%")
							->orWhere('users.name', 'LIKE',"%{$search}%")
							->offset($start)
							->limit($limit)
							->orderBy($order,$dir)
							->groupby('users.id')
							->get();			
								 
				$totalFiltered = \DB::table('users')
							->whereNotExists( function ($totalFiltered)  use ($campaign_id)
							{
									$totalFiltered->select(\DB::raw(1))
									->from('users_offer_1_sent_campaigns as sent')
									->whereRaw('users.id = sent.user_id')
									->where('sent.offer_id', '=' ,$campaign_id);

							})
							->where('users.id','LIKE',"%{$search}%")
							->orWhere('users.name', 'LIKE',"%{$search}%")
							->groupby('users.id')
							->count();				 
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{					
					$nestedData['checkbox'] = '<input  type="checkbox" class="checkboxes" value='.$post->id.' data-id='.$post->id.' data-name="'.$post->name.'" data-email='.$post->email.'  >';
					$nestedData['id'] = $post->id;
					$nestedData['name'] = $post->name;
					$nestedData['email'] = $post->email;
					$nestedData['joindate'] = date('F j, Y',strtotime($post->created_at));
					$nestedData['status'] = '';
					$nestedData['s_invite_date'] = '';
					$data[] = $nestedData;

				}
			}
			  
			$json_data = array(
			
							"draw"            => intval($draw),  
							"recordsTotal"    => intval($totalData),  
							"recordsFiltered" => intval($totalFiltered), 
							"data"            => $data,
						);
					
		return $json_data;
	}
	
	
	public static function getuserinvited($campaign_id,$draw,$limit,$start,$order,$dir,$search)
	{
		
	
			$totalData = \DB::table('users')
						->join('users_offer_1_sent_campaigns as sent','sent.user_id','=','users.id')
						->where('sent.offer_id',$campaign_id)
						->count();
		
			$totalFiltered = $totalData; 

	
			if(empty($search))
			{            
				
				$posts = \DB::table('users')
					->join('users_offer_1_sent_campaigns as sent','sent.user_id','=','users.id')
					->where('sent.offer_id',$campaign_id)
					->offset($start)
					->limit($limit)
					->orderBy($order,$dir)
					->groupby('users.id')
					->get();
				
				
				
			}
			else 
			{
										
				$posts = \DB::table('users')
							->join('users_offer_1_sent_campaigns as sent','sent.user_id','=','users.id')
							->where('sent.offer_id',$campaign_id)
							->where('users.id','LIKE',"%{$search}%")
							->orWhere('users.name', 'LIKE',"%{$search}%")
							->offset($start)
							->limit($limit)
							->orderBy($order,$dir)
							->groupby('users.id')
							->get();			

		
								 
				$totalFiltered = \DB::table('users')
							->join('users_offer_1_sent_campaigns as sent','sent.user_id','=','users.id')
							->where('sent.offer_id',$campaign_id)
							->where('users.id','LIKE',"%{$search}%")
							->orWhere('users.name', 'LIKE',"%{$search}%")
							->groupby('users.id')
							->count();				 
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					
			
					$nestedData['checkbox'] = "<i class='fa fa-fw fa-check-square-o'></i>";
					$nestedData['id'] = $post->id;
					$nestedData['name'] = $post->name;
					$nestedData['email'] = $post->email;
					$nestedData['joindate'] = date('F j, Y',strtotime($post->created_at));
					$nestedData['status'] = 'Sent Offer';
					$nestedData['s_invite_date'] = '';
					$data[] = $nestedData;

				}
			}
			  
			$json_data = array(
						"draw"            => intval($draw),  
						"recordsTotal"    => intval($totalData),  
						"recordsFiltered" => intval($totalFiltered), 
						"data"            => $data,
						);
				
			return $json_data;
		
		
	}
	
	
	public static function getalluserwithStatus($campaign_id,$draw,$limit,$start,$order,$dir,$search)
	{
		

		
		$select = "t1.user_id,t1.created_at";
		$datax = \DB::table('users_offer_1_sent_campaigns as t1')
		->select(\DB::raw($select))
				->where('t1.offer_id',$campaign_id)
				->get();
		
	
			$totalData = User::count();
			
		
		
			$totalFiltered = $totalData; 

			 
			 
			if(empty($search))
			{            
			
				$posts = User::offset($start)
							 ->limit($limit)
							 ->orderBy($order,$dir)
							 ->get(); 
			
			}
			else 
			{
			

				$posts =  User::where('id','LIKE',"%{$search}%")
								->orWhere('name', 'LIKE',"%{$search}%")
								->offset($start)
								->limit($limit)
								->orderBy($order,$dir)
								->get(); 
								
					

				$totalFiltered = User::where('id','LIKE',"%{$search}%")
								 ->orWhere('name', 'LIKE',"%{$search}%")
								 ->count();
								 
			 
			}

			$data = array();
			if(!empty($posts))
			{
				foreach ($posts as $post)
				{
					//$show =  route('posts.show',$post->id);
					//$edit =  route('posts.edit',$post->id);
					
					
					
					$nestedData['checkbox'] = '<input  type="checkbox" class="checkboxes" value='.$post->id.' data-id='.$post->id.' data-name="'.$post->name.'" data-email='.$post->email.'  >';
					$nestedData['id'] = $post->id;
					$nestedData['name'] = $post->name;
					$nestedData['email'] = $post->email;
					$nestedData['joindate'] = date('F j, Y',strtotime($post->created_at));
					$nestedData['status'] = '';
					$nestedData['s_invite_date'] = '';
					
					if(!empty($datax))
					{		
						foreach($datax as $info)
						{
							if($post->id ==  $info->user_id)
							{
								  $nestedData['status'] = 'Sent Offer';
								  $nestedData['s_invite_date'] = date('F j, Y',strtotime($info->created_at));
								  $nestedData['checkbox'] = "<i class='fa fa-fw fa-check-square-o'></i>";
							}
						}	

					}
					
					
			
					//$nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
					//&emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";
					$data[] = $nestedData;

				}
			}
			  
		$json_data = array(
						"draw"            => intval($draw),  
						"recordsTotal"    => intval($totalData),  
						"recordsFiltered" => intval($totalFiltered), 
						"data"            => $data,
						);
				
			return $json_data;
		
	}
	
	
}
