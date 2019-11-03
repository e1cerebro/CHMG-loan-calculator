<?php

class CplcProductSettings{

    private $plugin_name;

    public function __construct( $plugin_name ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    public function register_section(){
        add_settings_section(
            'cplc_general_product_section',
            __( 'Product Settings', CPLC_CHMG_TEXT_DOMAIN ),
            '',
            $this->plugin_name."-product"
        );

    }

    public function register_fields(){
        /* List of products to be included */
        add_settings_field(
            'cplc_include_categories_el',
            __( 'Include Categories', CPLC_CHMG_TEXT_DOMAIN),
            [ $this,'cplc_include_categories_cb'],
            $this->plugin_name."-product",
            'cplc_general_product_section'
        );
        register_setting( $this->plugin_name."-product", 'cplc_include_categories_el');

    }

    
	public function cplc_include_categories_cb(){
		$cplc_include_categories_el =  get_option('cplc_include_categories_el');

		?>
			<div class="ui input">
				<select  data-placeholder="Choose categories..." class="chosen-select" name="cplc_include_categories_el[]" multiple >
 					<?php foreach(CPLC_DB_Utils::get_all_product_categories() as $cat): ?>
						<option <?php echo in_array($cat->term_id, $cplc_include_categories_el) ? 'SELECTED' : ''; ?>  value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<p class="description"><?php _e('Choose products categories to display', CPLC_CHMG_TEXT_DOMAIN) ?></p>

		<?php
		
	}


}