<?php
wp_enqueue_script('lockfixed', get_stylesheet_directory_uri() . '/js/jquery.lockfixed.min.js', array('jquery'), '0.1');
?>
<div class="explore-loop row">
	<div class="eight columns">
		<ul class="list-posts">
			<?php
			$i = 0;
			while(have_posts()) : the_post();
				$i++;
				$post_class = (($i % 2) ? 'alpha' : 'omega') . ' four columns';
				?>
				<li id="post-<?php the_ID(); ?>" <?php post_class('post-item ' . $post_class); ?>>
					<article>
						<header class="post-header">
							<p class="meta">
								<?php echo get_the_date(_x('m/d/Y', 'reduced date format', 'infoamazonia')); ?> - 
								<?php
								if(get_the_terms($post->ID, 'publisher'))
									echo array_shift(get_the_terms($post->ID, 'publisher'))->name;
								?>
							</p>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
								if(has_post_thumbnail())
									the_post_thumbnail('post-thumb');
								else
									echo '<img src="' . get_post_meta($post->ID, 'picture', true) . '" />';
								?>
							</a>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read more', 'ekuatorial'); ?></a>
						</header>
					</article>
				</li>
			<?php endwhile; ?>
		</ul>
		<div>
			<?php if(function_exists('wp_paginate')) wp_paginate(); ?>
		</div>
	</div>
	<div class="four columns">
		<div class="explore-map">
			<?php jeo_featured(); ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$('.list-posts').imagesLoaded(function() {

				var $media = $('.list-posts .media-limit img');

				$media.each(function() {

					var containerHeight = $(this).parents('.media-limit').height();
					var imageHeight = $(this).height();

					var topOffset = (containerHeight - imageHeight) / 2;

					if(topOffset < 0) {
						$(this).css({
							'margin-top': topOffset
						});
					}

				});

			});

			$(window).resize(mapSize).resize();

			(function() {
				var bottom = $('body').outerHeight() - ($('#last-stories').offset().top + $('#last-stories').innerHeight());
				$.lockfixed('.explore-map', { offset: { top: 0, bottom: bottom }});
			})();


		});

		jeo.mapReady(function(map) {
			listPosts = $('.list-posts');
			if(listPosts.length) {
				listPosts.find('.button').click(function() {
					window.location = $(this).attr('href');
				});
				listPosts.find('li').click(function(e) {
					e.preventDefault();
					var markerID = $(this).attr('id');
					map.markers.openMarker(markerID, false);
					return false;
				});
			}
		});

		function mapSize() {

			var map = $('.explore-map');

			var width = $(window).width() - map.offset().left;
			var height = $(window).height();

			map.css({
				width: width,
				height: height
			});

		}


	})(jQuery);
</script>