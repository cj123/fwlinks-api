<?php

/**
 * Firmware Links API for PHP Example
 * (C) 2012 Callum Jones <cj@icj.me>
 */

require "class.firmwarelinks-api.php";

try {
	$fw = new firmwarelinks_api();
	$download_url = $fw->firmware("url", "iPhone5,1", "7.1");
	echo $download_url . "\n";

	// device name test
	echo $fw->firmware("name", "iPad3,2", "latest") . "\n";

	// iTunes request

	echo $fw->iTunes("url", "Windows", "earliest") . "\n";

} catch (Exception $e) {
	echo "Caught exception: " .  $e->getMessage() . "\n";
}

?>