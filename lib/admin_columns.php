<?php

/**
 * Automatically set up the columns if Admin Columns Pro is installed
 */
function ac_custom_column_settings_c4198dc0() {

	ac_register_columns( 'faqs', array(
		array(
			'columns' => array(
				'title' => array(
					'type' => 'title',
					'label' => 'Question',
					'width' => '',
					'width_unit' => '%',
					'edit' => 'on',
					'sort' => 'on',
					'name' => 'title',
					'label_type' => '',
					'search' => ''
				),
				'5bd9f34267bdf' => array(
					'type' => 'column-content',
					'label' => 'Answer',
					'width' => '',
					'width_unit' => '%',
					'string_limit' => 'word_limit',
					'excerpt_length' => '5',
					'before' => '',
					'after' => '',
					'edit' => 'on',
					'sort' => 'off',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5bd9f34267bdf',
					'label_type' => '',
					'search' => ''
				),
				'5bd9f2eb8d4a5' => array(
					'type' => 'column-taxonomy',
					'label' => 'FAQ Category',
					'width' => '',
					'width_unit' => '%',
					'taxonomy' => 'faq-categories',
					'edit' => 'on',
					'enable_term_creation' => 'on',
					'sort' => 'on',
					'filter' => 'on',
					'filter_label' => '',
					'name' => '5bd9f2eb8d4a5',
					'label_type' => '',
					'search' => ''
				),
				'5bd9f2eb8e112' => array(
					'type' => 'column-author_name',
					'label' => 'Author',
					'width' => '',
					'width_unit' => '%',
					'display_author_as' => 'display_name',
					'user_link_to' => 'edit_user',
					'edit' => 'on',
					'sort' => 'on',
					'filter' => 'on',
					'filter_label' => '',
					'name' => '5bd9f2eb8e112',
					'label_type' => '',
					'search' => ''
				),
				'5bd9f2eb8eb93' => array(
					'type' => 'column-modified',
					'label' => 'Last Modified',
					'width' => '',
					'width_unit' => '%',
					'date_format' => 'diff',
					'edit' => 'off',
					'sort' => 'on',
					'filter' => 'off',
					'filter_label' => '',
					'filter_format' => '',
					'name' => '5bd9f2eb8eb93',
					'label_type' => '',
					'search' => ''
				)
			),
			
		)
	) );
}
add_action( 'ac/ready', 'ac_custom_column_settings_c4198dc0' );