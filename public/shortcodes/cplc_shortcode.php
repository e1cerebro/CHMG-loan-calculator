<?php


add_shortcode('cplc_show_calculator', 'cplc_show_calculator_cb');

function cplc_show_calculator_cb($attr){
    extract(shortcode_atts(array(
                
        ), $attr));

        ob_start();
?>

        <div class="cplc-container cplc-loan-calculator">
            <h5 class="cplc-header-section">
                <div class="cplc-logo"><img src="https://paybright.com/wp-content/themes/healthsmart/images/PayBright-logo-neworange.png" height="auto" width="250px"/></div>
                <div class="cplc-heading-text">
                    <h3 class="cplc-text-center">Pay later with PayBright</h3>
                    <p class="cplc-text-center">Checking your eligibility won’t affect your credit.</p>
                </div>

                <!-- Body Section -->
            <div class="cplc-body-section">
                <div class="cplc-input-text">
                    <h4>How much is your purchase?</h4>
                    <p>We’ll estimate your monthly payments.</p>
                </div>
                <div class="cplc-input-field">
                            <label for="cplc-loan-amount" class="cplc-label">See how you can split</label>
                            <input type="text" name="cplc-loan-amount" id="cplc-amount-input" class="cplc-amount-input"/>
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

            <div class="cplc-footer-section">
                <div class="cplc-footer-button">
                    <button id="cplc-launch-prequalify-modal">See if you qualify</button>
                    <p class="cplc-small-text cplc-mt-small">Get a real-time decision with just 5 pieces of info.</p>
                </div>
                <div class="cplc-footer-sub-text">
                    <p class="cplc-small-text">Rates are between 0–30% APR, and a down payment may be required. Subject to eligibility check and approval. Payment options depend on your purchase amount. Estimated payment amount excludes taxes and shipping fees. Actual terms may vary. Affirm loans are made by Cross River Bank, Member FDIC. Visit affirm.com/help for more info.</p>
                </div>
            </div>

        </div>
        <!-- / Container Section -->
            


            


 
<?php

        $editor_contents    = ob_get_clean();
        return $editor_contents;

    }