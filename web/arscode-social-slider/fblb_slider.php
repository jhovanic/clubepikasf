<?php
if($options['TabPosition']=='Middle' && in_array($options['TabDesign'],array(3,6)))
{
	$fblbHead_position='top: 50%; margin-top: -30px;';
}
if($options['TabPosition']=='Middle' && in_array($options['TabDesign'],array(1,2,4,5)))
{
	$fblbHead_position='top: 50%; margin-top: -78px;';
}
if($options['TabPosition']=='Middle' && in_array($options['TabDesign'],array(7,8)))
{
	$fblbHead_position='top: 50%; margin-top: -45px;';
}
if($options['TabPosition']=='Middle' && in_array($options['TabDesign'],array(9)))
{
	$fblbHead_position='top: 50%; margin-top: -18px;';
}
if($options['TabPosition']=='Top')
{
	$fblbHead_position='top: 5px;';
}
if($options['TabPosition']=='Bottom')
{	
	$fblbHead_position='bottom: 5px;';
}
if($options['TabPosition']=='Fixed')
{	
	$fblbHead_position='top: '.$options['TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterFb <?php echo ($options['VPosition']=='Fixed' ? 'fblbFixed': '')?> fblb<?php echo $options['Position']?>" style="<?php echo ($options['VPosition']=='Fixed' ? 'margin-top: '.($options['VPositionPx'] ? $options['VPositionPx'] : '0').'px; ': '')?> <?php echo ($options['Position']=='Left' ? 'left: -'.($options['Width']+$options['Border']).'px;' : 'right: -'.($options['Width']+$options['Border']).'px;')?><?php echo ($options['ZIndex'] ? 'z-index: '.$options['ZIndex'].';': '')?>">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['TabDesign']?>">
			<div class="fblbForm" style="background: <?php echo $options['BorderColor']?>; height: <?php echo $options['Height']?>px; width: <?php echo $options['Width']?>px; padding: <?php echo ($options['Position']=='Left' ? $options['Border'].'px '.$options['Border'].'px '.$options['Border'].'px 0' : $options['Border'].'px 0 '.$options['Border'].'px '.$options['Border'].'px')?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_position; ?> <?php echo ($options['Position']=='Left' ? 'left: '.($options['Width']+$options['Border']).'px;' : 'right: '.($options['Width']+$options['Border']).'px;')?>">Facebook</h2>
				<div id="fblbInnerFb" class="fblbInner fblbInnerLoading" style="height: <?php echo $options['Height']?>px; background-color: <?php echo $options['BackgroundColor']?>;">
					<div class="fb-root" id="fb-root"></div>
					<script>
					jQuery(document).ready(function(){	
					if ( jQuery.browser.msie ) 
					{jQuery('#fblbInnerFb').removeClass('fblbInnerLoading');}
					else{jQuery('.fb-like-box').bind('DOMNodeInserted', function(event) { 
					if(event.target.nodeName=='IFRAME'){
					jQuery('.fb-like-box iframe').load(function() 
					{jQuery('#fblbInnerFb').removeClass('fblbInnerLoading');
					jQuery('.fb-like-box').unbind('DOMNodeInserted');});
					}});}
					(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) {return;}
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/<?php echo $options['Locale']?>/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));});</script>
					<div class="fb-like-box" <?php if($options['ForceWall']==1) { echo 'force_wall="true"'; }?> data-colorscheme="<?php echo $options['ColorScheme']?>"  data-border-color="<?php echo $options['BorderColor']?>" data-href="<?php echo  $options['FacebookPageURL'] ?>" data-width="<?php echo $options['Width']?>" data-height="<?php echo $options['Height']?>" data-show-faces="<?php echo ($options['ShowFaces'] ? 'true' : 'false')?>" data-stream="<?php echo ($options['ShowStream'] ? 'true' : 'false')?>" data-header="<?php echo ($options['ShowHeader'] ? 'true' : 'false')?>"></div>
				</div>
			</div>
		</div>
	</div>
</div>