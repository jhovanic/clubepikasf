<?php
error_reporting(E_ALL ^ E_NOTICE);
define('FBLB_CONFIG', 1);
require(dirname(__FILE__) . '/config.php');
require(dirname(__FILE__) . '/fblbconfig.inc.php');
if(isset($_GET['installdb']))
{	
	function fblb_install_db()
	{
		$r=array();
		$fblbconn = mysql_connect($_REQUEST['MySQL_Host'], $_REQUEST['MySQL_Username'], $_REQUEST['MySQL_Password']);
		if (!$fblbconn) 
		{
			echo json_encode(array('error' => mysql_error()));
			return;
		}
		$db_selected = mysql_select_db($_REQUEST['MySQL_Database'], $fblbconn);
		if (!$db_selected) 
		{
			echo json_encode(array('error' => mysql_error()));
			return;
		}
		$table_name = $_REQUEST['MySQL_Prefix'] . "arscode_gp";
		$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . "  (
		  `id` varchar(255) NOT NULL,
		  `datetime` datetime NOT NULL,
		  `desc` text NOT NULL,
		  `plus` int(11) NOT NULL,
		   UNIQUE KEY `id` (`id`)
		  )  DEFAULT CHARSET=utf8;";
		mysql_query($sql,$fblbconn);
		if( mysql_error())
		{
			echo json_encode(array('error' => mysql_error()));
			return;
		}
		else
		{
			echo json_encode(array('ok' => 1));
		}
		return;
	}
	fblb_install_db();
	exit;
}
if(!count($_POST) && !count($_GET))
{
	$options=$fblb_options;
}
global $FBLB_Presets;
if (($_POST['Config'] || ($_GET['Preset'] && $_GET['submit'])))
{
	if ($_GET['Preset'] && $_GET['submit'])
	{
		$_POST = array_merge((array)$_POST,(array)$fblb_options,(array)$FBLB_Presets[$_GET['Preset']]['Options']);
	}
	//print_r($_POST);
	// Facebook
	if (isset($_POST['Enable']))
	{
		$options['Enable'] = $_POST['Enable'];
	}
	if (isset($_POST['FacebookPageURL']))
	{
		$options['FacebookPageURL'] = $_POST['FacebookPageURL'];
	}
	if (isset($_POST['Width']) && intval($_POST['Width']))
	{
		$options['Width'] = $_POST['Width'];
	}
	if (isset($_POST['Height']) && intval($_POST['Height']))
	{
		$options['Height'] = $_POST['Height'];
	}
	if (isset($_POST['ShowFaces']))
	{
		$options['ShowFaces'] = $_POST['ShowFaces'];
	}
	if (isset($_POST['ShowStream']))
	{
		$options['ShowStream'] = $_POST['ShowStream'];
	}
	if (isset($_POST['ForceWall']))
	{
		$options['ForceWall'] = $_POST['ForceWall'];
	}
	if (isset($_POST['ShowHeader']))
	{
		$options['ShowHeader'] = $_POST['ShowHeader'];
	}
	if (isset($_POST['Position']))
	{
		$options['Position'] = $_POST['Position'];
	}
	if (isset($_POST['TabPosition']))
	{
		$options['TabPosition'] = $_POST['TabPosition'];
	}
	if (isset($_POST['TabPositionPx']) && intval($_POST['TabPositionPx']))
	{
		$options['TabPositionPx'] = $_POST['TabPositionPx'];
	}
	if (isset($_POST['TabDesign']))
	{
		$options['TabDesign'] = $_POST['TabDesign'];
	}
	if (isset($_POST['Border']) && intval($_POST['Border']))
	{
		$options['Border'] = $_POST['Border'];
	}
	if (isset($_POST['BorderColor']))
	{
		$options['BorderColor'] = $_POST['BorderColor'];
	}
	if (isset($_POST['BackgroundColor']))
	{
		$options['BackgroundColor'] = $_POST['BackgroundColor'];
	}
	if (isset($_POST['Locale']))
	{
		$options['Locale'] = $_POST['Locale'];
	}
	if (isset($_POST['ColorScheme']))
	{
		$options['ColorScheme'] = $_POST['ColorScheme'];
	}
	if (isset($_POST['VPosition']))
	{
		$options['VPosition'] = $_POST['VPosition'];
	}
	if (isset($_POST['VPositionPx']) && intval($_POST['VPositionPx']))
	{
		$options['VPositionPx'] = $_POST['VPositionPx'];
	}
	if (isset($_POST['ZIndex']) && intval($_POST['ZIndex']))
	{
		$options['ZIndex'] = $_POST['ZIndex'];
	}
	// Twitter
	if (isset($_POST['TW_Enable']))
	{
		$options['TW_Enable'] = $_POST['TW_Enable'];
	}
	if (isset($_POST['TW_Username']))
	{
		$options['TW_Username'] = $_POST['TW_Username'];
	}
	if (isset($_POST['TW_Width']) && intval($_POST['TW_Width']))
	{
		$options['TW_Width'] = $_POST['TW_Width'];
	}
	if (isset($_POST['TW_Height']) && intval($_POST['TW_Height']))
	{
		$options['TW_Height'] = $_POST['TW_Height'];
	}
	if (isset($_POST['TW_ShowFollowButton']))
	{
		$options['TW_ShowFollowButton'] = $_POST['TW_ShowFollowButton'];
	}
	if (isset($_POST['TW_Position']))
	{
		$options['TW_Position'] = $_POST['TW_Position'];
	}
	if (isset($_POST['TW_TabPosition']))
	{
		$options['TW_TabPosition'] = $_POST['TW_TabPosition'];
	}
	if (isset($_POST['TW_TabPositionPx']) && intval($_POST['TW_TabPositionPx']))
	{
		$options['TW_TabPositionPx'] = $_POST['TW_TabPositionPx'];
	}
	if (isset($_POST['TW_TabDesign']))
	{
		$options['TW_TabDesign'] = $_POST['TW_TabDesign'];
	}
	if (isset($_POST['TW_Border']) && intval($_POST['TW_Border']))
	{
		$options['TW_Border'] = $_POST['TW_Border'];
	}
	if (isset($_POST['TW_BorderColor']))
	{
		$options['TW_BorderColor'] = $_POST['TW_BorderColor'];
	}
	if (isset($_POST['TW_ShellBackground']))
	{
		$options['TW_ShellBackground'] = $_POST['TW_ShellBackground'];
	}
	if (isset($_POST['TW_ShellText']))
	{
		$options['TW_ShellText'] = $_POST['TW_ShellText'];
	}
	if (isset($_POST['TW_TweetBackground']))
	{
		$options['TW_TweetBackground'] = $_POST['TW_TweetBackground'];
	}
	if (isset($_POST['TW_TweetText']))
	{
		$options['TW_TweetText'] = $_POST['TW_TweetText'];
	}
	if (isset($_POST['TW_Links']))
	{
		$options['TW_Links'] = $_POST['TW_Links'];
	}
	if (isset($_POST['TW_VPosition']))
	{
		$options['TW_VPosition'] = $_POST['TW_VPosition'];
	}
	if (isset($_POST['TW_VPositionPx']) && intval($_POST['TW_VPositionPx']))
	{
		$options['TW_VPositionPx'] = $_POST['TW_VPositionPx'];
	}
	if (isset($_POST['TW_ZIndex']) && intval($_POST['TW_ZIndex']))
	{
		$options['TW_ZIndex'] = $_POST['TW_ZIndex'];
	}
	if (isset($_POST['TW_live']))
	{
		$options['TW_live'] = $_POST['TW_live'];
	}
	if (isset($_POST['TW_behavior']))
	{
		$options['TW_behavior'] = $_POST['TW_behavior'];
	}
	if (isset($_POST['TW_loop']))
	{
		$options['TW_loop'] = $_POST['TW_loop'];
	}
	if (isset($_POST['TW_interval']) && intval($_POST['TW_interval']))
	{
		$options['TW_interval'] = $_POST['TW_interval'];
	}
	if (isset($_POST['TW_rpp']) && intval($_POST['TW_rpp']))
	{
		$options['TW_rpp'] = $_POST['TW_rpp'];
	}
	if (isset($_POST['TW_Language']))
	{
		$options['TW_Language'] = $_POST['TW_Language'];
	}
	// Google Plus
	if (isset($_POST['GP_Enable']))
	{
		$options['GP_Enable'] = $_POST['GP_Enable'];
	}
	if (isset($_POST['GP_PageID']))
	{
		$options['GP_PageID'] = $_POST['GP_PageID'];
	}
	if (isset($_POST['GP_ShowFeed']))
	{
		$options['GP_ShowFeed'] = $_POST['GP_ShowFeed'];
	}
	if (isset($_POST['GP_Width']) && intval($_POST['GP_Width']))
	{
		$options['GP_Width'] = $_POST['GP_Width'];
	}
	if (isset($_POST['GP_Height']) && intval($_POST['GP_Height']))
	{
		$options['GP_Height'] = $_POST['GP_Height'];
	}
	if (isset($_POST['GP_Position']))
	{
		$options['GP_Position'] = $_POST['GP_Position'];
	}
	if (isset($_POST['GP_TabPosition']))
	{
		$options['GP_TabPosition'] = $_POST['GP_TabPosition'];
	}
	if (isset($_POST['GP_TabPositionPx']) && intval($_POST['GP_TabPositionPx']))
	{
		$options['GP_TabPositionPx'] = $_POST['GP_TabPositionPx'];
	}
	if (isset($_POST['GP_TabDesign']))
	{
		$options['GP_TabDesign'] = $_POST['GP_TabDesign'];
	}
	if (isset($_POST['GP_Border']) && intval($_POST['GP_Border']))
	{
		$options['GP_Border'] = $_POST['GP_Border'];
	}
	if (isset($_POST['BorderColor']))
	{
		$options['GP_BorderColor'] = $_POST['GP_BorderColor'];
	}
	if (isset($_POST['GP_BackgroundColor']))
	{
		$options['GP_BackgroundColor'] = $_POST['GP_BackgroundColor'];
	}

	if (isset($_POST['GP_VPosition']))
	{
		$options['GP_VPosition'] = $_POST['GP_VPosition'];
	}
	if (isset($_POST['GP_VPositionPx']) && intval($_POST['GP_VPositionPx']))
	{
		$options['GP_VPositionPx'] = $_POST['GP_VPositionPx'];
	}
	if (isset($_POST['GP_ZIndex']) && intval($_POST['GP_ZIndex']))
	{
		$options['GP_ZIndex'] = $_POST['GP_ZIndex'];
	}
	if (isset($_POST['GP_Language']))
	{
		$options['GP_Language'] = $_POST['GP_Language'];
	}
	
	// YouTube
	if (isset($_POST['YT_Enable']))
	{
		$options['YT_Enable'] = $_POST['YT_Enable'];
	}
	if (isset($_POST['YT_Channel']))
	{
		$options['YT_Channel'] = $_POST['YT_Channel'];
	}
	if ($_POST['YT_Position'])
		$options['YT_Position'] = $_POST['YT_Position'];
	if ($_POST['YT_TabPosition'])
		$options['YT_TabPosition'] = $_POST['YT_TabPosition'];
	if (isset($_POST['YT_TabPositionPx']) && intval($_POST['YT_TabPositionPx']))
		$options['YT_TabPositionPx'] = $_POST['YT_TabPositionPx'];
	if ($_POST['YT_TabDesign'])
		$options['YT_TabDesign']  = $_POST['YT_TabDesign'];
	if ($_POST['YT_Width'])
		$options['YT_Width'] = $_POST['YT_Width'];
	if ($_POST['YT_Height'])
		$options['YT_Height']  = $_POST['YT_Height'];
	if ($_POST['YT_Border'])
		$options['YT_Border'] = $_POST['YT_Border'];
	if ($_POST['YT_BorderColor'])
		$options['YT_BorderColor'] = $_POST['YT_BorderColor'];
	if ($_POST['YT_BackgroundColor'])
		$options['YT_BackgroundColor']  = $_POST['YT_BackgroundColor'];
	if ($_POST['YT_VPosition'])
		$options['YT_VPosition'] = $_POST['YT_VPosition'];
	if (isset($_POST['YT_VPositionPx']) && intval($_POST['YT_VPositionPx']))
		$options['YT_VPositionPx'] = $_POST['YT_VPositionPx'];
	if ($_POST['YT_ZIndex'])
		$options['YT_ZIndex']  = $_POST['YT_ZIndex'];
	
	// LinkedIn
	if (isset($_POST['LI_Enable']))
		$options['LI_Enable'] = $_POST['LI_Enable'];
	if (isset($_POST['LI_ShowPublicProfile']))
		$options['LI_ShowPublicProfile'] = $_POST['LI_ShowPublicProfile'];
	if (isset($_POST['LI_ShowCompanyProfile']))
		$options['LI_ShowCompanyProfile'] = $_POST['LI_ShowCompanyProfile'];
	if (isset($_POST['LI_PublicProfile']))
		$options['LI_PublicProfile'] = $_POST['LI_PublicProfile'];
	if (isset($_POST['LI_CompanyID']))
		$options['LI_CompanyID'] = $_POST['LI_CompanyID'];
	if (isset($_POST['LI_Order']))
		$options['LI_Order'] = $_POST['LI_Order'];
	if ($_POST['LI_Position'])
		$options['LI_Position'] = $_POST['LI_Position'];
	if ($_POST['LI_TabPosition'])
		$options['LI_TabPosition'] = $_POST['LI_TabPosition'];
	if (isset($_POST['LI_TabPositionPx']) && intval($_POST['LI_TabPositionPx']))
		$options['LI_TabPositionPx'] = $_POST['LI_TabPositionPx'];
	if ($_POST['LI_TabDesign'])
		$options['LI_TabDesign']  = $_POST['LI_TabDesign'];
	if ($_POST['LI_Width'])
		$options['LI_Width'] = $_POST['LI_Width'];
	if ($_POST['LI_Height'])
		$options['LI_Height']  = $_POST['LI_Height'];
	if ($_POST['LI_Border'])
		$options['LI_Border'] = $_POST['LI_Border'];
	if ($_POST['LI_BorderColor'])
		$options['LI_BorderColor'] = $_POST['LI_BorderColor'];
	if ($_POST['LI_BackgroundColor'])
		$options['LI_BackgroundColor']  = $_POST['LI_BackgroundColor'];
	if ($_POST['LI_VPosition'])
		$options['LI_VPosition'] = $_POST['LI_VPosition'];
	if (isset($_POST['LI_VPositionPx']) && intval($_POST['LI_VPositionPx']))
		$options['LI_VPositionPx'] = $_POST['LI_VPositionPx'];
	if ($_POST['LI_ZIndex'])
		$options['LI_ZIndex']  = $_POST['LI_ZIndex'];
	// Advanced
	if (isset($_POST['DisableByGetParamN']))
	{
		$options['DisableByGetParamN'] = $_POST['DisableByGetParamN'];
	}
	if (isset($_POST['DisableByGetParamV']))
	{
		$options['DisableByGetParamV'] = $_POST['DisableByGetParamV'];
	}
	if (isset($_POST['MySQL_Host']))
	{
		$options['MySQL_Host'] = $_POST['MySQL_Host'];
	}
	if (isset($_POST['MySQL_Database']))
	{
		$options['MySQL_Database'] = $_POST['MySQL_Database'];
	}
	if (isset($_POST['MySQL_Username']))
	{
		$options['MySQL_Username'] = $_POST['MySQL_Username'];
	}
	if (isset($_POST['MySQL_Password']))
	{
		$options['MySQL_Password'] = $_POST['MySQL_Password'];
	}
	if (isset($_POST['MySQL_Prefix']))
	{
		$options['MySQL_Prefix'] = $_POST['MySQL_Prefix'];
	}
	$fblb_options=$options;
}
if ($_GET['preview'] && $_GET['Preset'])
{
	if ($FBLB_Presets[$_GET['Preset']])
	{
		global $fblb_preview_options;
		$fblb_preview_options = $fblb_options;
		if (!$fblb_preview_options['FacebookPageURL'])
			$fblb_preview_options['FacebookPageURL'] = 'http://www.facebook.com/facebook';
		if (!$fblb_preview_options['TW_Username'])
			$fblb_preview_options['TW_Username'] = 'twitter';
		if (!$fblb_preview_options['GP_PageID'])
			$fblb_preview_options['GP_PageID'] = '104629412415657030658';
		if (!$fblb_preview_options['YT_Channel'])
			$fblb_preview_options['YT_Channel'] = 'jwcfree';
		if (!$fblb_preview_options['Locale'])
			$fblb_preview_options['Locale'] = 'en_US';
		if (!$fblb_preview_options['ZIndex'])
			$fblb_preview_options['ZIndex'] = 1000;
		if (!$fblb_preview_options['TW_ZIndex'])
			$fblb_preview_options['TW_ZIndex'] = 1000;
		if (!$fblb_preview_options['TW_Language'])
			$fblb_preview_options['TW_Language'] = 'en';
		if (!$fblb_preview_options['GP_ZIndex'])
			$fblb_preview_options['GP_ZIndex'] = 1000;
		if (!$fblb_preview_options['GP_Language'])
			$fblb_preview_options['GP_Language'] = 'en-US';
		if (!$fblb_preview_options['LI_PublicProfile'])
			$fblb_preview_options['LI_PublicProfile'] = 'http://www.linkedin.com/in/collis';
		if (!$fblb_preview_options['LI_CompanyID'])
			$fblb_preview_options['LI_CompanyID'] = '589883';
		$fblb_preview_options = array_merge((array) $fblb_preview_options, (array) $FBLB_Presets[$_GET['Preset']]['Options']);
	}
}
if ($_POST['preview'] && $_POST['Config'])
{
	global $fblb_preview_options;
	$fblb_preview_options = $options;
}
else
{
	$options = $fblb_options;	
}
// Facebook
if (!$options['Position'])
	$options['Position'] = 'Left';
if (!$options['TabPosition'])
	$options['TabPosition'] = 'Top';
if (!$options['TabDesign'])
	$options['TabDesign'] = 7;
if (!$options['Width'])
	$options['Width'] = 300;
if (!$options['Height'])
	$options['Height'] = 450;
if (!$options['Border'])
	$options['Border'] = 5;
if (!$options['BorderColor'])
	$options['BorderColor'] = '#3b5998';
if (!$options['BackgroundColor'])
	$options['BackgroundColor'] = '#ffffff';
if (!$options['ColorScheme'])
	$options['ColorScheme'] = 'light';
if (!$options['VPosition'])
	$options['VPosition'] = 'Middle';
if (!$options['Locale'])
	$options['Locale'] = 'en_US';
if (!$options['ZIndex'])
	$options['ZIndex'] = 1000;
// Twitter
if (!$options['TW_Position'])
	$options['TW_Position'] = 'Left';
if (!$options['TW_TabPosition'])
	$options['TW_TabPosition'] = 'Middle';
if (!$options['TW_TabDesign'])
	$options['TW_TabDesign'] = 7;
if (!$options['TW_Width'])
	$options['TW_Width'] = 300;
if (!$options['TW_Height'])
	$options['TW_Height'] = 450;
if (!$options['TW_Border'])
	$options['TW_Border'] = 5;
if (!$options['TW_BorderColor'])
	$options['TW_BorderColor'] = '#33ccff';
if (!$options['TW_ShellBackground'])
	$options['TW_ShellBackground'] = '#33ccff';
if (!$options['TW_ShellText'])
	$options['TW_ShellText'] = '#ffffff';
if (!$options['TW_TweetBackground'])
	$options['TW_TweetBackground'] = '#ffffff';
if (!$options['TW_TweetText'])
	$options['TW_TweetText'] = '#000000';
if (!$options['TW_Links'])
	$options['TW_Links'] = '#47a61e';
if (!$options['TW_VPosition'])
	$options['TW_VPosition'] = 'Middle';
if (!$options['TW_behavior'])
	$options['TW_behavior'] = 'all';
if (!$options['TW_interval'])
	$options['TW_interval'] = 30;
if (!$options['TW_rpp'])
	$options['TW_rpp'] = 4;
if (!$options['TW_ZIndex'])
	$options['TW_ZIndex'] = 1000;
if (!$options['TW_Language'])
	$options['TW_Language'] = 'en';
// Google Plus
if (!$options['GP_Position'])
	$options['GP_Position'] = 'Left';
if (!$options['GP_TabPosition'])
	$options['GP_TabPosition'] = 'Bottom';
if (!$options['GP_TabDesign'])
	$options['GP_TabDesign'] = 7;
if (!$options['GP_Width'])
	$options['GP_Width'] = 300;
if (!$options['GP_Height'])
	$options['GP_Height'] = 450;
if (!$options['GP_Border'])
	$options['GP_Border'] = 5;
if (!$options['GP_BorderColor'])
	$options['GP_BorderColor'] = '#000000';
if (!$options['GP_BackgroundColor'])
	$options['GP_BackgroundColor'] = '#000000';
if (!$options['GP_VPosition'])
	$options['GP_VPosition'] = 'Middle';
if (!$options['GP_ZIndex'])
	$options['GP_ZIndex'] = 1000;
if (!$options['GP_Language'])
	$options['GP_Language'] = 'en-US';
// YouTube
if (!$options['YT_Position'])
	$options['YT_Position'] = 'Left';
if (!$options['YT_TabPosition'])
	$options['YT_TabPosition'] = 'Bottom';
if (!$options['YT_TabDesign'])
	$options['YT_TabDesign'] = 7;
if (!$options['YT_Width'])
	$options['YT_Width'] = 300;
if (!$options['YT_Height'])
	$options['YT_Height'] = 450;
if (!$options['YT_Border'])
	$options['YT_Border'] = 5;
if (!$options['YT_BorderColor'])
	$options['YT_BorderColor'] = '#9b9b9b';
if (!$options['YT_BackgroundColor'])
	$options['YT_BackgroundColor'] = '#ffffff';
if (!$options['YT_VPosition'])
	$options['YT_VPosition'] = 'Middle';
if (!$options['YT_ZIndex'])
	$options['YT_ZIndex'] = 1000;
// LinkedIn
if (!$options['LI_Order'])
	$options['LI_Order'] = 1;
if (!$options['LI_Position'])
	$options['LI_Position'] = 'Left';
if (!$options['LI_TabPosition'])
	$options['LI_TabPosition'] = 'Bottom';
if (!$options['LI_TabDesign'])
	$options['LI_TabDesign'] = 1;
if (!$options['LI_Width'])
	$options['LI_Width'] = 300;
if (!$options['LI_Height'])
	$options['LI_Height'] = 450;
if (!$options['LI_Border'])
	$options['LI_Border'] = 5;
if (!$options['LI_BorderColor'])
	$options['LI_BorderColor'] = '#007fb1';
if (!$options['LI_BackgroundColor'])
	$options['LI_BackgroundColor'] = '#ffffff';
if (!$options['LI_VPosition'])
	$options['LI_VPosition'] = 'Middle';
if (!$options['LI_ZIndex'])
	$options['LI_ZIndex'] = 1000;
$OptionsList=array(
'Enable',
'FacebookPageURL',
'Width',
'Height',
'ShowFaces',
'ShowStream',
'ForceWall',
'ShowHeader',
'Position',
'TabPosition',
'TabPositionPx',
'TabDesign',
'Border',
'BorderColor',
'BackgroundColor',
'Locale',
'ColorScheme',
'VPosition',
'VPositionPx',
'ZIndex',
'TW_Enable',
'TW_Username',
'TW_Width',
'TW_Height',
'TW_ShowFollowButton',
'TW_Position',
'TW_TabPosition',
'TW_TabPositionPx',
'TW_TabDesign',
'TW_Border',
'TW_BorderColor',
'TW_ShellBackground',
'TW_ShellText',
'TW_TweetBackground',
'TW_TweetText',
'TW_Links',
'TW_VPosition',
'TW_VPositionPx',
'TW_ZIndex',
'TW_live',
'TW_behavior',
'TW_loop',
'TW_interval',
'TW_rpp',
'TW_Language',
'GP_Enable',
'GP_PageID',
'GP_ShowFeed',
'GP_Width',
'GP_Height',
'GP_Position',
'GP_TabPosition',
'GP_TabPositionPx',
'GP_TabDesign',
'GP_Border',
'GP_BorderColor',
'GP_BackgroundColor',
'GP_VPosition',
'GP_VPositionPx',
'GP_ZIndex',
'GP_Language',
'YT_Enable',
'YT_Channel',
'YT_Position',
'YT_TabPosition',
'YT_TabPositionPx',
'YT_TabDesign',
'YT_Width',
'YT_Height',
'YT_Border',
'YT_BorderColor',
'YT_BackgroundColor',
'YT_VPosition',
'YT_VPositionPx',
'YT_ZIndex',
'LI_Enable',
'LI_ShowPublicProfile',
'LI_ShowCompanyProfile',
'LI_PublicProfile',
'LI_CompanyID',
'LI_Order',
'LI_Position',
'LI_TabPosition',
'LI_TabPositionPx',
'LI_TabDesign',
'LI_Width',
'LI_Height',
'LI_Border',
'LI_BorderColor',
'LI_BackgroundColor',
'LI_VPosition',
'LI_VPositionPx',
'LI_ZIndex',
'DisableByGetParamN',
'DisableByGetParamV',
'MySQL_Host',
'MySQL_Database',
'MySQL_Username',
'MySQL_Password',
'MySQL_Prefix'	
);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl">
	<head>
		<title></title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="Description" content="" />
		<meta name="Keywords" content="" />
		<meta name="Author" content="" />
		<link rel="stylesheet" media="screen" href="install.css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<link rel="stylesheet" href="colorpicker.css" media="all" />
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="js/colorpicker.js"></script>
		<link rel="stylesheet" media="screen" href="ui-smoothness/jquery-ui-1.8.16.custom.css"/>
		<!-- arscode slider slider -->
		<link rel="stylesheet" media="screen" href="fblb.css"/>
		<!--[if lte IE 7]>
		<link rel="stylesheet" media="screen" href="ie7.css" />
		<![endif]-->
		<script type="text/javascript" src="js/userscripts.js"></script>
		<!--[if lte IE 7]>
			<script type="text/javascript" src="js/userscripts-ie7.js"></script>
		<![endif]-->
		<!-- arscode slider slider END -->
		
	</head>
<body>	
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2>Social Slider</h2>
	
	
		<?php
	if ($_POST['submit'] || $_GET['submit'])
	{
		echo '<div style="border: 1px solid #e4e4e4; padding: 25px;">';
		$code='';
		$code.='<?php'."\n";
		foreach($OptionsList as $o)
		{
			$code.='$fblb_options[\''.$o.'\'] = \''.$options[$o].'\';'."\n";
		}
		$code.='?>';
		if(is_writable('config.php') && file_put_contents ('config.php', $code))
		{
			echo 'Settings saved into <strong>config.php</strong>.<br />';
			echo '<span style="color: #cc0000;">Please, remove <strong>install.php</strong> from your server and make sure config.php file isn\'t writable.</span><br />';
		}
		else
		{
			echo 'Sorry, but I can\'t write the <strong>config.php</strong> file.<br />';
			echo 'You can create the <strong>config.php</strong> manually and paste the following text into it.<br />';
			echo '<span style="color: #cc0000;">Please, remove <strong>install.php</strong> from your server and make sure config.php file isn\'t writable.</span><br /><br />';
			echo '<textarea onClick="this.focus();this.select();" rows="15" cols="120">';
			echo htmlspecialchars($code);
			echo '</textarea>';
		}
		echo '<br /><br />';
		echo 'Below is an example - how to insert code into your site:<br />';
		echo '<pre>';
		echo htmlspecialchars('<html>
	<head>
		...
',true);
		echo htmlspecialchars('		<!-- jquery - add only if your site don\'t use jquery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
			jQuery.noConflict();
		</script>
		<!-- END jquery -->',true);
		echo '<br />';
		echo htmlspecialchars('		<!-- arscode social slider -->
		<link rel="stylesheet" media="screen" href="arscode-social-slider/fblb.css"/>
		<!--[if lte IE 7]>
		<link rel="stylesheet" media="screen" href="arscode-social-slider/ie7.css?ver=3.2.1" />
		<![endif]-->
		<script type="text/javascript" src="arscode-social-slider/js/userscripts.js"></script>
		<!--[if lte IE 7]>
			<script type="text/javascript" src="arscode-social-slider/js/userscripts-ie7.js"></script>
		<![endif]-->
		<!-- END arscode social slider -->',true);
		echo htmlspecialchars('
	</head>
	<body>
		...',true);
		echo '<br />';
		echo htmlspecialchars("		<?php require_once('arscode-social-slider/arscode-social-slider.php');	?>
",true);
		echo htmlspecialchars('	</body>
</html>
',true);
	echo '</pre>';
	echo '</div>';
	}
	?>

	<form id="SSForm" method="post" action="install.php">
		<input type="hidden" name="Config" value="1" />
		<div id="STabs">
			<ul>
				<li><a href="#STabsFb"><strong>Facebook</strong></a></li>
				<li><a href="#STabsTw"><strong>Twitter</strong></a></li>
				<li><a href="#STabsGp"><strong>Google Plus</strong></a></li>
				<li><a href="#STabsYt"><strong>YouTube</strong></a></li>
				<li><a href="#STabsLi"><strong>LinkedIn</strong></a></li>
				<li><a href="#STabsMySQL"><strong>MySQL</strong></a></li>
				<li><a href="#STabsAdw"><strong>Advanced</strong></a></li>
				<li style="float: right;"><a href="#STabsPresets"><strong>Settings Examples</strong></a></li>
			</ul>

			<div id="STabsFb">
				<h3>Facebook</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable Likebox</span></legend>
									<label for="Enable">
										<input name="Enable" <?php echo  ($options['Enable'] ? 'checked' : '' ) ?> type="checkbox" id="Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="FacebookPageURL">Facebook Page URL</label></th>
							<td><input name="FacebookPageURL" type="text" id="FacebookPageURL" value="<?php echo  $options['FacebookPageURL'] ?>" class="regular-text" /></td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="Width">Width</label></th>
							<td><input name="Width" type="text" id="Width" value="<?php echo  $options['Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="Height">Height</label></th>
							<td><input name="Height" type="text" id="Height" value="<?php echo  $options['Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show faces</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show faces</span></legend>
									<label for="ShowFaces">
										<input name="ShowFaces" <?php echo  ($options['ShowFaces'] ? 'checked' : '' ) ?> type="checkbox" id="ShowFaces" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show stream</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show stream</span></legend>
									<label for="ShowStream">
										<input name="ShowStream" <?php echo  ($options['ShowStream'] ? 'checked' : '' ) ?> type="checkbox" id="ShowStream" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Force wall</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Force wall</span></legend>
									<label for="ForceWall">
										<input name="ForceWall" <?php echo  ($options['ForceWall'] ? 'checked' : '' ) ?> type="checkbox" id="ForceWall" value="1" />
									</label>
								</fieldset>
								(for Places, specifies whether the stream contains posts from the Place's wall or just checkins from friends)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show header</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show header</span></legend>
									<label for="ShowHeader">
										<input name="ShowHeader" <?php echo  ($options['ShowHeader'] ? 'checked' : '' ) ?> type="checkbox" id="ShowHeader" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="PositionLeft">
										<input name="Position" <?php echo  ($options['Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="PositionLeft" value="Left" />
										left
									</label>
									<label for="PositionRight">
										<input name="Position" <?php echo  ($options['Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="VPositionMiddle">
										<input name="VPosition" <?php echo  ($options['VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="VPositionFixed">
										<input name="VPosition" <?php echo  ($options['VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="VPositionPx" type="text" id="VPositionPx" value="<?php echo  $options['VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="TabPositionTop">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="TabPositionTop" value="Top" />
										top
									</label>
									<label for="TabPositionMiddle">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="TabPositionBottom">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="TabPositionFixed">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="TabPositionPx" type="text" id="TabPositionPx" value="<?php echo  $options['TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="TabDesign1">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="TabDesign1" value="1" />
										<img src="<?php echo  'img/fb1-left.png'; ?>" />
									</label>
									<label for="TabDesign2">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="TabDesign2" value="2" />
										<img src="<?php echo  'img/fb2-left.png'; ?>" />
									</label>
									<label for="TabDesign3">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="TabDesign3" value="3" />
										<img src="<?php echo  'img/fb3-left.png'; ?>" />
									</label>
									<label for="TabDesign4">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 4 ? 'checked' : '' ) ?> type="radio" id="TabDesign4" value="4" />
										<img src="<?php echo  'img/fb4-left.png'; ?>" />
									</label>
									<label for="TabDesign5">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 5 ? 'checked' : '' ) ?> type="radio" id="TabDesign5" value="5" />
										<img src="<?php echo  'img/fb5-left.png'; ?>" />
									</label>
									<label for="TabDesign6">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 6 ? 'checked' : '' ) ?> type="radio" id="TabDesign6" value="6" />
										<img src="<?php echo  'img/fb6-left.png'; ?>" />
									</label>
									<br/>
									<label for="TabDesign7">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="TabDesign7" value="7" />
										<img src="<?php echo  'img/fb7-left.png'; ?>" />
									</label>
									<label for="TabDesign8">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="TabDesign8" value="8" />
										<img src="<?php echo  'img/fb8-left.png'; ?>" />
									</label>
									<label for="TabDesign9">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="TabDesign9" value="9" />
										<img src="<?php echo  'img/fb9-left.png'; ?>" />
									</label>
									<label for="TabDesign11">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="TabDesign11" value="11" />
										<img src="<?php echo 'img/fb11-left.png'; ?>" />
									</label>
									<label for="TabDesign12">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="TabDesign12" value="12" />
										<img src="<?php echo 'img/fb12-left.png'; ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="Border">Border width</label></th>
							<td><input name="Border" type="text" id="Border" value="<?php echo  $options['Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="BorderColor" type="text" id="BorderColor" value="<?php echo  $options['BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #3b5998)
								<div id="BorderColorPreview" style="background-color: <?php echo  $options['BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="BackgroundColor" type="text" id="BackgroundColor" value="<?php echo  $options['BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #ffffff for light color scheme, #333333 for dark color scheme)
								<div id="BackgroundColorPreview" style="background-color: <?php echo  $options['BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Color Scheme</th>
							<td> 
								<fieldset>
									<label for="ColorSchemelight">
										<input name="ColorScheme" <?php echo  ($options['ColorScheme'] == 'light' ? 'checked' : '' ) ?> type="radio" id="ColorSchemelight" value="light" />
										light
									</label>
									<label for="ColorSchemedark">
										<input name="ColorScheme" <?php echo  ($options['ColorScheme'] == 'dark' ? 'checked' : '' ) ?> type="radio" id="ColorSchemedark" value="dark" />
										dark
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="ZIndex">CSS z-index</label></th>
							<td><input name="ZIndex" type="text" id="ZIndex" value="<?php echo  $options['ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="Locale">Locale</label></th>
							<td>
								<select name="Locale" id="Locale">
								<?php
								foreach ($FB_Locales as $k => $v)
								{
									echo '<option ' . ($options['Locale'] == $k ? 'selected' : '') . ' value="' . $k . '">' . $v . '</option>';
								}
								?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="STabsTw">
				<h3>Twitter</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="TW_Enable">
										<input name="TW_Enable" <?php echo  ($options['TW_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="TW_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Username">Username</label></th>
							<td><input name="TW_Username" type="text" id="TW_Username" value="<?php echo  $options['TW_Username'] ?>" class="regular-text" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Width">Width</label></th>
							<td><input name="TW_Width" type="text" id="TW_Width" value="<?php echo  $options['TW_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Height">Height</label></th>
							<td><input name="TW_Height" type="text" id="TW_Height" value="<?php echo  $options['TW_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show follow button</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show follow button</span></legend>
									<label for="TW_ShowFollowButton">
										<input name="TW_ShowFollowButton" <?php echo  ($options['TW_ShowFollowButton'] ? 'checked' : '' ) ?> type="checkbox" id="TW_ShowFollowButton" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row">Poll for new results</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Poll for new results</span></legend>
									<label for="TW_live">
										<input name="TW_live" <?php echo  ($options['TW_live'] ? 'checked' : '' ) ?> type="checkbox" id="TW_live" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Behavior</th>
							<td> 
								<fieldset>
									<label for="TW_behaviordefaultall">
										<input name="TW_behavior" <?php echo  ($options['TW_behavior'] == 'all' ? 'checked' : '' ) ?> type="radio" id="TW_behaviordefaultall" value="all" />
										Load all tweets
									</label>
									<br />
									<label for="TW_behaviordefault">
										<input name="TW_behavior" <?php echo  ($options['TW_behavior'] == 'default' ? 'checked' : '' ) ?> type="radio" id="TW_behaviordefault" value="default" />
										Timed Interval:
									</label>
									<div style="margin-left: 80px;">
									Tweet Interval <input name="TW_interval" type="text" id="TW_interval" value="<?php echo  $options['TW_interval'] ?>" class="small-text" />
										<br />
									Loop results <input name="TW_loop" <?php echo  ($options['TW_loop'] ? 'checked' : '' ) ?> type="checkbox" id="TW_loop" value="1" />
									</div>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_rpp">Number of Tweets</label></th>
							<td><input name="TW_rpp" type="text" id="TW_rpp" value="<?php echo  $options['TW_rpp'] ?>" class="small-text" /></td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="TW_PositionLeft">
										<input name="TW_Position" <?php echo  ($options['TW_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="TW_PositionLeft" value="Left" />
										left
									</label>
									<label for="TW_PositionRight">
										<input name="TW_Position" <?php echo  ($options['TW_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="TW_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="TW_VPositionMiddle">
										<input name="TW_VPosition" <?php echo  ($options['TW_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="TW_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="TW_VPositionFixed">
										<input name="TW_VPosition" <?php echo  ($options['TW_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="TW_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="TW_VPositionPx" type="text" id="TW_VPositionPx" value="<?php echo  $options['TW_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="TW_TabPositionTop">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionTop" value="Top" />
										top
									</label>
									<label for="TW_TabPositionMiddle">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="TW_TabPositionBottom">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="TW_TabPositionFixed">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="TW_TabPositionPx" type="text" id="TW_TabPositionPx" value="<?php echo  $options['TW_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="TW_TabDesign1">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign1" value="1" />
										<img src="<?php echo  'img/tw1-left.png'; ?>" />
									</label>
									<label for="TW_TabDesign2">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign2" value="2" />
										<img src="<?php echo  'img/tw2-left.png'; ?>" />
									</label>
									<label for="TW_TabDesign3">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign3" value="3" />
										<img src="<?php echo  'img/tw3-left.png'; ?>" />
									</label>

									<label for="TW_TabDesign7">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign7" value="7" />
										<img src="<?php echo  'img/tw7-left.png'; ?>" />
									</label>
									<label for="TW_TabDesign8">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign8" value="8" />
										<img src="<?php echo  'img/tw8-left.png'; ?>" />
									</label>
									<label for="TW_TabDesign9">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign9" value="9" />
										<img src="<?php echo  'img/tw9-left.png'; ?>" />
									</label>
									<label for="TW_TabDesign11">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign11" value="11" />
										<img src="<?php echo 'img/tw11-left.png'; ?>" />
									</label>
									<label for="TW_TabDesign12">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign12" value="12" />
										<img src="<?php echo 'img/tw12-left.png'; ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Border">Border width</label></th>
							<td><input name="TW_Border" type="text" id="TW_Border" value="<?php echo  $options['TW_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="TW_BorderColor" type="text" id="TW_BorderColor" value="<?php echo  $options['TW_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #33ccff)
								<div id="TW_BorderColorPreview" style="background-color: <?php echo  $options['TW_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_ShellBackground">Shell background</label></th>
							<td>
								<input maxlength="7" name="TW_ShellBackground" type="text" id="TW_ShellBackground" value="<?php echo  $options['TW_ShellBackground'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #33ccff)
								<div id="TW_ShellBackgroundPreview" style="background-color: <?php echo  $options['TW_ShellBackground'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_ShellText">Shell text</label></th>
							<td>
								<input maxlength="7" name="TW_ShellText" type="text" id="TW_ShellText" value="<?php echo  $options['TW_ShellText'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #ffffff)
								<div id="TW_ShellTextPreview" style="background-color: <?php echo  $options['TW_ShellText'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_TweetBackground">Tweet background</label></th>
							<td>
								<input maxlength="7" name="TW_TweetBackground" type="text" id="TW_TweetBackground" value="<?php echo  $options['TW_TweetBackground'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #ffffff)
								<div id="TW_TweetBackgroundPreview" style="background-color: <?php echo  $options['TW_TweetBackground'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_TweetText">Tweet text</label></th>
							<td>
								<input maxlength="7" name="TW_TweetText" type="text" id="TW_TweetText" value="<?php echo  $options['TW_TweetText'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="TW_TweetTextPreview" style="background-color: <?php echo  $options['TW_TweetText'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Links">Links</label></th>
							<td>
								<input maxlength="7" name="TW_Links" type="text" id="TW_Links" value="<?php echo  $options['TW_Links'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #47a61e)
								<div id="TW_LinksPreview" style="background-color: <?php echo  $options['TW_Links'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>		
						<tr valign="top">
							<th scope="row"><label for="TW_ZIndex">CSS z-index</label></th>
							<td><input name="TW_ZIndex" type="text" id="TW_ZIndex" value="<?php echo  $options['TW_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Language">Language</label></th>
							<td>
								<select name="TW_Language" id="TW_Language">
								<?php
								foreach ($TW_Languages as $k => $v)
								{
									echo '<option ' . ($options['TW_Language'] == $k ? 'selected' : '') . ' value="' . $k . '">' . $v . '</option>';
								}
								?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="STabsGp">
				<h3>Google Plus</h3>
				<?php
				echo '
				<div>
					<p style="color: #CC0000;"><strong>To get Google+ feed you have to setup cronjob. Url to run:</strong>
					<a target="_blank" href="cron.php">http://yoursite.com/arscode-social-slider/cron.php</a>
					<br />
					<strong>and configure MySQL connection.</strong>
					</p>
				</div>';
				?>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="GP_Enable">
										<input name="GP_Enable" <?php echo  ($options['GP_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="GP_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_PageID">Google+ Page ID</label></th>
							<td>
								<input name="GP_PageID" maxlength="30" type="text" id="GP_PageID" value="<?php echo  $options['GP_PageID'] ?>" class="regular-text" /> <b>ID of Google Plus Page (like Facebook fanpage) not Private Profile</b>
								<br />
								(ex: 104629412415657030658 get from https://plus.google.com/<strong>104629412415657030658</strong>/posts)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Width">Width</label></th>
							<td><input name="GP_Width" type="text" id="GP_Width" value="<?php echo  $options['GP_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Height">Height</label></th>
							<td><input name="GP_Height" type="text" id="GP_Height" value="<?php echo  $options['GP_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show feed</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show feed</span></legend>
									<label for="GP_ShowFeed">
										<input name="GP_ShowFeed" <?php echo  ($options['GP_ShowFeed'] ? 'checked' : '' ) ?> type="checkbox" id="GP_ShowFeed" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="GP_PositionLeft">
										<input name="GP_Position" <?php echo  ($options['GP_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="GP_PositionLeft" value="Left" />
										left
									</label>
									<label for="GP_PositionRight">
										<input name="GP_Position" <?php echo  ($options['GP_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="GP_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="GP_VPositionMiddle">
										<input name="GP_VPosition" <?php echo  ($options['GP_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="GP_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="GP_VPositionFixed">
										<input name="GP_VPosition" <?php echo  ($options['GP_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="GP_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="GP_VPositionPx" type="text" id="GP_VPositionPx" value="<?php echo  $options['GP_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="GP_TabPositionTop">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionTop" value="Top" />
										top
									</label>
									<label for="GP_TabPositionMiddle">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="GP_TabPositionBottom">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="GP_TabPositionFixed">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="GP_TabPositionPx" type="text" id="GP_TabPositionPx" value="<?php echo  $options['GP_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="GP_TabDesign1">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign1" value="1" />
										<img src="<?php echo  'img/gp1-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign2">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign2" value="2" />
										<img src="<?php echo  'img/gp2-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign3">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign3" value="3" />
										<img src="<?php echo  'img/gp3-left.png'; ?>" />
									</label>

									<label for="GP_TabDesign7">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign7" value="7" />
										<img src="<?php echo  'img/gp7-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign8">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign8" value="8" />
										<img src="<?php echo  'img/gp8-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign9">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign9" value="9" />
										<img src="<?php echo 'img/gp9-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign11">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign11" value="11" />
										<img src="<?php echo 'img/gp11-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign12">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign12" value="12" />
										<img src="<?php echo 'img/gp12-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign13">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 13 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign13" value="13" />
										<img src="<?php echo 'img/gp13-left.png'; ?>" />
									</label>
									<label for="GP_TabDesign14">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 14 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign14" value="14" />
										<img src="<?php echo 'img/gp14-left.png'; ?>" />
									</label>

								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Border">Border width</label></th>
							<td><input name="GP_Border" type="text" id="GP_Border" value="<?php echo  $options['GP_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="GP_BorderColor" type="text" id="GP_BorderColor" value="<?php echo  $options['GP_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="GP_BorderColorPreview" style="background-color: <?php echo  $options['GP_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="GP_BackgroundColor" type="text" id="GP_BackgroundColor" value="<?php echo  $options['GP_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="GP_BackgroundColorPreview" style="background-color: <?php echo  $options['GP_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_ZIndex">CSS z-index</label></th>
							<td><input name="GP_ZIndex" type="text" id="GP_ZIndex" value="<?php echo  $options['GP_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Language">Language</label></th>
							<td>
								<select name="GP_Language" id="GP_Language">
								<?php
								foreach ($GP_Languages as $k => $v)
								{
									echo '<option ' . ($options['GP_Language'] == $k ? 'selected' : '') . ' value="' . $k . '">' . $v . '</option>';
								}
								?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			
			<div id="STabsYt">
				<h3>YouTube</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="YT_Enable">
										<input name="YT_Enable" <?php echo  ($options['YT_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="YT_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Channel">Channel</label></th>
							<td>
								<input name="YT_Channel" type="text" id="YT_Channel" value="<?php echo  $options['YT_Channel'] ?>" class="regular-text" />
								(ex: jwcfree)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Width">Width</label></th>
							<td><input name="YT_Width" type="text" id="YT_Width" value="<?php echo  $options['YT_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Height">Height</label></th>
							<td><input name="YT_Height" type="text" id="YT_Height" value="<?php echo  $options['YT_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="YT_PositionLeft">
										<input name="YT_Position" <?php echo  ($options['YT_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="YT_PositionLeft" value="Left" />
										left
									</label>
									<label for="YT_PositionRight">
										<input name="YT_Position" <?php echo  ($options['YT_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="YT_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="YT_VPositionMiddle">
										<input name="YT_VPosition" <?php echo  ($options['YT_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="YT_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="YT_VPositionFixed">
										<input name="YT_VPosition" <?php echo  ($options['YT_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="YT_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="YT_VPositionPx" type="text" id="YT_VPositionPx" value="<?php echo  $options['YT_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="YT_TabPositionTop">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionTop" value="Top" />
										top
									</label>
									<label for="YT_TabPositionMiddle">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="YT_TabPositionBottom">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="YT_TabPositionFixed">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="YT_TabPositionPx" type="text" id="YT_TabPositionPx" value="<?php echo  $options['YT_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="YT_TabDesign1">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign1" value="1" />
										<img src="<?php echo  'img/yt1-left.png'; ?>" />
									</label>
									<?php /*
									<label for="YT_TabDesign2">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign2" value="2" />
										<img src="<?php echo  'img/yt2-left.png'; ?>" />
									</label>*/?>
									<label for="YT_TabDesign3">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign3" value="3" />
										<img src="<?php echo  'img/yt3-left.png'; ?>" />
									</label>

									<label for="YT_TabDesign7">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign7" value="7" />
										<img src="<?php echo  'img/yt7-left.png'; ?>" />
									</label>
									<?php /*
									<label for="YT_TabDesign8">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign8" value="8" />
										<img src="<?php echo  'img/yt8-left.png'; ?>" />
									</label> */?>
									<label for="YT_TabDesign9">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign9" value="9" />
										<img src="<?php echo 'img/yt9-left.png'; ?>" />
									</label>
									<label for="YT_TabDesign11">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign11" value="11" />
										<img src="<?php echo 'img/yt11-left.png'; ?>" />
									</label>
									<label for="YT_TabDesign12">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign12" value="12" />
										<img src="<?php echo 'img/yt12-left.png'; ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Border">Border width</label></th>
							<td><input name="YT_Border" type="text" id="YT_Border" value="<?php echo  $options['YT_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="YT_BorderColor" type="text" id="YT_BorderColor" value="<?php echo  $options['YT_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #e0e0e0)
								<div id="YT_BorderColorPreview" style="background-color: <?php echo  $options['YT_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="YT_BackgroundColor" type="text" id="YT_BackgroundColor" value="<?php echo  $options['YT_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="YT_BackgroundColorPreview" style="background-color: <?php echo  $options['YT_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_ZIndex">CSS z-index</label></th>
							<td><input name="YT_ZIndex" type="text" id="YT_ZIndex" value="<?php echo  $options['YT_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div id="STabsLi">
				<h3>LinkedIn</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="LI_Enable">
										<input name="LI_Enable" <?php echo  ($options['LI_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="LI_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show Member Public Profile</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show Member Public Profile</span></legend>
									<label for="LI_ShowPublicProfile">
										<input name="LI_ShowPublicProfile" <?php echo  ($options['LI_ShowPublicProfile'] ? 'checked' : '' ) ?> type="checkbox" id="LI_ShowPublicProfile" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_PublicProfile">Public Profile URL</label></th>
							<td>
								<input name="LI_PublicProfile" type="text" id="LI_PublicProfile" value="<?php echo  $options['LI_PublicProfile'] ?>" class="regular-text" />
								(ex: http://www.linkedin.com/in/collis)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show Company Profile</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show Company Profile</span></legend>
									<label for="LI_ShowCompanyProfile">
										<input name="LI_ShowCompanyProfile" <?php echo  ($options['LI_ShowCompanyProfile'] ? 'checked' : '' ) ?> type="checkbox" id="LI_ShowCompanyProfile" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_CompanyID">Company ID</label></th>
							<td>
								<input name="LI_CompanyID" type="text" id="LI_CompanyID" value="<?php echo  $options['LI_CompanyID'] ?>" class="regular-text" />
								(ex: 589883)
								<a href="http://arscode.pro/linkedin/" target="_blank"><b>Company ID lookup</b></a>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Order</th>
							<td> 
								<fieldset>
									<label style="width: 100%" for="LI_Order1">
										<input name="LI_Order" <?php echo  ($options['LI_Order'] == '1' ? 'checked' : '' ) ?> type="radio" id="LI_Order1" value="1" />
										<br />
										1. Member Public Profile<br />
										2. Company Profile
				
									</label>
									<br /><br />
									<label style="width: 100%" for="LI_Order2">
										<input name="LI_Order" <?php echo  ($options['LI_Order'] == '2' ? 'checked' : '' ) ?> type="radio" id="LI_Order2" value="2" />
										<br />
										1. Company Profile<br />
										2. Member Public Profile
									</label>
								</fieldset>
							</td>
						</tr>
						
						
						<tr valign="top">
							<th scope="row"><label for="LI_Width">Width</label></th>
							<td><input name="LI_Width" type="text" id="LI_Width" value="<?php echo  $options['LI_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_Height">Height</label></th>
							<td><input name="LI_Height" type="text" id="LI_Height" value="<?php echo  $options['LI_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="LI_PositionLeft">
										<input name="LI_Position" <?php echo  ($options['LI_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="LI_PositionLeft" value="Left" />
										left
									</label>
									<label for="LI_PositionRight">
										<input name="LI_Position" <?php echo  ($options['LI_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="LI_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="LI_VPositionMiddle">
										<input name="LI_VPosition" <?php echo  ($options['LI_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="LI_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="LI_VPositionFixed">
										<input name="LI_VPosition" <?php echo  ($options['LI_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="LI_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="LI_VPositionPx" type="text" id="LI_VPositionPx" value="<?php echo  $options['LI_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="LI_TabPositionTop">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionTop" value="Top" />
										top
									</label>
									<label for="LI_TabPositionMiddle">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="LI_TabPositionBottom">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="LI_TabPositionFixed">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="LI_TabPositionPx" type="text" id="LI_TabPositionPx" value="<?php echo  $options['LI_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="LI_TabDesign1">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign1" value="1" />
										<img src="<?php echo 'img/li1-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign2">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign2" value="2" />
										<img src="<?php echo 'img/li2-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign3">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign3" value="3" />
										<img src="<?php echo 'img/li3-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign6">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 6 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign6" value="6" />
										<img src="<?php echo 'img/li6-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign7">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign7" value="7" />
										<img src="<?php echo 'img/li7-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign8">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign8" value="8" />
										<img src="<?php echo 'img/li8-left.png'; ?>" />
									</label> 
									<label for="LI_TabDesign9">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign9" value="9" />
										<img src="<?php echo 'img/li9-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign10">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 10 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign10" value="10" />
										<img src="<?php echo 'img/li10-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign11">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign11" value="11" />
										<img src="<?php echo 'img/li11-left.png'; ?>" />
									</label>
									<label for="LI_TabDesign12">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign12" value="12" />
										<img src="<?php echo 'img/li12-left.png'; ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_Border">Border width</label></th>
							<td><input name="LI_Border" type="text" id="LI_Border" value="<?php echo  $options['LI_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="LI_BorderColor" type="text" id="LI_BorderColor" value="<?php echo  $options['LI_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #e0e0e0)
								<div id="LI_BorderColorPreview" style="background-color: <?php echo  $options['LI_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="LI_BackgroundColor" type="text" id="LI_BackgroundColor" value="<?php echo  $options['LI_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="LI_BackgroundColorPreview" style="background-color: <?php echo  $options['LI_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_ZIndex">CSS z-index</label></th>
							<td><input name="LI_ZIndex" type="text" id="LI_ZIndex" value="<?php echo  $options['LI_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div id="STabsMySQL">
				<h3>MySQL</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="MySQL_Host">Host</label></th>
							<td>
								<input name="MySQL_Host" type="text" id="MySQL_Host" value="<?php echo $options['MySQL_Host'] ?>" class="regular-text" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="MySQL_Database">Database</label></th>
							<td>
								<input name="MySQL_Database" type="text" id="MySQL_Database" value="<?php echo $options['MySQL_Database'] ?>" class="regular-text" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="MySQL_Username">Username</label></th>
							<td>
								<input name="MySQL_Username" type="text" id="MySQL_Username" value="<?php echo $options['MySQL_Username'] ?>" class="regular-text" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="MySQL_Password">Password</label></th>
							<td>
								<input name="MySQL_Password" type="text" id="MySQL_Password" value="<?php echo $options['MySQL_Password'] ?>" class="regular-text" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="MySQL_Prefix">Table prefix</label></th>
							<td>
								<input name="MySQL_Prefix" type="text" id="MySQL_Prefix" value="<?php echo $options['MySQL_Prefix'] ?>" class="regular-text" /> (ex: site1_)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"></th>
							<td>
								<input id="InstallMySQL" type="button" class="button-primary" value="Test &amp; Install DB" />
								<script type="text/javascript">
								jQuery(function(){
									jQuery('#InstallMySQL').click(function(){
										jQuery.ajax({
										  type: "post",
										  cache: false,
										  url: 'install.php?installdb=1',
										  dataType: 'json',
										  data: {
											MySQL_Host: jQuery('#MySQL_Host').val(),
											MySQL_Username: jQuery('#MySQL_Username').val(),
											MySQL_Password: jQuery('#MySQL_Password').val(),
											MySQL_Database: jQuery('#MySQL_Database').val(),
											MySQL_Prefix: jQuery('#MySQL_Prefix').val()
										  },
										  success: function(data) 
										  {
											if(data.ok==1)
											{
												alert('OK! Database was created successfully!');
											}
											else
											{
												alert('ERROR! '+data.error);
											}
										  }
										});
									});
								});
								</script>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div id="STabsAdw">
				<h3>Advanced</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row"><label for="DisableByGetParamN">Disable by GET param</label></th>
							<td>
								name: <input name="DisableByGetParamN" type="text" id="DisableByGetParamN" value="<?php echo  $options['DisableByGetParamN'] ?>" class="regular-text" /> (ex: iframe)
								<br />
								value: <input name="DisableByGetParamV" type="text" id="DisableByGetParamV" value="<?php echo  $options['DisableByGetParamV'] ?>" class="regular-text" /> (ex: 1)
								<br />
								(ex: if you set this option, slider will be disabled on www.yoursite.com.pl/sampleurl/?iframe=1)
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div id="STabsPresets">
			<?php
			$i=0;
			foreach((array)$FBLB_Presets as $k => $v)
			{
				$i++;
				?>
				<div style="float: left; width: 250px;">	
					<strong><?php echo $i.'. '.$v['Name']; ?></strong><br />
					<img src="<?php echo 'presets/'.$v['Thumb']; ?>" />
					<p class="submit">
						<input type="button" onclick="document.location='install.php?Preset=<?php echo $k; ?>&amp;submit=1#STabsPresets'" class="button-primary" value="Select this settings" />
						<input type="button" onclick="document.location='install.php?Preset=<?php echo $k; ?>&amp;preview=1#STabsPresets'" value="Preview" />
					</p>
				</div>
				<?php
				if($i%4==0)
				{
					echo '<br style="clear: both;" />';
				}
			}
			?>
			<br style="clear: both;" />
			</div>
		</div>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button-primary" value="Save settings" />
			<input type="submit" name="preview" id="preview" value="Preview" />
		</p>
	</form>

<script type="text/javascript">
jQuery(function(){
	
	jQuery('#STabs').tabs();
	jQuery('#BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#BorderColor').val('#' + hex);
			jQuery('#BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#BackgroundColor').val('#' + hex);
			jQuery('#BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});

	jQuery('#TW_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_BorderColor').val('#' + hex);
			jQuery('#TW_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_ShellBackground').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_ShellBackground').val('#' + hex);
			jQuery('#TW_ShellBackgroundPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_ShellText').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_ShellText').val('#' + hex);
			jQuery('#TW_ShellTextPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_TweetBackground').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_TweetBackground').val('#' + hex);
			jQuery('#TW_TweetBackgroundPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_TweetText').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_TweetText').val('#' + hex);
			jQuery('#TW_TweetTextPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_Links').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_Links').val('#' + hex);
			jQuery('#TW_LinksPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});

	jQuery('#GP_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#GP_BorderColor').val('#' + hex);
			jQuery('#GP_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#GP_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#GP_BackgroundColor').val('#' + hex);
			jQuery('#GP_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	
	
	
	jQuery('#YT_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#YT_BorderColor').val('#' + hex);
			jQuery('#YT_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#YT_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#YT_BackgroundColor').val('#' + hex);
			jQuery('#YT_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#LI_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#LI_BorderColor').val('#' + hex);
			jQuery('#LI_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#LI_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#LI_BackgroundColor').val('#' + hex);
			jQuery('#LI_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
});
</script>
	</div>
	<?php
	if ($_REQUEST['preview'])
	{
		require_once(dirname(__FILE__) . '/arscode-social-slider.php');
	}
	?>
	</body>
</html>