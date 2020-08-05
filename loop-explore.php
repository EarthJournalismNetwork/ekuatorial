<?php
wp_enqueue_script('lockfixed', get_stylesheet_directory_uri() . '/js/jquery.lockfixed.min.js', array('jquery'), '0.1');
?>
<div class="explore-loop row">
	<div class="four columns">
		<ul class="list-posts">
			<?php
			$i = 0;
			while(have_posts()) : the_post();
				$i++;
				$post_class = (($i % 2) ? 'alpha' : 'omega') . ' four columns';
				$post_class = 'alpha omega four columns';
				?>
				<li id="post-<?php the_ID(); ?>" <?php post_class('post-item ' . $post_class); ?>>
					<article>
						<header class="post-header">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
								if(has_post_thumbnail())
									the_post_thumbnail('post-thumb');
								else
									echo '<img src="' . get_post_meta($post->ID, 'picture', true) . '" />';
								?>
							</a>
							<h2>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php if (get_post_meta($post->ID, 'is_label', true) == "1"): ?>
								<br><a href="#"><span class="label">Belt and Road</span></a>
								<?php endif; ?>
							</h2>
							<p class="meta clearfix">
								<span class="date">
									<span class="lsf">&#xE15e;</span>
									<span class="date-content"><?php echo get_the_date('m/d/Y'); ?></span>
								</span>
								<?php
								if(get_the_terms($post->ID, 'publisher')) :
									?>
									<span class="publisher">
										<span class="lsf">clip</span>
										<span class="publisher-content">
											<?php
											// mohjak 2012-12-12 Fix Notice: Only variables should be passed by reference
											// in /var/www/html/wp-content/themes/ekuatorial/loop-explore.php on line 43
											$terms = get_the_terms($post->ID, 'publisher');
											echo array_shift($terms)->name;
											?>
										</span>
									</span>
									<?php
								endif;
								?>
							</p>
						</header>
						<section class="post-content">
							<?php the_excerpt(); ?>
						</section>
						<footer class="post-actions">
							<div class="buttons">
								<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read more', 'ekuatorial'); ?></a>
								<a class="button" href="<?php echo jeo_get_share_url(array('p' => $post->ID)); ?>"><?php _e('Share', 'ekuatorial'); ?></a>
							</div>
						</footer>
					</article>
				</li>
			<?php endwhile; ?>
		</ul>
		<div>
			<?php if(function_exists('wp_paginate')) wp_paginate(); ?>
		</div>
	</div>
	<div class="eight columns">
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
