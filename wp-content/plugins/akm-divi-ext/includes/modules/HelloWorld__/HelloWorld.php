<?php


class AKMDE_HelloWorld extends ET_Builder_Module
{
	public $slug       = 'akmde_hello_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'akm-divi-ext',
		'author'     => 'AKM Miraz',
		'author_uri' => '',
	);

	public function init()
	{
		$this->name = esc_html__('Hello World', 'akmde-akm-divi-ext');
	}

	public function get_fields()
	{
		return array(
			'content' => array(
				'label'           => esc_html__('Content', 'akmde-akm-divi-ext'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__('Content entered here will appear inside the module.', 'akmde-akm-divi-ext'),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render($attrs, $content = null, $render_slug)
	{
		return sprintf('<h1>%1$s</h1>', $this->props['content']);
	}

	// Disable Design and Advanced tabs
	// public function get_advanced_fields_config()
	// {
	// 	return array(
	// 		'background' => false,
	// 		'text'       => false,
	// 		'max_width'  => false,
	// 		'borders'    => false,
	// 		'box_shadow' => false,
	// 		'filters'    => false,
	// 		'animation'  => false,
	// 		'transform'  => false,
	// 	);
	// }

	public function get_advanced_fields_config()
	{
		return array(
			'text'       => false,
			'background' => false,
			'max_width'  => false,
			'borders'    => false,
			'box_shadow' => false,
			'filters'    => false,
			'animation'  => false,
			'transform'  => false,
		);
	}
}

new AKMDE_HelloWorld;
