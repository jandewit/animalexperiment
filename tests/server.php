<?php

$command = $_POST['command'];

if ($command == 'newlog') {
	// Create new log file
	$files = glob('logs/log_*.txt');
	natsort($files);
	$files = array_values($files);
	$maxfile = $files[count($files)-1];
	$success = sscanf($maxfile, 'logs/log_%d.txt', $number);

	if (!$success)
		$number = 0;

	$myFile = "logs/log_" . ($number+1) . ".txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, date('m/d/Y H:i:s', time()) . " ========== Pretest NL started\r\n");
	fclose($fh);	
}

else {
	// Write to log
	// Find highest log file number
	$files = glob('logs/log_*.txt');
	natsort($files);
	$files = array_values($files);
	$maxfile = $files[count($files)-1];
	$success = sscanf($maxfile, 'logs/log_%d.txt', $number);

	$myFile = "logs/log_" . ($number) . ".txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	$stringData =$_POST['logcontent'] ;
	fwrite($fh, date('m/d/Y H:i:s', time()) . ' ' . $stringData . "\r\n");
	fclose($fh);
}

?>