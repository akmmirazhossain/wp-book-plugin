<?php

class AKMDE_AKMImage extends ET_Builder_Module
{

    public $slug       = 'akmimage';
    public $vb_support = 'on';

    public function init()
    {
        $this->name = esc_html__('AKM Image Mod Name', 'akmde-akmimage');
    }

    public function get_fields()
    {
        return array();
    }

    public function render($unprocessed_props, $content, $render_slug)
    {
    }
}

new AKMDE_AKMImage;
