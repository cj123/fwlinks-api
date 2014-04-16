<?php

/**
 * FirmwareLinks is a class for requesting information from the Firmware Links API
 *
 * Before using this class you should read the information given at the documentation:
 *		http://api.ios.icj.me/docs
 *
 * BSD Licensed - see attached LICENSE file for more information
 *
 * @package firmwarelinks_api
 * @author  Callum Jones <cj@icj.me>
 * @version 1.0
 */

class firmwarelinks_api {

	// the api base
	private $apibase = "http://api.ios.icj.me/v2/";

	// user agent
	private $user_agent = "firmwarelinks-api";

	// request from the api given an url relative to the api base
	private function api_request($relative_url) {
		// Initialize and configure cURL
		$ch = curl_init();

		$options = array(
			CURLOPT_URL => $this->apibase . $relative_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_USERAGENT => $this->user_agent
		);

		curl_setopt_array($ch, $options);

		// get response
		$response = curl_exec($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// throw exception if http response code is not correct
		if($http_code !== 200) {
			throw new Exception("HTTP Response not as expected: code " . $http_code);
		}

		// close curl request
		curl_close($ch);

		return $response;
	}

	/**
	 * firmware - get information to do with a firmware
	 *
	 * @param 	string 	request 	the item you wish to request (see http://api.ios.icj.me/docs/Firmware)
	 * @param 	string 	device 		the identifier or boardconfig for the device
	 * @param 	string 	buildid 	the buildid (or if you must: version) of the firmware
	 *
	 * @return 	string 	response from the api
	 */
	public function firmware($request, $device, $buildid) {
		// prepare the relative url
		$url = sprintf("%s/%s/%s", $device, $buildid, $request);
		return $this->api_request($url);
	}

	/**
	 * iTunes - get information to do with iTunes
	 *
	 * @param 	string 	request 	the item you wish to request (see http://api.ios.icj.me/docs/iTunes)
	 * @param 	string 	platform 	the platform (Windows or Mac OS X)
	 * @param 	string 	version 	the version of iTunes
	 *
	 * @return 	string 	response from the api
	 */
	public function iTunes($request, $platform, $version) {
		$url = sprintf("iTunes/%s/%s/%s", $platform, $version, $request);
		return $this->api_request($url);
	}

	/**
	 * PwnageTool - get information to do with PwnageTool
	 *
	 * @param 	string 	request 	the item you wish to request (see http://api.ios.icj.me/docs/PwnageTool)
	 * @param 	string 	version 	the version of PwnageTool
	 *
	 * @return 	string 	response from the api
	 */
	public function PwnageTool($request, $version) {
		$url = sprintf("PwnageTool/%s/%s", $version, $request);
		return $this->api_request($url);
	}

	/**
	 * redsn0w - get information to do with iTunes
	 *
	 * @param 	string 	request 	the item you wish to request (see http://api.ios.icj.me/docs/redsn0w)
	 * @param 	string 	platform 	the platform (Windows or Mac OS X)
	 * @param 	string 	version 	the version of redsn0w
	 *
	 * @return 	string 	response from the api
	 */
	public function redsn0w($request, $platform, $version) {
		$url = sprintf("redsn0w/%s/%s/%s", $platform, $version, $request);
		return $this->api_request($url);
	}

	// outdated, merely provides backwards compatability for some unknown reason
	public function getData($request, $device, $buildid) {
		return $this->firmware($request, $device, $buildid);
	}
}
