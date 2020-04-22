<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password','dob','zipcode','interest','verification_code','user_domain_origin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function registeruser($input = array())
	{
		
            return User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => bcrypt($input['password']),
                ]);
    }
	
	public static function getallUserswithstatus($campaign_id)
	{
		
		$getallData = self::orderBy('id', 'asc')->orderBy('id')->get();
		
		$select = "t1.user_id";
		$datax = \DB::table('users_offer_1_sent_campaigns as t1')
		->select(\DB::raw($select))
				->where('t1.offer_id',$campaign_id)
				->get();
		
		$r_id = array();	
		if(!empty($datax))
		{		
			foreach($datax as $info)
			{
				array_push($r_id, $info->user_id);
			}
		}
				
			
			
		
		$data = array();
		
		if(!empty($getallData))
		{
		
			foreach ($getallData as $person) 
			{
				
				
				$row = array();
				$row['id'] = $person->id;
				$row['name'] = $person->name;
				$row['email'] = $person->email;
				
				
				if(in_array($person->id, $r_id))
				{
					$row['status'] = 'Sent Offer';
				}
				else
				{
					$row['status'] = '';
				} 
				
				
				 
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
	

	
    
}
