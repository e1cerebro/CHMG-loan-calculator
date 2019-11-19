<?php

class CPLCFormHeaderSettings{

    private $plugin_name;

    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
      }

     public function register_section(){
        add_settings_section(
			'cplc_general_heading_section',
			__( 'Heading Settings', CPLC_CHMG_TEXT_DOMAIN ),
			'',
			$this->plugin_name."-form_heading"
		);
     }

     public function register_fields(){
         /* Heading Main Title */
		add_settings_field(
			'cplc_header_title_el',
			__( 'Header Title', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_header_title_cb'],
			$this->plugin_name."-form_heading",
			'cplc_general_heading_section'
		 );
		register_setting( $this->plugin_name."-form_heading", 'cplc_header_title_el');

		add_settings_field(
			'cplc_header_sub_title_el',
			__( 'Header Sub Title', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_header_sub_title_cb'],
			$this->plugin_name."-form_heading",
			'cplc_general_heading_section'
 		);
		register_setting( $this->plugin_name."-form_heading", 'cplc_header_sub_title_el');

		/* insurance company logo */
		add_settings_field(
			'cplc_financing_company_logo_el',
			__( 'Financing Company Logo ', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_financing_company_logo_cb'],
			$this->plugin_name."-form_heading",
			'cplc_general_heading_section'
 		);
		register_setting( $this->plugin_name."-form_heading", 'cplc_financing_company_logo_el');
		

     }

	 public function cplc_financing_company_logo_cb(){
		//id and name of form element should be same as the setting name.
		$cplc_financing_company_logo_el =  get_option('cplc_financing_company_logo_el'); 
	?>
	   <input id="background_image" type="hidden" name="<?php echo 'cplc_financing_company_logo_el'; ?>" value="<?php echo get_option('cplc_financing_company_logo_el'); ?>" />
	   <input id="upload_image_button" type="button" class="button-primary" value="Upload Logo" />
	   <input id="remove_image_button" type="button" class="button-secondary" value="Remove Logo" />
	   <p><img width="140" src="<?php  echo $cplc_financing_company_logo_el; ?>"   alt="loading-animation" id="cplc-loading-animation"></p>
	   <p class="description"><?php _e('Choose the loading animation image here.', 'wpr') ?></p>

   <?php
   }

   

   public function cplc_header_title_cb(){
	$cplc_header_title_el =  get_option('cplc_header_title_el');
	?>
	<div class="ui input">
		<input type="text" style="width: 35%;" name="cplc_header_title_el"   placeholder="Enter the header title" value="<?php echo $cplc_header_title_el; ?>">
	</div>
 
	<?php
		
	}

   public function cplc_header_sub_title_cb(){
	$cplc_header_sub_title_el =  get_option('cplc_header_sub_title_el');
	?>
	 

	<div class="ui form">
		<div class="field">
			<textarea rows="6" cols="80"   name="cplc_header_sub_title_el"><?php echo $cplc_header_sub_title_el; ?></textarea>
		</div>
	</div>
 
	<?php
	
	}
}