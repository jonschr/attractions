<?php

function ac_custom_column_settings_b3d8487a() {

	ac_register_columns( 'attractions', array(
		array(
			'columns' => array(
				'5d1a9d13925fe' => array(
					'type' => 'column-featured_image',
					'label' => 'Featured Image',
					'width' => '120',
					'width_unit' => 'px',
					'featured_image_display' => 'image',
					'image_size' => 'cpac-custom',
					'image_size_w' => '100',
					'image_size_h' => '100',
					'edit' => 'on',
					'sort' => 'on',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5d1a9d13925fe',
					'label_type' => '',
					'bulk-editing' => '',
					'export' => '',
					'search' => ''
				),
				'title' => array(
					'type' => 'title',
					'label' => 'Title',
					'width' => '',
					'width_unit' => '%',
					'edit' => 'on',
					'sort' => 'on',
					'name' => 'title',
					'label_type' => '',
					'bulk-editing' => '',
					'export' => '',
					'search' => ''
				),
				'5d1a9d13a4217' => array(
					'type' => 'column-acf_field',
					'label' => 'Address',
					'width' => '',
					'width_unit' => '%',
					'field' => 'field_5d1a88d99f154',
					'character_limit' => '20',
					'edit' => 'on',
					'sort' => 'on',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5d1a9d13a4217',
					'label_type' => '',
					'bulk-editing' => '',
					'export' => '',
					'search' => ''
				),
				'5d1a9d13a525d' => array(
					'type' => 'column-acf_field',
					'label' => 'Custom URL',
					'width' => '',
					'width_unit' => '%',
					'field' => 'field_5d1a88fb9f155',
					'edit' => 'on',
					'sort' => 'on',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5d1a9d13a525d',
					'label_type' => '',
					'bulk-editing' => '',
					'export' => '',
					'search' => ''
				),
				'5d1a9d7989da7' => array(
					'type' => 'column-taxonomy',
					'label' => 'Type',
					'width' => '',
					'width_unit' => '%',
					'taxonomy' => 'attractiontype',
					'edit' => 'on',
					'enable_term_creation' => 'off',
					'sort' => 'on',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5d1a9d7989da7',
					'label_type' => '',
					'export' => '',
					'search' => ''
				)
			),
			
		)
	) );
}
add_action( 'ac/ready', 'ac_custom_column_settings_b3d8487a' );