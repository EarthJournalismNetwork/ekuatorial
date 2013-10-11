(function($) {

	/*
	 * Home slider
	 */
	$(document).ready(function() {

		if($('.highlights').length) {

			$(window).resize(fixItemWidth).resize();

			var sly = new Sly('.highlights', {
				horizontal: 1,
				itemNav: 'basic',
				smart: 1,
				startAt: 0,
				scrollBy: 0,
				speed: 200,
				ease: 'easeOutExpo',
				next: $('.highlights .next'),
				prev: $('.highlights .prev')
			});

			sly.init();

			$(window).resize(function() {
				sly.reload();
			});

		}

		function fixItemWidth() {

			$('.highlights li').css({
				width: $(window).width()
			});

		}

	});

})(jQuery);