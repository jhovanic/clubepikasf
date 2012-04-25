<?php
if($options['TW_TabPosition']=='Middle' && in_array($options['TW_TabDesign'],array(3,6)))
{
	$fblbHead_TW_position='top: 50%; margin-top: -30px;';
}
if($options['TW_TabPosition']=='Middle' && in_array($options['TW_TabDesign'],array(1,2,4,5)))
{
	$fblbHead_TW_position='top: 50%; margin-top: -78px;';
}
if($options['TW_TabPosition']=='Middle' && in_array($options['TW_TabDesign'],array(7,8)))
{
	$fblbHead_TW_position='top: 50%; margin-top: -45px;';
}
if($options['TW_TabPosition']=='Middle' && in_array($options['TW_TabDesign'],array(9)))
{
	$fblbHead_TW_position='top: 50%; margin-top: -18px;';
}
if($options['TW_TabPosition']=='Top')
{
	$fblbHead_TW_position='top: 5px;';
}
if($options['TW_TabPosition']=='Bottom')
{	
	$fblbHead_TW_position='bottom: 5px;';
}
if($options['TW_TabPosition']=='Fixed')
{	
	$fblbHead_TW_position='top: '.$options['TW_TabPositionPx'].'px;';
}
?>
<div class="fblbCenterOuter fblbCenterOuterTw <?php echo  ($options['TW_VPosition'] == 'Fixed' ? 'fblbFixed' : '') ?> fblb<?php echo  $options['TW_Position'] ?>" style="<?php echo  ($options['TW_VPosition'] == 'Fixed' ? 'margin-top: ' . ($options['TW_VPositionPx'] ? $options['TW_VPositionPx'] : '0') . 'px; ' : '') ?> <?php echo  ($options['TW_Position'] == 'Left' ? 'left: -' . ($options['TW_Width'] + $options['TW_Border']) . 'px;' : 'right: -' . ($options['TW_Width'] + $options['TW_Border']) . 'px;') ?><?php echo  ($options['TW_ZIndex'] ? 'z-index: ' . $options['TW_ZIndex'] . ';' : '') ?>">
	<div class="fblbCenterInner">
		<div class="fblbWrap fblbTheme0 fblbTab<?php echo  $options['TW_TabDesign'] ?>">
			<div class="fblbForm" style="background: <?php echo  $options['TW_BorderColor'] ?>; height: <?php echo  $options['TW_Height'] ?>px; width: <?php echo  $options['TW_Width'] ?>px; padding: <?php echo  ($options['TW_Position'] == 'Left' ? $options['TW_Border'] . 'px ' . $options['TW_Border'] . 'px ' . $options['TW_Border'] . 'px 0' : $options['TW_Border'] . 'px 0 ' . $options['TW_Border'] . 'px ' . $options['TW_Border'] . 'px') ?>;">
				<h2 class="fblbHead" style="<?php echo $fblbHead_TW_position; ?> <?php echo  ($options['TW_Position'] == 'Left' ? 'left: ' . ($options['TW_Width'] + $options['TW_Border']) . 'px;' : 'right: ' . ($options['TW_Width'] + $options['TW_Border']) . 'px;') ?>">Twitter</h2>
				<div id="fblbInnerTw" class="fblbInner fblbInnerLoading" style="height: <?php echo $options['TW_Height']?>px;">
					<div id="fblbTww"></div>
					<script src="http://widgets.twimg.com/j/2/widget.js"></script>
					<script>
						jQuery(document).ready(function(){	
						new TWTR.Widget({
							id:	'fblbTww',
							version: 2,
							type: 'profile',
							rpp: <?php echo  $options['TW_rpp'] ?>,
							interval: <?php echo  $options['TW_interval'] * 1000 ?>,
							width: <?php echo  $options['TW_Width'] ?>,
							height: <?php echo  $options['TW_Height'] - 92 ?>,
							theme: {
								shell: {
									background: '<?php echo  $options['TW_ShellBackground'] ?>',
									color: '<?php echo  $options['TW_ShellText'] ?>'
								},
								tweets: {
									background: '<?php echo  $options['TW_TweetBackground'] ?>',
									color: '<?php echo  $options['TW_TweetText'] ?>',
									links: '<?php echo  $options['TW_Links'] ?>'
								}
							},
							features: {
								loop: <?php echo  ($options['TW_loop'] ? 'true' : 'false') ?>,
								live: <?php echo  ($options['TW_live'] ? 'true' : 'false') ?>,
								scrollbar: true,
								avatars: true,
								behavior: '<?php echo  $options['TW_behavior'] ?>'				  
							}
						}).render().setUser('<?php echo  $options['TW_Username'] ?>').start();
					   jQuery('#fblbInnerTw').removeClass('fblbInnerLoading');
					});
					</script>		
					<?php if($options['TW_ShowFollowButton']){?>
					<div class="fblbFollowTw">
						<a href="https://twitter.com/<?php echo  $options['TW_Username'] ?>" class="twitter-follow-button" data-width="130px" data-show-count="false" data-lang="<?php echo  $options['TW_Language'] ?>">Follow <?php echo  $options['TW_Username'] ?></a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>