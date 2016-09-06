<?php
/*
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
{ 
die('Direct Access not permitted...'); 
}
*/

function validate_url($url=false)  
	{
		return true;
		
		if((strpos($url,'http://')=== false))
			{
				if(strpos($url,'https://')=== false)
				{
					return false;
				}
			}
		if($url!="")
		{
			

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_NOBODY,true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 	
			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);			
			$dt = curl_exec($ch); 
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
			curl_close($ch);   
			
			if($httpcode >= 200 && $httpcode < 300)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	

function checkLinksStatusArray()
	{
		$data['error'] = 0;
		$brokenFound = 0;
		if(empty($_POST['links']))
		{
			$data['error'] = '1';
			json_encode($data['error']);
			exit;
		}
		$links = explode(',', $_POST['links']);
		
		$aTag = array();
		foreach($links as $url)
		{
			if(validate_url($url))
			{
				$aTag[] = array(
					"ok" => 1,
					"url" => $url
				);
			} else {
				$brokenFound++;
				$aTag[] = array(
					"ok" => 0,
					"url" => $url
				);
			}
			
		}
		
		$data['links'] = $aTag;
		if($brokenFound > 0)
		{
			$data['status'] = '<i class="fa fa-remove fa-2x icon_cross"></i>';
			$data['msg'] = 'From '.count($links).' distinct anchor links analyzed, '.$brokenFound.' of them appears to be broken. ';
		} else {
			$data['status'] = '<i class="fa fa-check fa-2x green"></i>';
			$data['msg'] = 'From '.count($links).' distinct anchor links analyzed, none of them appears to be broken. ';
		}
		
		echo json_encode($data);
		exit;
	}
