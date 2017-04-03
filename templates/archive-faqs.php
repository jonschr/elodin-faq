<?php

/**
 * Force the full width layout
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**
 * FAQ loop.
 * We're replacing the Genesis loop with our own.
 */
function rbfaq_archive_loop() {

	do_before_faq();

    if ( have_posts() ) {
    	while ( have_posts() ) {
    		the_post(); 
    		
            do_single_faq();
    	} // end while
    } // end if

    do_after_faq();
}
 
/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rbfaq_archive_loop' );

genesis();