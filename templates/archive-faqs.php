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

	echo '<div id="accordion" class="entry-content faqspage">';
    if ( have_posts() ) {
    	while ( have_posts() ) {
    		the_post(); 
    		?>

    		<div class="faq-section">
    			<h3><?php the_title(); ?><i class="fa fa-chevron-down"></i></h3>
    			<div>
    				<?php edit_post_link( 'Edit this FAQ', '<small>', '</small>', '' ); ?>
    				<?php the_content(); ?>
    			</div>
    		</div>
    	
			<?php
    	} // end while
    } // end if
    echo '</div>';
}
 
/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'rbfaq_archive_loop' );

genesis();