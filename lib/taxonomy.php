<?php


function faq_register_faq_category_taxonomy() {
	$labels = array(
		'name' => 'FAQ Categories',
		'singular_name' => 'FAQ Category',
		'search_items' =>  'Search FAQ categories',
		'all_items' => 'All FAQ Categories',
		'parent_item' => 'Parent FAQ Category',
		'parent_item_colon' => 'Parent FAQ Category:',
		'edit_item' => 'Edit FAQ Category',
		'update_item' => 'Update FAQ Category',
		'add_new_item' => 'Add New FAQ Category',
		'new_item_name' => 'New FAQ Category Name',
		'menu_name' => 'FAQ Categories'
	); 	

	register_taxonomy( 'faq-categories', array( 'faqs' ),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'faq-categories' ),
		)
	);
}
add_action( 'init', 'faq_register_faq_category_taxonomy' );

function rb_edit_faqs_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Question' ),
		'faq-categories' => __( 'Category' ),
		'date' => __( 'Date published' )
	);

	return $columns;
}
add_filter( 'manage_edit-faqs_columns', 'rb_edit_faqs_columns' ) ;

add_action( 'manage_faqs_posts_custom_column', 'manage_faq_columns', 10, 2 );

function manage_faq_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'genre' column. */
		case 'faq-categories' :

			/* Get the genres for the post. */
			$terms = get_the_terms( $post_id, 'faq-categories' );

			/* If terms were found. */
			if ( !empty( $terms ) ) {

				$out = array();

				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'faqs' => $post->post_type, 'faq-categories' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'faq-categories', 'display' ) )
					);
				}

				/* Join the terms, separating them with a comma. */
				echo join( ', ', $out );
			}

			/* If no terms were found, output a default message. */
			else {
				_e( 'No Category Assigned' );
			}

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}