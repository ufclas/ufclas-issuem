jQuery(function($){
	// Rollover Dropdown
	$('.dropdown').hover(            
		function() {
			$('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
			$(this).toggleClass('open');        
		},
		function() {
			$('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
			$(this).toggleClass('open');       
		}
	);
	
	// Jumbotron Parallax
	var jumboHeight = $('.jumbotron').outerHeight();
		function parallax(){
		var scrolled = $(window).scrollTop();
		$('.bg-jumbotron').css('height', (jumboHeight-scrolled) + 'px');
	}

	$(window).scroll(function(e){
		parallax();
	});
});