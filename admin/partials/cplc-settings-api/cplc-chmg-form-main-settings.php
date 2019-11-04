<?php

class CPLCFormMainSettings{

    private $plugin_name;

    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
      }

     public function register_section(){
		add_settings_section(
			'cplc_general_form_section',
			__( 'Form Settings', CPLC_CHMG_TEXT_DOMAIN ),
			'',
			$this->plugin_name."-form_main"
		);
     }

     public function register_fields(){
         		/* insurance company logo */
		add_settings_field(
			'cplc_form_heading_el',
			__( 'Header Title', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_heading_cb'],
			$this->plugin_name."-form_main",
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name."-form_main", 'cplc_form_heading_el');
		
		/* Sub heading title */
		add_settings_field(
			'cplc_form_sub_heading_el',
			__( 'Sub Heading', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_sub_heading_cb'],
			$this->plugin_name."-form_main",
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name."-form_main", 'cplc_form_sub_heading_el');
		
		
		/* Placeholder text */
		add_settings_field(
			'cplc_form_placeholder_text_el',
			__( 'Placeholder Text', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_placeholder_text_cb'],
			$this->plugin_name."-form_main",
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name."-form_main", 'cplc_form_placeholder_text_el');
		
		
		/* Qualify Button text */
		add_settings_field(
			'cplc_form_button_text_el',
			__( 'Qualify Button Text', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_button_text_cb'],
			$this->plugin_name."-form_main",
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name."-form_main", 'cplc_form_button_text_el');
		
		
		/* Qualify Button text */
		add_settings_field(
			'cplc_form_qualify_button_sub_text_el',
			__( 'Qualify Button Sub Text', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_qualify_button_sub_text_cb'],
			$this->plugin_name."-form_main",
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name."-form_main", 'cplc_form_qualify_button_sub_text_el');
     }

	 public function cplc_form_heading_cb(){
		$cplc_form_heading_el =  get_option('cplc_form_heading_el');
		?>
		<div class="ui input">
			<input type="text" name="cplc_form_heading_el"   placeholder="Enter the Form Header title" value="<?php echo $cplc_form_heading_el; ?>">
		</div>
	
		<?php
			
	}

	

	public function cplc_form_sub_heading_cb(){
		$cplc_form_sub_heading_el =  get_option('cplc_form_sub_heading_el');
		?>
	 
		<div class="ui form">
		<div class="field">
				<textarea rows="3" columns="25"   name="cplc_form_sub_heading_el"><?php echo $cplc_form_sub_heading_el; ?></textarea>
			</div>
		</div>
		<?php
			
		}



		public function cplc_form_placeholder_text_cb(){
			$cplc_form_placeholder_text_el =  get_option('cplc_form_placeholder_text_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_form_placeholder_text_el"   placeholder="Enter Placeholder text" value="<?php echo $cplc_form_placeholder_text_el; ?>">
			</div>
		
			<?php
				
		}


		public function cplc_form_button_text_cb(){
			$cplc_form_button_text_el =  get_option('cplc_form_button_text_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_form_button_text_el"   placeholder="Enter Button text" value="<?php echo $cplc_form_button_text_el; ?>">
			</div>
		
			<?php
				
		}

		public function cplc_form_qualify_button_sub_text_cb(){
			$cplc_form_qualify_button_sub_text_el =  get_option('cplc_form_qualify_button_sub_text_el');
			?>
		 
			<div class="ui form">
			<div class="field">
					<textarea rows="3" columns="25"   name="cplc_form_qualify_button_sub_text_el"><?php echo $cplc_form_qualify_button_sub_text_el; ?></textarea>
				</div>
			</div>
			<?php
				
			}
}