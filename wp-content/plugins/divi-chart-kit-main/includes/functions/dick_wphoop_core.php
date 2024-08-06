<?php
if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

trait dick_expand_core{
   
    
    /**
     * Add margin and padding fields
     * 
     */
    function dick_margin_padding(&$fields, $options, $type ) {

        $key = $options['key'] . '_' . $type;
 
        $fields[$key] = array(
            'label'				=> sprintf(esc_html__('%1$s %2$s', 'mini-cart-expand'), $options['title'], ucwords($type)),
            'type'				=> 'custom_margin',
            'toggle_slug'       => $options['toggle_slug'],
            'sub_toggle'		=> $options['sub_toggle'],
            'default'           => $options['default_'.$type], // default value set using margin/padding type 
            'tab_slug'			=> $options['tab_slug'],
            'mobile_options'    => true,
            'hover'				=> 'tabs',
            'priority' 			=> $options['priority'],
        );
        $fields[$key . '_tablet'] = array(
            'type'            	=> 'skip',
            'tab_slug'        	=> $options['tab_slug'],
            'toggle_slug'		=> $options['toggle_slug'],
            'sub_toggle'		=> $options['sub_toggle']
        );
        $fields[$key.'_phone'] = array(
            'type'            	=> 'skip',
            'tab_slug'        	=> $options['tab_slug'],
            'toggle_slug'		=> $options['toggle_slug'],
            'sub_toggle'		=> $options['sub_toggle']
        );
        $fields[$key.'_last_edited'] = array(
            'type'            	=> 'skip',
            'tab_slug'        	=> $options['tab_slug'],
            'toggle_slug'		=> $options['toggle_slug'],
            'sub_toggle'		=> $options['sub_toggle']
        );
        // added in version 1.0.5
        if(isset($options['show_if'])) {
            $fields[$key]['show_if'] = $options['show_if'];
        }
    }
    function add_margin_padding( $options = array() ) {
        $margin_padding = array();
        $default = array(
            'title'         => '',
            'key'           => '',
            'toggle_slug'   => '',
            'sub_toggle'    => null,
            'tab_slug'      => 'advanced',
            'default_padding' => '',
            'default_margin'  => '',
            'option'        => 'both',
            'priority'      => 30
        );
        $args = wp_parse_args( $options, $default );

        if ( $args['option'] === 'both' || $args['option'] === 'margin' ) {
            $this->dmce_margin_padding($margin_padding, $args, 'margin');
        }
        if ( $args['option'] === 'both' || $args['option'] === 'padding' ) {
            $this->dmce_margin_padding($margin_padding, $args, 'padding');
        }
        return $margin_padding;
    }

    /**
     * Process string attr
     */
    function dick_process_string_attr($options = array()) {
        $default = array(
            'render_slug'       => '',
            'slug'              => '',
            'type'              => '',
            'selector'          => '',
            'hover'             => '',
            'important'         => false,
            'default'           => ''
        );
        $options        = wp_parse_args( $options, $default );
        extract($options); // phpcs:ignore WordPress.PHP.DontExtract
        $desktop  =  !empty($this->props[$slug]) ? 
            $this->dmce_process_values($this->props[$slug]) : $default;
        $tablet   =  !empty($this->props[$slug.'_tablet']) ? 
            $this->dmce_process_values($this->props[$slug.'_tablet']) : $desktop;
        $phone   =  !empty($this->props[$slug.'_phone']) ? 
            $this->dmce_process_values($this->props[$slug.'_phone']) : $tablet;
        $important_opt = $important === true ? '!important' : '';

        ET_Builder_Element::set_style($render_slug, array(
            'selector' => $selector,
            'declaration' => sprintf('%1$s:%2$s %3$s;', $type, $desktop, $important_opt),
        ));
        ET_Builder_Element::set_style($render_slug, array(
            'selector' => $selector,
            'declaration' => sprintf('%1$s:%2$s %3$s;', $type, $tablet,$important_opt),
            'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
        ));
        ET_Builder_Element::set_style($render_slug, array(
            'selector' => $selector,
            'declaration' => sprintf('%1$s:%2$s %3$s;', $type, $phone,$important_opt),
            'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
        ));
    }


    /**
     * Process Margin & Padding styles
     */
    function dick_apply_custom_spacing_css($options = array()) {
        $default = array(
            'module'            => '',
            'render_slug'       => '',
            'slug'              => '',
            'type'              => '',
            'selector'          => '',
            'hover'             => '',
            'important'         => true
        );
        $options        = wp_parse_args( $options, $default );
        extract($options); // phpcs:ignore WordPress.PHP.DontExtract
        $module = $this;
		$desktop 		= $module->props[$slug];
		$tablet 		= $module->props[$slug.'_tablet'];
        $phone 			= $module->props[$slug.'_phone'];
        
        if (class_exists('ET_Builder_Element')) {
            if(isset($desktop) && !empty($desktop)) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => $options['selector'],
                    'declaration' => et_builder_get_element_style_css($desktop, 
                        $type, $important),
                ));
            }
            if (isset($tablet) && !empty($tablet)) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => $options['selector'],
                    'declaration' => et_builder_get_element_style_css($tablet, 
                        $type, $important),
                    'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
                ));
            }
            if (isset($phone) && !empty($phone)) {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => $options['selector'],
                    'declaration' => et_builder_get_element_style_css($phone, 
                        $type, $important),
                    'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
                ));
            }
			if (et_builder_is_hover_enabled( $slug, $module->props ) && isset($module->props[$slug.'__hover'])) {
				$hover = $module->props[$slug.'__hover'];
				ET_Builder_Element::set_style($render_slug, array(
					'selector' => $options['hover'],
                    'declaration' => et_builder_get_element_style_css($hover, 
                        $type, $important),
				));
			}
        }
    }

    


    /**
     * check hover option
     */
    function dick_check_hover_enable($key, $module) {
        if ( isset($module->props[$key . '__hover'])  && et_builder_is_hover_enabled( $key, $module->props ) ) {
            return true;
        } else {
            return false;
        }
    }

   
    /**
     * Fix border transition issues
     * 
     */
    function dick_apply_border_hover_transition($fields, $key, $selector) {
        // all
        $fields['border_radii_'.$key] = array('border-radius' => $selector);
        $fields['border_width_all_'.$key] = array('border-width' => $selector);
        $fields['border_color_all_'.$key] = array('border-color' => $selector);
        $fields['border_style_all_'.$key] = array('border-style' => $selector);

        // right
        $fields['border_width_right_'.$key] = array('border-right-width' => $selector);
        $fields['border_color_right_'.$key] = array('border-right-color' => $selector);
        $fields['border_style_right_'.$key] = array('border-right-style' => $selector);
        // left
        $fields['border_width_left_'.$key] = array('border-left-width' => $selector);
        $fields['border_color_left_'.$key] = array('border-left-color' => $selector);
        $fields['border_style_left_'.$key] = array('border-left-style' => $selector);
        // top
        $fields['border_width_top_'.$key] = array('border-left-width' => $selector);
        $fields['border_color_top_'.$key] = array('border-top-color' => $selector);
        $fields['border_style_top_'.$key] = array('border-top-style' => $selector);
        // bottom
        $fields['border_width_bottom_'.$key] = array('border-left-width' => $selector);
        $fields['border_color_bottom_'.$key] = array('border-bottom-color' => $selector);
        $fields['border_style_bottom_'.$key] = array('border-bottom-style' => $selector);

        return $fields;
    }
    /**
     * Fix font style transition issues
     * Description: take all the attribute from divi advanced 'fonts' field
     * and set the transition with given selector.
     * 
     * @param Array $fields
     * @param String $key
     * @param String Selector
     * @return Array $fields
     */
    function dick_apply_font_hover_transition($fields, $key, $selector) {
        
        $fields[$key . '_font_size'] = array('font-size' => $selector);
        $fields[$key . '_text_color'] = array('color' => $selector);
        $fields[$key . '_letter_spacing'] = array('letter-spacing' => $selector);
        $fields[$key . '_line_height'] = array('line-height' => $selector);

        return $fields;
    }

    /**
     * Fix box-shadow transition issues
     * 
     */
    function dick_apply_boxshadow_hover_transition($fields, $key, $selector) {
        // all
        $fields['box_shadow_color_'.$key] = array('box-shadow' => $selector);
        $fields['box_shadow_blur_'.$key] = array('box-shadow' => $selector);
        $fields['box_shadow_spread_'.$key] = array('box-shadow' => $selector);
        $fields['box_shadow_horizontal_'.$key] = array('box-shadow' => $selector);
        $fields['box_shadow_vertical_'.$key] = array('box-shadow' => $selector);
         return $fields;
    }
    
}