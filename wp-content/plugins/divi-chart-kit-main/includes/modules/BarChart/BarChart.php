<?php

class DICK_BarChart extends ET_Builder_Module {

	public $slug       = 'dick_bar_chart';
	public $vb_support = 'on';
	//public $child_slug = 'dick_line_chart_child';

	protected $module_credits = array(
		'module_uri' => 'wphoop.com',
		'author'     => 'wphoop',
		'author_uri' => 'wphoop.com',
	);

	public function init() {
		$this->name = esc_html__( 'Bar Chart', 'dick-divi-chart-kit' );
	}

	public function get_settings_modal_toggles(){
        return array(
            'general'   => array(
                'toggles'      => array(
                    'chart_data_settings'         => esc_html__('Chart Data Settings', 'dick-divi-chart-kit'),
                    'chart_basic_settings'    => esc_html__('Chart General Settings', 'dick-divi-chart-kit'),
                    'config_settings'         => esc_html__('Config Settings', 'dick-divi-chart-kit'),
                    'stroke_settings'         => esc_html__('Stroke Settings', 'dick-divi-chart-kit'),

                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'chart_data_settings'         => esc_html__('Chart Data Design', 'dick-divi-chart-kit'),
                    'stroke_settings'         => esc_html__('Stroke', 'dick-divi-chart-kit'),
                )
            ),
        );
    }

    public function get_advanced_fields_config() {
        $advanced_fields = array();
        // $advanced_fields['text'] = false;
        // $advanced_fields['link_options'] = false;
    
        return $advanced_fields;
    }

    public function get_fields() {
        $chart_data_settings = array(
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
                'toggle_slug'           => 'chart_data_settings',
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
				'toggle_slug'     => 'chart_data_settings', 
                'show_if'         => array(
                        'chart_data_type' => 'csv_upload'
                )
            ),

            'import_table_data' => array(
                'label'           => esc_html__( 'CSV Data', 'et_builder' ),
                'description'     => esc_html__('Put Comma separated Data'),
				'type'            => 'codemirror',
				'mode'            => 'html',
				'toggle_slug'     => 'chart_data_settings', 
                'show_if'         => array(
                        'chart_data_type' => 'import_table_data'
                )
            ),

            'database_tables_list'    => array(
                'label'    => esc_html__('Table Name', 'divi_flash'),
                'type'          => 'select',
                'options'       => dick_database_tables(),
                'default'       => 'select',
                'toggle_slug'   => 'chart_data_settings',
                'show_if'         => array(
                    'chart_data_type' => 'database_table'
                )
            ),

            'table_press_list'    => array(
                'label'    => esc_html__('Table Name', 'divi_flash'),
                'type'          => 'select',
                'options'       => dick_fetch_table_press(),
                'default'       => 'select',
                'toggle_slug'   => 'chart_data_settings',
                'show_if'         => array(
                    'chart_data_type' => 'table_press'
                )
            ),
            
            'google_api_key' => array(
                'label'                 => esc_html__('Google API Key', 'divi_flash'),
                'description'           => esc_html__('<a href="https://console.developers.google.com/"> Get API Key</a'),
                'type'                  => 'text',
                'toggle_slug'           => 'general_settings',
                'show_if'         => array(
                    'chart_data_type' => 'google_sheet'
                )
                
            ),
            // 'chart_Categories'     => array(
			// 		'label'           => esc_html__( 'Message Pattern', 'et_builder' ),
			// 		'type'            => 'textarea',
			// 		'option_category' => 'configuration',
			// 		'description'     => et_get_safe_localization( __( 'Here you can define the custom pattern for the email Message. Fields should be included in following format - <strong>%%field_id%%</strong>. For example if you want to include the field with id = <strong>phone</strong> and field with id = <strong>message</strong>, then you can use the following pattern: <strong>My message is %%message%% and phone number is %%phone%%</strong>. Leave blank for default.', 'et_builder' ) ),
			// 		'toggle_slug'           => 'chart_data_settings',
            //         'tab_slug'              => 'general',
			// 	),
            'chart_Categories' => array(
                'label'                 => esc_html__( 'Chart Categories', 'dick-divi-chart-kit' ),
                'type'                  => 'tiny_mce',
                'option_category'       => 'configuration',
                //'default'               => "'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'",
                'toggle_slug'           => 'chart_data_settings',
                'tab_slug'              => 'general'
        
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
                'toggle_slug' => 'chart_data_settings',
                'tab_slug'    => 'general',
            ),
        );

       
        // Generate fields dynamically based on chart_data_count
        for ($i = 1; $i <= 9; $i++) {
        $dependent_count = range($i, 9);  // Generates the required array, e.g., for $i=2, it generates array(2, 3, 4, 5)

        $chart_data_settings["element_name_$i"] = array(
            'label'       => esc_html__("Element Name $i", 'dick-divi-chart-kit'),
            'type'        => 'text',
            'default'     => "Series $i",
            'toggle_slug' => 'chart_data_settings',
            'tab_slug'    => 'general',
            'show_if'     => array(
                'chart_data_type'  => 'custom',
                'chart_data_count' => array_map('strval', $dependent_count)
            )
        );

        $chart_data_settings["element_data_$i"] = array(
            'label'       => esc_html__("Element Data $i", 'dick-divi-chart-kit'),
            'type'        => 'text',
            'default'     => '12,33,76,44,44,47',
            'toggle_slug' => 'chart_data_settings',
            'tab_slug'    => 'general',
            'show_if'     => array(
                'chart_data_type'  => 'custom',
                'chart_data_count' => array_map('strval', $dependent_count)
            )
        );

        $chart_data_settings["element_color_$i"] = array(
            'label'       => esc_html__("Element Color $i", 'dick-divi-chart-kit'),
            'type'              => 'color-alpha',
            'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'dick-divi-chart-kit' ),
            'toggle_slug' => 'chart_data_settings',
            'tab_slug'    => 'advanced',
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
                'toolbar_reset'
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
            'tab_slug'              => 'general',
            // 'affects'               => array (
            //     'stroke_curve_type',
            //     'stock_lineCap_type',
            //     'stroke_width',
            //     'stroke_dash_array',
            //     'stroke_color'
            // ) 
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
        $stroke_settings = array (
            'show_stroke' => array(
				'label'                 => esc_html__( 'Show Stroke', 'dick-divi-chart-kit' ),
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
                    'stock_lineCap_type',
                    'stroke_width',
                    'stroke_dash_array',
                    'stroke_color'
				) 
            ),
            'stroke_curve_type' => array(
                'label'                 => esc_html__('Stroke Curve Type', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'click',
                'options'               => array(
                    'straight'             => esc_html__('Straight', 'dick-divi-chart-kit'),
                    'smooth'         => esc_html__('Smooth', 'dick-divi-chart-kit'),
                    'monotoneCubic'             => esc_html__('Monotone Cubic', 'dick-divi-chart-kit'),
                    'stepline'             => esc_html__('stepline', 'dick-divi-chart-kit'),
                    'custom'             => esc_html__('Custom', 'dick-divi-chart-kit'),
                    
                ),
                'toggle_slug'           => 'stroke_settings',
                'tab_slug'              => 'general',
                'depends_show_if'       => 'on'
            ),

            'stock_line_cap_type' => array(
                'label'                 => esc_html__('Stroke LineCap Type', 'dick-divi-chart-kit'),
                'type'                  => 'select',
                'default'               => 'click',
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


        return array_merge(
            $chart_data_settings,
            $chart_basic_settings,
            $stroke_settings
        );
    }

    public function get_transition_fields_css_props() {
        $fields = parent::get_transition_fields_css_props();
        

        return $fields;
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
                'color' => $this->props["element_color_$i"]
            ];
        }
        
    
        // Loop through the rest of the rows
        while (($row = fgetcsv($file_url, 1000, ",")) !== FALSE) {
            for ($i = 1; $i < count($row); $i++) {
                $data[$i - 1]['data'][] = intval($row[$i]);
            }
        }
    
        fclose($file_url);
      // Convert each data array to a comma-separated string
        foreach ($data as &$dataSet) {
            $dataSet['data'] = implode(',', $dataSet['data']);
        }
        // Return the single-level data_set array
        return $data;
    }

	public function render( $attrs, $render_slug , $content = null) {

		wp_enqueue_script( 'dick-chart-kit-lib' );
		wp_enqueue_script( 'dick-bar-chart' );
        // $stroke_width = isset($this->props['stroke_width']) ? 
        // $this->props['stroke_width'] : '2';
        $categories_array = array_map('intval', explode(',', $this->props['chart_Categories'])); // Convert to array

        $data = [
            'chart_Categories_list'   => $categories_array,
            'use_zoom'                => isset($this->props['use_zoom']) && $this->props['use_zoom'] === 'on' ? true : false,
            'chart_height'            => $this->props['chart_height'],
            'chart_width'             => $this->props['chart_width'],
            'use_toolbar'             => isset($this->props['use_toolbar']) && $this->props['use_toolbar'] === 'on' ? true : false,
            'toolbar_download'        => isset($this->props['toolbar_download']) && $this->props['toolbar_download'] === 'on' ? true : false,
            'toolbar_reset'           => isset($this->props['toolbar_reset']) && $this->props['toolbar_reset'] === 'on' ? true : false,
            'toolbar_pen'             => isset($this->props['toolbar_pen']) && $this->props['toolbar_pen'] === 'on' ? true : false,
            'toolbar_zoom'            => isset($this->props['toolbar_zoom']) && $this->props['toolbar_zoom'] === 'on' ? true : false,
            'toolbar_zoom_in'         => isset($this->props['toolbar_zoom_in']) && $this->props['toolbar_zoom_in'] === 'on' ? true : false,
            'toolbar_zoom_out'        => isset($this->props['toolbar_zoom_out']) && $this->props['toolbar_zoom_out'] === 'on' ? true : false,
            'show_stroke'             => isset($this->props['show_stroke']) && $this->props['show_stroke'] === 'on' ? true : false,
            'stroke_curve_type'       => $this->props['stroke_curve_type'],
            'stock_line_cap_type'     => $this->props['stock_line_cap_type'],
            //'stroke_width'            => $stroke_width,
            'stroke_dash_array'       => $this->props['stroke_dash_array'],
            'stroke_color'            => $this->props['stroke_color'],
        ];
        // Initialize data_set array
        if($this->props['chart_data_type'] === 'csv_upload'){
            $data['data_set'] = $this->csv_upload_process();
            // echo '<pre>';
            // print_r($this->csv_upload_process());
            // echo '</pre>';
        }

        else if($this->props['chart_data_type'] === 'custom'){
            $data['data_set'] = [];
            $data_set_count = intval($this->props['chart_data_count']);
            for ($i = 1; $i <= $data_set_count; $i++) {
                $data['data_set'][] = [
                    'name' => $this->props["element_name_$i"],
                    'data' => $this->props["element_data_$i"],
                    'color' => $this->props["element_color_$i"]
                ];
            }
        }

        


		return sprintf( '<div class="dick-bar-chart-container" data-settings=\'%1$s\'>
							<div class="dick-bar-chart-wrapper">
								<div class="dick-bar-chart">Bar Chart</div>
							</div>
						</div>
					    ', 
                        wp_json_encode($data) );
	}
}

new DICK_BarChart;
