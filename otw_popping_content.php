<?php
/**
Plugin Name: Popping Content Light
Plugin URI: http://OTWthemes.com
Description:  Create custom popping layouts and insert ready to use shortcodes in just a few clicks. 
Author: OTWthemes
Version: 2.4
Author URI: https://codecanyon.net/user/otwthemes/portfolio?ref=OTWthemes
*/

load_plugin_textdomain('otw_pcl',false,dirname(plugin_basename(__FILE__)) . '/languages/');

$otw_pcl_plugin_url = plugin_dir_url( __FILE__);
$otw_pcl_plugin_id = '74378ffa2cc0b7484e9b3cffc6adb7e3';
$otw_pcl_js_version = '1.5';
$otw_pcl_css_version = '1.5';

//include functons
require_once( plugin_dir_path( __FILE__ ).'/include/otw_pcl_functions.php' );
require_once( plugin_dir_path( __FILE__ ).'/include/otw_pcl_core.php' );

//components
$otw_pcl_grid_manager_component = false;
$otw_pcl_grid_manager_object = false;
$otw_pcl_shortcode_component = false;
$otw_pcl_factory_component = false;
$otw_pcl_factory_object = false;
$otw_pcl_form_component = false;
$otw_pcl_validator_component = false;
$otw_pcl_overlay_component = false;
$otw_pcl_overlay_object = false;

//load core component functions
@include_once( 'include/otw_components/otw_functions/otw_functions.php' );

if( !function_exists( 'otw_register_component' ) ){
	wp_die( 'Please include otw components' );
}

otw_set_up_memory_limit( '124M' );

//register grid manager component
otw_register_component( 'otw_overlay_grid_manager', dirname( __FILE__ ).'/include/otw_components/otw_overlay_grid_manager_light/', $otw_pcl_plugin_url.'/include/otw_components/otw_overlay_grid_manager_light/' );

//register form component
otw_register_component( 'otw_form', dirname( __FILE__ ).'/include/otw_components/otw_form/', $otw_pcl_plugin_url.'/include/otw_components/otw_form/' );

//register factory component
otw_register_component( 'otw_factory', dirname( __FILE__ ).'/include/otw_components/otw_factory/', $otw_pcl_plugin_url.'include/otw_components/otw_factory/' );

//register validator component
otw_register_component( 'otw_validator', dirname( __FILE__ ).'/include/otw_components/otw_validator/', $otw_pcl_plugin_url.'/include/otw_components/otw_validator/' );

//register shortcode component
otw_register_component( 'otw_overlay_shortcode', dirname( __FILE__ ).'/include/otw_components/otw_overlay_shortcode/', $otw_pcl_plugin_url.'/include/otw_components/otw_overlay_shortcode/' );

//register overlay component
otw_register_component( 'otw_overlay', dirname( __FILE__ ).'/include/otw_components/otw_overlay_light/', $otw_pcl_plugin_url.'/include/otw_components/otw_overlay_light/' );

add_action('init', 'otw_pcl_init' );

if( is_admin() ){
	add_action( 'wp_ajax_otw_pcl_admin_settings', 'otw_pcl_admin_settings' );
}
