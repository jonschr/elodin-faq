<?php
/*
	Plugin Name: Red Blue FAQ
	Plugin URI: http://redblue.us
	Description: Just another FAQs plugin
	Version: 1.1
    Author: Jon Schroeder
    Author URI: http://redblue.us

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/

// Plugin Directory 
define( 'FAQ_DIR', dirname( __FILE__ ) );

//* Register the post type
include_once( 'lib/post_type.php' );

//* Register the custom taxonomy
include_once( 'lib/taxonomy.php' );

//* Customize the admin panel
include_once( 'lib/admin.php' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'rbfaq_add_scripts' );
function rbfaq_add_scripts() {

    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', '', '4.2.0' );

    wp_enqueue_script( 'jquery-ui-accordion' );
    wp_enqueue_script( 'custom-accordion', plugins_url('/js/accordion.js', __FILE__), array('jquery') );
    
    wp_register_style( 'faq-style', plugins_url( '/css/faq-style.css', __FILE__) );
    wp_enqueue_style( 'faq-style' );

}

/**
 * Set up the archive template
 * @param  string $archive_template
 * @return string
 */
function rbpfaq_get_archive_template( $archive_template ) {
    global $post;

    if ( is_post_type_archive ( 'faqs' ) ) {
        $archive_template = dirname( __FILE__ ) . '/templates/archive-faqs.php';
    }
    return $archive_template;
}
add_filter( 'archive_template', 'rbpfaq_get_archive_template', 999 ) ;

/**
 * Set the posts per page to infinite on archives
 * @param  array $query
 * @return array
 */
function rbfaq_pagesize( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'faqs' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'rbfaq_pagesize', 1 );

/**
 * Add a redirect from the single template to the archive
 */
function rbfaq_redirect_faq_single_to_archive()
{
    if ( ! is_singular( 'faqs' ) )
        return;

    wp_redirect( get_post_type_archive_link( 'faqs' ), 301 );
    exit;
}
add_action( 'template_redirect', 'rbfaq_redirect_faq_single_to_archive' );