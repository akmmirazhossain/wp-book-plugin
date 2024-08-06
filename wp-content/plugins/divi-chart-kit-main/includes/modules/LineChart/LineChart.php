<?php

class DICK_LineChart extends ET_Builder_Module {

	public $slug       = 'dick_line_chart';
	public $vb_support = 'on';
	public $child_slug = 'dick_line_chart_child';

	protected $module_credits = array(
		'module_uri' => 'wphoop.com',
		'author'     => 'wphoop',
		'author_uri' => 'wphoop.com',
	);

	public function init() {
		$this->name = esc_html__( 'Line Chart', 'dick-divi-chart-kit' );
	}

	public function get_settings_modal_toggles(){
        return array(
            'general'   => array(
                'toggles'      => array(
                  
                    'chart_settings'          => esc_html__('Chart Settings', 'dick-divi-chart-kit'),
                    'chart_basic_settings'    => esc_html__('Chart General Settings', 'dick-divi-chart-kit'),
                    'config_settings'         => esc_html__('Config Settings', 'dick-divi-chart-kit'),
                    'stroke_settings'         => esc_html__('Stroke Settings', 'dick-divi-chart-kit'),
                    'legend_settings'         => esc_html__('Legend Settings', 'dick-divi-chart-kit'),
                    'X_axis_settings'         => esc_html__('X Axis Settings', 'dick-divi-chart-kit'),
                    'y_axix_settings'         => esc_html__('Y Axis Settings', 'dick-divi-chart-kit'),
                    'tooltip_settings'        => esc_html__('Tooltip Settings', 'dick-divi-chart-kit'),
                    'animation_settings'      => esc_html__('Animation Settings', 'dick-divi-chart-kit'),
                    'responsible_settings'    => esc_html__('Responsible Settings', 'dick-divi-chart-kit'),
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'stroke_settings'         => esc_html__('Stroke', 'dick-divi-chart-kit'),
                )
            ),
        );
    }

    public function get_advanced_fields_config() {
        $advanced_fields = array();
        
    
        return $advanced_fields;
    }

    public function get_fields() {
        $chart_settings = array(
            'chart_data_type' => array(
                'label'                 => esc_html__('Chart Data Type', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'custom',
                'options'               => array(
                    'custom'             => esc_html__('Custom', 'dick-divi-chart-kit'),
                    'csv_upload'             => esc_html__('CSV Upload File', 'dick-divi-chart-kit'),
                    'import_table_data'           => esc_html__('Import Table', 'divi_flash'),
                    'database'         => esc_html__('Database', 'dick-divi-chart-kit'),
                    'api'             => esc_html__('API', 'dick-divi-chart-kit'),
                    'google_sheet'     => esc_html__('Google Sheet', 'dick-divi-chart-kit'),
                ),
                'toggle_slug'           => 'chart_settings',
                'tab_slug'              => 'general',
            ),

            'csv_upload_data' => array(
                'label'           => esc_html__( 'CSV Upload', 'et_builder' ),
                'description'     => esc_html__('Only CSV file will support'),
				'type'            => 'upload',
                'data_type'       => 'mine',
                'addImage'   => esc_html__( 'Add CSV File', 'et_builder' ),
                'upload_new_text'        => esc_attr__( 'Add CSV File', 'et_builder' ),
                'upload_button_text' => esc_attr__( 'Upload a csv', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose a csv', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As csv', 'et_builder' ),
				'toggle_slug'     => 'chart_settings', 
                'show_if'         => array(
                        'chart_data_type' => 'csv_upload'
                )
            ),

            'import_table_data' => array(
                'label'           => esc_html__( 'CSV Data', 'et_builder' ),
                'description'     => esc_html__('Put Comma separated Data'),
				'type'            => 'codemirror',
				'mode'            => 'html',
				'toggle_slug'     => 'chart_settings', 
                'show_if'         => array(
                        'chart_data_type' => 'import_table_data'
                )
            ),

            'database_tables_list'    => array(
                'label'    => esc_html__('Table Name', 'divi_flash'),
                'type'          => 'select',
                'options'       => dick_database_tables(),
                'default'       => 'select',
                'toggle_slug'   => 'chart_settings',
                'show_if'         => array(
                    'chart_data_type' => 'database_table'
                )
            ),

            'table_press_list'    => array(
                'label'    => esc_html__('Table Name', 'divi_flash'),
                'type'          => 'select',
                'options'       => dick_fetch_table_press(),
                'default'       => 'select',
                'toggle_slug'   => 'chart_settings',
                'show_if'         => array(
                    'chart_data_type' => 'table_press'
                )
            ),
            
            'google_api_key' => array(
                'label'                 => esc_html__('Google API Key', 'divi_flash'),
                'description'           => esc_html__('<a href="https://console.developers.google.com/"> Get API Key</a'),
                'type'                  => 'text',
                'toggle_slug'           => 'chart_settings',
                'show_if'         => array(
                    'chart_data_type' => 'google_sheet'
                )
                
            ),
                 
            'categories'           => array(
				'label'           => esc_html__( 'Categories', 'dich-divi-charts' ),
				'description'     => esc_html__( 'Define your data categories separate by commas. Ex. 1991,1992,1993 etc.', 'dich-divi-charts' ),
                'default'         => 'January, February , March ,  April , May , June, July, August, September,October, November, December',
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'chart_settings',
			),
            'chart_data_count' => array(
                'label'       => esc_html__('Chart Data Count', 'dick-divi-chart-kit'),
                'type'        => 'select',
                'default'     => '1',
                'options'     => array(
                    '0' => esc_html__('Select', 'dick-divi-chart-kit'),
                    '1' => esc_html__('1', 'dick-divi-chart-kit'),
                    '2' => esc_html__('2', 'dick-divi-chart-kit'),
                    '3' => esc_html__('3', 'dick-divi-chart-kit'),
                    '4' => esc_html__('4', 'dick-divi-chart-kit'),
                    '5' => esc_html__('5', 'dick-divi-chart-kit'),
                    '6' => esc_html__('6', 'dick-divi-chart-kit'),
                    '7' => esc_html__('7', 'dick-divi-chart-kit'),
                    '8' => esc_html__('8', 'dick-divi-chart-kit'),
                    '9' => esc_html__('9', 'dick-divi-chart-kit'),
                ),
                'toggle_slug' => 'chart_settings',
                'tab_slug'    => 'advanced',
                'show_if_not'         => array(
                    'chart_data_type' => 'custom'
                )
            ),
       
        );

         // Generate fields dynamically based on chart_data_count
         for ($i = 1; $i <= 9; $i++) {
            $dependent_count = range($i, 9);  // Generates the required array, e.g., for $i=2, it generates array(2, 3, 4, 5)
    
            $chart_settings["element_color_$i"] = array(
                'label'       => esc_html__("Element Color $i", 'dick-divi-chart-kit'),
                'type'              => 'color-alpha',
                'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'dick-divi-chart-kit' ),
                'toggle_slug' => 'chart_settings',
                'tab_slug'    => 'advanced',
                'show_if_not'         => array(
                    'chart_data_type' => 'custom'
                ),
                'show_if'     => array(
                    'chart_data_count' => array_map('strval', $dependent_count)
                )
            );

               
            $chart_settings["item_line_width_$i"]  = array(
                'label'             => esc_html__("Item $i Line Width", 'dick-divi-chart-kit'),
                'type'              => 'range',
                'toggle_slug' => 'chart_settings',
                'tab_slug'    => 'advanced',
                'default'           => 2,
                'unitless'          => true,
                'range_settings'    => array(
                    'min'  => '0',
                    'max'  => '100',
                    'step' => '1'
                ),
                'responsive'        => true,
                'mobile_options'    => true,
                'show_if_not'         => array(
                    'chart_data_type' => 'custom'
                ),
                'show_if'     => array(
                    'chart_data_count' => array_map('strval', $dependent_count)
                )
            );
        }
        $chart_basic_settings = array (
    
            'chart_height'  => array (
                'label'             => esc_html__( 'Chart Height', 'dick-divi-chart-kit' ),
                'type'              => 'range',
                'toggle_slug'       => 'chart_basic_settings',
                'tab_slug'          => 'general',
                // 'default'           => 'auto',
                'unitless'          => true,
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '1000',
                    'step' => '1',
                ),
            ),
    
            'chart_width'  => array (
                'label'             => esc_html__( 'Chart Width', 'dick-divi-chart-kit' ),
                'type'              => 'range',
                'toggle_slug'       => 'chart_basic_settings',
                'tab_slug'          => 'general',
                'default'           => '100%',
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ),
            ),
    
    
            'use_zoom' => array(
                'label'                 => esc_html__( 'Use Zoom', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                // 'affects'               => array (
                //     'stroke_curve_type',
                //     'stock_lineCap_type',
                //     'stroke_width',
                //     'stroke_dash_array',
                //     'stroke_color'
                // ) 
            ),
    
            'use_toolbar' => array(
                'label'                 => esc_html__( 'Use Toolbar', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                'affects'               => array (
                    'toolbar_download',
                    'toolbar_selection',
                    'toolbar_zoom',
                    'toolbar_zoom_in',
                    'toolbar_zoom_out',
                    'toolbar_pen',
                    'toolbar_reset',
                    'show_stacked'
                ) 
            ),
    
            'toolbar_download' => array(
                'label'                 => esc_html__( 'Toolbar Download', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'on',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),
            'toolbar_selection' => array(
                'label'                 => esc_html__( 'Toolbar Selection', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'on',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),
            'toolbar_zoom' => array(
                'label'                 => esc_html__( 'Toolbar Zoom', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'on',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),
            'toolbar_zoom_in' => array(
                'label'                 => esc_html__( 'Toolbar Zoom In', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'on',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),
            'toolbar_zoom_out' => array(
                'label'                 => esc_html__( 'Toolbar Zoom Out', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'on',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),
            'toolbar_reset' => array(
                'label'                 => esc_html__( 'Toolbar Reset', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose zoom show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'on',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),
    
            'show_stacked' => array(
                'label'                 => esc_html__( 'Show Stacked', 'dick-divi-chart-kit' ),
                'type'                  => 'yes_no_button',
                'options'               => array(
                    'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
                    'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                'description'           => esc_html__( 'Here you can choose whether Stacked show or not show.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'chart_basic_settings',
                'tab_slug'              => 'general'
            ),

           
        );

        $stroke_settings = array (
            'show_stroke' => array(
				'label'                 => esc_html__( 'Custom Strock for all Item', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'stroke_settings',
                'tab_slug'              => 'general',
                'affects'               => array (
                    'stroke_curve_type',
                    'stroke_line_cap_type',
                    'stroke_width',
                    'stroke_dash_array',
                    'stroke_color'
				) 
            ),
            'stroke_curve_type' => array(
                'label'                 => esc_html__('Stroke Curve Type', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'smooth',
                'options'               => array(
                    'straight'             => esc_html__('Straight', 'dick-divi-chart-kit'),
                    'smooth'         => esc_html__('Smooth', 'dick-divi-chart-kit'),
                    'monotoneCubic'             => esc_html__('Monotone Cubic', 'dick-divi-chart-kit'),
                    'stepline'             => esc_html__('stepline', 'dick-divi-chart-kit'),    
                ),
                'toggle_slug'           => 'stroke_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),

            'stroke_line_cap_type' => array(
                'label'                 => esc_html__('Stroke LineCap Type', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => '',
                'options'               => array(
                    'butt'             => esc_html__('Butt', 'dick-divi-chart-kit'),
                    'square'         => esc_html__('Square', 'dick-divi-chart-kit'),
                    'round'             => esc_html__('Round', 'dick-divi-chart-kit'),
                    
                ),
                'toggle_slug'           => 'stroke_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on' 
            ),

            'stroke_width'  => array (
                'label'             => esc_html__( 'Stroke Width', 'dick-divi-chart-kit' ),
				'type'              => 'range',
                'toggle_slug'       => 'stroke_settings',
                'tab_slug'          => 'general',
				'default'           => '2',
                'unitless'          => true,
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
                ),
				'mobile_options'    => true,
                'responsive'        => true,
                'depends_show_if'       => 'on'
            ),
            'stroke_dash_array'  => array (
                'label'             => esc_html__( 'Stroke Dash Array', 'dick-divi-chart-kit' ),
				'type'              => 'range',
                'toggle_slug'       => 'stroke_settings',
                'tab_slug'          => 'general',
				'default'           => '0',
                'unitless'          => true,
				'range_settings' => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
                ),
				'mobile_options'    => true,
                'responsive'        => true,
                'depends_show_if'       => 'on'
            ),
            'stroke_color'            => array (
                'label'             => esc_html__( 'Stroke Color', 'dick-divi-chart-kit' ),
                'type'              => 'color-alpha',
                'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'dick-divi-chart-kit' ),
                'depends_show_if'   => 'on',
                'toggle_slug'       => 'stroke_settings',
                'tab_slug'          => 'general',
                'hover'             => 'tabs',
                'depends_show_if'   => 'on'
            ),
            
        );

        $animation_settings = array (
            'enable_animation' => array(
				'label'                 => esc_html__( 'Enable Animation', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'animation_settings',
                'tab_slug'              => 'general',
                'affects'               => array (
                    'timing_function_type',
                    'animation_speed',
                    'enable_gradually_animation',
                    'enable_dynamic_animation',
				) 
            ),
            'timing_function_type' => array(
                'label'                 => esc_html__('Timing Function', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'easeinout',
                'options'               => array(
                    'linear'             => esc_html__('Linear', 'dick-divi-chart-kit'),
                    'easein'            => esc_html__('Ease In', 'dick-divi-chart-kit'),
                    'easeout'             => esc_html__('Ease Out', 'dick-divi-chart-kit'),
                    'easeinout'             => esc_html__('Ease In Out', 'dick-divi-chart-kit'),    
                ),
                'toggle_slug'           => 'animation_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),

            'animation_speed'  => array (
                'label'             => esc_html__( 'Animation Speed', 'dick-divi-chart-kit' ),
				'type'              => 'range',
                'toggle_slug'       => 'animation_settings',
                'tab_slug'          => 'general',
				'default'           => '800',
                'unitless'          => true,
				'range_settings' => array(
					'min'  => '1',
					'max'  => '1000',
					'step' => '1',
                ),
				'mobile_options'    => true,
                'responsive'        => true,
                'depends_show_if'       => 'on'
            ),

            'enable_gradually_animation' => array(
				'label'                 => esc_html__( 'Enable Gradually Animation', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'animation_settings',
                'tab_slug'              => 'general',
                'affects'               => array (
                    'gradually_animation_delay',
				) 
            ),

            'gradually_animation_delay'  => array (
                'label'             => esc_html__( 'Gradually Animation Delay', 'dick-divi-chart-kit' ),
				'type'              => 'range',
                'toggle_slug'       => 'animation_settings',
                'tab_slug'          => 'general',
				'default'           => '150',
                'unitless'          => true,
				'range_settings' => array(
					'min'  => '1',
					'max'  => '1000',
					'step' => '1',
                ),
				'mobile_options'    => true,
                'responsive'        => true,
                'depends_show_if'       => 'on'
            ),

            'enable_dynamic_animation' => array(
				'label'                 => esc_html__( 'Enable Dynamic Animation', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'animation_settings',
                'tab_slug'              => 'general',
                'affects'               => array (
                    'dynamic_animation_speed',
				) 
            ),

            'dynamic_animation_speed'  => array (
                'label'             => esc_html__( 'Animation Speed', 'dick-divi-chart-kit' ),
				'type'              => 'range',
                'toggle_slug'       => 'animation_settings',
                'tab_slug'          => 'general',
				'default'           => '350',
                'unitless'          => true,
				'range_settings' => array(
					'min'  => '1',
					'max'  => '1000',
					'step' => '1',
                ),
				'mobile_options'    => true,
                'responsive'        => true,
                'depends_show_if'       => 'on'
            ),
            
        );

        $legend_settings = array (
            'enable_legend' => array(
				'label'                 => esc_html__( 'Enable Legend', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'legend_settings',
                'tab_slug'              => 'general',
                'affects'               => array (
                    'legend_position',
                    'legend_horizontal_align',
                    'legend_inverse_order',
                    'legend_font_size',
                    'legend_level_color',
                    'legend_use_series_color',
                    'legend_markar_size',
                    'legend_marker_shape'
				) 
            ),
            'legend_position' => array(
                'label'                 => esc_html__('Legend Position', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'bottom',
                'options'               => array(
                    'top'             => esc_html__('Top', 'dick-divi-chart-kit'),
                    'bottom'            => esc_html__('Bottom', 'dick-divi-chart-kit')   
                ),
                'toggle_slug'           => 'legend_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),

            'legend_horizontal_align' => array(
                'label'                 => esc_html__('Legend Horizontal Align', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'center',
                'options'               => array(
                    'left'             => esc_html__('Left', 'dick-divi-chart-kit'),
                    'center'            => esc_html__('center', 'dick-divi-chart-kit'),
                    'right'             => esc_html__('Right', 'dick-divi-chart-kit'), 
                ),
                'toggle_slug'           => 'legend_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),

            'legend_inverse_order' => array(
				'label'                 => esc_html__( 'Enable Legend Inverse Order', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'legend_settings',
                'tab_slug'              => 'general',
            ),
            'legend_font_size'  => array (
                'label'             => esc_html__( 'Legend Font Size', 'dick-divi-chart-kit' ),
				'type'              => 'range',
                'toggle_slug'       => 'legend_settings',
                'tab_slug'          => 'general',
				'default'           => '14px',
                'allowed_units'     => array('px'),
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
                ),
				'mobile_options'    => true,
                'responsive'        => true,
                'depends_show_if'       => 'on'
            ),

            'legend_level_color'            => array (
                'label'             => esc_html__( 'Legend Level Color', 'dick-divi-chart-kit' ),
                'type'              => 'color-alpha',
                'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'dick-divi-chart-kit' ),
                'depends_show_if'   => 'on',
                'toggle_slug'       => 'legend_settings',
                'tab_slug'          => 'general',
                'hover'             => 'tabs',
                'depends_show_if'   => 'on'
            ),

            'use_series_color_for_legend' => array(
				'label'                 => esc_html__( 'Use Series Color for Legend', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'legend_settings',
                'tab_slug'              => 'general',
            ),

            'legend_markar_size'  => array (
                'label'             => esc_html__( 'Legend Markar Size', 'dick-divi-chart-kit' ),
				'type'              => 'range',
                'toggle_slug'       => 'legend_settings',
                'tab_slug'          => 'general',
				'default'           => 6,
                'unitless'          => true,
				'range_settings' => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
                ),
				'mobile_options'    => true,
                'responsive'        => true,
                'depends_show_if'       => 'on'
            ),

            'legend_marker_shape' => array(
                'label'                 => esc_html__('Legend Marker Shape', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'easeinout',
                'options'               => array(
                    'circle'             => esc_html__('Circle', 'dick-divi-chart-kit'),
                    'square'            => esc_html__('Square', 'dick-divi-chart-kit'),
                    'line'            => esc_html__('Line', 'dick-divi-chart-kit'),
                    'plus'             => esc_html__('Plus', 'dick-divi-chart-kit'), 
                    'cross'            => esc_html__('Cross', 'dick-divi-chart-kit'), 
                ),
                'toggle_slug'           => 'legend_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),
            
        );

        return array_merge(
            $chart_settings,
            $chart_basic_settings,
            $stroke_settings,
            $animation_settings,
            $legend_settings

        );
    }

    function csv_upload_process() {        
        if (empty($this->props['csv_upload_data'])) {
            return sprintf('<div class="df-data-table-error">%1$s</div>', __('Only CSV file will Suport. So Upload CSV file.', 'divi_flash'));
        }
    
        $file_url = @fopen($this->props['csv_upload_data'], 'r'); // phpcs:ignore WordPress.WP.AlternativeFunctions
        if (!$file_url) {
            return sprintf('<div class="df-data-table-error">%1$s</div>', __('File isn\'t available', 'divi_flash'));
        }
    
        $file_parts = pathinfo($this->props['csv_upload_data']);
        if ($file_parts['extension'] !== 'csv') {
            $error_message = sprintf('Oops! %1$s file can\'t be uploaded, So you have to Upload CSV file.', $file_parts['extension']);
            return sprintf('<div class="df-data-table-error">%1$s</div>', $error_message);
        }
    
        $data = [];
        $header = fgetcsv($file_url, 1000, ","); // Read the first row (header row)
    
        // Initialize the data_set array with names and empty data arrays
        for ($i = 1; $i <= intval($this->props['chart_data_count']); $i++) {
            $data[] = [
                'name' => $header[$i],
                'data' => [],
                'item_line_color' => $this->props["element_color_$i"],
                'item_line_width' =>$this->props["item_line_width_$i"],
            ];
        }
        
    
        // Loop through the rest of the rows
        while (($row = fgetcsv($file_url, 1000, ",")) !== FALSE) {
            for ($i = 1; $i <= intval($this->props['chart_data_count']); $i++) {
                $data[$i - 1]['data'][] = intval($row[$i]);
            }
        }
    
        fclose($file_url);
      // Convert each data array to a comma-separated string
        foreach ($data as &$dataSet) {
            $dataSet['data'] = implode(',', $dataSet['data']);
        }
        // Return the single-level data_set array
        return wp_json_encode($data);
    }
    public function get_transition_fields_css_props() {
        $fields = parent::get_transition_fields_css_props();
        

        return $fields;
    }

    /**
	 * Performs task before rendering the chart
	 */
	public function before_render() {
		global $dich_line_chart;
		$dich_line_chart = array();
	}

	/**
	 * Get child module props
	 */
	private function get_child_props() {
		global $dich_line_chart;
		return wp_json_encode( $dich_line_chart );
	}

	public function render( $attrs, $render_slug, $content = null ) {
	

        wp_enqueue_script( 'dick-chart-kit-lib' );
		wp_enqueue_script( 'dick-line-chart' );
   
        $categories = ( ! empty( $this->props['categories'] ) ? esc_attr( $this->props['categories'] ) : '' );
        
        if($this->props['chart_data_type'] === 'custom'){
            $child_props = $this->get_child_props();
        }else if($this->props['chart_data_type'] === 'csv_upload'){
            $child_props = $this->csv_upload_process();
        }
   
      
		$child_props = "data-series={$child_props}";

        $stroke_width = isset($this->props['stroke_width']) ?  $this->props['stroke_width'] : 2; 
        
        $show_stroke = isset($this->props['show_stroke']) && $this->props['show_stroke'] === 'on' ? true : false;
        $data = [
            // Amination
            'enable_animation'          => isset($this->props['enable_animation']) && $this->props['enable_animation'] === 'on' ? true : false,
            'timing_function_type'      => isset($this->props['timing_function_type']) ? $this->props['timing_function_type'] : 'easeinout',
            'animation_speed'           =>  isset($this->props['animation_speed']) ? $this->props['animation_speed']  : 800,
            'enable_gradually_animation'=> isset($this->props['enable_gradually_animation']) && $this->props['enable_gradually_animation'] === 'on' ? true : false,
            'gradually_animation_delay' =>  isset($this->props['gradually_animation_delay']) ? $this->props['gradually_animation_delay']  : 150,
            'enable_dynamic_animation'  => isset($this->props['enable_dynamic_animation']) && $this->props['enable_dynamic_animation'] === 'on' ? true : false,
            'dynamic_animation_speed'   =>  isset($this->props['dynamic_animation_speed']) ? $this->props['dynamic_animation_speed']  : 350,
            
            // Toolbar
            'use_zoom'                  => isset($this->props['use_zoom']) && $this->props['use_zoom'] === 'on' ? true : false,
            'chart_height'              => $this->props['chart_height'],
            'chart_width'               => $this->props['chart_width'],
            'use_toolbar'               => isset($this->props['use_toolbar']) && $this->props['use_toolbar'] === 'on' ? true : false,
            'toolbar_download'          => isset($this->props['toolbar_download']) && $this->props['toolbar_download'] === 'on' ? true : false,
            'toolbar_reset'             => isset($this->props['toolbar_reset']) && $this->props['toolbar_reset'] === 'on' ? true : false,
            'toolbar_pen'               => isset($this->props['toolbar_pen']) && $this->props['toolbar_pen'] === 'on' ? true : false,
            'toolbar_zoom'              => isset($this->props['toolbar_zoom']) && $this->props['toolbar_zoom'] === 'on' ? true : false,
            'toolbar_zoom_in'           => isset($this->props['toolbar_zoom_in']) && $this->props['toolbar_zoom_in'] === 'on' ? true : false,
            'toolbar_zoom_out'          => isset($this->props['toolbar_zoom_out']) && $this->props['toolbar_zoom_out'] === 'on' ? true : false,
            
            // Line 
            'show_stroke'               => $show_stroke,
            'stroke_curve_type'         => isset($this->props['stroke_curve_type']) ? $this->props['stroke_curve_type']: 'smooth',
            'stroke_line_cap_type'      => isset($this->props['stroke_line_cap_type']) ? $this->props['stroke_line_cap_type'] : 'butt',
            'stroke_width'              => $stroke_width,
            'stroke_dash_array'         =>  isset($this->props['stroke_dash_array']) ? $this->props['stroke_dash_array']  : 2,
            'stroke_color'              =>  isset($this->props['stroke_color']) ? $this->props['stroke_color']: '',

            // Legend
            'enable_legend'             => isset($this->props['enable_legend']) && $this->props['enable_legend'] === 'on' ? true : false,
            'legend_position'           => isset($this->props['legend_position']) ? $this->props['legend_position'] : 'bottom',
            'legend_horizontal_align'   => isset($this->props['legend_horizontal_align']) ? $this->props['legend_horizontal_align']  : 'center',
            'legend_inverse_order'      => isset($this->props['legend_inverse_order']) && $this->props['legend_inverse_order'] === 'on' ? true : false,
            'legend_font_size'          => isset($this->props['legend_font_size']) ? $this->props['legend_font_size']  : '14',
            'legend_level_color'        => isset($this->props['legend_level_color']) ?  $this->props['legend_level_color'] : '',
            'use_series_color_for_legend'=> isset($this->props['use_series_color_for_legend']) && $this->props['use_series_color_for_legend'] === 'on' ? true : false,
            'legend_markar_size'        => isset($this->props['legend_font_size']) ? $this->props['legend_font_size']  : 6,
            'legend_marker_shape'       => isset($this->props['legend_marker_shape']) ? $this->props['legend_marker_shape'] : 'round',
        ];

		return sprintf( '<div class="dick-line-chart-container" data-categories="%1$s" data-settings=\'%2$s\' %3$s >
							<div class="dick-line-chart-wrapper">
								<div class="dick-line-chart"></div>
							</div>
						</div>
					',
                    esc_attr( $categories ), 
                    wp_json_encode($data),  
                    esc_attr( $child_props ) 
                );
	}
}

new DICK_LineChart;
