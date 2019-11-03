<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/includes
 * @author     Canadian Home Medical Group <it@chmg.ca>
 */
class Cplc_Chmg_Paybright_Loan_Calculator_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	
		update_option('cplc_chmg_loan_amount_input_el', 'input', true);
		update_option('cplc_chmg_additional_fee_el', '250', true);
		update_option('cplc_calculation_method_el', 'fixed', true);
		update_option('cplc_minimum_approved_amount_el', '300', true);
 		update_option('cplc_available_interest_rates_el', '0, 7.95', true);
		update_option('cplc_header_title_el', 'Pay later with PayBright', true);
		update_option('cplc_header_sub_title_el', 'Checking your eligibility won’t affect your credit.', true);
		update_option('cplc_form_heading_el', 'How much is your purchase?', true);
		update_option('cplc_form_sub_heading_el', 'We’ll estimate your monthly payments.', true);
		update_option('cplc_form_button_text_el', 'see if you qualify', true);
		update_option('cplc_form_qualify_button_sub_text_el', 'Get a real-time decision with just 5 pieces of info.', true);
		update_option('cplc_footer_message_el', 'Rates are between 0–30% APR, and down payment may be required. Subject to eligibility check and approval. Payment options depend on your purchase amount. The estimated payment amount excludes taxes and shipping fees. Actual terms may vary. Affirm loans are made by Cross River Bank, Member FDIC. Visit affirm.com/help for more info.', true);
		update_option('cplc_card_block_close_icon_el', '1', true);
	}

}
