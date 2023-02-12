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
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/cplc-chmg-paybright-loan-calculator-public.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . "-chosen-js", plugin_dir_url(__FILE__) . 'js/cplc-chmg-paybright-loan-calculator-public-chosen.js', array('jquery'), true);
	
		$options = [
			'cplc_available_loan_term_el' => sanitize_text_field(get_option('cplc_available_loan_term_el')),
			'cplc_available_interest_rates_el' => sanitize_text_field(get_option('cplc_available_interest_rates_el')),
			'cplc_calculation_method_el' => sanitize_text_field(get_option('cplc_calculation_method_el')),
			'cplc_chmg_additional_fee_el' => sanitize_text_field(get_option('cplc_chmg_additional_fee_el')),
			'cplc_minimum_approved_amount_el' => sanitize_text_field(get_option('cplc_minimum_approved_amount_el')),
			'cplc_card_block_interest_rate_el' => sanitize_text_field(get_option('cplc_card_block_interest_rate_el')),
			'cplc_card_block_interest_amount_el' => sanitize_text_field(get_option('cplc_card_block_interest_amount_el')),
			'cplc_card_block_total_amount_el' => sanitize_text_field(get_option('cplc_card_block_total_amount_el')),
			'cplc_card_block_close_icon_el' => sanitize_text_field(get_option('cplc_card_block_close_icon_el')),
			'cplc_paybright_public_key_el' => sanitize_text_field(get_option('cplc_paybright_public_key_el'))
		];
		
		wp_localize_script($this->plugin_name, 'cplc_vars', array_merge($options, ['ajax_url' => admin_url('admin-ajax.php')]));
	}

	/**
	 * Function that displays the price and message for products in different locales.
	 * 
	 * @param float $price The original price of the product.
	 * 
	 * @return string The price and message to be displayed below the price of the product.
	 */
	function cplc_change_product_price_display($price) {
		global $post;
	
		$cplc_current_locale = get_locale();
		$cplc_post_type = $post->post_type;
		$cplc_message = '';
	
		if (is_product() || is_shop() || is_woocommerce() || is_product_category() || is_page()) {
			if ($cplc_post_type == 'product') {
				$lowest_price = $this->cplc_get_product_lowest_price($post);
	
				if ($lowest_price >= get_option('cplc_minimum_approved_amount_el')) {
					$monthly_pay = number_format($this->cplc_get_monthly_pay($lowest_price), 2, 'fr_CA' == $cplc_current_locale ? ',' : '.', 'fr_CA' == $cplc_current_locale ? ' ' : ',');
	
					$cplc_message = str_replace("_CPLC_PRICE", '<span class="cplc_monthly_pay">$' . $monthly_pay . '</span>', get_option('fr_CA' == $cplc_current_locale ? 'cplc_text_below_price_fr_el' : 'cplc_text_below_price_en_el'));
					$cplc_message = str_replace("_PER_MONTH", '<span class="cplc_per_month">/' . ('fr_CA' == $cplc_current_locale ? 'mois' : 'month') . '</span>', $cplc_message);
				}
			}
		}
	
		return $cplc_message;
	}

	/**
	 * 	Get the lowest price of the product
	 * 
	 */

	public function cplc_get_product_lowest_price($post) {
		$product = wc_get_product($post->ID);
		$product_type = $product->get_type();
		switch ($product_type) {
			case 'variable':
				$finance_price = $product->get_variation_price('min');
				break;
			case 'simple':
				$product_regular_price  = $product->get_regular_price();
				$product_sale_price = $product->get_sale_price();

				$finance_price = !empty($product_sale_price) ? $product_sale_price : $product_regular_price;
				break;
			default:
				$finance_price = null;
		}
		return $finance_price;
	}	

	/**
	 * Launches PayBright financing option for the product.
	 *
	 * @return void
	 */
	public function cplc_pb_finance_now_launch() {
		global $post;
		$lowest_price = $this->cplc_get_product_lowest_price($post);
		$cplc_current_locale = get_locale();
		$cplc_message = '';
		$monthly_pay = '';
	
		if ('fr_CA' == $cplc_current_locale) {
			$monthly_pay = number_format($this->cplc_get_monthly_pay($lowest_price), 2, ',', ' ');
			$cplc_message = str_replace("_CPLC_PRICE", $monthly_pay . '$ ', get_option('cplc_financing_button_message_fr_el'));
			$cplc_message = str_replace("_PER_MONTH", '<span class="cplc_btn_per_month">/mois</span>', $cplc_message);
		} elseif ('en_CA' == $cplc_current_locale) {
			$monthly_pay = number_format($this->cplc_get_monthly_pay($lowest_price), 2, '.', ',');
			$cplc_message = str_replace("_CPLC_PRICE", '$' . $monthly_pay, get_option('cplc_financing_button_message_en_el'));
			$cplc_message = str_replace("_PER_MONTH", '<span class="cplc_btn_per_month">/month</span>', $cplc_message);
		}
	
		if ($lowest_price >= get_option('cplc_minimum_approved_amount_el')) {
			echo "<button id='cplc-launch-prequalify-single' style='background-color: " . esc_attr(get_option('cplc_financing_button_bg_color_el')) . "'>$cplc_message</button>
			<style>
				div#paybright-widget-container p {
					display: none;
				}
			</style>";
		}
	
		$product_price = $this->cplc_get_product_lowest_price($post);
		$pb_product_format = $this->cplc_get_estimated_price($product_price);
		$cplc_paybright_public = get_option('cplc_paybright_public_key_el');
	
		echo "<script id='paybright' type='text/javascript' src='https://app.healthsmartfinancial.com/api/pb_woocommerce.js?public_key=$cplc_paybright_public&financedamount=$$pb_product_format'></script>
		<div id='paybright-widget-container'></div>";
	}
	
	/**
	 * Calculates and returns the estimated price of a product
	 * 
	 * @param float $product_price The price of the product
	 * 
	 * @return float The estimated price of the product
	 */
	public function cplc_get_estimated_price($product_price) {
		$_multiplier = get_option('cplc_chmg_additional_fee_el') ?: 1.10;
		$_addition_type = get_option('cplc_calculation_method_el');
	
		switch ($_addition_type) {
			case 'fixed':
				$LoanAmt = (float) $product_price + $_multiplier;
				break;
			case 'percentage':
				$LoanAmt = (float) $product_price * $_multiplier;
				break;
			default:
				$LoanAmt = (float) $product_price + $_multiplier;
		}
	
		return $LoanAmt;
	}

	/**
	 * Calculates and returns the monthly payment amount
	 * 
	 * @param float $price The price of the product
	 * 
	 * @return float The monthly payment amount
	 */
	public function cplc_get_monthly_pay($price) {
		$LoanAmt = $this->cplc_get_estimated_price($price);
		$LoanTerm = get_option('cplc_advanced_loan_term_el') ?: 18;
		$LoanRate = get_option('cplc_default_interest_rate_el') ?: 7.95;

		if ($LoanRate === 0) {
			$result = ($LoanAmt / $LoanTerm);
		} else {
			$newinterestrate = $LoanRate / 12;
			$result = ($LoanAmt * ($newinterestrate / 100) * pow((1 + ($newinterestrate / 100)), $LoanTerm)) / (pow((1 + ($newinterestrate / 100)), $LoanTerm) - 1);
		}

		return round($result, 2);
	}

}
