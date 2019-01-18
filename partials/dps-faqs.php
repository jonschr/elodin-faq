<?php

// global $post;

// $title = get_the_title();
// $content = apply_filters( 'the_content', get_the_content() );

// printf( '<h3>%s</h3>', $title );
// printf( '<div class="faq-content">%s</div>', $content );

echo '<div class="faq-section">';
    printf( '<p class="header">%s<i class="fa fa-chevron-down"></i></p>', get_the_title() );
    echo '<div>';
        edit_post_link( 'Edit this FAQ', '<small>', '</small>', '' );
        the_content();
    echo '</div>';
echo '</div>';

