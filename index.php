<?php get_header(); ?>

<section id="stage" class="row">
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
	if(is_front_page()) :
		?>
		<aside id="home-call" class="row">
			<div class="container">
				<div class="four columns">
					<span class="lsf">param</span>
					<h3><?php _e('Customize and share', 'ekuatorial'); ?></h3>
					<p><?php _e('Create a custom map visualization with different news and spread the word.', 'ekuatorial'); ?></p>
				</div>
				<div class="four columns">
					<span class="lsf">save</span>
					<h3><?php _e('Get the data', 'ekuatorial'); ?></h3>
					<p><?php _e('Download all the researched data used to design our maps and help us remix it into new visualizations.', 'ekuatorial'); ?></p>
				</div>
				<div class="four columns">
					<span class="lsf">edit</span>
					<h3><?php _e('Submit a story', 'ekuatorial'); ?></h3>
					<p><?php _e('Do you have news from Indonesia? Contribute to this map by submitting your story.', 'ekuatorial'); ?></p>
				</div>
			</div>
		</aside>
		<?php
	endif;
	?>

	<?php
	/*
	 * Highlights
	 */
	if(is_front_page()) :
		$highlights = get_posts();
		if($highlights) :
			?>
			<div class="highlights row">
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
											<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<?php the_excerpt(); ?>
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
			</div>
		<?php
		endif;
	endif;
	?>

	<?php get_template_part('section', 'publisher-description'); ?>

	<?php if(is_front_page() && !is_paged()) : ?>

		<?php query_posts(array('meta_key' => 'featured', 'posts_per_page' => 4)); if(have_posts()) : ?>

			<div class="container">

				<section id="highlights" class="loop-section">
					<div class="twelve columns">
						<h3><?php _e('Highlights', 'infoamazonia'); ?></h3>
					</div>
					<?php get_template_part('loop'); ?>
				</section>

			</div>

		<?php endif; wp_reset_query(); ?>

	<?php endif; ?>

	<?php if(have_posts()) : ?>

		<div class="container">

			<section id="last-stories" class="loop-section">
				<div class="twelve columns">
					<?php if(is_front_page()) : ?>
						<h3><?php _e('Last stories', 'infoamazonia'); ?></h3>
					<?php elseif(is_tax('publisher')) : ?>
						<h3><?php _e('Stories by ', 'infoamazonia'); ?> &ldquo;<?php single_term_title(); ?>&rdquo;</h3>
					<?php elseif(is_tag()) : ?>
						<h3><?php _e('Stories on ', 'infoamazonia'); ?> &ldquo;<?php single_tag_title(); ?>&rdquo;</h3>
					<?php else : ?>
						<h3><?php _e('Stories', 'infoamazonia'); ?></h3>
					<?php endif; ?>
				</div>
				<?php get_template_part('loop'); ?>
			</section>

		</div>

	<?php else : ?>

		<?php query_posts('post_type=post'); if(have_posts()) : ?>

			<div class="container">

				<section id="last-stories" class="loop-section">
					<div class="six columns">
						<h3><?php _e('Nothing found. Viewing all posts', 'infoamazonia'); ?></h3>
					</div>
					<?php get_template_part('loop'); ?>
				</section>

			</div>

		<?php endif; wp_reset_query(); ?>

	<?php endif; ?>

	<?php // get_template_part('section', 'submit-call'); ?>

</section>

<?php get_template_part('section', 'main-widget'); ?>

<?php get_footer(); ?>