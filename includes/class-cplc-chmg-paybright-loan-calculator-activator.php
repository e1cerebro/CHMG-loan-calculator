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

		/* Loan Calculator Tab settings*/
		if(empty(get_option('cplc_chmg_loan_amount_input_el')))
			update_option('cplc_chmg_loan_amount_input_el', 'input', true);

		if(empty(get_option('cplc_chmg_additional_fee_el')))
			update_option('cplc_chmg_additional_fee_el', '250', true);
		
		if(empty(get_option('cplc_calculation_method_el')))
			update_option('cplc_calculation_method_el', 'fixed', true);
		
		if(empty(get_option('cplc_minimum_approved_amount_el')))
			update_option('cplc_minimum_approved_amount_el', '300', true);
		
		if(empty(get_option('cplc_available_interest_rates_el')))
			update_option('cplc_available_interest_rates_el', '0, 7.95', true);

		if(empty(get_option('cplc_available_interest_rates_el')))
			update_option('cplc_available_interest_rates_el', '0, 7.95', true);

		/* Form Heading Settings Tab */
		if(empty(get_option('cplc_header_title_el')))
			update_option('cplc_header_title_el', 'Pay later with PayBright', true);

		if(empty(get_option('cplc_header_sub_title_el')))
		update_option('cplc_header_sub_title_el', 'Get a real-time decision with just few pieces of info.', true);


		/* Form Main Settings Tab */
		if(empty(get_option('cplc_form_heading_el')))
			update_option('cplc_form_heading_el', 'How much is your purchase?', true);

		if(empty(get_option('cplc_form_sub_heading_el')))
			update_option('cplc_form_sub_heading_el', 'We’ll estimate your monthly payments.', true);

		if(empty(get_option('cplc_form_button_text_el')))
			update_option('cplc_form_button_text_el', 'Pre-qualify Now!', true);

		if(empty(get_option('cplc_form_qualify_button_sub_text_el')))
			update_option('cplc_form_qualify_button_sub_text_el', 'Get a real-time decision with just 5 pieces of info.', true);


		/* Card Block Main Settings Tab */
		if(empty(get_option('cplc_card_block_interest_rate_el')))
			update_option('cplc_card_block_interest_rate_el', 'Interest Rate', true);
 
		if(empty(get_option('cplc_card_block_interest_amount_el')))
			update_option('cplc_card_block_interest_amount_el', 'Interest Amount', true);
 
		if(empty(get_option('cplc_card_block_total_amount_el')))
			update_option('cplc_card_block_total_amount_el', 'Total Payment', true);
		
		if(empty(get_option('cplc_card_block_close_icon_el')))
			update_option('cplc_card_block_close_icon_el', '1', true);
 
		/* Card Block Main Settings Tab */
		if(empty(get_option('cplc_footer_message_el')))
 			update_option('cplc_footer_message_el', 'Your loan terms available may depend on your personal credit profile. Some conditions apply and all transactions are subject to approval by PayBright. Loan offers may vary for customers in the province of Quebec. See paybright.com/faq for more information.', true);
		
		/* Financing Advanced Features Tab */
		if(empty(get_option('cplc_enable_advanced_options_el')))
			update_option('cplc_enable_advanced_options_el', 1 , true);

		if(empty(get_option('cplc_advanced_loan_term_el')))
			update_option('cplc_advanced_loan_term_el', 18 , true);

		if(empty(get_option('cplc_default_interest_rate_el')))
			update_option('cplc_default_interest_rate_el', 7.95 , true);
		
		if(empty(get_option('cplc_text_below_price_el')))	
			update_option('cplc_text_below_price_el', 'Pay as low as _CPLC_PRICE_PER_MONTH' , true);
		
		if(empty(get_option('cplc_financing_button_message_el')))	
			update_option('cplc_financing_button_message_el', 'Finance now _CPLC_PRICE_PER_MONTH ' , true);
		
		if(empty(get_option('cplc_financing_button_bg_color_el')))	
			update_option('cplc_financing_button_bg_color_el', 'rgb(30, 115, 190)' , true);
		
		if(empty(get_option('cplc_financing_button_position_el')))	
			update_option('cplc_financing_button_position_el', 'below' , true);
		
		if(empty(get_option('cplc_advanced_activate_for_single_only_el')))	
			update_option('cplc_advanced_activate_for_single_only_el', '1' , true);


	}

}
