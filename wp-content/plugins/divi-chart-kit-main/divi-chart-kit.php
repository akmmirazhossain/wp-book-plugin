<?php
/*
Plugin Name: Divi Chart Kit
Plugin URI:  divichart.com
Description: Divi Chart Kit
Version:     1.0.0
Author:      Linereflection
Author URI:  linereflection.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dick-divi-chart-kit
Domain Path: /languages

Divi Chart Kit is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divi Chart Kit is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divi Chart Kit. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}
/**
 * define version and dir paths
 * 
 */
if(!defined('DIVI_CHART_KIT_PLUGIN_VERSION')) {
	define('DIVI_CHART_KIT_PLUGIN_VERSION','1.0.0');
}
if ( ! defined( 'DIVI_CHART_KIT_PLUGIN_BASENAME' ) ) {
	define( 'DIVI_CHART_KIT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if(!defined('DIVI_CHART_KIT_PLUGIN_DIR')) {
	define('DIVI_CHART_KIT_PLUGIN_DIR', __DIR__);
}
if(!defined('DIVI_CHART_KIT_PLUGIN_FILE_PATH')) {
	define('DIVI_CHART_KIT_PLUGIN_FILE_PATH', __FILE__);
}


if(!defined('DIVI_CHART_KIT_ADMIN_DIR')) {
	define('DIVI_CHART_KIT_ADMIN_DIR', trailingslashit(plugin_dir_url(__FILE__)) . 'admin/');
}
if(!defined('DIVI_CHART_KIT_ADMIN_DIR_PATH')) {
	define('DIVI_CHART_KIT_ADMIN_DIR_PATH', plugin_dir_path( __FILE__ ) . 'admin/');
}

// if ( ! function_exists( 'dick_initialize_extension' ) ):
// /**
//  * Creates the extension's main class instance.
//  *
//  * @since 1.0.0
//  */
// function dick_initialize_extension() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviChartKit.php';
// }
// add_action( 'divi_extensions_init', 'dick_initialize_extension' );
// endif;

if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}


// function dick_check_requirements() {
//     // Add the WooCommerce add to cart button conditionally
//     if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
//         return true;
//     }

//     add_action( 'admin_notices', 'dick_missing_wc_notice' );

//     return false;
// }


// function dick_missing_wc_notice() {
//     $class   = 'notice notice-error';
//     $message = __( 'Divi Mini Cart Expand requires WooCommerce to be installed and active.', 'mini-cart-expand' );

//     printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
// }


function activate_Divi_dick() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-divi-chart-kit-activator.php';
    Divi_Chart_Kit_Activator::activate();
}


function deactivate_Divi_dick() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-divi-chart-kit-deactivator.php';
    Divi_Chart_Kit_Deactivator::deactivate();
}

//add_action( 'plugins_loaded', 'dick_check_requirements' );

register_activation_hook( __FILE__, 'activate_Divi_dick' );
register_deactivation_hook( __FILE__, 'deactivate_Divi_dick' );

require plugin_dir_path( __FILE__ ) . 'includes/functions/dick_wphoop_core.php';
require plugin_dir_path( __FILE__ ) . 'includes/functions/dick_chart_functions.php';


require plugin_dir_path( __FILE__ ) . 'includes/class-divi-chart-kit.php';

function dick_chart_kit_start() {
	$plugin = new Divi_Chart_Kit();
	$plugin->run();
}

dick_chart_kit_start();