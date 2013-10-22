<?php get_header(); ?>

<section id="stage">
	<div class="container">
		<div class="twelve columns">
			<?php get_template_part('section', 'subheader'); ?>
		</div>
	</div>
	<div id="main-map" class="stage-map">
		<?php jeo_featured(); ?>
	</div>
</section>

<section id="content">

	<?php
	/*
	 * Side content (get data, share map, contribute)
	 */
	if(is_front_page() && !is_paged())
		get_template_part('section', 'actions');
	?>

	<?php
	/*
	 * Highlights
	 */
	$disable_highlights = true;
	if(is_front_page() && !is_paged() && !$disable_highlights) :
		$highlights = get_posts();
		if($highlights) :
			?>
			<section id="featured-stories" class="highlights">
				<div class="highlights-title">
					<div class="container">
						<div class="twelve columns">
							<h2><?php _e('Highlights', 'ekuatorial'); ?></h2>
						</div>
					</div>
				</div>
				<div class="highlight-content">
					<ul>
						<?php
						foreach($highlights as $post) :
							global $post;
							setup_postdata($post);
							?>
							<li class="highlight" data-postid="<?php the_ID(); ?>">
								<article id="post-<?php the_ID(); ?>" class="highlight-item">
									<div class="thumbnail">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="post-content">
										<header class="post-header">
											<p class="date-publisher">
												<?php
												echo get_the_date();
												$publisher = get_the_terms($post->ID, 'publisher');
												if($publisher) :
													$publisher = array_shift($publisher);
													?>
													- 
													<a href="<?php echo get_term_link($publisher); ?>"><?php echo $publisher->name; ?></a>
												<?php endif; ?>
											</p>
											<div class="post-cut">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<?php the_excerpt(); ?>
											</div>
											<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read more', 'ekuatorial'); ?></a>
										</header>
									</div>
								</article>
							</li>
							<?php
							wp_reset_postdata();
						endforeach;
						?>
					</ul>
				</div>
				<div class="highlight-navigation">
					<a class="prev" href="#" title="<?php _e('Previous', 'ekuatorial'); ?>"><span class="lsf">&#xE080;</span></a>
					<a class="next" href="#" title="<?php _e('Next', 'ekuatorial'); ?>"><span class="lsf">&#xE112;</span></a>
				</div>
			</section>
		<?php
		endif;
	endif;
	?>

	<?php get_template_part('section', 'publisher-description'); ?>

	<?php if(have_posts()) : ?>

		<section id="last-stories" class="loop-section">
			<div class="section-title">
				<div class="container">
					<div class="twelve columns">
						<h3><?php if(is_front_page()) : ?>
							<?php _e('Latest stories', 'infoamazonia'); ?>
						<?php elseif(is_tax('publisher')) : ?>
							<?php _e('Stories by ', 'infoamazonia'); ?> &ldquo;<?php single_term_title(); ?>&rdquo;
						<?php elseif(is_tag()) : ?>
							<?php _e('Stories on ', 'infoamazonia'); ?> &ldquo;<?php single_tag_title(); ?>&rdquo;
						<?php else : ?>
							<?php _e('Stories', 'infoamazonia'); ?>
						<?php endif; ?>
						<?php if(is_paged()) : ?>
							- <?php printf(__('Page %d', 'ekuatorial'), get_query_var('paged')); ?>
						<?php endif; ?>
						</h3>
					</div>
				</div>
			</div>
			<div class="container">
				<?php get_template_part('loop'); ?>
			</div>
		</section>

	<?php else : ?>

		<?php query_posts(); if(have_posts()) : ?>

			<section id="last-stories" class="loop-section">
				<div class="section-title">
					<div class="container">
						<div class="twelve columns">
							<h3><?php _e('Nothing found. Viewing all posts', 'infoamazonia'); ?></h3>
						</div>
					</div>
				</div>
				<div class="container">
					<?php get_template_part('loop'); ?>
				</div>
			</section>

		<?php endif; wp_reset_query(); ?>

	<?php endif; ?>

	<?php // get_template_part('section', 'submit-call'); ?>

	<?php
	/*
	 * Side content (get data, share map, contribute)
	 */
	if(is_front_page() && is_paged())
		get_template_part('section', 'actions');
	?>

</section>

<?php get_template_part('section', 'main-widget'); ?>

<?php get_footer(); ?>