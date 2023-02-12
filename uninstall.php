<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 */

	// If uninstall not called from WordPress, then exit.
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
		exit;
	}
	
	/* Loan Calculator Tab settings*/
	if(!empty(get_option('cplc_chmg_loan_amount_input_el')))
		delete_option('cplc_chmg_loan_amount_input_el');

	if(!empty(get_option('cplc_chmg_additional_fee_el')))
		delete_option('cplc_chmg_additional_fee_el');
	
	if(!empty(get_option('cplc_calculation_method_el')))
		delete_option('cplc_calculation_method_el');
	
	if(!empty(get_option('cplc_minimum_approved_amount_el')))
		delete_option('cplc_minimum_approved_amount_el');
	
	if(!empty(get_option('cplc_available_interest_rates_el')))
		delete_option('cplc_available_interest_rates_el');

	if(!empty(get_option('cplc_available_interest_rates_el')))
		delete_option('cplc_available_interest_rates_el');

	/* Form Heading Settings Tab */
	if(!empty(get_option('cplc_header_title_el')))
		delete_option('cplc_header_title_el');

	if(!empty(get_option('cplc_header_sub_title_el')))
		delete_option('cplc_header_sub_title_el');


	/* Form Main Settings Tab */
	if(!empty(get_option('cplc_form_heading_el')))
		delete_option('cplc_form_heading_el');

	if(!empty(get_option('cplc_form_sub_heading_el')))
		delete_option('cplc_form_sub_heading_el');

	if(!empty(get_option('cplc_form_button_text_el')))
		delete_option('cplc_form_button_text_el');

	if(!empty(get_option('cplc_form_qualify_button_sub_text_el')))
		delete_option('cplc_form_qualify_button_sub_text_el');


	/* Card Block Main Settings Tab */
	if(!empty(get_option('cplc_card_block_interest_rate_el')))
		delete_option('cplc_card_block_interest_rate_el');

	if(!empty(get_option('cplc_card_block_interest_amount_el')))
		delete_option('cplc_card_block_interest_amount_el');

	if(!empty(get_option('cplc_card_block_total_amount_el')))
		delete_option('cplc_card_block_total_amount_el');
	
	if(!empty(get_option('cplc_card_block_close_icon_el'))) {}
		delete_option('cplc_card_block_close_icon_el');

	/* Card Block Main Settings Tab */
	if(!empty(get_option('cplc_footer_message_el')))
		delete_option('cplc_footer_message_el');
	
	/* Financing Advanced Features Tab */
	if(!empty(get_option('cplc_enable_advanced_options_el')))
		delete_option('cplc_enable_advanced_options_el');

	if(!empty(get_option('cplc_advanced_loan_term_el')))
		delete_option('cplc_advanced_loan_term_el');

	if(!empty(get_option('cplc_default_interest_rate_el')))
		delete_option('cplc_default_interest_rate_el');
	
	if(!empty(get_option('cplc_text_below_price_el')))	
		delete_option('cplc_text_below_price_el');
	
	if(!empty(get_option('cplc_financing_button_message_el')))	
		delete_option('cplc_financing_button_message_el');
	
	if(!empty(get_option('cplc_financing_button_bg_color_el')))	
		delete_option('cplc_financing_button_bg_color_el');
	
	if(!empty(get_option('cplc_financing_button_position_el')))	
		delete_option('cplc_financing_button_position_el');
	
	if(!empty(get_option('cplc_advanced_activate_for_single_only_el')))	
		delete_option('cplc_advanced_activate_for_single_only_el');
