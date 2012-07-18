<?php
require_once(dirname(__FILE__) . '/common.inc.php');
require_once(dirname(__FILE__) . '/config.php');
function fblb_getgpfeed()
{
	global $fblb_options;
	$options = $fblb_options;
	$fblbconn = mysql_connect($options['MySQL_Host'], $options['MySQL_Username'], $options['MySQL_Password']);
	mysql_select_db($options['MySQL_Database'], $fblbconn);
	$GPlusID=$options['GP_PageID'];
	if (!$GPlusID)
	{
		return false;
	}
	$UserAgentList[] = "Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux i686; en) Opera 8.01";
	$UserAgentList[] = "Mozilla/5.0 (compatible; Konqueror/3.3; Linux) (KHTML, like Gecko)";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.121 Safari/535.2";
	$UserAgentList[] = "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9.2.25) Gecko/20111212 Firefox/3.6.25";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/534.52.7 (KHTML, like Gecko) Version/5.1.2 Safari/534.52.7";
	$UserAgentList[] = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; Win64; x64; SV1; .NET CLR 2.0.50727)";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7";
	$Url = 'https://plus.google.com/_/stream/getactivities/' . $GPlusID . '/?sp=[1,2,"' . $GPlusID . '",null,null,null,null,"social.google.com",[]]&rt=j';
	$hcurl = curl_init();
	curl_setopt($hcurl, CURLOPT_URL, $Url);
	curl_setopt($hcurl, CURLOPT_USERAGENT, $UserAgentList[array_rand($UserAgentList)]);
	curl_setopt($hcurl, CURLOPT_TIMEOUT, 60);
	curl_setopt($hcurl, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($hcurl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($hcurl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($hcurl);
	curl_close($hcurl);

	$result = substr($result, 5);
	$result = str_replace('[,', '[null,', $result);
	$result = str_replace(',]', ',null]', $result);
	$result = str_replace(',,', ',null,', $result);
	$result = str_replace(',,', ',null,', $result);
	$result = str_replace('{', '[', $result);
	$result = str_replace('}', ']', $result);
	//$result = str_replace('26807950:', '', $result);
	//$result = preg_replace('/\[(\d+):/', '["$1":', $result);
	$result = preg_replace('/\[(\d+):/', '[', $result);
	//echo $result;
	$Aresult = json_decode($result);
	$Aposts = $Aresult[0][0][1][0];
	//echo '<pre>';
	//print_r($Aposts);
	foreach ((array) $Aposts as $v)
	{
	//	print_r($v);
		$desc = '';
		if ($v[4])
		{
			$desc = $desc . $v[4];
		}
		if (is_array($v[44]))
		{
			$desc = $desc . ' <a target="_blank" href="https://plus.google.com/' . $v[44][1] . '">' . $post[44][0] . '</a>';
		}
		if (is_array($v[66][0]) && $v[66][0][1] && $v[66][0][3])
		{
			$desc = $desc . ' <a href="' . $v[66][0][1] . '" target="_blank">' . $v[66][0][3] . '</a>';
		}
		if ($desc)
		{
			mysql_query("REPLACE INTO `".$options['MySQL_Prefix']."arscode_gp` SET 
			`id`='".addslashes($v[21])."',
			`datetime`='".addslashes(date('Y-m-d H:i:s', $v[5] / 1000))."',
			`desc`='".addslashes($desc)."',
			`plus`='".addslashes($v[73][16])."'
			",$fblbconn);
		}
	}
	echo 'G+: DONE<br />';
}
fblb_getgpfeed();
?>