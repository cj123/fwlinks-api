<?php

	/**
	 * Firmware Links API for PHP Example
	 * (C) 2012 Callum Jones <cj@icj.me>
	 */
	class FirmwareLinks {

		public function getData($request, $device, $buildid) {

			// Validate user input
			$r = new ReflectionMethod(__CLASS__, __FUNCTION__);
			foreach ($r->getParameters() as $param) {
				$name = $param->getName();
				if (empty(${$name}))
					throw new Exception("The `$name` parameter cannot be empty.");
				elseif (!is_string(${$name}))
					throw new Exception("The `$name` parameter must be a string.");
			}

			// Set the request URL
			$url = "http://api.ios.icj.me/v2/$device/$buildid/$request";

			// Initialize and configure cURL
			$ch = curl_init();
			$options = array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_CONNECTTIMEOUT => 5,
				CURLOPT_USERAGENT => "firmwarelinks-api <cj@icj.me>"
			);
			curl_setopt_array($ch, $options);

			// Execute and terminate the cURL request
			$returned_data = curl_exec($ch);
			curl_close($ch);

			// Validate the cURL response
			$response = get_headers($url, 1);
			if($response[0] == "HTTP/1.1 200 OK")
				return $returned_data;
			else
				throw new Exception("Error: " . $response[0]);

		}

	}

?>