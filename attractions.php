<?php
/*
	Plugin Name: Attractions
	Plugin URI: https://elod.in
    Description: Just another local attractions plugin
	Version: 1.1
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
define( 'ATTRACTIONS_VERSION', '1.1' );
define( 'ATTRACTIONS_DIR', plugin_dir_path( __FILE__ ) );

require_once( 'lib/post_type.php' );
require_once( 'lib/tax.php' );
require_once( 'lib/layout.php' ); 
require_once( 'lib/fields.php' );
// require_once( 'lib/admin_columns.php' );

add_action( 'wp_enqueue_scripts', 'attractions_enqueue' );
function attractions_enqueue() {
	
	// Plugin styles
    wp_enqueue_style( 'attractions-style', plugin_dir_url( __FILE__ ) . 'css/attractions-style.css', array(), ATTRACTIONS_VERSION, 'screen' );
    
}

//* Remove Yoast
add_action('add_meta_boxes', 'my_remove_wp_seo_meta_box', 100);
function my_remove_wp_seo_meta_box() {
	remove_meta_box( 'wpseo_meta', 'attractions', 'normal');
}


///////////////////////
// ADMIN COLUMNS PRO //
///////////////////////

use AC\ListScreenRepository\Storage\ListScreenRepositoryFactory;
use AC\ListScreenRepository\Rules;
use AC\ListScreenRepository\Rule;
add_filter( 'acp/storage/repositories', function( array $repositories, ListScreenRepositoryFactory $factory ) {
    
    //! Change $writable to true to allow changes to columns for the content types below
    $writable = false;
    
    // 2. Add rules to target individual list tables.
    // Defaults to Rules::MATCH_ANY added here for clarity, other option is Rules::MATCH_ALL
    $rules = new Rules( Rules::MATCH_ANY );
    $rules->add_rule( new Rule\EqualType( 'attractions' ) );
    
    // 3. Register your repository to the stack
    $repositories['attractions'] = $factory->create(
        ATTRACTIONS_DIR . '/acp-settings',
        $writable,
        $rules
    );
    
    return $repositories;
    
}, 10, 2 );

/////////
// ACF //
/////////

//! UNCOMMENT THIS FILTER TO SAVE ACF FIELDS TO PLUGIN
// add_filter( 'acf/settings/save_json', 'attractions_acf_json_save_point' );
function attractions_acf_json_save_point( $path ) {
    
    // update path
    $path = ATTRACTIONS_DIR . 'acf-json';
    
    // return
    return $path;
    
}

add_filter( 'acf/settings/load_json', 'attractions_acf_json_load_point' );
function attractions_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = ATTRACTIONS_DIR . 'acf-json';
    
    // return
    return $paths;
    
}

/////////////
// Updater //
/////////////

require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/attractions',
	__FILE__,
	'attractions'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

