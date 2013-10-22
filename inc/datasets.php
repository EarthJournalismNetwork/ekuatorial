<?php

/*
 * Ekuatorial
 * Data sets
 */

class Ekuatorial_DataSets {

	function __construct() {

		add_action('init', array($this, 'register_post_type'));
		add_action('init', array($this, 'register_taxonomies'));
		add_filter('upload_mimes', array($this, 'upload_mimes'));

	}

	function register_post_type() {

		$labels = array( 
			'name' => __('Datasets', 'ekuatorial'),
			'singular_name' => __('Dataset', 'ekuatorial'),
			'add_new' => __('Add dataset', 'ekuatorial'),
			'add_new_item' => __('Add new dataset', 'ekuatorial'),
			'edit_item' => __('Edit dataset', 'ekuatorial'),
			'new_item' => __('New dataset', 'ekuatorial'),
			'view_item' => __('View dataset', 'ekuatorial'),
			'search_items' => __('Search dataset', 'ekuatorial'),
			'not_found' => __('No dataset found', 'ekuatorial'),
			'not_found_in_trash' => __('No dataset found in the trash', 'ekuatorial'),
			'menu_name' => __('Datasets', 'ekuatorial')
		);

		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => __('Ekuatorial Datasets', 'ekuatorial'),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'has_archive' => true,
			'menu_position' => 4,
			'rewrite' => array('slug' => 'datasets', 'with_front' => false)
		);

		register_post_type('dataset', $args);

	}

	function register_taxonomies() {

		$labels = array(
			'name' => _x('Licenses', 'License general name', 'ekuatorial'),
			'singular_name' => _x('License', 'License singular name', 'ekuatorial'),
			'all_items' => __('All licenses', 'ekuatorial'),
			'edit_item' => __('Edit license', 'ekuatorial'),
			'view_item' => __('View license', 'ekuatorial'),
			'update_item' => __('Update license', 'ekuatorial'),
			'add_new_item' => __('Add new license', 'ekuatorial'),
			'new_item_name' => __('New license name', 'ekuatorial'),
			'parent_item' => __('Parent license', 'ekuatorial'),
			'parent_item_colon' => __('Parent license:', 'ekuatorial'),
			'search_items' => __('Search licenses', 'ekuatorial'),
			'popular_items' => __('Popular licenses', 'ekuatorial'),
			'separate_items_with_commas' => __('Separate licenses with commas', 'ekuatorial'),
			'add_or_remove_items' => __('Add or remove licenses', 'ekuatorial'),
			'choose_from_most_used' => __('Choose from most used licenses', 'ekuatorial'),
			'not_found' => __('No licenses found', 'ekuatorial')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_admin_column' => true,
			'hierarchical' => false,
			'query_var' => 'license',
			'rewrite' => array('slug' => 'datasets/licenses', 'with_front' => false)
		);

		register_taxonomy('license', 'dataset', $args);

		$labels = array(
			'name' => _x('Sources', 'Source general name', 'ekuatorial'),
			'singular_name' => _x('Source', 'Source singular name', 'ekuatorial'),
			'all_items' => __('All sources', 'ekuatorial'),
			'edit_item' => __('Edit source', 'ekuatorial'),
			'view_item' => __('View source', 'ekuatorial'),
			'update_item' => __('Update source', 'ekuatorial'),
			'add_new_item' => __('Add new source', 'ekuatorial'),
			'new_item_name' => __('New source name', 'ekuatorial'),
			'parent_item' => __('Parent source', 'ekuatorial'),
			'parent_item_colon' => __('Parent source:', 'ekuatorial'),
			'search_items' => __('Search sources', 'ekuatorial'),
			'popular_items' => __('Popular sources', 'ekuatorial'),
			'separate_items_with_commas' => __('Separate sources with commas', 'ekuatorial'),
			'add_or_remove_items' => __('Add or remove sources', 'ekuatorial'),
			'choose_from_most_used' => __('Choose from most used sources', 'ekuatorial'),
			'not_found' => __('No sources found', 'ekuatorial')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_admin_column' => true,
			'hierarchical' => false,
			'query_var' => 'source',
			'rewrite' => array('slug' => 'datasets/sources', 'with_front' => false)
		);

		register_taxonomy('source', 'dataset', $args);

	}

	function upload_mimes($mimes = array()) {

		$mimes['csv'] = 'text/csv';
		$mimes['geojson'] = 'application/json';
		$mimes['json'] = 'application/json';

		return $mimes;
	}

}

$GLOBALS['ekuatorial_datasets'] = new Ekuatorial_DataSets();