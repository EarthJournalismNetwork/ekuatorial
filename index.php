<?php get_header(); ?>

<section id="stage">
	<div class="container">
		<div class="twelve columns">
			<?php get_template_part('section', 'subheader'); ?>
		</div>
	</div>
	<?php if(!get_query_var('ekuatorial_advanced_nav')) : ?>
		<div id="main-map" class="stage-map">
			<?php jeo_featured(); ?>
		</div>
	<?php endif; ?>
</section>

<section id="content">

	<?php
	/*
	 * Side content (get data, share map, contribute)
	 */
	if(is_front_page() && !is_paged())
		get_template_part('section', 'actions');
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
				<?php
				if(get_query_var('ekuatorial_advanced_nav'))
					get_template_part('loop', 'explore');
				else
					get_template_part('loop');
				?>
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
					<?php
					if(get_query_var('ekuatorial_advanced_nav'))
						get_template_part('loop',' explore');
					else
						get_template_part('loop');
					?>
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