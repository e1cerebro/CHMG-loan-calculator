<?php

//include_once( CPLC_ROOT_PATH.'cplc-custom-utils/cplc-db-utils.php' );

require_once plugin_dir_path( __FILE__ ).'../../includes/cplc-custom-utils/cplc-db-utils.php';

add_shortcode('cplc_show_calculator', 'cplc_show_calculator_cb');



function cplc_show_calculator_cb($attr){
	$defaults = [
		'cplc_show_logo' => '',
		'cplc_show_header_title' => '',
		'cplc_show_header_sub_title' => '',
		'cplc_show_form_title' => '',
		'cplc_show_form_sub_title' => '',
		'cplc_form_qualify_button_sub_text' => '',
		'cplc_footer_message' => '',
	];
	$options = shortcode_atts($defaults, $attr);

	ob_start();
?>
        <div class="cplc-container cplc-loan-calculator">
			<!-- Start header section -->
			<div class="cplc-header-section">
				<?php if('yes' == $cplc_show_logo || empty($cplc_show_logo)): ?>
					<?php if(strlen(get_option('cplc_financing_company_logo_el')) > 0): ?>   
							<div class="cplc-logo"><img src="<?php echo esc_attr(get_option('cplc_financing_company_logo_el'), CPLC_CHMG_TEXT_DOMAIN); ?>" height="auto" width="250px"/></div>
					<?php endif; ?>  
				<?php endif; ?> 
				<!-- Header title -->
				<div class="cplc-heading-text">
				<?php if('yes' == $cplc_show_header_title || empty($cplc_show_header_title)): ?>
					<?php if(!empty(get_option('cplc_header_title_el'))): ?>
						<span class="cplc-text-center cplc-header-title"><?php echo  _e(get_option('cplc_header_title_el'), CPLC_CHMG_TEXT_DOMAIN); ?></span>
					<?php endif; ?>
				<?php endif; ?> 

				<!-- Header Sub title -->
				<?php if('yes' == $cplc_show_header_sub_title || empty($cplc_show_header_sub_title)): ?>
					<?php if(!empty(get_option('cplc_header_sub_title_el'))): ?>
					<span class="cplc-text-center cplc-header-sub-title "><?php echo _e(get_option('cplc_header_sub_title_el'), CPLC_CHMG_TEXT_DOMAIN); ?></span>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<!-- End header section -->
		
			<!-- Body Section -->
			<div class="cplc-body-section">
				<div class="cplc-input-text">
				
				<!-- Form Title -->
					<?php if('yes' == $cplc_show_form_title || empty($cplc_show_form_title)): ?>
						<?php if(!empty(get_option('cplc_form_heading_el'))): ?>
						<span class="cplc-form-heading">
								<?php echo _e( get_option('cplc_form_heading_el'), CPLC_CHMG_TEXT_DOMAIN ); ?> 
						</span>
						<?php endif; ?>
					<?php endif; ?>

					<!-- Form Subtitle -->
					<?php if('yes' == $cplc_show_form_sub_title || empty($cplc_show_form_sub_title)): ?>
						<?php if(!empty(get_option('cplc_form_sub_heading_el'))): ?>
						<span class="cplc-form-sub-heading">
							<?php echo _e(  get_option('cplc_form_sub_heading_el'), CPLC_CHMG_TEXT_DOMAIN ); ?>
						</span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<div class="cplc-input-field">
					<?php if( 'input' == get_option('cplc_chmg_loan_amount_input_el')): ?>
						<input type="text" name="cplc-loan-amount" placeholder="<?php echo _e(  get_option('cplc_form_placeholder_text_el'), CPLC_CHMG_TEXT_DOMAIN ); ?>" id="cplc-amount-input" class="cplc-amount-input"/>
					<?php elseif('select'): ?>            
							
					<?php $cplc_all_product = !empty(get_option('cplc_include_categories_el')) ?  CPLC_DB_Utils::get_product_from_cat()->posts : CPLC_DB_Utils::get_products();   ?>
						<select data-placeholder="Choose categories..." class="chosen-select" name="cplc-loan-amount_select" id="cplc-amount-select">
							<option value="">select product</option>
							<?php foreach($cplc_all_product as $product_id): ?>
								<?php $product = wc_get_product( $product_id ); ?>
								<?php if('instock' == $product->get_stock_status()): ?>
									<?php if ($product->is_type( 'variable' )): ?>
										<optgroup label="<?php echo $product->get_name(); ?>">
											<?php
												$variations = CPLC_DB_Utils::get_products_variations($product_id);
											?>

											<?php foreach($variations as $product_id): ?>
												<?php
													$product = wc_get_product( $product_id );
													$variation_product_name = $product->get_name();
													$variation_product_regular_price = $product->get_regular_price();
													$variation_product_sales_price = $product->get_sale_price();
		
													if(!empty($variation_product_sales_price)){
														$variation_product_price = $variation_product_sales_price;
													}else{
														$variation_product_price = $variation_product_regular_price;
													}
												?>
												<option value="<?php echo $variation_product_price; ?>"><?php echo $variation_product_name." - ($".number_format( $variation_product_price, 2, '.', ',' ).")"; ?></option>
											<?php endforeach;?>
										</optgroup>
									<?php else: ?>
										<?php
											$product_name = $product->get_name();
											$product_regular_price = $product->get_regular_price();
											$product_sales_price = $product->get_sale_price();

											if(!empty($product_sales_price)){
												$product_price = $product_sales_price;
											}else{
												$product_price = $product_regular_price;
											}

										?>
											<option value="<?php echo $product_price; ?>"><?php echo $product_name." - ($".number_format( $product_price, 2, '.', ',' ).")"; ?></option>
									<?php endif; ?>
									<?php endif; ?>
							<?php endforeach;?>
						</select>
					<?php endif; ?>
					<span style="display: none;" id="cplc-hidden-amount" ></span>
				</div>
			</div>
			<!-- / Body Section -->

			<div id="cplc-error-messages" class="cplc-mb-medium"></div>

			<div id="cplc-loading-shimmer" class="cplc-mb-medium">
				<section class="cplc-loading-shimmer"> 
				<div class="cplc-summary-block">
					<div class="cplc-summary-block_header">
						<div class="cplc-summary-block_header_monthly_pay"><span class="cplc-monthly-amount"></span></div>
						<div class="cplc-summary-block_header_month"><span></span></div>
					</div>

					<div class='cplc-summary-block_body'>
						<div class='cplc-summary-block_body_interest_rate'><h5></h5><p></p></div>
						<div class='cplc-summary-block_body_interest_amount'><h5></h5><p></p></div>
						<div class='cplc-summary-block_body_total_payment'><h5></h5><p></p></div>
					</div>
					</div>  
				<div class="cplc-summary-block">
					<div class="cplc-summary-block_header">
						<div class="cplc-summary-block_header_monthly_pay"><span class="cplc-monthly-amount"></span></div>
						<div class="cplc-summary-block_header_month"><span></span></div>
					</div>

					<div class='cplc-summary-block_body'>
						<div class='cplc-summary-block_body_interest_rate'><h5></h5><p></p></div>
						<div class='cplc-summary-block_body_interest_amount'><h5></h5><p></p></div>
						<div class='cplc-summary-block_body_total_payment'><h5></h5><p></p></div>
					</div>
					</div>  
				<div class="cplc-summary-block">
					<div class="cplc-summary-block_header">
						<div class="cplc-summary-block_header_monthly_pay"><span class="cplc-monthly-amount"></span></div>
						<div class="cplc-summary-block_header_month"><span></span></div>
					</div>

					<div class='cplc-summary-block_body'>
						<div class='cplc-summary-block_body_interest_rate'><h5></h5><p></p></div>
						<div class='cplc-summary-block_body_interest_amount'><h5></h5><p></p></div>
						<div class='cplc-summary-block_body_total_payment'><h5></h5><p></p></div>
					</div>
					</div>
				</section>
			</div>

			<div class="cplc-footer-section">
				<div class="cplc-footer-button">
					<button id="cplc-launch-prequalify-modal" class="cplc-mb-small"><?php echo esc_attr( get_option('cplc_form_button_text_el'), CPLC_CHMG_TEXT_DOMAIN ); ?></button>
				
					<?php if('yes' == $cplc_form_qualify_button_sub_text || empty($cplc_form_qualify_button_sub_text)): ?>
						<?php if(!empty(get_option('cplc_form_qualify_button_sub_text_el'))): ?>
						<span class="cplc-small-text cplc-mt-small cplc-form-qualify-button-sub-text"><?php echo _e(get_option('cplc_form_qualify_button_sub_text_el'), CPLC_CHMG_TEXT_DOMAIN) ;?></span>
						<?php endif ?>
					<?php endif ?>
				</div>

				<?php if('yes' == $cplc_footer_message || empty($cplc_footer_message)): ?>
					<div class="cplc-footer-sub-text">
					
						<?php if(!empty(get_option('cplc_footer_message_el'))) :?>
						<span class="cplc-small-text cplc-footer-message"><?php echo _e(get_option('cplc_footer_message_el'), CPLC_CHMG_TEXT_DOMAIN); ?></span>
						<?php endif; ?>
					</div>
				<?php endif ?>
			</div>
		</div>
		<!-- / Container Section -->

		<script id='paybright' type='text/javascript' src='https://app.healthsmartfinancial.com/api/pb_woocommerce.js?public_key=6ehgkT9K1KvH137bZdjQNXFCG4KeXWLXNxaUm4gPdWK3bhPHD7&financedamount=$1000'></script>
		<div id='paybright-widget-container' class='cplc-paybright-container'></div>

<?php $editor_contents = ob_get_clean();
		return $editor_contents;
	}