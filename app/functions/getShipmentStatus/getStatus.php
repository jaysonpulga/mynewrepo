<?php
namespace App\functions\getShipmentStatus; 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'vendor/autoload.php';

use Sauladam\ShipmentTracker\ShipmentTracker;


Class GetStatus
{
	
		
	public function getAction($shipment_company,$tracking_number)
	{
		
	
		$dhlTracker = ShipmentTracker::get($shipment_company);
		$track = $dhlTracker->track($tracking_number);
		$latestEvent = $track->latestEvent();
		$array = array();
		
	

		if(!empty($latestEvent))
		{
			
			if($track->delivered()){
			  $array['isDelivered'] = "Delivered to " . $track->getRecipient();
			}
			else{
				$array['isDelivered'] = "Not delivered yet, The current status is " . $track->currentStatus();
				$array['status']  =  $track->currentStatus();
			}
			

			$array['status'] = $latestEvent->getStatus();

			$array['description'] =  "The parcel was last seen in " . $latestEvent->getLocation() . " on " . $latestEvent->getDate()->format('Y-m-d') . " " . $latestEvent->getDescription(); 
		}
		else
		{
			$array['isDelivered'] = "";
			$array['status'] =  "The current status is " . $track->currentStatus();
			$array['description'] = 'This tracking number cannot be found, please check the number or contact the sender.';
			
		}
		
		return  json_encode($array);
	}
}