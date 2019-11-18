<?php

class CplcLoanSettings{

    private $plugin_name;

    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
      }

     public function register_section(){
        add_settings_section(
			'cplc_general_section',
			__( 'Loan Settings', CPLC_CHMG_TEXT_DOMAIN ),
			'',
			$this->plugin_name."-loan_options"
		);
     }

     public function register_fields(){
         /* CHMG additional Fee*/
			add_settings_field(
				'cplc_chmg_loan_amount_input_el',
				__( 'Loan Amount Field Type', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_chmg_loan_amount_input_cb'],
				$this->plugin_name."-loan_options",
				'cplc_general_section'
			 );
			register_setting( $this->plugin_name."-loan_options", 'cplc_chmg_loan_amount_input_el');
	

			/* CHMG additional Fee*/
			add_settings_field(
				'cplc_chmg_additional_fee_el',
				__( 'CHMG additional Fee', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_chmg_additional_fee_cb'],
				$this->plugin_name."-loan_options",
				'cplc_general_section'
			 );
			register_setting( $this->plugin_name."-loan_options", 'cplc_chmg_additional_fee_el');
	
			/* Calculation method */
			add_settings_field(
				'cplc_calculation_method_el',
				__( 'Calculation Method', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_calculation_method_cb'],
				$this->plugin_name."-loan_options",
				'cplc_general_section'
			 );
			register_setting( $this->plugin_name."-loan_options", 'cplc_calculation_method_el');
	
			/* Minimum valid amount method */
			add_settings_field(
				'cplc_minimum_approved_amount_el',
				__( 'Minimum  Amount ($)', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_minimum_approved_amount_cb'],
				$this->plugin_name."-loan_options",
				'cplc_general_section'
			);
			register_setting( $this->plugin_name."-loan_options", 'cplc_minimum_approved_amount_el');


		/* Available loan terms (months) */
		add_settings_field(
			'cplc_available_loan_term_el',
			__( 'Available Loan Term', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_available_loan_term_cb'],
			$this->plugin_name."-loan_options",
			'cplc_general_section'
 		);
		register_setting( $this->plugin_name."-loan_options", 'cplc_available_loan_term_el');

		/* Available Interest rates */
		add_settings_field(
			'cplc_available_interest_rates_el',
			__( 'Available Interest Rates', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_available_interest_rates_cb'],
			$this->plugin_name."-loan_options",
			'cplc_general_section'
 		);
		register_setting( $this->plugin_name."-loan_options", 'cplc_available_interest_rates_el');

		/* Available Interest rates */
		add_settings_field(
			'cplc_paybright_public_key_el',
			__( 'PayBright Public Key', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_paybright_public_key_cb'],
			$this->plugin_name."-loan_options",
			'cplc_general_section'
 		);
		register_setting( $this->plugin_name."-loan_options", 'cplc_paybright_public_key_el');

     }


     
	public function cplc_chmg_additional_fee_cb(){
		$cplc_chmg_additional_fee_el =  get_option('cplc_chmg_additional_fee_el');
 	
		?>

			 <div class="ui input">
			 <input type="text" name="cplc_chmg_additional_fee_el" placeholder="Additional Fee" value="<?php echo $cplc_chmg_additional_fee_el; ?>">
			</div>
			<p class="description"><?php _e(' Enter an additional fee to add to the regular price of the product', CPLC_CHMG_TEXT_DOMAIN) ?></p>

		<?php
		
	}

	public function cplc_minimum_approved_amount_cb(){
		$cplc_minimum_approved_amount_el =  get_option('cplc_minimum_approved_amount_el');
		?>

			 <div class="ui input">
			 <input type="text" name="cplc_minimum_approved_amount_el" placeholder="Amount" value="<?php echo $cplc_minimum_approved_amount_el; ?>">
			</div>
			<p class="description"><?php _e('Enter minimum valid amount for financing', CPLC_CHMG_TEXT_DOMAIN) ?></p>

		<?php
		
	}

	public function cplc_chmg_loan_amount_input_cb(){
		$cplc_chmg_loan_amount_input_el =  get_option('cplc_chmg_loan_amount_input_el');

		?>
			<div class="">
				<div class="">
 					<select  name="cplc_chmg_loan_amount_input_el">
						<option value="input" <?php echo 'input' == $cplc_chmg_loan_amount_input_el ? 'SELECTED' : ''; ?>><?php _e('Normal Input Field', CPLC_CHMG_TEXT_DOMAIN) ?></option>
						<option value="select" <?php echo 'select' == $cplc_chmg_loan_amount_input_el ? 'SELECTED' : ''; ?>><?php _e('Product Dropdown Input', CPLC_CHMG_TEXT_DOMAIN) ?></option> 
					</select>
				</div>
			</div>
			<p class="description"><?php _e('Customers can either use a dropdown or text field to enter the loan amount', CPLC_CHMG_TEXT_DOMAIN) ?></p>


		<?php
		
    }
    
    public function cplc_calculation_method_cb(){
		$cplc_calculation_method_el =  get_option('cplc_calculation_method_el');

		?>
			<div class="ui form">
				<div class="field">
 					<select name="cplc_calculation_method_el">
						<option value="fixed" <?php echo 'fixed' == $cplc_calculation_method_el ? 'SELECTED' : ''; ?>><?php _e('Fixed Amount Rate', CPLC_CHMG_TEXT_DOMAIN) ?></option>
						<option value="percentage" <?php echo 'percentage' == $cplc_calculation_method_el ? 'SELECTED' : ''; ?>><?php _e('Percentage Rate', CPLC_CHMG_TEXT_DOMAIN) ?></option> 
					</select>
				</div>
			</div>

		<?php
		
	}

	public function cplc_available_loan_term_cb(){
		$cplc_available_loan_term_el =  get_option('cplc_available_loan_term_el');

		?>
			 <div class="ui form">
				<select style="width: 100%;"  data-placeholder="Choose loan term..." name="cplc_available_loan_term_el[]" multiple class="chosen-select">
					<option <?php echo @in_array(3, $cplc_available_loan_term_el) ? 'SELECTED' : ''; ?> value="3" >3 Months</option>
					<option <?php echo @in_array(6, $cplc_available_loan_term_el) ? 'SELECTED' : ''; ?> value="6" >6 Months</option>
					<option <?php echo @in_array(12, $cplc_available_loan_term_el) ? 'SELECTED' : ''; ?> value="12" >12 Months</option>
					<option <?php echo @in_array(18, $cplc_available_loan_term_el) ? 'SELECTED' : ''; ?> value="18" >18 Months</option>
					<option <?php echo @in_array(24, $cplc_available_loan_term_el) ? 'SELECTED' : ''; ?> value="24" >24 Months</option>
 				</select>
			 </div>	
 
		<?php
		
	}

	public function cplc_available_interest_rates_cb(){
		$cplc_available_interest_rates_el =  get_option('cplc_available_interest_rates_el');

		?>
			 <div class="ui form">
				<div class="field">
					<textarea rows="3" cols="80"   name="cplc_available_interest_rates_el"><?php echo $cplc_available_interest_rates_el; ?></textarea>
				</div>
			 </div>	
			 <p class="description"><?php _e('Enter a comma separated list of available interest rates', CPLC_CHMG_TEXT_DOMAIN) ?></p>
			 
		<?php
		
	}

	public function cplc_paybright_public_key_cb(){
		$cplc_paybright_public_key_el =  get_option('cplc_paybright_public_key_el');
		?>

			 <div class="ui input">
			 <input type="text" style="width: 40%;"  name="cplc_paybright_public_key_el" placeholder="Enter API key" value="<?php echo $cplc_paybright_public_key_el; ?>">
			</div>
			<p class="description"><?php _e('Enter the paybright public API key', CPLC_CHMG_TEXT_DOMAIN) ?></p>

		<?php
		
	}


}