<?php

//include_once( CPLC_ROOT_PATH.'cplc-custom-utils/cplc-db-utils.php' );

require_once plugin_dir_path( __FILE__ ).'../../includes/cplc-custom-utils/cplc-db-utils.php';

add_shortcode('cplc_show_calculator', 'cplc_show_calculator_cb');



function cplc_show_calculator_cb($attr){
    extract(shortcode_atts(array(
                
        ), $attr));

        ob_start();
?>
 


        <div class="cplc-container cplc-loan-calculator">
            <div class="cplc-header-section">

             <?php if(strlen(get_option('cplc_financing_company_logo_el')) > 0): ?>   
            <div class="cplc-logo"><img src="<?php echo esc_attr(get_option('cplc_financing_company_logo_el'), CPLC_CHMG_TEXT_DOMAIN); ?>" height="auto" width="250px"/></div>
            <?php endif; ?>   
            <div class="cplc-heading-text">

                    <?php if(!empty(get_option('cplc_header_title_el'))): ?>
                     <h3 class="cplc-text-center"><?php echo esc_attr(get_option('cplc_header_title_el'), CPLC_CHMG_TEXT_DOMAIN); ?></h3>
                    <?php endif; ?>

                    <?php if(!empty(get_option('cplc_header_sub_title_el'))): ?>
                    <p class="cplc-text-center"><?php echo esc_attr(get_option('cplc_header_sub_title_el'), CPLC_CHMG_TEXT_DOMAIN); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Body Section -->
            <div class="cplc-body-section">
                <div class="cplc-input-text">
                    <?php if(!empty(get_option('cplc_form_heading_el'))): ?>
                    <h4><?php echo esc_attr( get_option('cplc_form_heading_el'), CPLC_CHMG_TEXT_DOMAIN ); ?></h4>
                    <?php endif; ?>
                    <?php if(!empty(get_option('cplc_form_sub_heading_el'))): ?>
                    <p><?php echo esc_attr(  get_option('cplc_form_sub_heading_el'), CPLC_CHMG_TEXT_DOMAIN ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="cplc-input-field">
                             
                <?php if( 'input' == get_option('cplc_chmg_loan_amount_input_el')): ?>
                            <!-- <label for="cplc-loan-amount" class="cplc-label">See how you can split</label> -->
                             <input type="text" name="cplc-loan-amount" placeholder="Loan Amount" id="cplc-amount-input" class="cplc-amount-input"/>
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

            
            <div id="cplc-results" class="cplc-mb-medium">
                <!-- <div class="cplc-summary-block">
                    <div class="cplc-summary-block_header">
                        <div class="cplc-summary-block_header_monthly_pay"><span class="cplc-monthly-amount">1000</span><span class="cplc-month">/month</span></div>
                        <div class="cplc-summary-block_header_month"><span>6 months</span></div>
                    </div>

                    <div class='cplc-summary-block_body'>
                        <div class='cplc-summary-block_body_interest_rate'><h5>Interest Rate</h5><p>10.00%</p></div>
                        <div class='cplc-summary-block_body_interest_amount'><h5>Interest Amount</h5><p>0.00%</p></div>
                        <div class='cplc-summary-block_body_total_payment'><h5>Total Payment</h5><p>$3,000.00</p></div>
                     </div>
                </div> -->
            </div>

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
                    <button id="cplc-launch-prequalify-modal"><?php echo esc_attr( get_option('cplc_form_button_text_el'), CPLC_CHMG_TEXT_DOMAIN ); ?></button>
                    <?php if(!empty(get_option('cplc_form_qualify_button_sub_text_el'))): ?>
                    <p class="cplc-small-text cplc-mt-small"><?php echo esc_attr(get_option('cplc_form_qualify_button_sub_text_el'), CPLC_CHMG_TEXT_DOMAIN) ;?></p>
                    <?php endif ?>
                </div>

                <div class="cplc-footer-sub-text">
                    <?php if(!empty(get_option('cplc_footer_message_el'))) :?>
                    <p class="cplc-small-text"><?php echo esc_attr(get_option('cplc_footer_message_el'), CPLC_CHMG_TEXT_DOMAIN); ?></p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <!-- / Container Section -->
        
            
        <script id='paybright' type='text/javascript' src='https://app.healthsmartfinancial.com/api/pb_woocommerce.js?public_key=6ehgkT9K1KvH137bZdjQNXFCG4KeXWLXNxaUm4gPdWK3bhPHD7&financedamount=$1000'></script>
        <div id='paybright-widget-container' class='cplc-paybright-container'></div>

            


 
<?php


        $editor_contents    = ob_get_clean();
        return $editor_contents;

    }

     