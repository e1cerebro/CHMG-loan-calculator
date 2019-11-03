<?php
require plugin_dir_path( __FILE__ ).'../includes/cplc-custom-utils/cplc-db-utils.php';
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cplc_Chmg_Paybright_Loan_Calculator
 * @subpackage Cplc_Chmg_Paybright_Loan_Calculator/admin
 * @author     Canadian Home Medical Group <it@chmg.ca>
 */
class Cplc_Chmg_Paybright_Loan_Calculator_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook_suffix) {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cplc-chmg-paybright-loan-calculator-admin.css', array(), $this->version, 'all' );
		
		if($hook_suffix == 'toplevel_page_cplc-chmg-paybright-loan-calculator') {
			wp_enqueue_style( $this->plugin_name."-semantic-ui-css", plugin_dir_url( __FILE__ ) . 'css/cplc-chmg-paybright-semantic-ui.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name."-chosen-css", "https://harvesthq.github.io/chosen/chosen.css", array(), '', 'all' );

		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook_suffix) {

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

		  //wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-loan-calculator-admin.js', array( 'jquery' ), $this->version, false );
		  wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-loan-calculator-admin.js', array( 'jquery' ), time(), false );
 
		  if($hook_suffix == 'toplevel_page_cplc-chmg-paybright-loan-calculator') {
			 wp_enqueue_script( $this->plugin_name."-semantic-ui-js", plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-paybright-semantic-ui.js', array("jquery" ), '', true );
			 wp_enqueue_script( $this->plugin_name."-chosen","//harvesthq.github.io/chosen/chosen.jquery.js", '', true );

			 wp_enqueue_media();
			 wp_register_script( $this->plugin_name.'-img-uploader', plugin_dir_url( __FILE__ ) . 'js/cplc-chmg-uploader.js', array('jquery'), time());
		  	 wp_enqueue_script($this->plugin_name.'-img-uploader');
 		  }  

		  


	 

	}


	public function cplc_admin_menu(){

		add_menu_page( 
						$page_title 	= __("Loan Calculator", CPLC_CHMG_TEXT_DOMAIN), 
						$menu_title 	= __("Loan Calculator", CPLC_CHMG_TEXT_DOMAIN) , 
						$capability		= 'manage_options', 
						$menu_slug		= $this->plugin_name, 
						$function		= [$this, 'cplc_loan_calculator_menu_cb'], 
						$icon_url		= 'dashicons-list-view', 
						$position 		= null );

	}


	public function cplc_loan_calculator_menu_cb(){
		include_once( 'partials/cplc-chmg-paybright-loan-calculator-admin-display.php' );
	}


	public function cplc_settings_options(){
	
		add_settings_section(
			'cplc_general_section',
			__( 'General Settings', CPLC_CHMG_TEXT_DOMAIN ),
			[$this, 'cplc_general_settings_section_cb' ],
			$this->plugin_name
		);

			/* CHMG additional Fee*/
			add_settings_field(
				'cplc_chmg_loan_amount_input_el',
				__( 'Loan Amount Input', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_chmg_loan_amount_input_cb'],
				$this->plugin_name,
				'cplc_general_section'
			 );
			register_setting( $this->plugin_name, 'cplc_chmg_loan_amount_input_el');
	

			/* CHMG additional Fee*/
			add_settings_field(
				'cplc_chmg_additional_fee_el',
				__( 'CHMG additional Fee', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_chmg_additional_fee_cb'],
				$this->plugin_name,
				'cplc_general_section'
			 );
			register_setting( $this->plugin_name, 'cplc_chmg_additional_fee_el');
	
			/* Calculation method */
			add_settings_field(
				'cplc_calculation_method_el',
				__( 'Calculation Method', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_calculation_method_cb'],
				$this->plugin_name,
				'cplc_general_section'
			 );
			register_setting( $this->plugin_name, 'cplc_calculation_method_el');
	
			/* Minimum valid amount method */
			add_settings_field(
				'cplc_minimum_approved_amount_el',
				__( 'Minimum  Amount ($)', CPLC_CHMG_TEXT_DOMAIN),
				[ $this,'cplc_minimum_approved_amount_cb'],
				$this->plugin_name,
				'cplc_general_section'
			);
			register_setting( $this->plugin_name, 'cplc_minimum_approved_amount_el');


		/* Available loan terms (months) */
		add_settings_field(
			'cplc_available_loan_term_el',
			__( 'Available Loan Term', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_available_loan_term_cb'],
			$this->plugin_name,
			'cplc_general_section'
 		);
		register_setting( $this->plugin_name, 'cplc_available_loan_term_el');

		/* Available Interest rates */
		add_settings_field(
			'cplc_available_interest_rates_el',
			__( 'Available Interest Rates', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_available_interest_rates_cb'],
			$this->plugin_name,
			'cplc_general_section'
 		);
		register_setting( $this->plugin_name, 'cplc_available_interest_rates_el');

	/*========= PRODUCT SECTION ========= */
		add_settings_section(
			'cplc_product_settings_section',
			__( 'Product Settings', CPLC_CHMG_TEXT_DOMAIN ),
			[$this, 'cplc_general_settings_section_cb' ],
			$this->plugin_name
		);

		/* insurance company logo */
		add_settings_field(
			'cplc_include_categories_el',
			__( 'Include Categories', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_include_categories_cb'],
			$this->plugin_name,
			'cplc_product_settings_section'
		);
		register_setting( $this->plugin_name, 'cplc_include_categories_el');









	/*========= END PRODUCT SECTION ========= */


	/*========= HEADING SECTION ========= */

		add_settings_section(
			'cplc_general_heading_section',
			__( 'Heading Settings', CPLC_CHMG_TEXT_DOMAIN ),
			[$this, 'cplc_general_settings_section_cb' ],
			$this->plugin_name
		);

		
		/* insurance company logo */
		add_settings_field(
			'cplc_financing_company_logo_el',
			__( 'Financing Company Logo ', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_financing_company_logo_cb'],
			$this->plugin_name,
			'cplc_general_heading_section'
 		);
		register_setting( $this->plugin_name, 'cplc_financing_company_logo_el');
		
		/* Heading Main Title */
		add_settings_field(
			'cplc_header_title_el',
			__( 'Header Title', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_header_title_cb'],
			$this->plugin_name,
			'cplc_general_heading_section'
		 );
		register_setting( $this->plugin_name, 'cplc_header_title_el');

		add_settings_field(
			'cplc_header_sub_title_el',
			__( 'Header Sub Title', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_header_sub_title_cb'],
			$this->plugin_name,
			'cplc_general_heading_section'
 		);
		register_setting( $this->plugin_name, 'cplc_header_sub_title_el');
	
	/*========= END HEADING SECTION ========= */
	
	/*========= FORM SECTION ========= */
		add_settings_section(
			'cplc_general_form_section',
			__( 'Form Settings', CPLC_CHMG_TEXT_DOMAIN ),
			[$this, 'cplc_general_settings_section_cb' ],
			$this->plugin_name
		);

		/* insurance company logo */
		add_settings_field(
			'cplc_form_heading_el',
			__( 'Header Text', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_heading_cb'],
			$this->plugin_name,
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name, 'cplc_form_heading_el');
		
		/* Sub heading title */
		add_settings_field(
			'cplc_form_sub_heading_el',
			__( 'Sub Heading Text', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_sub_heading_cb'],
			$this->plugin_name,
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name, 'cplc_form_sub_heading_el');
		
		
		/* Qualify Button text */
		add_settings_field(
			'cplc_form_button_text_el',
			__( 'Qualify Button Text', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_button_text_cb'],
			$this->plugin_name,
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name, 'cplc_form_button_text_el');
		
		
		/* Qualify Button text */
		add_settings_field(
			'cplc_form_qualify_button_sub_text_el',
			__( 'Qualify Button Sub Text', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_form_qualify_button_sub_text_cb'],
			$this->plugin_name,
			'cplc_general_form_section'
 		);
		register_setting( $this->plugin_name, 'cplc_form_qualify_button_sub_text_el');
		
	/*========= END FORM SECTION ========= */


	/*========= FOOTER SECTION ========= */

		add_settings_section(
			'cplc_general_footer_section',
			__( 'Footer Settings', CPLC_CHMG_TEXT_DOMAIN ),
			[$this, 'cplc_general_settings_section_cb' ],
			$this->plugin_name
		);

		add_settings_field(
			'cplc_footer_message_el',
			__( 'Footer Message', CPLC_CHMG_TEXT_DOMAIN),
			[ $this,'cplc_footer_message_cb'],
			$this->plugin_name,
			'cplc_general_footer_section'
 		);
		register_setting( $this->plugin_name, 'cplc_footer_message_el');

	/*========= END FOOTER SECTION ========= */


	}

	/* Callback function for the settings sections */
	public function cplc_general_settings_section_cb(){

	}

	public function cplc_include_categories_cb(){
		$cplc_include_categories_el =  get_option('cplc_include_categories_el');
		

		?>
			<div class="ui input">
				<select  data-placeholder="Choose categories..." name="cplc_include_categories_el[]" multiple class="chosen-select">
					<option value="All" >All Categories</option>
					<?php foreach(CPLC_DB_Utils::get_all_product_categories() as $cat): ?>
						<option <?php echo in_array($cat->term_id, $cplc_include_categories_el) ? 'SELECTED' : ''; ?>  value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
					<?php endforeach; ?>
				</select>

			</div>
			<p class="description"><?php _e('Choose products categories to display', CPLC_CHMG_TEXT_DOMAIN) ?></p>

		<?php
		
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
			<div class="ui form">
				<div class="field">
 					<select class="ui search dropdown" style="width:28%;" name="cplc_chmg_loan_amount_input_el">
						<option value="input" <?php echo 'input' == $cplc_chmg_loan_amount_input_el ? 'SELECTED' : ''; ?>><?php _e('Normal Input Field', CPLC_CHMG_TEXT_DOMAIN) ?></option>
						<option value="select" <?php echo 'select' == $cplc_chmg_loan_amount_input_el ? 'SELECTED' : ''; ?>><?php _e('Product Dropdown Input', CPLC_CHMG_TEXT_DOMAIN) ?></option> 
					</select>
				</div>
			</div>

		<?php
		
	}


	public function cplc_calculation_method_cb(){
		$cplc_calculation_method_el =  get_option('cplc_calculation_method_el');

		?>
			<div class="ui form">
				<div class="field">
 					<select class="ui search dropdown" style="width:28%;" name="cplc_calculation_method_el">
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
				<div class="field">
					<textarea rows="5" columns="25" style="width:80%;" name="cplc_available_loan_term_el"><?php echo $cplc_available_loan_term_el; ?></textarea>

				</div>
			 </div>	
			 <p class="description"><?php _e('Enter a comma separated list of available months', CPLC_CHMG_TEXT_DOMAIN) ?></p>

		<?php
		
	}

	public function cplc_available_interest_rates_cb(){
		$cplc_available_interest_rates_el =  get_option('cplc_available_interest_rates_el');

		?>
			 <div class="ui form">
				<div class="field">
					<textarea rows="5" columns="25" style="width:80%;" name="cplc_available_interest_rates_el"><?php echo $cplc_available_interest_rates_el; ?></textarea>
				</div>
			 </div>	
			 <p class="description"><?php _e('Enter a comma separated list of available interest rates', CPLC_CHMG_TEXT_DOMAIN) ?></p>

		<?php
		
	}


	public function cplc_financing_company_logo_cb(){
		//id and name of form element should be same as the setting name.
		$cplc_financing_company_logo_el =  get_option('cplc_financing_company_logo_el'); 
	?>
	   <input id="background_image" type="hidden" name="<?php echo 'cplc_financing_company_logo_el'; ?>" value="<?php echo get_option('cplc_financing_company_logo_el'); ?>" />
	   <input id="upload_image_button" type="button" class="button-primary" value="Upload Image" />
	   <p><img width="140" src="<?php  echo $cplc_financing_company_logo_el; ?>"   alt="loading-animation" id="cplc-loading-animation"></p>
	   <p class="description"><?php _e('Choose the loading animation image here.', 'wpr') ?></p>

   <?php
   }

   

   public function cplc_header_title_cb(){
	$cplc_header_title_el =  get_option('cplc_header_title_el');
	?>
	<div class="ui input">
		<input type="text" name="cplc_header_title_el" style="width:80%;" placeholder="Enter the header title" value="<?php echo $cplc_header_title_el; ?>">
	</div>
 
	<?php
		
	}

   public function cplc_header_sub_title_cb(){
	$cplc_header_sub_title_el =  get_option('cplc_header_sub_title_el');
	?>
	 

	<div class="ui form">
		<div class="field">
			<textarea rows="3" columns="25" style="width:80%;" name="cplc_header_sub_title_el"><?php echo $cplc_header_sub_title_el; ?></textarea>
		</div>
	</div>
 
	<?php
	
	}


   public function cplc_footer_message_cb(){
	$cplc_footer_message_el =  get_option('cplc_footer_message_el');
	?>
	<div class="ui form">
		<div class="field">
			<textarea rows="5" columns="25" style="width:80%;" name="cplc_footer_message_el"><?php echo $cplc_footer_message_el; ?></textarea>
		</div>
	</div>
 
	<?php
	
}


	public function cplc_form_heading_cb(){
		$cplc_form_heading_el =  get_option('cplc_form_heading_el');
		?>
		<div class="ui input">
			<input type="text" name="cplc_form_heading_el" style="width:80%;" placeholder="Enter the Form Header title" value="<?php echo $cplc_form_heading_el; ?>">
		</div>
	
		<?php
			
	}

	

	public function cplc_form_sub_heading_cb(){
		$cplc_form_sub_heading_el =  get_option('cplc_form_sub_heading_el');
		?>
	 
		<div class="ui form">
		<div class="field">
				<textarea rows="5" columns="25" style="width:80%;" name="cplc_form_sub_heading_el"><?php echo $cplc_form_sub_heading_el; ?></textarea>
			</div>
		</div>
		<?php
			
		}



		public function cplc_form_button_text_cb(){
			$cplc_form_button_text_el =  get_option('cplc_form_button_text_el');
			?>
			<div class="ui input">
				<input type="text" name="cplc_form_button_text_el" style="width:80%;" placeholder="Enter Button text" value="<?php echo $cplc_form_button_text_el; ?>">
			</div>
		
			<?php
				
		}

		public function cplc_form_qualify_button_sub_text_cb(){
			$cplc_form_qualify_button_sub_text_el =  get_option('cplc_form_qualify_button_sub_text_el');
			?>
		 
			<div class="ui form">
			<div class="field">
					<textarea rows="5" columns="25" style="width:80%;" name="cplc_form_qualify_button_sub_text_el"><?php echo $cplc_form_qualify_button_sub_text_el; ?></textarea>
				</div>
			</div>
			<?php
				
			}

}
