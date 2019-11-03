<?php

class CPLCCardBlockSettings{

    private $plugin_name;

    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
      }

     public function register_section(){
        add_settings_section(
			'cplc_general_card_block_section',
			__( 'Card Block Settings', CPLC_CHMG_TEXT_DOMAIN ),
			'',
			$this->plugin_name."-card_block"
		);
     }

     public function register_fields(){
		

		/* Interest Rate field */
		add_settings_field(
			'cplc_card_block_interest_rate_el',
			__( 'Interest Rate Title', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_card_block_interest_rate_cb'],
			$this->plugin_name."-card_block",
			'cplc_general_card_block_section'
		);
		register_setting( $this->plugin_name."-card_block", 'cplc_card_block_interest_rate_el');
		
		
		
		/* Interest Rate field */
		add_settings_field(
			'cplc_card_block_interest_amount_el',
			__( 'Interest Amount', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_card_block_interest_amount_cb'],
			$this->plugin_name."-card_block",
			'cplc_general_card_block_section'
		);
		register_setting( $this->plugin_name."-card_block", 'cplc_card_block_interest_amount_el');
		
		/* Interest Rate field */
		add_settings_field(
			'cplc_card_block_total_amount_el',
			__( 'Total Payment Amount', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_card_block_total_amount_cb'],
			$this->plugin_name."-card_block",
			'cplc_general_card_block_section'
		);
		register_setting( $this->plugin_name."-card_block", 'cplc_card_block_total_amount_el');
		
	 }
	 
	 	/* ---------- START CARD BLOCK HTML FIELDS --------------- */
		 public function cplc_card_block_interest_rate_cb(){
			$cplc_card_block_interest_rate_el =  get_option('cplc_card_block_interest_rate_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_card_block_interest_rate_el"   placeholder="Enter title for interest rate" value="<?php echo $cplc_card_block_interest_rate_el; ?>">
			</div>
		
			<?php
		}


		public function cplc_card_block_interest_amount_cb(){
			$cplc_card_block_interest_amount_el =  get_option('cplc_card_block_interest_amount_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_card_block_interest_amount_el"   placeholder="Enter title for interest amount" value="<?php echo $cplc_card_block_interest_amount_el; ?>">
			</div>
		
			<?php
		}

		public function cplc_card_block_total_amount_cb(){
			$cplc_card_block_total_amount_el =  get_option('cplc_card_block_total_amount_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_card_block_total_amount_el"   placeholder="Enter title for total payment" value="<?php echo $cplc_card_block_total_amount_el; ?>">
			</div>
		
			<?php
		}


	/* ---------- END CARD BLOCK HTML FIELDS --------------- */

}