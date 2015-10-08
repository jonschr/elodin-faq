<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @author       Jon Schroeder <jon@redblue.us>
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Create Services post type
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function faq_register_post_type() {
	$labels = array(
		'name' => 'FAQs',
		'singular_name' => 'FAQ',
		'add_new' => 'Add new',
		'add_new_item' => 'Add new FAQ',
		'edit_item' => 'Edit FAQ',
		'new_item' => 'New FAQ',
		'view_item' => 'View FAQ',
		'search_items' => 'Search FAQs',
		'not_found' =>  'No FAQs found',
		'not_found_in_trash' => 'No FAQs found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'FAQs'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'rewrite' => true,
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-format-status',
		'supports' => array( 'title', 'editor', 'genesis-cpt-archives-settings' )
	); 

	register_post_type( 'faqs', $args );

}
add_action( 'init', 'faq_register_post_type' );	