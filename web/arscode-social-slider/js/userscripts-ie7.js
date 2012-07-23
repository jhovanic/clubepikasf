jQuery(document).ready(function()
{	
		jQuery('.fblbCenterOuter').each(function(index) {
			if (!jQuery(this).hasClass('fblbFixed'))
			{
				var mt=(((jQuery('body').height()/2)-(jQuery(this).height()/2)))*-1;
				jQuery(this).css('margin-top',mt);
			}
		});
});