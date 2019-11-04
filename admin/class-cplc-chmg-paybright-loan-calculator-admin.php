<?php
require plugin_dir_path( __FILE__ ).'../includes/cplc-custom-utils/cplc-db-utils.php';
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
		
		if(strpos($hook_suffix, 'woocommerce_page_cplc-chmg-paybright-loan-calculator') !== false) {
			//wp_enqueue_style( $this->plugin_name."-semantic-ui-css", plugin_dir_url( __FILE__ ) . 'css/cplc-chmg-paybright-semantic-ui.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name."-chosen-css", "https://harvesthq.github.io/chosen/chosen.css", array(), '', 'all' );

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

		  //wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-loan-calculator-admin.js', array( 'jquery' ), $this->version, false );
		  wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-loan-calculator-admin.js', array( 'jquery' ), time(), false );
  
		  if(strpos($hook_suffix, 'woocommerce_page_cplc-chmg-paybright-loan-calculator') !== false) {
 			 
			
			  
			 wp_enqueue_script( $this->plugin_name."-chosen","//harvesthq.github.io/chosen/chosen.jquery.js", '', true );

			 wp_enqueue_media();
			 wp_register_script( $this->plugin_name.'-img-uploader', plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-uploader.js', array('jquery'), time());
		  	 wp_enqueue_script($this->plugin_name.'-img-uploader');
 		  }  

	}


	public function cplc_admin_menu(){

		/* add_menu_page( 
						$page_title 	= __("Loan Calculator", CPLC_CHMG_TEXT_DOMAIN), 
						$menu_title 	= __("Loan Calculator", CPLC_CHMG_TEXT_DOMAIN) , 
						$capability		= 'manage_options', 
						$menu_slug		= $this->plugin_name, 
						$function		= [$this, 'cplc_loan_calculator_menu_cb'], 
						$icon_url		= 'dashicons-list-view', 
						$position 		= null ); */

		add_submenu_page( 
							'woocommerce', 
							$page_title 	= __("PayBright Loan Calculator", CPLC_CHMG_TEXT_DOMAIN), 
							$menu_title 	= __(" Loan Calculator", CPLC_CHMG_TEXT_DOMAIN) , 
							$capability		= 'manage_options', 
							$menu_slug		= $this->plugin_name, 
							$function		= [$this, 'cplc_loan_calculator_menu_cb']);

	}


	public function cplc_loan_calculator_menu_cb(){
		include_once( 'partials/cplc-chmg-paybright-loan-calculator-admin-display.php' );
	}


	public function cplc_settings_options(){

		/* ---------------------- PRODUCT SECTION ---------------------- */
			include_once( 'partials/cplc-settings-api/cplc-chmg-product-settings.php' );

			$product_settings = new CplcProductSettings($this->plugin_name);
			$product_settings->register_section();
			$product_settings->register_fields();
		/* ---------------------- END PRODUCT SECTION ---------------------- */

		/* --------------------------- Start Loan Settings ---------------------- */
			include_once( 'partials/cplc-settings-api/cplc-chmg-loan-settings.php' );
				
			$loan_settings = new CplcLoanSettings($this->plugin_name);
			$loan_settings->register_section();
			$loan_settings->register_fields();
		/* --------------------------- End Loan Settings ---------------------- */
 
		/*--------------------- HEADING SECTION ------------------------ */
			include_once( 'partials/cplc-settings-api/cplc-chmg-form-header-settings.php' );

			$form_heading_settings = new CPLCFormHeaderSettings($this->plugin_name);
			$form_heading_settings->register_section();
			$form_heading_settings->register_fields();
		/* ------------------- END HEADING SECTION ---------------------- */
	
	/* ---------------------- FORM SECTION ---------------------------- */
			include_once( 'partials/cplc-settings-api/cplc-chmg-form-main-settings.php' );
			

			$form_main_settings = new CPLCFormMainSettings($this->plugin_name);
			$form_main_settings->register_section();
			$form_main_settings->register_fields();
	/* ----------------------------- END FORM SECTION --------------------------- */
	
	/* ----------------------------- CARD BLOCK SECTION ---------------------------- */

		include_once( 'partials/cplc-settings-api/cplc-chmg-card-block-settings.php' );
 
		$card_block_settings = new CPLCCardBlockSettings($this->plugin_name);
		$card_block_settings->register_section();
		$card_block_settings->register_fields();

	/* ----------------------------- END CARD BLOCK SECTION ---------------------------- */

	/* ------------------- FOOTER SECTION -------------------- */
		include_once( 'partials/cplc-settings-api/cplc-chmg-form-footer-settings.php' );

		$form_footer_settings = new CPLCFormFooterSettings($this->plugin_name);
		$form_footer_settings->register_section();
		$form_footer_settings->register_fields();

	/* ------------------- END FOOTER SECTION ------------------- */


	}
 
  
}
