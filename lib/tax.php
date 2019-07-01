<?php

add_action( 'init', 'attractions_register_tax' );
function attractions_register_tax() {
	register_taxonomy(
		'attractiontype',
		'attractions',
		array(
			'label' => __( 'Attraction types' ),
			'rewrite' => array( 'slug' => 'attractiontype' ),
			'hierarchical' => true,
		)
	);
}