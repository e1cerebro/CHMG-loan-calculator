<?php

class CPLCFormFooterSettings{

    private $plugin_name;

    public function __construct( $plugin_name ) {
 		$this->plugin_name = $plugin_name;
      }

     public function register_section(){
        add_settings_section(
			'cplc_general_footer_section',
			__( 'Footer Settings', CPLC_CHMG_TEXT_DOMAIN ),
			[$this, 'cplc_general_settings_section_cb' ],
			$this->plugin_name
		);
     }

     public function register_fields(){
		 
		add_settings_field(
			'cplc_footer_message_el',
			__( 'Footer Message', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_footer_message_cb'],
			$this->plugin_name,
			'cplc_general_footer_section'
 		);
		register_setting( $this->plugin_name, 'cplc_footer_message_el');
	 }

	 public function cplc_footer_message_cb(){
		$cplc_footer_message_el =  get_option('cplc_footer_message_el');
		?>
		<div class="ui form">
			<div class="field">
				<textarea rows="5" columns="30"   name="cplc_footer_message_el"><?php echo $cplc_footer_message_el; ?></textarea>
			</div>
		</div>
	
		<?php
		
	}
	  

}