<?php

class AKMDE_AKMform extends ET_Builder_Module
{
    public $slug       = 'akmform';
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => 'https://example.com',
        'author'     => 'AKM Miraz',
        'author_uri' => 'https://example.com',
    );

    public function init()
    {
        $this->name = esc_html__('AKMform', 'akmde-akm-divi-ext');
    }

    public function get_fields()
    {
        return array(
            'content' => array(
                'label'           => esc_html__('Content', 'akmde-akm-divi-ext'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Content entered here will appear inside the module.', 'akmde-akm-divi-ext'),
                'toggle_slug'     => 'main_content',
            ),
        );
    }

    public function render($attrs, $content = null, $render_slug)
    {
        return sprintf('<div class="akmform">%1$s</div>', $this->props['content']);
    }
}

new AKMDE_AKMform;
