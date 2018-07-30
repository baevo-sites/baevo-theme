<?php

function disable_acf_frontend_forms_css() {
  wp_deregister_style( 'acf' );
  wp_deregister_style( 'acf-field-group' );
  wp_deregister_style( 'acf-global' );
  wp_deregister_style( 'acf-input' );
  wp_deregister_style( 'acf-datepicker' );
}
add_action( 'wp_print_styles', 'disable_acf_frontend_forms_css', 100 );

function my_acf_load_field( $field ) {
  if( ! is_admin() ){
    $field['class'] = 'form-control form-control-minimal';
    $field['wrapper']['class'] .= ' form-group';
  }
  return $field;
}
add_filter('acf/load_field', 'my_acf_load_field');

/*
function contact_form_scripts() {
  wp_enqueue_script( 
    'contact-form-js', 
    get_template_directory_uri() . '/js/contact-form.js', 
    array(), 
    '1.0.0', 
    true 
  );
};
add_action('acf/input/admin_enqueue_scripts', 'contact_form_scripts');
*/

acf_register_form(array(
	'id'		=> 'new-contact',
	'post_id'	=> 'new_post',
	'new_post'	=> array(
		'post_type'		=> 'contacts',
		'post_status'	=> 'publish'
	),
	'post_title'=> false,
  'post_content'=> false,
  'submit_value'	=> 'consulta gratuita',
  'fields' => array('name', 'email', 'content'),
  'kses'	=> true
));

add_action('acf/save_post', 'after_save_contact', 20);
function after_save_contact( $post_id ) {  
  // bail early if not a contact_form post
  if( get_post_type($post_id) !== 'contacts' ) { return; }
  // bail early if editing in admin
  // if( is_admin() ) { return; }

  $name = get_field('name', $post_id);
  $email = get_field('email', $post_id);
  $content = get_field('content', $post_id);
  
  $new_contact = array(
    'ID'           => $post_id,
    'post_title'   => $name,
  );

  wp_update_post( $new_contact, true );
  if (is_wp_error($post_id)) {
    $errors = $post_id->get_error_messages();
    foreach ($errors as $error) {
      echo $error;
    }
    return;
  };


  $to = 'angvillar@gmail.com';
  $subject = $name;
  $body = 'name: ' . $name . ' email: ' . $email . ' content: ' . $content;
  $headers = array('Content-Type: text/html; charset=UTF-8');
 
  wp_mail( $to, $subject, $body, $headers );
}

add_filter('acf/validate_value/name=name', 'validate_name', 10, 4);
function validate_name( $valid, $value, $field, $input ) {
  if (empty($value)) {
    $valid = 'Este valor es requerido.';
    return $valid;
  }

  return $valid;	
}

add_filter('acf/validate_value/name=email', 'validate_email', 10, 4);
function validate_email( $valid, $value, $field, $input ) {
  if (empty($value)) {
    return 'Este valor es requerido.';
  }

  if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
    return 'Este valor debe ser un correo válido.';
  }

  return $valid;	
}

add_filter('acf/validate_value/name=content', 'validate_content', 10, 4);
function validate_content( $valid, $value, $field, $input ) {
  if (empty($value)) {
    $valid = 'Este valor es requerido.';
    return $valid;
  }

  return $valid;	
}