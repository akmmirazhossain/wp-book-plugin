<?php

class AKMDE_AKMCustomPage5Fields extends ET_Builder_Module
{

    public $slug       = 'akm_custom_page_5_fields';
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => '#',
        'author'     => 'AKM Miraz',
        'author_uri' => 'https://akmmiraz.com',
    );

    public function init()
    {
        $this->name = esc_html__('AKM Custom Page 5 Fields', 'akm-custom-page-5-fields');

        // $this->settings_modal_toggles = array(
        //     'general' => array(
        //         'toggles' => array(
        //             'main_content' => esc_html__('Main Content', 'akm-custom-page-5-fields'),
        //         ),
        //     ),
        // );



        $this->settings_modal_toggles = array(
            'general'  => array(
                'toggles' => array(
                    'main_content' => esc_html__('Main Content', 'akm-custom-page-5-fields'),
                    'icon_settings' => esc_html__('Icon Settings', 'akm-custom-page-5-fields'),
                    'button' => esc_html__('Button', 'akm-custom-page-5-fields'),
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'title_text' => array(
                        'title'    => esc_html__('Title', 'akm-custom-page-5-fields'),
                        'priority' => 10,
                    ),
                    'subtitle_text' => array(
                        'title'    => esc_html__('Sub Title', 'akm-custom-page-5-fields'),
                        'priority' => 10,
                    ),
                ),
            ),
        );

        // $this->advanced_fields = array();
    }


    function get_advanced_fields_config()
    {
        // Advanced fields
        // The goal of advanced fields are to reduce repetitiveness of field definition. Many modules
        // use the same set of fields with slight differences (i.e.: most modules have box shadow
        // fields but Blurb has additional box-shadow fields for its image) so advanced fields
        // enables module to declare minimum variable to auto generate commonly used fields.

        // NOTE:
        // IF MODULE HAS PARTIAL OR FULL BUILDER SUPPORT, ALL ADVANCED OPTIONS (EXCEPT BUTTON) ARE ADDED BY DEFAULT
        $advanced_fields = array();

        // The following advanced fields are automatically added regardless builder support or explicit definition
        // Tabs     | Toggles          | Fields
        // --------- ------------------ -------------
        // Design   | Border           | Rounded Corners (multiple fields)
        // Design   | Border           | Border Styles (multiple fields)
        // Design   | Box Shadow       | Box Shadow (multiple fields)
        // Design   | Animation        | Animation (multiple fields)

        // Note: "// default" comment after the configuration attribute means that Divi automatically
        // adds this value. The attribute can be left undeclared if you want to use default value

        // Add advanced fields: module background
        // There can only be one module background so its setting is as minimal as possible.
        // The location of the background is at Content > Background > Background
        $advanced_fields['background'] = array(
            'has_background_color_toggle'   => false, // default. Warning: to be deprecated
            'use_background_color'          => true, // default
            'use_background_color_gradient' => true, // default
            'use_background_image'          => true, // default
            'use_background_video'          => true, // default
        );

        // Add advanced fields: fonts
        // There can be multiple advanced font options in a module, so it is designed to accept
        // multiple advanced fields
        // Adding very basic font options
        $advanced_fields['fonts'] = array(
            'title'   => array(
                'label'    => esc_html__('Title', 'akm-custom-page-5-fields'),
                'css'      => array(
                    'main' => "{$this->main_css_element} .title",
                ),
                'toggle_slug' => 'title_text',
                'tab_slug' => 'advanced'
            ),
            'subtitle'   => array(
                'label'    => esc_html__('Sub Title', 'akm-custom-page-5-fields'),
                'css'      => array(
                    'main' => "{$this->main_css_element} .subtitle",
                ),
                'toggle_slug' => 'subtitle_text',
                'tab_slug' => 'advanced'
            ),
        );

        // Example of more advanced font options
        $advanced_fields['fonts']['link'] = array(
            'label'    => esc_html__('Link', 'akm-custom-page-5-fields'),
            'css'      => array(
                'main' => "{$this->main_css_element} a",
            ),
            'toggle_slug' => 'body',
            'sub_toggle'  => 'a',
        );

        $advanced_fields['fonts']['quote'] = array(
            'label'    => esc_html__('Blockquote', 'akm-custom-page-5-fields'),
            'css'      => array(
                'main' => "{$this->main_css_element} blockquote",
            ),
            'line_height' => array(
                'default' => '1em',
            ),
            'font_size' => array(
                'default' => '16px',
            ),
            'toggle_slug' => 'body',
            'sub_toggle'  => 'quote',
        );

        // Add advanced fields: border (radius & style)
        // Most module has border, thus it is automatically added even without explicit definition
        // However, some module might have multiple border (ie. blurb which has module and image
        // border options) or slightly different border configuration
        $advanced_fields['borders'] = array(
            'default' => array(), // default
        );

        // Adding additional border options
        $advanced_fields['borders']['title'] = array(
            'css'             => array(
                'main' => array(
                    'border_radii' => "%%order_class%% .et-demo-title",
                    'border_styles' => "%%order_class%% .et-demo-title",
                )
            ),
            'label_prefix'    => esc_html__('Title', 'akm-custom-page-5-fields'),
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'title',
        );

        // Add advanced fields: text
        // Automatically add text orientation field (left|center|right|justified) to advanced tab.
        // text_orientation are commonly not printing anything; the attribute is used to outputs
        // text-align affecting class name. To manually output CSS styling, `css` attribute containing
        // `text` orientation and valid selector template needs to be declared
        $advanced_fields['text'] = array(
            'use_text_orientation'  => true, // default
            'css' => array(
                'text_orientation' => '%%order_class%%',
            ),
        );

        // Add advanced fields: Max Width (sizing)
        // This advanced fields automatically adds Width and Module Alignment (responsive) fields
        // on Design > Sizing toggle. Module Alignment only appears if Width value isn't (100%)
        // because Module Alignment is irrelvant if the module widht fills its entire wrapper
        $advanced_fields['max_width'] = array(
            'use_max_width'        => true, // default
            'use_module_alignment' => true, // default
        );

        // Add advanced fields: margin & padding
        // Adding advanced fields automatically adds Margin and Padding fields on Design > Spacing
        // Module is expected to have max one margin and padding option so the only option this
        // advanced field has is either to activate / deactivate margin / padding options
        $advanced_fields['margin_padding'] = array(
            'use_margin'  => true,
            'use_padding' => true,
        );

        // Add advanced fields: button
        // Similar to advanced font options, there can be multiple advanced button options in a
        // module (ie. Fullwidth Header module), so it is designed to accept multiple advanced
        // options and requires module to at least explicitly set one setting

        // NOTE:
        // Button fields are not automatically added even if the module has builder support
        $advanced_fields['button'] = array(
            'button' => array(
                'label' => esc_html__('Button', 'akm-custom-page-5-fields'),
                'css'   => array(
                    'alignment'   => "%%order_class%% .et_pb_button_wrapper",
                ),
            ),
        );

        // Add advanced fields: filter
        // Adding CSS-based color filter options to the module. CSS filter is pre-deterministic:
        // It is assumed that module can only have maximum two filters advanced fields at the same
        // time so there's no flexibility in terms of attribute naming (unlike font and button options)
        $advanced_fields['filters'] = array(
            // The following are optional. only if you'd like to add secondary filter options to module
            'child_filters_target' => array(
                'tab_slug'    => 'advanced',
                'toggle_slug' => 'title',
            ),
        );

        // Add advanced fields: animation
        // Advanced animation options is automatically added to all module except to module item
        // It doesn't have many option except to have it disabled (uncomment the line below to try it)
        // $advanced_fields['animation'] = false;

        // Add advanced fields: text shadow
        // Text shadow option is automatically added when advanced_options property is defined.
        // Module normally only defined one advanced advanced text shadow fields but it accepts
        // parameter to define additional text shadow options
        $advanced_fields['text_shadow'] = array(
            'default' => array(), // default
        );

        return $advanced_fields;
    }



    public function get_fields()
    {
        return array(
            'title' => array(
                'label'           => esc_html__('Title', 'akm-custom-page-5-fields'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Title entered here will appear inside the module.', 'akm-custom-page-5-fields'),
                'toggle_slug'     => 'main_content',
                'tab_slug'        => 'general',
            ),
            'subtitle' => array(
                'label'           => esc_html__('Sub Title', 'akm-custom-page-5-fields'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Sub Title entered here will appear inside the module.', 'akm-custom-page-5-fields'),
                'toggle_slug'     => 'main_content',
            ),
            'content' => array(
                'label'           => esc_html__('Content', 'akm-custom-page-5-fields'),
                'type'            => 'tiny_mce',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Content entered here will appear inside the module.', 'akm-custom-page-5-fields'),
                'toggle_slug'     => 'main_content',
            ),
            'icon' => array(
                'label'           => esc_html__('Icon', 'akm-custom-page-5-fields'),
                'type'            => 'upload',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Upload an icon to display with the content.', 'akm-custom-page-5-fields'),
                'toggle_slug'     => 'icon_settings',
            ),
            'button_text' => array(
                'label'           => esc_html__('Button Text', 'akm-custom-page-5-fields'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Input your desired button text, or leave blank for no button.', 'akm-custom-page-5-fields'),
                'toggle_slug'     => 'button',
            ),
            'button_url' => array(
                'label'           => esc_html__('Button URL', 'akm-custom-page-5-fields'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Input the URL for the button.', 'akm-custom-page-5-fields'),
                'toggle_slug'     => 'button',
            ),
            'button_style' => array(
                'label'           => esc_html__('Button Style', 'akm-custom-page-5-fields'),
                'type'            => 'select',
                'option_category' => 'basic_option',
                'options'         => array(
                    'default' => esc_html__('Default', 'akm-custom-page-5-fields'),
                    'primary' => esc_html__('Primary', 'akm-custom-page-5-fields'),
                    'secondary' => esc_html__('Secondary', 'akm-custom-page-5-fields'),
                ),
                'description'     => esc_html__('Choose a style for the button.', 'akm-custom-page-5-fields'),
                'toggle_slug'     => 'button',
            ),
        );
    }

    // public function render($attrs, $content = null, $render_slug)
    // {
    //     $title = $this->props['title'];
    //     $subtitle = $this->props['subtitle'];
    //     $icon = $this->props['icon'];
    //     $content = $this->props['content'];
    //     $button = $this->props['button'];

    //     $output = sprintf(
    //         '<div class="akm-custom-page-5-fields">
    //             <h1>%1$s</h1>
    //             <h2>%2$s</h2>
    //             <img src="%3$s" alt="Icon">
    //             <div>%4$s</div>
    //             <button>%5$s</button>
    //         </div>',
    //         esc_html($title),
    //         esc_html($subtitle),
    //         esc_url($icon),
    //         $this->content,
    //         esc_html($button)
    //     );

    //     return $output;
    // }

    public function render($attrs, $content = null, $render_slug)
    {
        $title = $this->props['title'];
        $subtitle = $this->props['subtitle'];
        $content = $this->props['content'];
        $icon = $this->props['icon'];
        $button_text = $this->props['button_text'];
        $button_url = $this->props['button_url'];
        $button_style = $this->props['button_style'];
        $button_class = '';
        switch ($button_style) {
            case 'primary':
                $button_class = 'button-primary';
                break;
            case 'secondary':
                $button_class = 'button-secondary';
                break;
            default:
                $button_class = 'button-default';
                break;
        }

        return sprintf(
            '<div>
				<h1 class="title">%2$s sdfdsfsfdsfdsf</h1>
				<h3 class="subtitle">%3$s</h3>
				%1$s
				<div class="content">%4$s</div>
				%5$s
			</div>',
            $icon ? sprintf('<img src="%s" alt="Icon" /><br />', esc_url($icon)) : '',

            esc_html($title),
            $subtitle ? esc_html($subtitle)  : '',
            $this->content,
            $button_text ? sprintf('<br /><a href="%s" class="%s">%s</a>', esc_url($button_url), esc_attr($button_class), esc_html($button_text)) : ''
        );
    }
}

new AKMDE_AKMCustomPage5Fields;
