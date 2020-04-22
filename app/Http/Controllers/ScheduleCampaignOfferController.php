<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Model\frontend\users_offer_2_get_schedules;
use App\Model\offer_settings;
use App\Model\offer_setting_prices;


class ScheduleCampaignOfferController extends Controller
{
	
	public function returntime($start_date,$time)
	{
		
		$latest_shed  = $start_date.' '.$start_time;
		$carbon_date = Carbon::parse($latest_shed);
		 return $carbon_date->addMinutes(30);
		
	}
	
	
	public function getCampaignofferALLschedule(Request $request)
	{
		 $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		
		$currentdate_str = strtotime($currentdate);
		
		$dt = Carbon::now()->format('m/d/Y H:i:s');
		$datenow_str = strtotime($dt);
		
		$offer_id  =  $request->offer_id;
		
		$offerdetails = offer_settings::where('id',$offer_id)->first();
		
		$schedtaken = users_offer_2_get_schedules::where('offer_id',$offer_id)->get();
		
		$array_schedule = array();
	
		
		foreach($schedtaken as $row) 
		{
			$datetime = $row->sched_date.' '. $row->sched_time;
			
			array_push($array_schedule,$datetime);
		}
		
		
		//print_r($array_schedule);
		
	   
		
		$latest_shed  = $offerdetails->start_date.' '.$offerdetails->start_time;
		$carbon_date = Carbon::parse($latest_shed);
		$first_date_time = $carbon_date->addMinutes(30);
		
	
		$date_unserialize = unserialize($offerdetails->offer_daily_order);
		
	 	$events = array();
		$result = [];
		$slotperday = [];
		
		$sched_array = array();
		$status ="";
		
		
		
		
		
		if(!empty($date_unserialize))
		{	
			
		   $count = 0;
		   
			foreach($date_unserialize as $key => $row) 
			{
		
				$availabledate = trim($row['date']);
				$availabledate = explode('-',$availabledate);
				$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
				$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
				$availabledate_str = strtotime($availabledate);
				
				
				if($currentdate_str <= $availabledate_str) // change ko muna 1/27/2020 ..  loop all available date 
				//if($currentdate_str == $availabledate_str) // change into get available for today only
				{
				
				
					$eventsArray['id_date']  =  $id_date;
					$eventsArray['date']  =  $availabledate;					
					$eventsArray['value'] =  $row['value'];
					$getotalavailble_fortoday = 0;
					
					$getotalavailble_fortoday = 0;
					$getCountsched = 0;
					
					for($i = 1; $i <= $row['value']; $i++)
					{
						
					
						if($row['nameofday'] === 'Day1')
						{
						
							if($i === 1)
							{
								 $date  = $availabledate.' '.$start_time="00:00:00";
								 $date = date('m/d/Y H:i:s',strtotime($date));
								 
							}
							else
							{
								$carbon_date = Carbon::parse($date);
								$date = $carbon_date->addMinutes(10);
								$date = date('m/d/Y H:i:s',strtotime($date));
							}
							
							
						
						}
						else
						{
	
							if($i === 1)
							{
								$date  = $availabledate.' '.$start_time="00:00:00";
								$date = date('m/d/Y H:i:s',strtotime($date)); 
							}
							else
							{
								$carbon_date = Carbon::parse($date);
								$date = $carbon_date->addMinutes(10);
								$date = date('m/d/Y H:i:s',strtotime($date));
							}
							
						} 
						
						
						@$getCountsched = \DB::table('users_offer_2_get_schedules')
							->select(\DB::raw('*'))
							->where('offer_id', $offer_id)
							->where('sched_date', $eventsArray['date'])
							->get();
							
							
						$getCountsched = count($getCountsched);
						$getotalavailble_fortoday =   $eventsArray['value'] -  $getCountsched;
						
						$availableSlot  = ($getotalavailble_fortoday == 0 ? "SOLD_OUT" : $getotalavailble_fortoday );
						
						
						if($availableSlot == "SOLD_OUT")
						{
						    $status = "taken";
						}
						
						
						if(in_array($date, $array_schedule))
						{
						  $status = "taken";
						}
						else
						{
							$status = "available";
						}
                        
                        /*
						$date_str = strtotime($date);
						if($datenow_str > $date_str)
						{
							$status = "lapsed";
						}
					    */
					
						
				
						$new_array = array('schedule_time'=>$date,'status'=>$status);
						array_push($result,$new_array);
						
						
					
					}
				
					
					$eventsArray['available_slot']	= $getotalavailble_fortoday;
					$count += $eventsArray['available_slot'];
					
					$eventsArray['time'] = $result;
					$events[] = $eventsArray;
					
					
				
				}

               
				$result = [];
				$getotalavailble_fortoday = 0;
				 
			}
		
		} 
		
		echo json_encode(array('data'=>$events,'count_available'=>$count));
		//print_r($date_unserialize);
	}
	
	
	public function getCampaignofferscheduleToday(Request $request)
	{
		 $currentdate = Carbon::now();
		// pag format sa current date m/d/Y format
		$currentdate =	$currentdate->toDateString(); 
		$currentdate = explode('-',$currentdate);
		$currentdate = $currentdate[1]."/".$currentdate[2]."/".$currentdate[0];
		
		$currentdate_str = strtotime($currentdate);
		
		$dt = Carbon::now()->format('m/d/Y H:i:s');
		$datenow_str = strtotime($dt);
		
		$offer_id  =  $request->offer_id;
		
		$offerdetails = offer_settings::where('id',$offer_id)->first();
		
		$schedtaken = users_offer_2_get_schedules::where('offer_id',$offer_id)->get();
		
		$array_schedule = array();
	
		
		foreach($schedtaken as $row) 
		{
			$datetime = $row->sched_date.' '. $row->sched_time;
			
			array_push($array_schedule,$datetime);
		}
		
		
		//print_r($array_schedule);
		
	   
		
		$latest_shed  = $offerdetails->start_date.' '.$offerdetails->start_time;
		$carbon_date = Carbon::parse($latest_shed);
		$first_date_time = $carbon_date->addMinutes(30);
		
	
		$date_unserialize = unserialize($offerdetails->offer_daily_order);
		
	 	$events = array();
		$result = [];
		$slotperday = [];
		
		$sched_array = array();
		$status ="";
		
		
		
		
		
		if(!empty($date_unserialize))
		{	
			
		   $count = 0;
		   
			foreach($date_unserialize as $key => $row) 
			{
		
				$availabledate = trim($row['date']);
				$availabledate = explode('-',$availabledate);
				$id_date = $availabledate[0]."".$availabledate[1]."".$availabledate[2];
				$availabledate = $availabledate[0]."/".$availabledate[1]."/".$availabledate[2];
				$availabledate_str = strtotime($availabledate);
				
				
				//if($currentdate_str <= $availabledate_str) // change ko muna 1/27/2020 ..  loop all available date 
				if($currentdate_str == $availabledate_str) // change into get available for today only
				{
				
				
					$eventsArray['id_date']  =  $id_date;
					$eventsArray['date']  =  $availabledate;					
					$eventsArray['value'] =  $row['value'];
					$getotalavailble_fortoday = 0;
					
					
					
					for($i = 1; $i <= $row['value']; $i++)
					{
						
					
						if($row['nameofday'] === 'Day1')
						{
						
							if($i === 1)
							{
								 $date  = $availabledate.' '.$offerdetails->start_time;
								 $date = date('m/d/Y H:i:s',strtotime($date));
								 
							}
							else
							{
								$carbon_date = Carbon::parse($date);
								$date = $carbon_date->addMinutes(10);
								$date = date('m/d/Y H:i:s',strtotime($date));
							}
							
							
						
						}
						else
						{
	
							if($i === 1)
							{
								$date  = $availabledate.' '.$start_time="00:00:00";
								$date = date('m/d/Y H:i:s',strtotime($date)); 
							}
							else
							{
								$carbon_date = Carbon::parse($date);
								$date = $carbon_date->addMinutes(10);
								$date = date('m/d/Y H:i:s',strtotime($date));
							}
							
						} 
						
						
						@$getCountsched = \DB::table('users_offer_2_get_schedules')
							->select(\DB::raw('*'))
							->where('offer_id', $offer_id)
							->where('sched_date', $currentdate)
							->get();
							
							
						$getCountsched = count($getCountsched);
						$getotalavailble_fortoday =   $row['value'] -  $getCountsched;
						$availableSlot  = ($getotalavailble_fortoday == 0 ? "SOLD_OUT" : $getotalavailble_fortoday );
						if($availableSlot == "SOLD_OUT")
						{
						    $status = "taken";
						}
						else if(in_array($date, $array_schedule))
						{
						  $status = "taken";
						}
						else
						{
							$status = "available";
						}
						
						
				
						/*
						$date_str = strtotime($date);
						if($datenow_str > $date_str)
						{
							$status = "lapsed";
						}
						*/
					
						
				
						$new_array = array('schedule_time'=>$date,'status'=>$status);
						array_push($result,$new_array);
						
						
					
					}
				
					
					$eventsArray['available_slot']	= $getotalavailble_fortoday;
					$count += $eventsArray['available_slot'];
					
					$eventsArray['time'] = $result;
					$events[] = $eventsArray;
				
				}

               
				$result = [];
				$getotalavailble_fortoday = 0;
				 
			}
		
		} 
		
		echo json_encode(array('data'=>$events,'count_available'=>$count));
		//print_r($date_unserialize);
	}
	
	


}