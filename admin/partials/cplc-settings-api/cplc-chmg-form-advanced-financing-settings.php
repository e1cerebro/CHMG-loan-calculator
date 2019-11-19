<?php

class CPLCAdvancedFinancingSettings{

    private $plugin_name;

    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
      }

     public function register_section(){
        add_settings_section(
			'cplc_advanced_financing_section',
			__( 'Advanced Financing Settings', CPLC_CHMG_TEXT_DOMAIN ),
			'',
			$this->plugin_name."-cplc_advanced_financing"
		);
     }

     public function register_fields(){

		/* Interest Rate field */
		add_settings_field(
			'cplc_enable_advanced_options_el',
			__( 'Enable Advanced Options', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_enable_advanced_options_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_enable_advanced_options_el');
		
		/* Interest Rate field */
		add_settings_field(
			'cplc_advanced_loan_term_el',
			__( 'Loan Term', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_advanced_loan_term_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_advanced_loan_term_el');
		
		/* Interest Rate field */
		add_settings_field(
			'cplc_default_interest_rate_el',
			__( 'Default Interest Rate', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_default_interest_rate_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_default_interest_rate_el');
		
		/* Message below price (ENGLISH) */
		add_settings_field(
			'cplc_text_below_price_en_el',
			__( 'Message Below Main Price (EN)', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_text_below_price_en_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_text_below_price_en_el');

		/*  Message below price (FRENCH) */
		add_settings_field(
			'cplc_text_below_price_fr_el',
			__( 'Message Below Main Price (FR)', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_text_below_price_fr_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_text_below_price_fr_el');
		
		/* Interest Rate field */
		add_settings_field(
			'cplc_financing_button_message_en_el',
			__( 'Finance Button Text (EN)', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_financing_button_message_en_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_financing_button_message_en_el');
		
		/* Interest Rate field */
		add_settings_field(
			'cplc_financing_button_message_fr_el',
			__( 'Finance Button Text (FR)', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_financing_button_message_fr_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_financing_button_message_fr_el');
		

		add_settings_field(
			'cplc_financing_button_bg_color_el',
			__( 'Button Background Color', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_financing_button_bg_color_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_financing_button_bg_color_el');
		

		/* Interest Rate field */
		add_settings_field(
			'cplc_financing_button_position_el',
			__( 'Finance Button Position', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_financing_button_position_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_financing_button_position_el');
		
		
		/* Interest Rate field */
		add_settings_field(
			'cplc_advanced_activate_for_single_only_el',
			__( 'Show Only For Single Product Page', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_advanced_activate_for_single_only_cb'],
			$this->plugin_name."-cplc_advanced_financing",
			'cplc_advanced_financing_section'
		);
		register_setting( $this->plugin_name."-cplc_advanced_financing", 'cplc_advanced_activate_for_single_only_el');

	 }
	 
	 	/* ---------- START CARD BLOCK HTML FIELDS --------------- */
		 public function cplc_enable_advanced_options_cb(){
			$cplc_enable_advanced_options_el =  get_option('cplc_enable_advanced_options_el');
			?>
			   <label for="cplc_enable_advanced_options_el"><input <?php echo '1' == $cplc_enable_advanced_options_el ? 'checked' : ''; ?> name="cplc_enable_advanced_options_el" type="checkbox" id="cplc_enable_advanced_options_el" value="1" > Check this box to activate advanced functionality</label>
			<?php
		}

		public function cplc_advanced_loan_term_cb(){
			$cplc_advanced_loan_term_el =  get_option('cplc_advanced_loan_term_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_advanced_loan_term_el"   placeholder="Default is 18" value="<?php echo $cplc_advanced_loan_term_el; ?>">
			</div>
		
			<?php
		}

		 public function cplc_default_interest_rate_cb(){
			$cplc_default_interest_rate_el =  get_option('cplc_default_interest_rate_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_default_interest_rate_el"   placeholder="Default is 0" value="<?php echo $cplc_default_interest_rate_el; ?>">
			</div>
		
			<?php
        }
        
		 public function cplc_text_below_price_en_cb(){
			$cplc_text_below_price_en_el =  get_option('cplc_text_below_price_en_el');
			?>
	            <textarea rows="5" cols="50" name="cplc_text_below_price_en_el"><?php echo $cplc_text_below_price_en_el; ?></textarea>
                <p class="description">Shortcodes: <br/>_CPLC_PRICE can be used for price <br/>_PER_MONTH for per month(/month)</p>
			<?php
		}
        
        
		 public function cplc_text_below_price_fr_cb(){
			$cplc_text_below_price_fr_el =  get_option('cplc_text_below_price_fr_el');
			?>
	            <textarea rows="5" cols="50" name="cplc_text_below_price_fr_el"><?php echo $cplc_text_below_price_fr_el; ?></textarea>
                <p class="description">Shortcodes: <br/>_CPLC_PRICE can be used for price <br/>_PER_MONTH for per month(/month)</p>
			<?php
		}
        
		 public function cplc_financing_button_message_en_cb(){
			$cplc_financing_button_message_en_el =  get_option('cplc_financing_button_message_en_el');
			?>
 	            <textarea rows="5" cols="50" name="cplc_financing_button_message_en_el"><?php echo $cplc_financing_button_message_en_el; ?></textarea>
                <p class="description">Shortcodes: <br/>_CPLC_PRICE can be used for price <br/>_PER_MONTH for per month(/month)</p>
			<?php
		}
        
        
		 public function cplc_financing_button_message_fr_cb(){
			$cplc_financing_button_message_fr_el =  get_option('cplc_financing_button_message_fr_el');
			?>
 	            <textarea rows="5" cols="50" name="cplc_financing_button_message_fr_el"><?php echo $cplc_financing_button_message_fr_el; ?></textarea>
                <p class="description">Shortcodes: <br/>_CPLC_PRICE can be used for price <br/>_PER_MONTH for per month(/mois)</p>
			<?php
		}
        
		 public function cplc_financing_button_position_cb(){
            $cplc_financing_button_position_el =  get_option('cplc_financing_button_position_el');
 			?>
                 <select name="cplc_financing_button_position_el">
                    <option <?php echo ('above' == $cplc_financing_button_position_el) ? 'selected' : ''; ?> value="above">Above add to cart button </option>
                    <option <?php echo ('below' == $cplc_financing_button_position_el) ? 'selected' : ''; ?> value="below" >Below add to cart button</option> 
                </select>
			<?php
		}
        
		 public function cplc_financing_button_bg_color_cb(){
            $cplc_financing_button_bg_color_el =  get_option('cplc_financing_button_bg_color_el');
 			?>
                 <input type="text" name="cplc_financing_button_bg_color_el" class="color-field" id="" value="<?php echo $cplc_financing_button_bg_color_el; ?>">
		 			<p class="description"><?php _e('Background Color For The Finance Now Button.', CPLC_CHMG_TEXT_DOMAIN) ?></p> 
			<?php
		}
        
		 public function cplc_advanced_activate_for_single_only_cb(){
			$cplc_advanced_activate_for_single_only_el =  get_option('cplc_advanced_activate_for_single_only_el');
			?>
                 
                <label for="cplc_card_block_close_icon_el"><input <?php echo '1' == $cplc_advanced_activate_for_single_only_el ? 'checked' : ''; ?> name="cplc_advanced_activate_for_single_only_el" type="checkbox" id="cplc_card_block_close_icon_el" value="1" > Enable this functionality for single product page only</label>
 			<?php
		}


	/* ---------- END CARD BLOCK HTML FIELDS --------------- */

}