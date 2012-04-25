<?php
global $wpdb;
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(3,6)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -30px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -78px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(7,8)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -45px;';
}
if($options['YT_TabPosition']=='Middle' && in_array($options['YT_TabDesign'],array(9)))
{
	$fblbHead_YT_position='top: 50%; margin-top: -18px;';
}
if($options['YT_TabPosition']=='Top')
{
	$fblbHead_YT_position='top: 5px;';
}
if($options['YT_TabPosition']=='Bottom')
{	
	$fblbHead_YT_position='bottom: 5px;';
}
if($options['YT_TabPosition']=='Fixed')
{	
	$fblbHead_YT_position='top: '.$options['YT_TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterYt <?php echo ($options['YT_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo $options['YT_Position'] ?>" style="<?php echo ($options['YT_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['YT_VPositionPx'] ? $options['YT_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo ($options['YT_Position'] == 'Left' ? 'left: -' . ($options['YT_Width'] + $options['YT_Border']) . 'px;' : 'right: -' . ($options['YT_Width'] + $options['YT_Border']) . 'px;') ?><?php echo ($options['YT_ZIndex'] ? 'z-index: ' . $options['YT_ZIndex'] . ';' : '') ?>;">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo $options['YT_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo $options['YT_BorderColor'] ?>; height: <?php echo $options['YT_Height'] ?>px; width: <?php echo $options['YT_Width'] ?>px; padding: <?php echo ($options['YT_Position'] == 'Left' ? $options['YT_Border'] . 'px ' . $options['YT_Border'] . 'px ' . $options['YT_Border'] . 'px 0' : $options['YT_Border'] . 'px 0 ' . $options['YT_Border'] . 'px ' . $options['YT_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_YT_position; ?> <?php echo ($options['YT_Position'] == 'Left' ? 'left: ' . ($options['YT_Width'] + $options['YT_Border']) . 'px;' : 'right: ' . ($options['YT_Width'] + $options['YT_Border']) . 'px;') ?>">YouTube</h2>
				<div class="fblbInner" style="background: <?php echo $options['YT_BackgroundColor'] ?>; height: <?php echo $options['YT_Height'] ?>px;">				
					<div style="overflow: hidden; height: 98px;">
						<iframe id="fblbYTS" src="http://www.youtube.com/subscribe_widget?p=<?php echo $options['YT_Channel']; ?>" style="overflow: hidden; height: 98px; width:100%; border: 0;" scrolling="no" frameBorder="0"></iframe>
					</div>
					<div id="fblbInnerYt" class="fblbInnerLoading" style="overflow-y: scroll; overflow-x: hidden; height: <?php echo $options['YT_Height']-98?>px;">
						<ul id="fblbYtList" class="fblbList" style="height: <?php echo $options['YT_Height']-98 ?>px">
						</ul>
						<script type="text/javascript">
						function __fblb_YTGet(data) 
						{
							var MonthNames=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
							if(!data.feed.entry)
							{
							}
							else
							{
								jQuery.each(data.feed.entry, function(i,e) {
									added=new Date(e.published.$t);
									jQuery('#fblbYtList').append('<li>' +
									'<a href="' + e.link[0].href +'" class="fblbthumb-link"><img src="' + e.media$group.media$thumbnail[1].url + '" alt="" width="61" height="45" class="fblbthumb" /></a>' +
									'<div class="fblbbd">' +
									'<a href="' + e.link[0].href +'" class="fblbtitle">' + e.title.$t + '</a>' +
									'<span class="fblbinfo">' + (!e.yt$statistics ? '' : 'views: ' + e.yt$statistics.viewCount + ' |' ) + ' added: ' + (added.getDate()) + ' ' + MonthNames[added.getMonth()] + ' ' + added.getFullYear() + '</span>' +
									'</div>' +
									'</li>');
								});
							}
							jQuery('#fblbInnerYt').removeClass('fblbInnerLoading');
						}
						jQuery(document).ready(function(){
							jQuery.getScript("http://gdata.youtube.com/feeds/users/<?php echo $options['YT_Channel']; ?>/uploads?alt=json-in-script&max-results=10&format=5&callback=__fblb_YTGet");
						});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>