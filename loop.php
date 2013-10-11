<ul class="list-posts row">
	<?php while(have_posts()) : the_post(); ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class('post-item three columns'); ?>>
			<article>
				<header class="post-header">
					<p class="meta">
						<?php echo get_the_date(_x('m/d/Y', 'reduced date format', 'infoamazonia')); ?> - 
						<?php
						if(get_the_terms($post->ID, 'publisher'))
							echo array_shift(get_the_terms($post->ID, 'publisher'))->name;
						?></p>
					<div class="media-limit">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php
							if(has_post_thumbnail())
								the_post_thumbnail('post-thumb');
							else
								echo '<img src="' . get_post_meta($post->ID, 'picture', true) . '" />';
							?>
						</a>
					</div>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</header>
			</article>
		</li>
	<?php endwhile; ?>
</ul>
<div class="twelve columns">
	<?php if(function_exists('wp_paginate')) wp_paginate(); ?>
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
		});
	})(jQuery);
</script>