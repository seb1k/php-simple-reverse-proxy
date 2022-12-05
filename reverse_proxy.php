<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




$ip = "IP.REAL.SERVER.HERE"; // 1.2.3.4









$domain = $_SERVER['HTTP_HOST'];
$file =  substr($_SERVER['REQUEST_URI'], 1); /// ressource asked without '/' at the beginning


$ret = grab_url($ip,$domain,$file);
$url_data = $ret[0];
$url_code = $ret[1];
$url_header = $ret[2];




if ($url_code === FALSE) {
	http_response_code(500);
	die("REQUEST ERROR : $url_code");
	}



copy_header($url_header);
header('aaa-proxy-bypass:1'); // let's add a small header info to know that we use a proxy
die($url_data);






function grab_url($IP,$HTTP_HOST,$REQUEST_URI)
{

$opts = array(
    'http' => array(   "header"  => [           "Host: $HTTP_HOST"        ], 'ignore_errors' => true,'max_redirects' => '0')
	);
$context = stream_context_create($opts);
$handle = fopen( "http://$IP/$REQUEST_URI", 'r', false, $context );

$ret = stream_get_contents($handle);

$code = false;
if(is_array($http_response_header)) {
	$parts=explode(' ',$http_response_header[0]);
	if(count($parts)>1) //HTTP/1.0 <code> <text>
		$code = intval($parts[1]); //Get code
	}


return [$ret,$code,$http_response_header];
}


function copy_header($url_header)
{
for($i=0;$i<count($url_header);$i++) {
	$str=$url_header[$i];
	header($str);
	}
}
