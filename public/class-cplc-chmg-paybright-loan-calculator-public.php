<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/public
 * @author     Canadian Home Medical Group <it@chmg.ca>
 */
class Cplc_Chmg_Paybright_Loan_Calculator_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cplc-chmg-paybright-loan-calculator-public.css', array(), $this->version, 'all' );
 		wp_enqueue_style( $this->plugin_name."-chosen-css", plugin_dir_url( __FILE__ ) . 'css/cplc-chmg-paybright-loan-calculator-choosen.css', array(), '', 'all' );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-loan-calculator-public.js', array( 'jquery' ), $this->version, false );
 		wp_enqueue_script( $this->plugin_name."-chosen-js", plugin_dir_url( __FILE__ ) .'js/cplc-chmg-paybright-loan-calculator-public-chosen.js', array( 'jquery' ), true );

		wp_localize_script($this->plugin_name, 
							'cplc_vars',
								[
									'ajax_url' => admin_url('admin-ajax.php'),
									'cplc_available_loan_term_el' => get_option('cplc_available_loan_term_el'),
									'cplc_available_interest_rates_el' => get_option('cplc_available_interest_rates_el'),
									'cplc_calculation_method_el' => get_option('cplc_calculation_method_el'),
									'cplc_chmg_additional_fee_el' => get_option('cplc_chmg_additional_fee_el'),
									'cplc_minimum_approved_amount_el' => get_option('cplc_minimum_approved_amount_el'),
									'cplc_card_block_interest_rate_el' => get_option('cplc_card_block_interest_rate_el'),
									'cplc_card_block_interest_amount_el' => get_option('cplc_card_block_interest_amount_el'),
									'cplc_card_block_total_amount_el' => get_option('cplc_card_block_total_amount_el'),
									'cplc_card_block_close_icon_el' => get_option('cplc_card_block_close_icon_el'),
 								]
							);

	}

}
