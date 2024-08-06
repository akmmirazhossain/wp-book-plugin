<?php

class DICK_LineChartChild extends ET_Builder_Module {

	public $slug       = 'dick_line_chart_child';
	public $vb_support = 'on';
    public $type       = 'child';
    public $child_title_var  = 'item_label';
    public $child_title_fallback_var = 'admin_label';

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
                    'content' => esc_html__('Content', 'divi_flash'),
                    // 'at_icon' => esc_html__('Nav Icon Settings', 'divi_flash'),
                    // 'image' => esc_html__('Image', 'divi_flash'),
                    // 'at_button' => esc_html__('Button', 'divi_flash'),
                    // 'text_area' => esc_html__('Text Area Background', 'divi_flash'),
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'content' => esc_html__('Content Design', 'divi_flash'),
                    'nav_text'      => array(
                        'title'             => esc_html__('Nav Item Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => array(
							'title'     => array(
								'name' => 'Title'
							),
							'subtitle'     => array(
								'name' => 'Description'
							)
						)
                    ),
                )
            ),
        );
    }

    public function get_advanced_fields_config() {
        $advanced_fields = array();

        // $advanced_fields['text'] = false;
        // $advanced_fields['fonts']  = array(
        //     'title'     => array(
        //         'label'           => et_builder_i18n( 'Title' ),
        //         'css'             => array(
        //             'main'        => ".difl_advancedtab {$this->main_css_element} .df_at_title"
        //         ),
        //         'line_height'     => array(
        //             'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
        //         ),
        //         'font_size'       => array(
        //             'default' => '16px',
        //         ),
        //         'toggle_slug'     => 'nav_text',
        //         'sub_toggle'      => 'title'
        //     ),
        //     'subtitle'     => array(
        //         'label'           => et_builder_i18n( 'Sub Title' ),
        //         'css'             => array(
        //             'main'        => ".difl_advancedtab {$this->main_css_element} .df_at_subtitle"
        //         ),
        //         'line_height'     => array(
        //             'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
        //         ),
        //         'font_size'       => array(
        //             'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
        //         ),
        //         'toggle_slug'     => 'nav_text',
        //         'sub_toggle'      => 'subtitle'
        //     ),
        //     'text'     => array(
        //         'label'           => et_builder_i18n( 'Text' ),
        //         'css'             => array(
        //             'main'        => ".difl_advancedtab {$this->main_css_element} .df_at_content",
        //             'line_height' => ".difl_advancedtab {$this->main_css_element} .df_at_content",
        //             'color'       => ".difl_advancedtab {$this->main_css_element} .df_at_content",
        //         ),
        //         'line_height'     => array(
        //             'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
        //         ),
        //         'font_size'       => array(
        //             'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
        //         ),
        //         'toggle_slug'     => 'text',
        //         'sub_toggle'      => 'p',
        //         // 'hide_text_align' => true,
        //     ),
        //     'link'     => array(
        //         'label'       => et_builder_i18n( 'Link' ),
        //         'css'         => array(
        //             'main'  => ".difl_advancedtab {$this->main_css_element} .df_at_content a",
        //             'color' => ".difl_advancedtab {$this->main_css_element} .df_at_content a",
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'font_size'   => array(
        //             'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
        //         ),
        //         'hide_text_align' => true,
        //         'toggle_slug' => 'text',
        //         'sub_toggle'  => 'a',
        //     ),
        //     'ul'       => array(
        //         'label'       => esc_html__( 'Unordered List', 'et_builder' ),
        //         'css'         => array(
        //             'main'        => ".difl_advancedtab {$this->main_css_element} .df_at_content ul li",
        //             'color'       => ".difl_advancedtab {$this->main_css_element} .df_at_content ul li",
        //             'line_height' => ".difl_advancedtab {$this->main_css_element} .df_at_content ul li",
        //             'item_indent' => ".difl_advancedtab {$this->main_css_element} .df_at_content ul",
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'font_size'   => array(
        //             'default' => '14px',
        //         ),
        //         'toggle_slug' => 'text',
        //         'sub_toggle'  => 'ul',
        //     ),
        //     'ol'       => array(
        //         'label'       => esc_html__( 'Ordered List', 'et_builder' ),
        //         'css'         => array(
        //             'main'        => ".difl_advancedtab {$this->main_css_element} .df_at_content ol li",
        //             'color'       => ".difl_advancedtab {$this->main_css_element} .df_at_content ol li",
        //             'line_height' => ".difl_advancedtab {$this->main_css_element} .df_at_content ol li",
        //             'item_indent' => ".difl_advancedtab {$this->main_css_element} .df_at_content ol",
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'font_size'   => array(
        //             'default' => '14px',
        //         ),
        //         'toggle_slug' => 'text',
        //         'sub_toggle'  => 'ol',
        //     ),
        //     'quote'    => array(
        //         'label'       => esc_html__( 'Blockquote', 'et_builder' ),
        //         'css'         => array(
        //             'main'  => ".difl_advancedtab {$this->main_css_element} .df_at_content blockquote",
        //             'color' => ".difl_advancedtab {$this->main_css_element} .df_at_content blockquote",
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'font_size'   => array(
        //             'default' => '14px',
        //         ),
        //         'toggle_slug' => 'text',
        //         'sub_toggle'  => 'quote',
        //     ),
        //     'header'   => array(
        //         'label'       => esc_html__( 'Heading', 'et_builder' ),
        //         'css'         => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_content h1",
        //         ),
        //         'font_size'   => array(
        //             'default' => absint( et_get_option( 'body_header_size', '30' ) ) . 'px',
        //         ),
        //         'toggle_slug' => 'header',
        //         'sub_toggle'  => 'h1',
        //     ),
        //     'header_2' => array(
        //         'label'       => esc_html__( 'Heading 2', 'et_builder' ),
        //         'css'         => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_content h2",
        //         ),
        //         'font_size'   => array(
        //             'default' => '26px',
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'toggle_slug' => 'header',
        //         'sub_toggle'  => 'h2',
        //     ),
        //     'header_3' => array(
        //         'label'       => esc_html__( 'Heading 3', 'et_builder' ),
        //         'css'         => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_content h3",
        //         ),
        //         'font_size'   => array(
        //             'default' => '22px',
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'toggle_slug' => 'header',
        //         'sub_toggle'  => 'h3',
        //     ),
        //     'header_4' => array(
        //         'label'       => esc_html__( 'Heading 4', 'et_builder' ),
        //         'css'         => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_content h4",
        //         ),
        //         'font_size'   => array(
        //             'default' => '18px',
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'toggle_slug' => 'header',
        //         'sub_toggle'  => 'h4',
        //     ),
        //     'header_5' => array(
        //         'label'       => esc_html__( 'Heading 5', 'et_builder' ),
        //         'css'         => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_content h5",
        //         ),
        //         'font_size'   => array(
        //             'default' => '16px',
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'toggle_slug' => 'header',
        //         'sub_toggle'  => 'h5',
        //     ),
        //     'header_6' => array(
        //         'label'       => esc_html__( 'Heading 6', 'et_builder' ),
        //         'css'         => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_content h6",
        //         ),
        //         'font_size'   => array(
        //             'default' => '14px',
        //         ),
        //         'line_height' => array(
        //             'default' => '1em',
        //         ),
        //         'toggle_slug' => 'header',
        //         'sub_toggle'  => 'h6',
        //     ),
        //     'button'     => array(
        //         'label'           => et_builder_i18n( 'Button' ),
        //         'css'             => array(
        //             'main'        => ".difl_advancedtab {$this->main_css_element} .df_at_button"
        //         ),
        //         'line_height'     => array(
        //             'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
        //         ),
        //         'font_size'       => array(
        //             'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
        //         ),
        //         'toggle_slug'     => 'at_button'
        //     ),
        // );
        // $advanced_fields['borders'] = array(
        //     'default'   => array(
        //         'css'       => array(
        //             'main'  => array(
        //                 'border_radii' => ".df_at_all_tabs {$this->main_css_element}",
        //                 'border_radii_hover'  => ".df_at_all_tabs {$this->main_css_element}:hover",
        //                 'border_styles' => ".df_at_all_tabs {$this->main_css_element}",
        //                 'border_styles_hover' => ".df_at_all_tabs {$this->main_css_element}:hover",
        //             )
        //         )
        //     ),
        //     'button'                => array(
        //         'css'               => array(
        //             'main' => array(
        //                 'border_radii' => ".difl_advancedtab {$this->main_css_element} .df_at_button",
        //                 'border_radii_hover'  => ".difl_advancedtab {$this->main_css_element} .df_at_button:hover",
        //                 'border_styles' => ".difl_advancedtab {$this->main_css_element} .df_at_button",
        //                 'border_styles_hover' => ".difl_advancedtab {$this->main_css_element} .df_at_button:hover",
        //             )
        //         ),
        //         'tab_slug'          => 'advanced',
        //         'toggle_slug'       => 'at_button'
        //     ),
        //     'image'                => array(
        //         'css'               => array(
        //             'main' => array(
        //                 'border_radii' => ".difl_advancedtab {$this->main_css_element} .df_at_image",
        //                 'border_radii_hover'  => ".difl_advancedtab {$this->main_css_element} .df_at_image:hover",
        //                 'border_styles' => ".difl_advancedtab {$this->main_css_element} .df_at_image",
        //                 'border_styles_hover' => ".difl_advancedtab {$this->main_css_element} .df_at_image:hover",
        //             )
        //         ),
        //         'tab_slug'          => 'advanced',
        //         'toggle_slug'       => 'image'
        //     )
        // );
        // $advanced_fields['box_shadow'] = array(
        //     'button'              => array(
        //         'css' => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_button",
        //             'hover' => ".difl_advancedtab {$this->main_css_element} .df_at_button:hover",
        //         ),
        //         'tab_slug'        => 'advanced',
        //         'toggle_slug'     => 'at_button'
        //     ),
        //     'image'              => array(
        //         'css' => array(
        //             'main' => ".difl_advancedtab {$this->main_css_element} .df_at_image",
        //             'hover' => ".difl_advancedtab {$this->main_css_element} .df_at_image:hover",
        //         ),
        //         'tab_slug'        => 'advanced',
        //         'toggle_slug'     => 'image'
        //     )
        // );
        // $advanced_fields["filters"] = array(
		// 	'child_filters_target' => array(
		// 		'tab_slug' => 'advanced',
		// 		'toggle_slug' => 'image',
		// 		'css' => array(
		// 			'main' => '%%order_class%% img'
		// 		),
		// 	),
        // );
        
        // $advanced_fields['image'] = array(
		// 	'css' => array(
		// 		'main' => array(
		// 			'%%order_class%% img',
		// 		)
		// 	),
        // );
        // $advanced_fields['transform'] = false;
        // $advanced_fields['background'] = array(
        //     'css' => array(
        //         'main' => "{$this->main_css_element}.et_pb_module"
        //     )
        // );
        // $advanced_fields['max_width'] = array(
        //     'css'   => array(
        //         'main'      => "{$this->main_css_element}.et_pb_module"
        //     )
        // );
        // $advanced_fields['margin_padding'] = array(
        //     'css'   => array(
        //         'main'      => "{$this->main_css_element}.et_pb_module",
        //         'important' => 'all'
        //     )
        // );
        $advanced_fields['link_options'] = false;
    
        return $advanced_fields;
    }

    public function get_fields() {
        $general = array (
            'admin_label' => array (
				'label'           => esc_html__( 'Admin Label', 'dick-divi-chart-kit' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'admin_label',
				'default_on_front'=> 'Tab Item',
            ),
			'item_label' => array (
                'label'                 => esc_html__( 'Item Label', 'dick-divi-chart-kit' ),
				'type'                  => 'text',
                'toggle_slug'           => 'content',
                'dynamic_content'       => 'text'
            ),
            // 'data_set_labels' => array (
            //     'label'                 => esc_html__( 'Data Set Label', 'dick-divi-chart-kit' ),
			// 	'type'                  => 'text',
            //     'toggle_slug'           => 'content',
            //     'dynamic_content'       => 'text'
            // ),

			'data_set_values' => array (
                'label'                 => esc_html__( 'Item Data Set Values', 'dick-divi-chart-kit' ),
				'type'                  => 'text',
                'toggle_slug'           => 'content',
                'dynamic_content'       => 'text'
            ),

            'item_line_color'            => array (
                'label'             => esc_html__( 'Item Line Color', 'dick-divi-chart-kit' ),
                'type'              => 'color-alpha',
                'description'       => esc_html__( 'Here you can define a custom color for your Line.', 'dick-divi-chart-kit' ),
                'depends_show_if'   => 'on',
                'toggle_slug'       => 'content',
                'tab_slug'          => 'advanced',
                'hover'             => 'tabs',
                'depends_show_if'   => 'on'
            ),

            'item_line_width' => array(
                'label'             => esc_html__('Item Line Width', 'dick-divi-chart-kit'),
                'type'              => 'range',
                'toggle_slug'       => 'content',
                'tab_slug'          => 'advanced',
                'default'           => 2,
                'unitless'          => true,
                'range_settings'    => array(
                    'min'  => '0',
                    'max'  => '100',
                    'step' => '1'
                ),
                'responsive'        => true,
                'mobile_options'    => true,
                'depends_show_if'     => 'on'
            ),


			
			'enable_fill' => array(
				'label'                 => esc_html__( 'Enable Fill', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'button',
                'tab_slug'              => 'advanced'  
            ),
			'show_line' => array(
				'label'                 => esc_html__( 'Show Line', 'dick-divi-chart-kit' ),
				'type'                  => 'yes_no_button',
				'options'               => array(
					'off' => esc_html__( 'No', 'dick-divi-chart-kit' ),
					'on'  => esc_html__( 'Yes', 'dick-divi-chart-kit' ),
                ),
                
				'description'           => esc_html__( 'Here you can choose whether icon set below should be used.', 'dick-divi-chart-kit' ),
                'default_on_front'      => 'off',
                'toggle_slug'           => 'button',
                'tab_slug'              => 'advanced'  
            ),
            
			'data_set_border_width' => array(
                'label'             => esc_html__('Border Width', 'dick-divi-chart-kit'),
                'type'              => 'range',
                'toggle_slug'       => 'button',
                'tab_slug'          => 'advanced',
                'default'           => '1',
                // 'allowed_units'     => array(''),
                'range_settings'    => array(
                    'min'  => '0',
                    'max'  => '100',
                    'step' => '1'
                ),
                'responsive'        => true,
                'mobile_options'    => true,
                'depends_show_if'     => 'on'
            ),
			
        );
        // $icon = array(
        //     'use_icon'                  => array(
		// 		'label'                 => esc_html__( 'Use Icon', 'divi_flash' ),
		// 		'type'                  => 'yes_no_button',
		// 		'option_category'       => 'basic_option',
		// 		'options'               => array(
		// 			'off' => esc_html__( 'No', 'divi_flash' ),
		// 			'on'  => esc_html__( 'Yes', 'divi_flash' ),
        //         ),
        //         'toggle_slug'           => 'at_icon',
        //         'tab_slug'              => 'general',
        //         'affects'               => array (
        //             'font_icon',
        //             'icon_color',
        //             'icon_size'
		// 		)
        //     ),
        //     'font_icon'                 => array(
		// 		'label'                 => esc_html__( 'Icon', 'divi_flash' ),
		// 		'type'                  => 'select_icon',
		// 		'option_category'       => 'basic_option',
		// 		'class'                 => array( 'et-pb-font-icon' ),
        //         'toggle_slug'           => 'at_icon',
        //         'tab_slug'              => 'general',
        //         'depends_show_if'       => 'on'
        //     ),
        //     'icon_color'            => array (
		// 		'label'             => esc_html__( 'Icon Color', 'divi_flash' ),
		// 		'type'              => 'color-alpha',
		// 		'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'divi_flash' ),
		// 		'depends_show_if'   => 'on',
		// 		'tab_slug'          => 'general',
        //         'toggle_slug'       => 'at_icon',
        //         'hover'             => 'tabs'
        //     ),
        //     'icon_size'             => array (
        //         'label'             => esc_html__( 'Icon Size', 'divi_flash' ),
		// 		'type'              => 'range',
		// 		'option_category'   => 'font_option',
		// 		'tab_slug'          => 'general',
		// 		'toggle_slug'       => 'at_icon',
        //         'default_unit'      => 'px',
		// 		'range_settings' => array(
		// 			'min'  => '1',
		// 			'max'  => '120',
		// 			'step' => '1',
        //         ),
		// 		'mobile_options'    => true,
		// 		'depends_show_if'   => 'on',
		// 		'responsive'        => true
        //     ),
        //     'tab_image' => array (
        //         'label'                 => esc_html__( 'Tab Image', 'dgat-advanced-tabs' ),
		// 		'type'                  => 'upload',
		// 		'upload_button_text'    => esc_attr__( 'Upload an image', 'dgat-advanced-tabs' ),
		// 		'choose_text'           => esc_attr__( 'Choose an Image', 'dgat-advanced-tabs' ),
		// 		'update_text'           => esc_attr__( 'Set As Image', 'dgat-advanced-tabs' ),
        //         'toggle_slug'           => 'at_icon',
        //         'dynamic_content'       => 'image',
        //         'show_if_not'           => array('use_icon' => 'on')
        //     ),
        // );
        // $image = array (
        //     'image' => array (
        //         'label'                 => esc_html__( 'Image', 'divi_flash' ),
		// 		'type'                  => 'upload',
		// 		'upload_button_text'    => esc_attr__( 'Upload an image', 'divi_flash' ),
		// 		'choose_text'           => esc_attr__( 'Choose an Image', 'divi_flash' ),
		// 		'update_text'           => esc_attr__( 'Set As Image', 'divi_flash' ),
        //         'toggle_slug'           => 'image',
        //         'dynamic_content'       => 'image',
        //         // 'show_if_not'           => array('use_library_item' => 'on')
        //     ),
        //     'alt' => array (
        //         'label'                 => esc_html__( 'Alt Text', 'divi_flash' ),
		// 		'type'                  => 'text',
        //         'toggle_slug'           => 'image',
        //         'dynamic_content'       => 'text',
        //         // 'show_if_not'           => array('use_library_item' => 'on')
        //     ),
        //     'iamge_place'   => array(
        //         'label'             => esc_html__( 'Image Placement', 'divi_flash' ),
		// 		'type'              => 'composite',
		// 		'tab_slug'          => 'general',
        //         'toggle_slug'       => 'image',
        //         'composite_type'    => 'default',
        //         // 'show_if_not'       => array('use_library_item' => 'on'),
        //         'composite_structure' => array(
		// 			'desktop' => array(
        //                 'icon'     => 'desktop',
		// 				'controls' => array(
		// 					'img_placement' => array(
        //                         'label'                 => esc_html__('Image Placement Desktop', 'divi_flash'),
        //                         'type'                  => 'select',
        //                         'default'               => 'top',
        //                         'options'               => array(
        //                             'flex_top'       => esc_html__('Default', 'divi_flash'),
        //                             'flex_bottom'    => esc_html__('Bottom', 'divi_flash'),
        //                             'flex_left'      => esc_html__('Left', 'divi_flash'),
        //                             'flex_right'     => esc_html__('Right', 'divi_flash')
        //                         ),
        //                         'toggle_slug'            => 'image',
        //                         'tab_slug'               => 'general'
        //                     ),
        //                     'img_container_width'   => array(
        //                         'label'             => esc_html__( 'Container Width Desktop', 'divi_flash' ),
        //                         'type'              => 'range',
        //                         'toggle_slug'       => 'image',
        //                         'tab_slug'          => 'general',
        //                         'default'           => '50%',
        //                         'default_unit'      => '%',
        //                         'default_on_front'  => '50%',
        //                         'range_settings'    => array(
        //                             'min'  => '1',
        //                             'max'  => '100',
        //                             'step' => '1',
        //                         ),
        //                         'show_if'           => array(
        //                             'img_placement' => array('flex_left', 'flex_right')
        //                         )
        //                     ),
		// 				),
		// 			),
		// 			'tablet' => array(
        //                 'icon'  => 'tablet',
		// 				'controls' => array(
		// 					'img_placement_tablet' => array(
        //                         'label'                 => esc_html__('Image Placement Tablet', 'divi_flash'),
        //                         'type'                  => 'select',
        //                         'default'               => 'top',
        //                         'options'               => array(
        //                             'flex_top'       => esc_html__('Default', 'divi_flash'),
        //                             'flex_bottom'    => esc_html__('Bottom', 'divi_flash'),
        //                             'flex_left'      => esc_html__('Left', 'divi_flash'),
        //                             'flex_right'     => esc_html__('Right', 'divi_flash')
        //                         ),
        //                         'toggle_slug'            => 'image',
        //                         'tab_slug'               => 'general',
        //                     ),
        //                     'img_container_width_tablet'   => array(
        //                         'label'             => esc_html__( 'Container Width Tablet', 'divi_flash' ),
        //                         'type'              => 'range',
        //                         'toggle_slug'       => 'image',
        //                         'tab_slug'          => 'general',
        //                         'default'           => '50%',
        //                         'default_unit'      => '%',
        //                         'default_on_front'  => '50%',
        //                         'range_settings'    => array(
        //                             'min'  => '1',
        //                             'max'  => '100',
        //                             'step' => '1',
        //                         ),
        //                         'show_if'           => array(
        //                             'img_placement_tablet' => array('flex_left', 'flex_right')
        //                         )
        //                     ),
		// 				),
		// 			),
		// 			'phone' => array(
        //                 'icon'  => 'phone',
		// 				'controls' => array(
		// 					'img_placement_phone' => array(
        //                         'label'                 => esc_html__('Image Placement Mobile', 'divi_flash'),
        //                         'type'                  => 'select',
        //                         'default'               => 'top',
        //                         'options'               => array(
        //                             'flex_top'       => esc_html__('Default', 'divi_flash'),
        //                             'flex_bottom'    => esc_html__('Bottom', 'divi_flash'),
        //                             'flex_left'      => esc_html__('Left', 'divi_flash'),
        //                             'flex_right'     => esc_html__('Right', 'divi_flash')
        //                         ),
        //                         'toggle_slug'            => 'image',
        //                         'tab_slug'               => 'general',
        //                     ),
        //                     'img_container_width_phone'   => array(
        //                         'label'             => esc_html__( 'Container Width Mobile', 'divi_flash' ),
        //                         'type'              => 'range',
        //                         'toggle_slug'       => 'image',
        //                         'tab_slug'          => 'general',
        //                         'default'           => '50%',
        //                         'default_unit'      => '%',
        //                         'default_on_front'  => '50%',
        //                         'range_settings'    => array(
        //                             'min'  => '1',
        //                             'max'  => '100',
        //                             'step' => '1',
        //                         ),
        //                         'show_if'           => array(
        //                             'img_placement_phone' => array('flex_left', 'flex_right')
        //                         )
        //                     ),
		// 				),
		// 			),
		// 		),
        //     ),
        //     'image_z_index'    => array (
        //         'label'             => esc_html__( 'Image Z-index', 'divi_flash' ),
        //         'type'              => 'range',
        //         'toggle_slug'       => 'image',
        //         'tab_slug'          => 'advanced',
        //         'default'           => '0',
        //         'range_settings'    => array(
        //             'min'  => '0',
        //             'max'  => '15',
        //             'step' => '1',
        //         ),
        //         'validate_unit'     => false
        //     )
        // );
        // $at_button = array(
        //     'at_button_button_text' => array(
        //         'label'           => esc_html__( 'Button Text', 'divi_flash' ),
        //         'type'            => 'text',
        //         'option_category' => 'basic_option',
        //         'description'     => esc_html__( 'Input your desired button text, or leave blank for no button.', 'divi_flash' ),
        //         'toggle_slug'     => 'at_button',
        //         'tab_slug'        => 'general',
        //         // 'show_if_not'     => array('use_library_item' => 'on')
        //     ),
        //     'at_button_button_url' => array(
        //         'label'           => esc_html__( 'Button URL', 'divi_flash' ),
        //         'type'            => 'text',
        //         'option_category' => 'basic_option',
        //         'description'     => esc_html__( 'Input URL for your button.', 'divi_flash' ),
        //         'toggle_slug'     => 'at_button',
        //         'tab_slug'        => 'general',
        //         // 'show_if_not'     => array('use_library_item' => 'on')
        //     ),
        //     'at_button_button_url_new_window' => array(
        //         'default'         => 'off',
        //         'default_on_front'=> true,
        //         'label'           => esc_html__( 'Url Opens', 'divi_flash' ),
        //         'type'            => 'select',
        //         'option_category' => 'configuration',
        //         'options'         => array(
        //             'off' => esc_html__( 'In The Same Window', 'divi_flash' ),
        //             'on'  => esc_html__( 'In The New Tab', 'divi_flash' ),
        //         ),
        //         'toggle_slug'     => 'at_button',
        //         'tab_slug'        => 'general',
        //         // 'show_if_not'     => array('use_library_item' => 'on')
        //     ),
        // );
        // $button = array(
        //     'button_align'    => array(
        //         'label'             => esc_html__('Alignment', 'divi_flash'),
        //         'type'              => 'text_align',
        //         'options'           => et_builder_get_text_orientation_options(array('justified')),
        //         'toggle_slug'       => 'at_button',
        //         'tab_slug'          => 'advanced'
        //     )
        // );
        // $image_sizing =  $this->df_add_max_width(array(
        //     'key'                   => 'image_size',
        //     'toggle_slug'           => 'image',
        //     'alignment'             => true,
        //     'tab_slug'              => 'advanced',
        // ));
        // $button_background = $this->df_add_bg_field(array(
        //     'label'                 => 'Background',
        //     'key'                   => 'button',
        //     'toggle_slug'           => 'at_button',
        //     'tab_slug'              => 'advanced'
        // ));
        // $button_spacing = $this->add_margin_padding(array(
        //     'title'         => 'Button',
        //     'key'           => 'button',
        //     'toggle_slug'   => 'at_button',
        //     'tab_slug'      => 'advanced'
        // ));
        // $image_wrapper_spacing = $this->add_margin_padding(array(
        //     'title'         => 'Image Wrapper',
        //     'key'           => 'image_wrapper',
        //     'toggle_slug'   => 'margin_padding'
        // ));
        // $item_content_spacing = $this->add_margin_padding(array(
        //     'title'         => 'Content Wrapper',
        //     'key'           => 'content',
        //     'toggle_slug'   => 'margin_padding'
        // ));
        // $text_area_background = $this->df_add_bg_field(array(
        //     'label'                 => 'Nav Item Background',
        //     'key'                   => 'text_area',
        //     'toggle_slug'           => 'text_area',
        //     'tab_slug'              => 'general'
        // ));

        return array_merge(
            $general,
            // $icon,
            // $image,
            // $image_sizing,
            // $at_button,
            // $button,
            // $text_area_background,
            // $button_background,
            // $button_spacing,
            // $image_wrapper_spacing,
            // $item_content_spacing
        );
    }

    public function get_transition_fields_css_props() {
        $fields = parent::get_transition_fields_css_props();
        // $button = '%%order_class%% .df_at_button';
        // $image = '%%order_class%% .df_at_image';

        // $fields['icon_color'] = array('color' => '%%order_class%%.df_at_nav .et-pb-icon');
        // $fields['image_size_maxwidth'] = array('max-width' => $image);

        // $fields = $this->df_background_transition(array(
        //     'fields'        => $fields,
        //     'key'           => 'button',
        //     'selector'      => '%%order_class%% .df_at_button'
        // ));
        // $fields = $this->df_background_transition(array(
        //     'fields'        => $fields,
        //     'key'           => 'text_area',
        //     'selector'      => '%%order_class%% .df_at_content_wrapper'
        // ));

        // // spacing
        // $fields['image_wrapper_margin'] = array('margin' => '%%order_class%% .df_at_image_wrapper');
        // $fields['image_wrapper_padding'] = array('padding' => '%%order_class%% .df_at_image_wrapper');

        // $fields['content_margin'] = array('margin' => '%%order_class%% .df_at_content_wrapper');
        // $fields['content_padding'] = array('padding' => '%%order_class%% .df_at_content_wrapper');

        // $fields['button_margin'] = array('margin' => $button);
        // $fields['button_padding'] = array('padding' => $button);

        // // border
        // $fields = $this->df_fix_border_transition(
        //     $fields,
        //     'button',
        //     $button
        // );
        // $fields = $this->df_fix_border_transition(
        //     $fields,
        //     'image',
        //     $image
        // );

        return $fields;
    }

    	/**
	 * Sanitize the props value.
	 *
	 * @param string $value The value to sanitize.
	 * @param string $default_value The default value.
	 *
	 * @return string The sanitized value.
	 */
	private static function get_sanitized_value( $value, $default_value ) {
		return ( ! empty( $value ) ? sanitize_text_field( $value ) : $default_value );
	}

	/**
	 * Processecing child module props to use in the parent module
	 *
	 * @param string $render_slug Render Slug.
	 *
	 * @return array Array of child module props.
	 */
	private function process_props( $render_slug ) {
		global $dich_line_chart;
		$module_order_class = self::get_module_order_class( $render_slug );

		$title = self::get_sanitized_value( $this->props['item_label'], '' );
		$title = str_replace( ' ', '', $title );
		$data  = self::get_sanitized_value( $this->props['data_set_values'], '' );
		$data  = str_replace( ' ', '', $data );

		$dich_line_chart[ $module_order_class ] = array(
			'name'                  => $title,
			'data'                  => $data,
		    'item_line_width'            => isset($this->props['item_line_width'])?  $this->props['item_line_width']: 2,
			'item_line_color'            => isset($this->props['item_line_color'])? self::get_sanitized_value( $this->props['item_line_color'], '' ): '',
		);
		return $dich_line_chart;
	}

	/**
	 * Sanitize the props value.
	 *
	 * @param array  $attrs Attributes.
	 * @param array  $content Content.
	 * @param string $render_slug Render Slug.
	 *
	 * @return null
	 */
	public function render( $attrs, $content, $render_slug ) {
		$this->process_props( $render_slug );
		return null;
    }
}

new DICK_LineChartChild;
