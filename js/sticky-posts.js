(function($) {

	jeo.markersReady(function(map) {

		var t;

		function openSticky(postid) {

			var item = $('.sticky-posts .sticky-item[data-postid="' + postid + '"]');

			map.markers.focusMarker('post-' + postid);

			$('.sticky-posts').addClass('post-active');
			$('.sticky-posts .sticky-item').removeClass('active');
			item.addClass('active');

		}

		function closeSticky() {
			$('.sticky-posts').removeClass('post-active');
			$('.sticky-posts .sticky-item').removeClass('active');
		}

		function runSticky() {

			var current = $('.sticky-posts .sticky-item.active');

			if(!current.length) {
				var toGo = $('.sticky-posts .sticky-item:first-child');
			} else {
				if(current.is(':last-child'))
					var toGo = $('.sticky-posts .sticky-item:first-child');
				else
					var toGo = current.next('.sticky-item');
			}

			openSticky(toGo.data('postid'));

		}

		$('.sticky-posts .sticky-item').click(function() {
			clearInterval(t);
			if(!$(this).is('.active')) {
				openSticky($(this).data('postid'));
				return false;
			}
		});

		if($('.sticky-posts').length) {

			jeo.markerOpened(function() {
				clearInterval(t);
				closeSticky();
			});

			map.on('click mouseup', function() {
				clearInterval(t);
			});

			setTimeout(function() {
				openSticky($('.sticky-posts .sticky-item:first-child').data('postid'));
				t = setInterval(runSticky, 8000);
			}, 800);

		}

	});

})(jQuery);