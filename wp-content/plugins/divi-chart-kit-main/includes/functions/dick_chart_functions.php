<?php
/**
 * Check if TablePress is activated
 *
 * @return bool
 */
function dick_table_press_activate_status() {
	return class_exists( 'TablePress' );
}

/**
 * TablePress Tables List
 *
 * @return array
 */
function dick_fetch_table_press() {
	$lists = [];
	if ( ! dick_table_press_activate_status() ) return $lists;

	$tables = TablePress::$model_table->load_all( true ) ;
	if( $tables ) {
        $lists['select']  = 'Select Table';
		foreach ( $tables as $table ) {
			$table = TablePress::$model_table->load( $table, false, false );
			$lists[$table['id']] = $table['name'];
		}
	}

	return $lists;
}

/**
 * Database Table List
 *
 * @return array
 */
function dick_database_tables() {
	global $wpdb;

	$tables_list = [];
	$tables = $wpdb->get_results('show tables', ARRAY_N); // phpcs:ignore WordPress.DB.DirectDatabaseQuery

	if ( $tables ) {
		$tables = wp_list_pluck( $tables, 0 );
        $tables_list['select']  = 'Select Table';
		foreach ( $tables as $table ) {
			$tables_list[$table] = $table;
		}
	}

	return $tables_list;
}

/* Default Value Set Function */

if ( ! function_exists( 'dick_default_values_for_divi' ) ):
	// wp-content/plugins/divi-shop-builder/divi-shop-builder.php:1457
	function dick_default_values_for_divi( $defs ) {


		$modules_defaults = array(
			'item_label_1'    => _x( 'Test 1', 'Modules dummy content', 'et_builder' ),
			'data_set_values_1' => _x( '10,20,30,40,50,60,70,80,90,100,110,120', 'et_builder' ),
			'item_label_2'    => _x( 'Test 2', 'Modules dummy content', 'et_builder' ),
			'data_set_values_2' => _x( '40,30,20,40,20,80,70,80,10,90,100,110', 'et_builder' ),
		);

		$single_shortcode_1 = sprintf(
			'[dick_line_chart_child item_label="%1$s" data_set_values="%2$s"][/dick_line_chart_child]',
			$modules_defaults['item_label_1'],
			$modules_defaults['data_set_values_1']
		);

		$single_shortcode_2 = sprintf(
			'[dick_line_chart_child item_label="%1$s" data_set_values="%2$s"][/dick_line_chart_child]',
			$modules_defaults['item_label_2'],
			$modules_defaults['data_set_values_2']
		);
		

		$shortcodes = implode( '', array( $single_shortcode_1, $single_shortcode_2 ) );


		return $defs . sprintf(
				'; window.DICK_Chart_Data=%s;',
				et_fb_remove_site_url_protocol(
					wp_json_encode(
						array(
							// wp-content/themes/Divi/includes/builder/functions.php:11181
							// wp-content/themes/Divi/includes/builder/frontend-builder/helpers.php:727
							
							'lineChartDefault'       => array(
								'content' => et_fb_process_shortcode( $shortcodes )
							),
							// 'iconListItemDefault'  => array(
							// 	'list_item_title'     => $modules_defaults['title'],
							// 	'list_icon_type'      => 'icon',
							// 	'list_item_icon'      => $modules_defaults['icon']['icon_list'],
							// 	'list_item_image'     => $modules_defaults['image']['landscape'],
							// 	'list_item_icon_text' => '01',
							// 	'alt' => 'Icon Image',
							// 	'admin_label' => 'List item',
							// ),
						),
						ET_BUILDER_JSON_ENCODE_OPTIONS
					)
				)
			);
	}

	add_filter( 'et_fb_get_asset_definitions', 'dick_default_values_for_divi', 11 );
endif;