<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/admin
 * @author     Canadian Home Medical Group <it@chmg.ca>
 */
class Cplc_Chmg_Paybright_Loan_Calculator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook_suffix) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cplc_Chmg_Paybright_Loan_Calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cplc_Chmg_Paybright_Loan_Calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cplc-chmg-paybright-loan-calculator-admin.css', array(), $this->version, 'all' );
		
		if($hook_suffix == 'toplevel_page_cplc_loan_calculator') {
			wp_enqueue_style( $this->plugin_name."-semantic-ui-css", plugin_dir_url( __FILE__ ) . 'css/cplc-chmg-paybright-semantic-ui.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook_suffix) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cplc_Chmg_Paybright_Loan_Calculator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cplc_Chmg_Paybright_Loan_Calculator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		  wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-loan-calculator-admin.js', array( 'jquery' ), $this->version, false );
		
		  if($hook_suffix == 'toplevel_page_cplc_loan_calculator') {
			wp_enqueue_script( $this->plugin_name."-semantic-ui-js", plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-semantic-ui.js', array( 'jquery' ), $this->version, false );
		  }  

	 

	}


	public function cplc_admin_menu(){

		add_menu_page( 
						$page_title 	= __("Loan Calculator", CPLC_CHMG_TEXT_DOMAIN), 
						$menu_title 	= __("Loan Calculator", CPLC_CHMG_TEXT_DOMAIN) , 
						$capability		= 'manage_options', 
						$menu_slug		= $this->plugin_name, 
						$function		= [$this, 'cplc_loan_calculator_menu_cb'], 
						$icon_url		= 'dashicons-list-view', 
						$position 		= null );

	}


	public function cplc_loan_calculator_menu_cb(){
		include_once( 'partials/cplc-chmg-paybright-loan-calculator-admin-display.php' );
	}


	public function cplc_settings_options(){
		add_settings_section(
			'cplc_general_section',
			__( 'General Settings', CPLC_CHMG_TEXT_DOMAIN ),
			[$this, 'cplc_general_settings_section_cb' ],
			$this->plugin_name
		);

		add_settings_field(
			'cplc_available_months_el',
			__( 'Available Months', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_available_months_cb'],
			$this->plugin_name,
			'cplc_general_section'
 		);
		register_setting( $this->plugin_name, 'cplc_available_months_el');





	}

	/* Callback function for the settings sections */
	public function cplc_general_settings_section_cb(){

	}

	public function cplc_available_months_cb(){
		$cplc_available_months_el =  get_option('cplc_available_months_el');
		
	}




}
