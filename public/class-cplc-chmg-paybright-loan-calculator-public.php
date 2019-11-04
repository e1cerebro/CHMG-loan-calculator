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
									'cplc_paybright_public_key_el' => get_option('cplc_paybright_public_key_el'),
 								]
							);

	}

	function cplc_change_product_price_display( $price ) {
		
		global $post;

		if( '1' == get_option('cplc_advanced_activate_for_single_only_el')){
			if(is_single()){
				$finance_price = $this->cplc_get_lowest_price($post);
			
				$cplc_message = str_replace("_CPLC_PRICE", '<span class="cplc_monthly_pay">$'.$finance_price.'</span>', get_option('cplc_text_below_price_el')) ;
				$price .= '<p class="cplc_financing_message">'.$cplc_message.'</p>';

			}
		}else{
			$finance_price = $this->cplc_get_lowest_price($post);
			
			$cplc_message = str_replace("_CPLC_PRICE", '<span class="cplc_monthly_pay">$'.$finance_price.'</span>', get_option('cplc_text_below_price_el')) ;
			$price .= '<p class="cplc_financing_message">'.$cplc_message.'</p>';
		}
			

		return $price;


	}

	public function cplc_get_lowest_price_raw($post){

		$product = wc_get_product($post->ID);
		$product_type = $product->get_type();

		if('variable' == $product_type){
			$min_price = $product->get_variation_price('min');
			return $min_price;
			 

		}elseif('simple' == $product_type){

			$product_regular_price  = $product->get_regular_price();
			$product_sale_price = $product->get_sale_price();

			//check if the product is on sale
			if(!empty($product_sale_price)){
				$finance_price = $product_sale_price;
			}else{
				$finance_price = $product_regular_price;
			}
		}

		return $finance_price;
	}

	public function cplc_get_lowest_price($post){

		$product = wc_get_product($post->ID);
		$product_type = $product->get_type();

		if('variable' == $product_type){
			$min_price = $product->get_variation_price('min');
			$finance_price = number_format( $this->test($min_price), 2, '.', ',' );
			 

		}elseif('simple' == $product_type){

			$product_regular_price  = $product->get_regular_price();
			$product_sale_price = $product->get_sale_price();

			//check if the product is on sale
			if(!empty($product_sale_price)){
				$finance_price = number_format( $this->test($product_sale_price), 2, '.', ',' ) ;
			}else{
				$finance_price = number_format( $this->test($product_regular_price), 2, '.', ',' ) ;
			}
		}

		return $finance_price;
	}

	public function cplc_pb_finance_now_launch()
	{
		global $post;
	
		$finance_price = $this->cplc_get_lowest_price($post);

		$raw_price = $this->cplc_get_lowest_price_raw($post);

		$cpl_message = str_replace("_CPLC_PRICE", '$'.$finance_price, get_option('cplc_financing_button_message_el')) ;

		?>
			<button id='cplc-launch-prequalify-modal'><?php echo $cpl_message; ?> </button>

			<style>
				div#paybright-widget-container p{
					display: none;
				}
			</style>
		<?php

	 
		$pb_product_format = number_format((float)$raw_price, 2, '.', '');


	echo "<script id='paybright' type='text/javascript' src='https://app.healthsmartfinancial.com/api/pb_woocommerce.js?public_key=".$cplc_paybright_public."&financedamount=$$pb_product_format'></script>
 	<div id='paybright-widget-container'></div>";
	}


	public function test($product_price){
	 
			$_multiplier = !empty(get_option('cplc_chmg_additional_fee_el')) ? get_option('cplc_chmg_additional_fee_el') : 1.10;
			$_addition_type = get_option('cplc_calculation_method_el');

			if('fixed' == $_addition_type){
				$LoanAmt = (float) $product_price + $_multiplier;
			}elseif('percentage' == $_addition_type){
				$LoanAmt = (float) $product_price * $_multiplier;
			}else{
				$LoanAmt = (float) $product_price + $_multiplier;
			}
			
			
			//Get this as a options from the database: set by the user in the admin page
			$LoanTerm = (float) !empty(get_option('cplc_advanced_loan_term_el')) ? get_option('cplc_advanced_loan_term_el') : 18;
			
			//Get this a defaukt value set by the user in the admin page
			$LoanRate = (float) !empty(get_option('cplc_default_interest_rate_el')) ? get_option('cplc_default_interest_rate_el') : 0;

			if ($LoanRate == 0) {

				$result = ($LoanAmt / $LoanTerm);
				$Finalresult = round($result,2);
				return $Finalresult;
			} else {
				$newinterestrate = $LoanRate / 12;
				$result = (($LoanAmt * ($newinterestrate / 100) * pow((1 + ($newinterestrate / 100)), $LoanTerm)) / ((pow((1 + ($newinterestrate / 100)), $LoanTerm)) - 1));
				$Finalresult = round($result);
				return $Finalresult;

			}
             
     
	}

}
