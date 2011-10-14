jQuery(window).load(function() {
	jQuery('a[href$="jpg"], a[href$="png"], a[href$="jpeg"]').fancybox();
	jQuery('.flexslider').flexslider({
		directionNav: true,
		slideshow: false,
		controlNav: false,
		animation: "fade",
    	controlsContainer: '.flex-container'
	});
	jQuery(".post_content").fitVids();
});
