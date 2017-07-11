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

    wp_register_style( 'font-awesome-faq', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', '', '4.2.0' );
    wp_register_style( 'faq-style', plugins_url( '/css/faq-style.css', __FILE__) );

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

//* Define what an individual faq entry looks like
function do_single_faq() {

    echo '<div class="faq-section">';
        printf( '<p class="header">%s<i class="fa fa-chevron-down"></i></p>', get_the_title() );
        echo '<div>';
            edit_post_link( 'Edit this FAQ', '<small>', '</small>', '' );
            the_content();
        echo '</div>';
    echo '</div>';
}

//* For use with the Genesis Simple Query Shortcodes plugin, attach this
add_action( 'add_loop_layout_faqs', 'do_single_faq' );

//* Just for the Genesis Simple Query Shotrcodes plugin, we'll need those styles included
add_action( 'before_loop_layout_faqs', 'do_before_faq' );
function do_before_faq() {

    //* Get a random number to allow for multiples on a page
    $id = rand ( 1, 10000 );

    //* Scripts to make this work
    wp_enqueue_script( 'jquery-ui-accordion' );

    ?>
    <script>
    jQuery(document).ready(function($) {
        $( "#accordion-<?php echo $id; ?>" ).accordion({
            collapsible: true,
            active: false,
            header: 'div.faq-section > p.header',
            heightStyle: 'content'
        });
    });
    </script>

    <?php

    //* A few required styles
    wp_enqueue_style( 'font-awesome-faq', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', '', '4.2.0' );
    wp_enqueue_style( 'faq-style' );

    //* Do a wrapper with a random ID (allows for multiple on a page)
    printf( '<div id="accordion-%s">', $id );

}

add_action( 'after_loop_layout_faqs', 'do_after_faq' );
function do_after_faq() {
    echo '</div>'; // #accordion-{{THE RANDOM ID}}
}
