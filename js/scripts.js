	jQuery(document).ready(function(){
		jQuery('body').prepend('<span id="bm-top" />');
		jQuery('body').append('<a href="#bm-top" id="bm-arrow-top">Back To Top</a>');
		jQuery('#bm-arrow-top').bm_topLink({
			min: 200,
			fadeSpeed: 500
		});
		jQuery('#bm-arrow-top').click(function(e) {
			e.preventDefault();
		});		
		jQuery('a[href*=#]').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			
				var $target = jQuery(this.hash);
				$target = $target.length && $target || jQuery('[name=' + this.hash.slice(1) +']');
				
				if ($target.length) {
					var targetOffset = $target.offset().top;
					jQuery('html,body').animate({scrollTop: targetOffset}, 1000);
					return false;
				}
			}
		});		
	});
	jQuery.fn.bm_topLink = function(settings) {
		settings = jQuery.extend({
			min: 1,
			fadeSpeed: 200
		}, settings);
		return this.each(function() {
			var el = jQuery(this);
			el.hide(); 
			jQuery(window).scroll(function() {
				if (jQuery(window).scrollTop() >= settings.min) {
					el.fadeIn(settings.fadeSpeed);
				} else {
					el.fadeOut(settings.fadeSpeed);
				}
			});
		});
	};
