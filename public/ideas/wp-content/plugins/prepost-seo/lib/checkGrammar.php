<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
{ 
die('Direct Access not permitted...'); 
}

function pps_checkGrammar()
{
	$actionSite = PPS_ACTION_SITE;
	$data = array(
		"key" => @$_POST['key'],
		"text" => @$_POST['data']
	);
	$fields = $data;
	$target = $actionSite.'frontend/checkGrammar';
	//echo $target; exit;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $target); // Define target site
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Return page in string
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // Follow redirects
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	$page = curl_exec($ch);
	echo $page;
	exit;
}