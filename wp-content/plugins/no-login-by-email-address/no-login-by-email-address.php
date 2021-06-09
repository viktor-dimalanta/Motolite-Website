<?php
/*
Plugin Name: No Login by Email Address
Description: Prevent log in by email address
Author: Michael Atkins
Version: 1.2.0
Author URI: http://cubecolour.co.uk/
*/


if ( ! defined( 'ABSPATH' ) ) exit;


/**
* Replace 'Username or Email' input label with 'Username'
*
*/
function cc_login_username_label_change( $translated_text, $text, $domain )  {
	if ($text === 'Username or Email Address') {
		$translated_text = __( 'Username' ); // Use WordPress's own translation of 'Username'
	}
	return $translated_text;
}


/**
* Filter text in login head
*
*/
function cc_login_username_label() {
	add_filter( 'gettext', 'cc_login_username_label_change', 20, 3 );
}

add_action( 'login_head', 'cc_login_username_label' );


/**
* Filter wp_login_form username default
*
*/
function cc_change_login_username_label( $defaults ){
    $defaults['label_username'] = __( 'Username' );
    return $defaults;
}

add_filter( 'login_form_defaults', 'cc_change_login_username_label' );


/**
* Remove email/password authentication
*
*/
remove_filter( 'authenticate', 'wp_authenticate_email_password', 20 );
