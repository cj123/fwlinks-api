<?php

	/**
	 * Firmware Links API for PHP Example
	 * (C) 2012 Callum Jones <cj@icj.me>
	 */
	require "class.firmwarelinks-api.php";

	try {
		$fw = new FirmwareLinks();
		$download_url = $fw->getData("url", "iPhone4,1", "5.1");
		echo $download_url;
	} catch (Exception $e) {
		echo "Caught exception: " .  $e->getMessage() . "\n";
	}

?>