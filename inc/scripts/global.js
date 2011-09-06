jQuery(window).load(function() {
	jQuery('a[href$="jpg"], a[href$="png"], a[href$="jpeg"]').fancybox();
	jQuery('.flexslider').flexslider({
		directionNav: true,
		slideshow: false,
    	controlsContainer: '.flex-container'
	});
});
