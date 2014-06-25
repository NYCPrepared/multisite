<?php
/*
Plugin Name: Contact Form 7 IE DatePicker and Number Spinner Fix
Description: Add the DatePicker and Number Spinner functionality to the Internet Explorer in Contact Form 7
Version: 2.5
Author: Benjamin Klein
Author URI: http://touchdata.net
License: GPL2
*/
function td_dp_script() {
	/* register own scripts */
	wp_register_script ( 'jquery-spinner', plugins_url ( '/js/jquery.ui.spinner.js', __FILE__ ), array (
			'jquery',
			'jquery-ui-core',
			'jquery-ui-widget',
			'jquery-ui-button'
	), false, true );
	wp_register_script ( 'custom_script', plugins_url ( '/js/cf7-datepicker-ie-fixer.js', __FILE__ ), array (
			'jquery',
			'jquery-ui-core',
			'jquery-ui-widget',
			'jquery-ui-datepicker',
			'jquery-spinner'
	), false, true );

	/* load script */
	wp_enqueue_script ( 'jquery' );
	wp_enqueue_script ( 'jquery-ui-core' );
	wp_enqueue_script ( 'jquery-ui-widget' );
	wp_enqueue_script ( 'jquery-ui-button' );
	wp_enqueue_script ( 'jquery-ui-datepicker' );
	wp_enqueue_script ( 'jquery-spinner' );
	wp_enqueue_script ( 'custom_script' );
}
function td_dp_styles() {
	/* set styles */
	wp_register_style ( 'jquery-ui-css', plugins_url ( '/css/jquery-ui.css', __FILE__, true ) );
	/* load styles */
	wp_enqueue_style ( 'jquery-ui-css' );
}
add_action ( 'wp_enqueue_scripts', 'td_dp_script' );
add_action ( 'wp_print_styles', 'td_dp_styles' );
?>