<ul class="list-posts row">
	<?php while(have_posts()) : the_post(); ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class('post-item four columns'); ?>>
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
                                    $terms_arr = get_the_terms($post->ID, 'publisher');
                                    $first_term = array_shift($terms_arr);
                                    // by mohjak: 2019-11-21 excel line 23 issue#120
                                    $first_term_name = $first_term->name;
                                    echo $first_term_name;
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
