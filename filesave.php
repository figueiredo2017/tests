<?php

$filename = "test.log";
$content = json_encode([
		'timestamp' => date("Y-m-d H:i:s".substr((string)microtime(), 1, 8).' e'),
		'message' => "nova linha",
	])."\n";

$file=fopen($filename,"a");

while ($exit!=1) {
	try {
		flock($file, LOCK_EX);
		fwrite($file, $content);
		flock($file, LOCK_UN);	
		$exit = 1;
	}
	catch (Exception $e) {
		print "pin";
		sleep(0.1);
	}
}

fclose($file);

