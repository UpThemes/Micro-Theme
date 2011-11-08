jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({
		directionNav: true,
		slideshow: false,
		controlNav: false,
		animation: "fade",
    	controlsContainer: '.flex-container'
	});
	jQuery(".post_content").fitVids();
});
