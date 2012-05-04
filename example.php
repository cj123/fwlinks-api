<?php
/**
 * Firmware Links API for PHP Example
 * (C) 2012 Callum Jones <cj@icj.me>
 */

require "class.firmwarelinks-api.php";

try {

	$fwlinks = new FirmwareLinks();
	$download_url = $fwlinks->getData("url", "iPod4,1", "4.1");

	echo $download_url;
	
} catch (Exception $e) {
    echo "Caught exception: " .  $e->getMessage() . "\n";
	
}

?>