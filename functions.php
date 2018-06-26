<?php
require_once( __DIR__ . '/vendor/autoload.php' );
$timber = new \Timber\Timber();

Timber::$dirname = array('templates');

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = get_template_directory() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/';
    
    // return
    return $path;
    
}
 

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_template_directory_uri() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/';
    
    // return
    return $dir;
    
}
 

// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');
add_filter('acf/settings/show_admin', '__return_true');


// 4. Include ACF
include_once(get_template_directory() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/acf.php' );

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_template_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}
 