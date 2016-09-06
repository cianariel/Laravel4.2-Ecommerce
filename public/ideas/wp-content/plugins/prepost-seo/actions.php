<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
{ 
die('Direct Access not permitted...'); 
}


if(!empty($_POST['pps_check_broken']))
{
	include_once('lib/checkbroken.php');	
	if(!empty($_POST['url']))
	{
		if(validate_url($_POST['url']))
		{
			echo 'true'; exit;
		}
	}
	echo 'false'; exit;
}

if(!empty($_POST['pps_check_status']))
{
	include_once('lib/checkstatus.php');	
	pps_checkStatus();
}

if(!empty($_POST['pps_check_density']))
{
	include_once('lib/density.php');	
	pps_checkDensity();
}

if(!empty($_POST['pps_check_plag']))
{
	include_once('lib/checkPlag.php');	
	pps_checkPlag();
}


if(!empty($_POST['pps_check_imgDetails']))
{
	include_once('lib/imgDetails.php');	
	pps_checkImageDetails();
}

if(!empty($_POST['pps_img_compress']))
{
	include_once('lib/imgDetails.php');	
	pps_compressImg();
}


if(!empty($_POST['pps_check_grammar']))
{
	include_once('lib/checkGrammar.php');	
	pps_checkGrammar();
}

if(!empty($_POST['pps_check_siteDetails']))
{
	include_once('lib/siteDetails.php');	
	pps_checkSiteSEO();
}

if(!empty($_POST['pps_check_links_array']))
{
	include('lib/checkbroken.php');	
	checkLinksStatusArray();
}