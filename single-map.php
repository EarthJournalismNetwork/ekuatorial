<?php get_header(); ?>

<section id="stage">
	<div class="container">
		<div class="twelve columns">
			<ul class="share">
				<li class="facebook">
					<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="verdana" data-action="recommend"></div>
				</li>
				<li class="twitter">
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="InfoAmazonia" data-lang="<?php if(function_exists('qtrans_getLanguage')) echo qtrans_getLanguage(); ?>">Tweet</a>
				</li>
				<li class="share">
					<a class="button share-button" href="<?php echo jeo_get_share_url(array('map_id' => $post->ID)); ?>"><?php _e('Embed this map', 'infoamazonia'); ?></a>
				</li>
			</ul>
			<h1 class="title"><?php the_title(); ?></h1>
			<?php get_template_part('stage', 'map'); ?>
		</div>
	</div>
</section>

<section id="content">
	<?php
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$query = array(
		'paged' => $paged,
		's' => isset($_GET['s']) ? $_GET['s'] : null
	);
	query_posts($query);
	if(have_posts()) : ?>


		<div class="container">
			<div class="twelve columns">
				<?php get_search_form(); ?>
			</div>
			<section id="last-stories" class="loop-section">
				<div class="twelve columns">
					<h3><?php _e('Stories on', 'infoamazonia'); ?> &ldquo;<?php the_title(); ?>&ldquo;</h3>
				</div>
				<?php get_template_part('loop'); ?>
			</section>
		</div>

	<?php
	endif;
	wp_reset_query(); ?>

	<?php get_template_part('section', 'submit-call'); ?>
</section>

<?php get_template_part('section', 'main-widget'); ?>

<?php get_footer(); ?>