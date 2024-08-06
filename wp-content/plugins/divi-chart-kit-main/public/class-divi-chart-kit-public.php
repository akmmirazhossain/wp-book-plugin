<?php
class Divi_Chart_Kit_Public {


    private $plugin_name;

    private $version;

    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version     = $version;

    }


    public function enqueue_styles() {

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/divi-chart-kit-public.css', array(), $this->version, 'all' );

    }

    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Divi_Chart_Kit_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Divi_Chart_Kit_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

      
        wp_register_script( 'dick-chart-kit-lib', plugin_dir_url( __FILE__ ) . 'js/lib/apexcharts.js', '', $this->version, false );
        wp_register_script( 'dick-line-chart', plugin_dir_url( __FILE__ ) . 'js/lineChart.js', array( 'dick-chart-kit-lib' ), $this->version, false );
        wp_register_script( 'dick-bar-chart', plugin_dir_url( __FILE__ ) . 'js/barChart.js', array( 'dick-chart-kit-lib' ), $this->version, false );
        wp_register_script( 'dick-bubble-chart', plugin_dir_url( __FILE__ ) . 'js/bubbleChart.js', array( 'dick-chart-kit-lib' ), $this->version, false );
        wp_register_script( 'dick-radar-chart', plugin_dir_url( __FILE__ ) . 'js/radarChart.js', array( 'dick-chart-kit-lib' ), $this->version, false );
        // wp_register_script( 'dmce-product-list', plugin_dir_url( __FILE__ ) . 'js/woo-expand-product-list.js', array( 'dmce-product-quick-view' ), $this->version, false );
    
        // wp_localize_script('dmce-mini-cart', 'ajax_var', array(
		// 	'update_mini_cart_nonce' => wp_create_nonce('update_mini_cart_nonce'),
        //     'remove_product_item_nonce' => wp_create_nonce('remove_product_item_nonce'),
        //     'remove_coupon_nonce' => wp_create_nonce('remove_coupon_nonce'),
        //     'apply_coupon_nonce' => wp_create_nonce('apply_coupon_nonce')
		// ));
    }

}
