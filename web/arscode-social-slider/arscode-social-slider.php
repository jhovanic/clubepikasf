<?php
/*
  Social Slider by ARScode
  Description:
  Version: 2.0
  Author: ARScode
  http://www.arscode.pro/
*/
require_once(dirname(__FILE__) . '/common.inc.php');


DEFINE('FBLB_DEMO',true);

function fblb_slider()
{
	//print_r($_REQUEST);
	global $fblb_preview_options;
	if (isset($_REQUEST['Preset']) && FBLB_DEMO===true && FBLB_CONFIG===0)
	{
		require(dirname(__FILE__) . '/fblbconfig.inc.php');
		require_once(dirname(__FILE__) . '/config.php');
		$fblb_preview_options = array_merge((array)$fblb_options,(array)$FBLB_Presets[$_GET['Preset']]['Options']);
	}
	if (isset($_REQUEST['preview']) && (FBLB_CONFIG===1 || FBLB_DEMO===true))
	{
		$options = $fblb_preview_options;
	}
	else
	{
		require_once(dirname(__FILE__) . '/config.php');
		$options = $fblb_options;
		if($options['DisableByGetParamN'] && $options['DisableByGetParamV'] && $_GET[$options['DisableByGetParamN']]==$options['DisableByGetParamV'])
		{
			return;
		}
	}
	if ($options['Enable'] == 1 && $options['FacebookPageURL'])
	{
		require_once(dirname(__FILE__) . '/fblb_slider.php');
	}
	if ($options['TW_Enable'] == 1 && $options['TW_Username'])
	{
		require_once(dirname(__FILE__) . '/fblb_tw_slider.php');
	}
	if ($options['GP_Enable'] == 1 && $options['GP_PageID'])
	{
		require_once(dirname(__FILE__) . '/fblb_gp_slider.php');
	}
	if ($options['YT_Enable'] == 1 && $options['YT_Channel'])
	{
		require_once(dirname(__FILE__) . '/fblb_yt_slider.php');
	}
	if ($options['LI_Enable'])
	{
		require_once(dirname(__FILE__) . '/fblb_li_slider.php');
	}
}
fblb_slider();
?>