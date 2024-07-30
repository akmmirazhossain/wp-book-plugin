<?php

class AKMDE_AkmDiviExt extends DiviExtension
{

	public $gettext_domain = 'akmde-akm-divi-ext';
	public $name = 'akm-divi-ext';
	public $version = '1.0.0';

	public function __construct($name = 'akm-divi-ext', $args = array())
	{
		$this->plugin_dir     = plugin_dir_path(__FILE__);
		$this->plugin_dir_url = plugin_dir_url($this->plugin_dir);

		parent::__construct($name, $args);

		// Register modules
		add_action('et_builder_ready', array($this, 'load_modules'));
	}

	public function load_modules()
	{
		if (class_exists('ET_Builder_Module')) {
			include_once $this->plugin_dir . 'includes/modules/AKMform/AKMform.php';
		}
	}
}

new AKMDE_AkmDiviExt;
