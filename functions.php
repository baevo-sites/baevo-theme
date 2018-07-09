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

class StarterSite extends TimberSite {

  function __construct() {
  
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_action( 'wp_enqueue_scripts', array( $this, 'loadScripts' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
    parent::__construct();
  }

  function add_to_context( $context ) {
    $context['site'] = $this;
    return $context;
  }
 
  function loadScripts() {
    wp_enqueue_script(
       'app' 
      , get_template_directory_uri() . '/dist/index.js'
      , array()
      , false
      , true
    );
  }

  function register_post_types() {
		// Register Works
    $works_labels = array(
      'name'               => 'Works',
      'singular_name'      => 'Work',
      'menu_name'          => 'Works'
    );
    $works_args = array(
      'labels'             => $works_labels,
      'public'             => true,
      'capability_type'    => 'post',
      'has_archive'        => true,
      'supports'           => array( 'title' ),
    );
    register_post_type('works', $works_args);

    // Contact form
    $contacts_labels = array( 
      'name'          => 'Contacts',
      'singular_name' => 'Contact',
      'menu_name'     => 'Contacts'
    );
    $contacts_args = array(
      'labels'             => $contacts_labels,
      'public'             => true,
      'capability_type'    => 'post',
      'has_archive'        => true,
      'supports'           => array('title')
    );
    register_post_type('contacts', $contacts_args);
  }

}

new StarterSite();

require_once( __DIR__ . '/inc/functions-contact-form.php' );
 