<?php
/*
	Plugin Name: Attractions
	Plugin URI: https://elod.in
    Description: Just another local attractions plugin
	Version: 1.0.1
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Plugin directory
define( 'ATTRACTIONS', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ATTRACTIONS_VERSION', '1.0.1' );

require_once( 'lib/post_type.php' );
require_once( 'lib/tax.php' );
require_once( 'lib/layout.php' ); 
require_once( 'lib/fields.php' );
require_once( 'lib/admin_columns.php' );

add_action( 'wp_enqueue_scripts', 'attractions_enqueue' );
function attractions_enqueue() {
	
	// Plugin styles
    wp_enqueue_style( 'attractions-style', plugin_dir_url( __FILE__ ) . 'css/attractions-style.css', array(), ATTRACTIONS_VERSION, 'screen' );
    
}

//* Remove Yoast
add_action('add_meta_boxes', 'my_remove_wp_seo_meta_box', 100);
function my_remove_wp_seo_meta_box() {
	remove_meta_box('wpseo_meta', 'attractions', 'normal');
}


// Updater
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/attractions',
	__FILE__,
	'attractions'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

