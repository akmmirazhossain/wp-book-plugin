<?php
/*
Plugin Name: AKM Divi Ext
Plugin URI:  akm-divi-ext
Description: Demo Divi Ext by akm
Version:     1.0.0
Author:      AKM Miraz
Author URI:  
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: akmde-akm-divi-ext
Domain Path: /languages

AKM Divi Ext is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

AKM Divi Ext is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with AKM Divi Ext. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


if ( ! function_exists( 'akmde_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function akmde_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/AkmDiviExt.php';
}
add_action( 'divi_extensions_init', 'akmde_initialize_extension' );
endif;
