<?php
/**
 * Firmware Links API for PHP
 * (C) 2012 Callum Jones <cj@icj.me>
 */

class FirmwareLinks
{
	private $user_agent = "firmwarelinks-api <cj@icj.me>";
	
	public function getData($request, $device, $buildid) {
		// check input
		if (empty($device)) {
			throw new Exception("No device set.");
		}		
		if (empty($request)) {
			throw new Exception("No data requested.");
		}
		if (empty($buildid)) {
			throw new Exception("No buildid set.");
		}
		$ch = curl_init();
		$timeout = 5;
		
		// set the URL
		$url = "http://api.ios.icj.me/v2/$device/$buildid/$request";
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
		
		$returned_data = curl_exec($ch);
		curl_close($ch);
		
		// check if the link is returned properly
		
		$response = get_headers($url, 1);
				
		if($response[0] == "HTTP/1.1 200 OK") {
			return $returned_data;
		} else {
			throw new Exception("Error: " . $response[0]);
		}

	}
}
?>