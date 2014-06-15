<?php
/**
 * Plugin Name: Client Review
 * Plugin URI: https://logicduudes.com/wordpress/plugins/client-review
 * Description: Review business websites and grant access based on 7-digit code
 * Version: 1.1
 * Author: Kevin Ashcraft
 * Author URI: http://kevashcraft.com
 * License: GPL2
 */
 
// Activation/Deactivation Hooks
include dirname(__FILE__) . '/class.php';
register_activation_hook(__FILE__, array('clientreview', 'activate'));
register_deactivation_hook(__FILE__, array('clientreview', 'deactivate'));

// Create the Admin Menu
add_action('admin_menu', array('clientreview', 'adminmenu'));

// Handle Incomming Data
if(is_admin()) {
	add_action('wp_ajax_cr_addareview', array('clientreview', 'addareview_receiver'));
	add_action('wp_ajax_cr_editreview', array('clientreview', 'editreviews_receiver'));
	add_action('wp_ajax_cr_showreview', array('clientreview', 'showreview_receiver'));
	add_action('wp_ajax_nopriv_cr_showreview', array('clientreview', 'showreview_receiver'));
}
// Create Shortcode
add_shortcode('clientreviews', array('clientreview', 'showreview'));

// Register Javascript
wp_register_script('clientreview', plugin_dir_url(__FILE__).'clientreview.js');
wp_localize_script( 'clientreview', 'ClientReview', array('ajaxurl' => admin_url('admin-ajax.php')));

// Add to Header
add_action('wp_head', array('clientreview', 'givehead'));