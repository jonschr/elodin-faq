<?php

function faq_custom_title_admin( $title ){
     $screen = get_current_screen();
 
     if  ( 'faqs' == $screen->post_type ) {
          $title = 'Enter the question right here';
     }
 
     return $title;
}
add_filter( 'enter_title_here', 'faq_custom_title_admin' );

add_filter( 'default_content', 'faq_content_admin', 10, 2 );

function faq_content_admin( $content, $post ) {

    switch( $post->post_type ) {
        case 'faqs':
            $content = 'Enter the answer to your question here (and delete this sentence).';
        break;
        default:
            $content = '';
        break;
    }

    return $content;
}

/**
 * Remove the WordPress SEO metabox
 */
function rbfaq_remove_wp_seo_meta_box() {
    remove_meta_box( 'wpseo_meta', 'faqs', 'normal' ); // change custom-post-type into the name of your custom post type
}
add_action( 'add_meta_boxes', 'rbfaq_remove_wp_seo_meta_box', 100000 );