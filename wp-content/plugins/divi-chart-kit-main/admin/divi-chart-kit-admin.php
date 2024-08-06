<?php


class Divi_Chart_Kit_Admin {

    private $plugin_name;

    private $version;

    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version     = $version;

    }


    public function enqueue_styles() {

        wp_register_style( 'divi-chart-kit-admin', plugin_dir_url( __FILE__ ) . 'css/divi-chart-kit-admin.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'divi-chart-kit-admin');
    }


    public function enqueue_scripts() {

        wp_register_script( 'diviexpand-dashboard', plugin_dir_url( __FILE__ ) . 'js/divi-chart-kit-admin.js', array(), $this->version, true );
		wp_enqueue_script('diviexpand-dashboard');
		
        wp_localize_script('diviexpand-dashboard', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('diviexpand_save_module_settings')
		));

    }

    // public function Divi_Chart_Kit_add_settings( $settings ) {
    //     $settings[] = include plugin_dir_path( __DIR__ ) . 'admin/divi-chart-kit-wc-settings.php';

    //     return $settings;
    // }

}
