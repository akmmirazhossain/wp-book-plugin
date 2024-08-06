<?php

class Divi_Chart_Kit {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Divi_Chart_Kit_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'Chart_Kit_PLUGIN_VERSION' ) ) {
            $this->version = Chart_Kit_PLUGIN_VERSION;
        } else {
            $this->version = '1.0.2';
        }
        $this->plugin_name = 'divi-chart-kit';


        add_action( 'divi_extensions_init', [ $this, 'divi_extensions_init' ] );

        $this->load_dependencies();
       // $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }


    public function divi_extensions_init() {
        
        require_once plugin_dir_path( __DIR__ ) . 'includes/DiviChartKit.php';
        
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Divi_Chart_Kit_Loader. Orchestrates the hooks of the plugin.
     * - Divi_Chart_Kit_i18n. Defines internationalization functionality.
     * - Divi_Chart_Kit_Admin. Defines all hooks for the admin area.
     * - Divi_Chart_Kit_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-divi-chart-kit-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
       // require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-divi-chart-kit-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        
        //require_once plugin_dir_path( __DIR__ ) . 'admin/diviexpand-woo-module-manager.php';
        //require_once plugin_dir_path( __DIR__ ) . 'admin/diviexpand-woo-dashboard.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/divi-chart-kit-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-divi-chart-kit-public.php';

        $this->loader = new Divi_Chart_Kit_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Divi_Chart_Kit_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    // private function set_locale() {

    //     $plugin_i18n = new Divi_Chart_Kit_i18n();

    //     $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    // }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Divi_Chart_Kit_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        // Add plugin settings to WooCommerce
        //$this->loader->add_filter( 'woocommerce_get_settings_pages', $plugin_admin, 'Divi_Chart_Kit_add_settings' );

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Divi_Chart_Kit_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }


    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     * @since     1.0.0
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Divi_Chart_Kit_Loader    Orchestrates the hooks of the plugin.
     * @since     1.0.0
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.0.0
     */
    public function get_version() {
        return $this->version;
    }

}
