<?php

// metaboxes
include(STYLESHEETPATH . '/inc/metaboxes/metaboxes.php');

include(STYLESHEETPATH . '/inc/category-feeds-widget.php');

include(STYLESHEETPATH . '/inc/advanced-navigation.php');

include(STYLESHEETPATH . '/inc/jeo-post-zoom.php');

// ekuatorial setup

// register taxonomies
include(STYLESHEETPATH . '/inc/taxonomies.php');
// taxonomy meta
include(STYLESHEETPATH . '/inc/taxonomies-meta.php');

function newsroom_main_scripts() {
	wp_register_script('hammer.js', get_stylesheet_directory_uri() . '/lib/hammerjs/hammer.min.js');
}
add_action('wp_enqueue_scripts', 'newsroom_main_scripts');
/*
 * Datasets
 */
include(STYLESHEETPATH . '/inc/datasets.php');

function ekuatorial_setup() {

	add_theme_support('post-thumbnails');
	add_image_size('post-thumb', 360, 121, true);
	add_image_size('map-thumb', 200, 200, true);

	// text domain
	load_child_theme_textdomain('ekuatorial', get_stylesheet_directory() . '/languages');

	//sidebars
	register_sidebar(array(
		'name' => __('Main widgets', 'ekuatorial'),
		'id' => 'main-sidebar',
		'description' => __('Widgets used on front and inside pages.', 'ekuatorial'),
		'before_widget' => '<div class="four columns row">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

}
add_action('after_setup_theme', 'ekuatorial_setup');

// set OSM geocode
function ekuatorial_geocode_service() {
	return 'osm';
}
add_filter('jeo_geocode_service', 'ekuatorial_geocode_service');

function ekuatorial_scripts() {
	/*
	 * Register scripts & styles
	 */

	// deregister jeo styles
	wp_deregister_style('jeo-main');

	/* Shadowbox */
	wp_register_script('shadowbox', get_stylesheet_directory_uri() . '/lib/shadowbox/shadowbox.js', array('jquery'), '3.0.3');
	wp_register_style('shadowbox', get_stylesheet_directory_uri() . '/lib/shadowbox/shadowbox.css', array(), '3.0.3');

	/* Chosen */
	wp_register_script('chosen', get_stylesheet_directory_uri() . '/lib/chosen.jquery.min.js', array('jquery'), '1.0.0');

	// scripts
	wp_register_script('html5', get_stylesheet_directory_uri() . '/js/html5shiv.js', array(), '3.6.2');
	wp_register_script('submit-story', get_stylesheet_directory_uri() . '/js/submit-story.js', array('jquery'), '0.1.1');

	wp_register_script('twttr', '//platform.twitter.com/widgets.js');

	$lang = '';
	if(function_exists('qtranxf_getLanguage')) {
		$lang = qtranxf_getLanguage();
	}

	// custom marker system
	global $jeo_markers;
	wp_deregister_script('jeo.markers');
	wp_register_script('jeo.markers', get_stylesheet_directory_uri() . '/js/ekuatorial.markers.js', array('jeo', 'underscore', 'shadowbox', 'twttr'), '0.3.16', true);
	wp_localize_script('jeo.markers', 'ekuatorial_markers', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'query' => $jeo_markers->query(),
		'stories_label' => __('stories', 'ekuatorial'),
		'home' => (is_front_page() && !is_paged()),
		'copy_embed_label' => __('Copy the embed code', 'ekuatorial'),
		'share_label' => __('Share', 'ekuatorial'),
		'print_label' => __('Print', 'ekuatorial'),
		'embed_base_url' => home_url('/' . $lang . '/embed/'),
		'share_base_url' => home_url('/' . $lang . '/share/'),
		'marker_active' => array(
			'iconUrl' => get_stylesheet_directory_uri() . '/img/marker_active.png',
			'iconSize' => array(26, 30),
			'iconAnchor' => array(13, 30),
			'popupAnchor' => array(0, -40),
			'markerId' => 'none'
		),
		'language' => $lang,
		'site_url' => home_url('/'),
		'read_more_label' => __('Read more', 'ekuatorial'),
		'lightbox_label' => array(
			'slideshow' => __('Open slideshow', 'ekuatorial'),
			'videos' => __('Watch video gallery', 'ekuatorial'),
			'video' => __('Watch video', 'ekuatorial'),
			'images' => __('View image gallery', 'ekuatorial'),
			'image' => __('View fullscreen image', 'ekuatorial'),
			'infographic' => __('View infographic', 'ekuatorial'),
			'infographics' => __('View infographics', 'ekuatorial')
		),
		'enable_clustering' => jeo_use_clustering() ? true : false,
		'default_icon' => jeo_formatted_default_marker()
	));

	wp_enqueue_script('ekuatorial-sticky', get_stylesheet_directory_uri() . '/js/sticky-posts.js', array('jeo.markers', 'jquery'), '0.1.2');

	// styles
	wp_register_style('site', get_stylesheet_directory_uri() . '/css/site.css', array(), '1.1'); // old styles
	wp_register_style('reset', get_stylesheet_directory_uri() . '/css/reset.css', array(), '2.0');
	wp_register_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('jeo-skeleton', 'jeo-base', 'jeo-lsf'), '1.2.5');

	/*
	 * Enqueue scripts & styles
	 */
	// scripts
	wp_enqueue_script('html5');
	wp_enqueue_script('submit-story');
	// styles
	wp_enqueue_style('site');
	//wp_enqueue_style('reset');
	wp_enqueue_style('webfont-lato', '//fonts.googleapis.com/css?family=Lato:900');
	wp_enqueue_style('main');
	wp_enqueue_style('shadowbox');

	wp_localize_script('submit-story', 'ekuatorial_submit', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'success_label' => __('Success! Thank you, your story will be reviewed by one of our editors and soon will be online.', 'ekuatorial'),
		'redirect_label' => __('You\'re being redirect to the home page in 4 seconds.', 'ekuatorial'),
		'home' => home_url('/'),
		'error_label' => __('Oops, please try again in a few minutes.', 'ekuatorial')
	));

	wp_enqueue_script('ekuatorial-print', get_stylesheet_directory_uri() . '/js/ekuatorial.print.js', array('jquery', 'imagesloaded'));


	wp_register_script('sly', get_stylesheet_directory_uri() . '/lib/sly.min.js', array('jquery'));
	wp_enqueue_script('ekuatorial-site', get_stylesheet_directory_uri() . '/js/site.js', array('jquery','sly'));


}
add_action('wp_enqueue_scripts', 'ekuatorial_scripts', 100);

function ekuatorial_enqueue_marker_script() {
	wp_enqueue_script('ekuatorial.markers');
}
add_action('wp_footer', 'ekuatorial_enqueue_marker_script');

// ajax calendar
include(STYLESHEETPATH . '/inc/ajax-calendar.php');

// story fragment title
add_filter('wp_title', 'ekuatorial_story_fragment_title', 10, 2);
function ekuatorial_story_fragment_title($title, $sep) {
	if(isset($_GET['_escaped_fragment_'])) {
		$args = substr($_GET['_escaped_fragment_'], 1);
		parse_str($args, $query);
		if(isset($query['story'])) {
			$title = get_the_title(substr($query['story'], 9));
			return $title . ' ' . $sep . ' ';
		}
	}
	return $title;
}

// add qtranxf filter to get_permalink
if(function_exists('qtranxf_convertURL'))
	add_filter('post_type_link', 'qtranxf_convertURL');

// custom marker data
function ekuatorial_marker_data($data) {
	global $post;

	$permalink = $data['url'];
	if(function_exists('qtranxf_getLanguage'))
		$permalink = qtranxf_convertURL($data['url'], qtranxf_getLanguage());

	$data['permalink'] = $permalink;
	$data['url'] = get_post_meta($post->ID, 'url', true) ? get_post_meta($post->ID, 'url', true) : $data['permalink'];
	$data['content'] = get_the_excerpt();
	$data['slideshow'] = ekuatorial_get_content_media();
	if(get_post_meta($post->ID, 'geocode_zoom', true))
		$data['zoom'] = get_post_meta($post->ID, 'geocode_zoom', true);
	// source
	$publishers = get_the_terms($post->ID, 'publisher');
	if($publishers) {
		$publisher = array_shift($publishers);
		$data['source'] = apply_filters('single_cat_title', $publisher->name);
	}
	// thumbnail
	$data['thumbnail'] = ekuatorial_get_thumbnail();
	return $data;
}
add_filter('jeo_marker_data', 'ekuatorial_marker_data');

function ekuatorial_get_thumbnail($post_id = false) {
	global $post;
	$post_id = $post_id ? $post_id : $post->ID;
	$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumb');
	if($thumb_src)
		return $thumb_src[0];
	else
		return get_post_meta($post->ID, 'picture', true);
}

// geocode box
include(STYLESHEETPATH . '/inc/geocode-box.php');

// submit story
include(STYLESHEETPATH . '/inc/submit-story.php');

// import geojson
//include(STYLESHEETPATH . '/inc/import-geojson.php');

// remove page from search result

function ekuatorial_remove_page_from_search($query) {
	if($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts', 'ekuatorial_remove_page_from_search');

function ekuatorial_all_markers_if_none($posts, $query) {
	if(empty($posts))
		$posts = get_posts(array('post_type' => 'post', 'posts_per_page' => 100));
	return $posts;
}
//add_filter('jeo_the_markers', 'ekuatorial_all_markers_if_none', 10, 2);

// multilanguage publishers
add_action('publisher_add_form', 'qtranxf_modifyTermFormFor');
add_action('publisher_edit_form', 'qtranxf_modifyTermFormFor');

// limit markers per page
function ekuatorial_markers_limit() {
	return 100;
}
add_filter('jeo_markers_limit', 'ekuatorial_markers_limit');

// flush w3tc on save_post
function ekuatorial_flush_w3tc() {
	if(function_exists('flush_pgcache')) {
		flush_pgcache();
	}
}
add_action('save_post', 'ekuatorial_flush_w3tc');

// disable sidebar on single map
function ekuatorial_story_sidebar($conf) {
	if(is_singular('post')) {
		$conf['disableSidebar'] = true;
	}
	return $conf;
}
add_filter('jeo_map_conf', 'ekuatorial_story_sidebar');
add_filter('jeo_mapgroup_conf', 'ekuatorial_story_sidebar');

// search placeholder
function ekuatorial_search_placeholder() {
	global $wp_the_query;
	$placeholder = __('Search for stories', 'ekuatorial');
	if($wp_the_query->is_singular(array('map', 'map-group')))
		$placeholder = __('Search for stories on this map', 'ekuatorial');
	elseif($wp_the_query->is_tax('publisher'))
		$placeholder = __('Search for stories on this publisher', 'ekuatorial');

	return $placeholder;
}

// embed custom stuff

function ekuatorial_before_embed() {
	remove_action('wp_footer', 'ekuatorial_submit');
	remove_action('wp_footer', 'ekuatorial_geocode_box');
}
add_action('jeo_before_embed', 'ekuatorial_before_embed');

function ekuatorial_embed_type($post_types) {
	if(get_query_var('embed')) {
		$post_types = 'map';
	}
	return $post_types;
}
add_filter('jeo_featured_map_type', 'ekuatorial_embed_type');



// twitter card

function ekuatorial_share_meta() {

	if(is_singular('post')) {
		if(function_exists('jeo_get_mapbox_image'))
			$image = jeo_get_mapbox_image(false, 435, 375, jeo_get_marker_latitude(), jeo_get_marker_longitude(), 7);
	} elseif(is_singular('map')) {
		if(function_exists('jeo_get_mapbox_image'))
			$image = jeo_get_mapbox_image(false, 435, 375);
	} elseif(isset($_GET['_escaped_fragment_'])) {

		$fragment = $_GET['_escaped_fragment_'];

		$vars = str_replace('/', '', $fragment);
		$vars = explode('%26', $vars);

		$query = array();
		foreach($vars as $var) {
			$keyval = explode('=', $var);
			if($keyval[0] == 'story') {
				$post_id = explode('post-', $keyval[1]);
				$query[$keyval[0]] = $post_id[1];
				continue;
			}
			if($keyval[0] == 'loc') {
				$loc = explode(',', $keyval[1]);
				$query['lat'] = $loc[0];
				$query['lng'] = $loc[1];
				$query['zoom'] = $loc[2];
				continue;
			}
			$query[$keyval[0]] = $keyval[1];
		}

		if($query['story']) {
			global $post;
			setup_postdata(get_post($query['story']));
		}

		if(isset($query['map'])) {
			$map_id = $query['map'];
		}

		if($query['lat'] && $query['lng'] && $query['zoom']) {
			$lat = $query['lat'];
			$lng = $query['lng'];
			$zoom = $query['zoom'];
		}

		if(function_exists('jeo_get_mapbox_image'))
			$image = jeo_get_mapbox_image($map_id, 435, 375, $lat, $lng, $zoom);

	}

	?>
	<meta name="twitter:card" content="summary_large_image" />
	<meta name='twitter:site' content="@ekuatorial" />
	<meta name="twitter:url" content="<?php the_permalink(); ?>" />
	<meta name="twitter:title" content="<?php the_title(); ?>" />
	<meta name="twitter:description" content="<?php the_excerpt(); ?>" />

	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:description" content="<?php the_excerpt(); ?>" />
	<meta property="og:image" content="<?php echo $image; ?>" />

	<?php

	if($query['story'])
		wp_reset_postdata();

}
add_action('wp_head', 'ekuatorial_share_meta');

/*
 * Geojson keys according to language (qTranslate fix)
 */

function ekuatorial_geojson_key($key) {
	if(function_exists('qtranxf_getLanguage'))
		$key = '_ia_geojson_' . qtranxf_getLanguage();

	return $key;
}
add_filter('jeo_markers_geojson_key', 'ekuatorial_geojson_key');

function ekuatorial_geojson_keys($keys) {
	if(function_exists('qtranxf_getLanguage')) {
		global $q_config;
		$keys = array();
		foreach($q_config['enabled_languages'] as $lang) {
			$keys[] = '_ia_geojson_' . $lang;
		}
	}
	return $keys;
}
add_filter('jeo_markers_geojson_keys', 'ekuatorial_geojson_keys');

function ekuatorial_flush_rewrite() {
	global $pagenow;
	if(is_admin() && $_REQUEST['activated'] && $pagenow == 'themes.php') {
		global $wp_rewrite;
		$wp_rewrite->init();
		$wp_rewrite->flush_rules();
	}
}
add_action('jeo_init', 'ekuatorial_flush_rewrite');

function ekuatorial_convert_url($url) {
	if(function_exists('qtranxf_convertURL'))
		$url = qtranxf_convertURL($url);

	$pos = strpos($url, '?');
	if($pos === false)
		$url .= '?';
	return $url;
}
add_filter('jeo_embed_url', 'ekuatorial_convert_url');
add_filter('jeo_share_url', 'ekuatorial_convert_url');

function ekuatorial_embed_query($query) {
	if(get_query_var('jeo_map_embed')) {
		if($query->get('p') || $query->get('tax_query')) {
			error_log($query->get('p'));
			$query->set('without_map_query', 1);
		}
	}
}
add_action('pre_get_posts', 'ekuatorial_embed_query');

function ekuatorial_ignore_sticky($query) {
	if($query->is_main_query()) {
		$query->set('ignore_sticky_posts', true);
	}
}
add_action('pre_get_posts', 'ekuatorial_ignore_sticky');

/*
 * CUSTOM IMPLEMENTATION OF WP_DATE_QUERY
 */

if(!class_exists('WP_Date_Query')) {

	require(STYLESHEETPATH . '/inc/date.php');
	add_filter('query_vars', 'ekuatorial_date_query_var');
	add_filter('posts_clauses', 'ekuatorial_date_query_clauses', 10, 2);

}

function ekuatorial_date_query_var($vars) {
	$vars[] = 'date_query';
	return $vars;
}

function ekuatorial_date_query_clauses($clauses, $query) {

	if($query->get('date_query')) {
		$date_query = new WP_Date_Query($query->get('date_query'));
		$clauses['where'] .= $date_query->get_sql();
	}
	return $clauses;
}

function ekuatorial_home_url($path = '') {
	if(function_exists('qtranxf_convertURL'))
		return qtranxf_convertURL(home_url($path));
	else
		return home_url($path);
}

// do not use map query on front page

function ekuatorial_home_query($query) {
	if($query->is_main_query() && $query->is_home) {
		$query->set('without_map_query', 1);
	}
}
add_action('pre_get_posts', 'ekuatorial_home_query');

if(class_exists('SiteOrigin_Widget')) {
	include_once(STYLESHEETPATH . '/inc/siteorigin-widgets/highlight-carousel/highlight-carousel.php');
}

function newsroom_pb_parse_query($pb_query) {
	$query = wp_parse_args($pb_query);
	if($query['tax_query']) {
		$tax_args = explode(',', $query['tax_query']);
		$query['tax_query'] = array();
		foreach($tax_args as $tax_arg) {
			$tax_arg = explode(':', $tax_arg);
			if ( '-' == substr($tax_arg[1], 0, 1) ) {
				$query['tax_query'][] = array(
					'taxonomy' => $tax_arg[0],
					'field' => 'slug',
					'terms' => substr($tax_arg[1], 1),
					'operator' => 'NOT IN',
				);
			} else {
				$query['tax_query'][] = array(
					'taxonomy' => $tax_arg[0],
					'field' => 'slug',
					'terms' => $tax_arg[1]
				);	
			}
		}
	}
	return $query;
}

function ek_publishing_date( $the_date, $d, $post ) {
	$currentLang = get_locale();
	setlocale(LC_TIME, $currentLang);
	$value = get_field( "publishing_date" );
	if ( $value == false ) {
		$ts = mysql2date('U', $post->post_date);
	} else {
		$date = DateTime::createFromFormat( 'd-m-Y', $value );
		$ts = $date->format('U');
	}
	$value = date_i18n("F d, Y", $ts);
	return $value;
}
add_action( 'get_the_date', 'ek_publishing_date', 99, 3 );

function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'footer-section-1' => __( 'Footer section 1' ),
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );