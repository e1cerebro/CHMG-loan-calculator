 var animation_delay = 300;
 jQuery(document).ready(function($) {

    jQuery(document).on('click', '#cplc-launch-prequalify-single', function() {
        console.log('hello');
        jQuery('#pbModal').css("display", "block");

    });

     //jQuery(".chosen-select").chosen({ no_results_text: "Oops, nothing found!", allow_single_deselect: true }).change();



     //Give the input field focus when the page loads
     //jQuery('#cplc-amount-input').focus();

     /* handling the close for each of the card blocks */
     jQuery(document).on('click', '.cplc-close', function() {
         jQuery(this).parent().fadeOut(300, function() {
             var visible_blocks = jQuery('.cplc-summary-block:visible').length;

             if (visible_blocks <= 0) {
                 validation_failed('');
                 jQuery('#cplc-amount-input').val('');
                 jQuery('#cplc-loading-shimmer').css('display', 'none');

             } else {
                 validation_passed();
             }

         });
     });

     //Listen to the keyup event on the input text field
     jQuery(document).on('keyup', "#cplc-amount-input", function() {

         //Minimum valid amount for financing
         var cplc_minimum_approved_amount_el = cplc_vars.cplc_minimum_approved_amount_el;
         var minimum_approved_value = parseFloat(cplc_minimum_approved_amount_el);

         //construct the error message
         var minimum_amount_error = "Please enter an amount larger than or equal to $" + minimum_approved_value;

         if (event.which >= 37 && event.which <= 40) {
             event.preventDefault();
         }

         //format the display of the currency in the input field
         jQuery(this).val(function(index, value) {
             value = value.replace(/,/g, ''); // remove commas from existing input
             value = value.replace("$", ''); // remove commas from existing input
             jQuery('#cplc-hidden-amount').html(value);
             return numberWithCommas(value); // add commas back in
         });

         //get the value from the hidden span field
         var input_amount = parseFloat($('#cplc-hidden-amount').html());

         //display failed validation to create an animation
         validation_failed(minimum_amount_error);



         if (input_amount >= minimum_approved_value) {

             //wait for 1.5s before displaying the results
             setTimeout(function() {
                 validation_passed();
                 loan_amount = get_estimated_loan_amount(input_amount);

                 calculate_interest_rate(loan_amount.toFixed(0));

             }, 1500);

         } else {
             validation_failed(minimum_amount_error);
         }



     });


     jQuery(document).on('change', "#cplc-amount-select", function() {

         //Minimum valid amount for financing
         var cplc_minimum_approved_amount_el = cplc_vars.cplc_minimum_approved_amount_el;
         var minimum_approved_value = parseFloat(cplc_minimum_approved_amount_el);

         var input_amount = parseFloat(jQuery(this).val());
         var minimum_amount_error = "Please enter an amount larger than or equal to $" + minimum_approved_value;

         validation_failed(minimum_amount_error);


         setTimeout(function() {
             if (input_amount >= minimum_approved_value) {
                 jQuery('#cplc-hidden-amount').html(input_amount);
                 validation_passed();
                 loan_amount = get_estimated_loan_amount(input_amount);
                 calculate_interest_rate(loan_amount.toFixed(0));
             } else {
                 validation_failed(minimum_amount_error);
             }

         }, 1000);


     });

     jQuery(document).on('click', '#cplc-launch-prequalify-modal', function() {

         var input_amount = parseFloat($('#cplc-hidden-amount').html());
         loan_amount = get_estimated_loan_amount(input_amount);
         var cplc_paybright_api = cplc_vars.cplc_paybright_public_key_el;
         var cplc_src = "https://app.paybright.com/Payments/PreApproval/Preapproval_v2.aspx?public_key=" + cplc_paybright_api + "&purchase_amount=" + loan_amount;

         document.getElementById("pb_iframe").src = cplc_src;
         jQuery('#pbModal').css("display", "block");

     });
 });

 function get_estimated_loan_amount(input_amount, increment_amount) {

     //Get the calculation method: fixed or percentage
     var cplc_calculation_method_el = cplc_vars.cplc_calculation_method_el;
     var calculation_method = cplc_calculation_method_el;

     //The additional fee to add to the regular price of the product
     var cplc_chmg_additional_fee_el = cplc_vars.cplc_chmg_additional_fee_el;
     var increment_amount = parseFloat(cplc_chmg_additional_fee_el);

     if ('fixed' == calculation_method) {
         var loan_amount = input_amount + increment_amount;
     } else if ('percentage' == calculation_method) {
         var loan_amount = input_amount * increment_amount;
     }

     return loan_amount;
 }


 function validation_passed() {
     jQuery('#cplc-results').slideDown(animation_delay);
     jQuery('.cplc-label').css('display', 'inline-block');
     jQuery('.cplc-input-text').css('display', 'none');
     jQuery('.cplc-footer-button').css('display', 'block');
     jQuery('#cplc-error-messages').html("");
     jQuery('#cplc-loading-shimmer').css('display', 'none');

 }

 function validation_failed(error_message) {
     jQuery('#cplc-results').slideUp(animation_delay);
     jQuery('.cplc-label').css('display', 'none');
     jQuery('.cplc-input-text').css('display', 'block');
     jQuery('#cplc-error-messages').html(error_message);
     jQuery('.cplc-footer-button').css('display', 'none');
     jQuery('#cplc-loading-shimmer').css('display', 'block');

 }

 function calculate_interest_rate(loan_amount) {

     //get the available loan term and interest rates offered
     var cplc_available_loan_term_el = cplc_vars.cplc_available_loan_term_el;
     var cplc_available_interest_rates_el = cplc_vars.cplc_available_interest_rates_el;

     //convert the values to array
     var available_months = cplc_available_loan_term_el;
     var available_rates = cplc_available_interest_rates_el.split(",")

     //
     var interest_rate_value = '';
     var pay_per_month = '';
     var total_payment = '';

     //Remove everything from the result div
     jQuery('#cplc-results').empty();

     //Loop through all the available months
     available_months.forEach(function(loan_term, index) {
         //For each month, calculate interest amount by looping through the amount array
         available_rates.forEach(function(interest_rate, index) {

             if (interest_rate == 0) {

                 var result = (loan_amount / loan_term);
                 var calculated_monthly_pay = result.toFixed(2);

             } else {
                 var newinterestrate = interest_rate / 12;
                 var result = ((loan_amount * (newinterestrate / 100) * Math.pow((1 + (newinterestrate / 100)), loan_term)) / ((Math.pow((1 + (newinterestrate / 100)), loan_term)) - 1));
                 var calculated_monthly_pay = result.toFixed(2);
             }

             //Get the current interest rate
             interest_rate_value = parseFloat(interest_rate).toFixed(2);

             //monthly amount the customer pays
             pay_per_month = calculated_monthly_pay;

             //Total amount to pay at the end of the loan term - pay_per_month * loan_term
             total_payment_addition = parseFloat(pay_per_month) * loan_term;

             //fix the total loan term pay to zero decimal places
             total_payment = total_payment_addition.toFixed(0);


             //additional cost apart from the cost of the product
             additional_interest_amount = (total_payment - loan_amount).toFixed(2);

             /* console.log('Current Month: ', loan_term, ' months');
             console.log('Interest Rate: ', interest_rate, ' %');

             console.log('total_payment: ', total_payment);
             console.log('loan_amount: ', loan_amount);
             console.log('loan_amount: ', total_payment - loan_amount); */


             var htmlOutput = '';

             //get the dynamic color for the text and backgrounds
             var bg_color = get_custom_background_color(loan_term);
             var text_color = get_custom_text_color(loan_term);
             var highlight_interest = get_highlight_interest(interest_rate);
             var cplc_card_block_interest_rate_el = cplc_vars.cplc_card_block_interest_rate_el;
             var cplc_card_block_interest_amount_el = cplc_vars.cplc_card_block_interest_amount_el;
             var cplc_card_block_total_amount_el = cplc_vars.cplc_card_block_total_amount_el;
             var cplc_card_block_close_icon_el = cplc_vars.cplc_card_block_close_icon_el;

             htmlOutput += "<div class='cplc-summary-block .cplc-mb-medium'>";

             if ('1' == cplc_card_block_close_icon_el) {
                 htmlOutput += "<div class='cplc-close'><span class='cplc-close-icon'>&times;</span></div>";
             }
             htmlOutput += "<div class='cplc-summary-block_header'>";
             htmlOutput += "<div class='cplc-summary-block_header_monthly_pay'><span class='cplc-monthly-amount " + text_color + "'>" + formatCurrency(pay_per_month) + "</span><span class='cplc-month " + text_color + "'>/month</span></div>";
             htmlOutput += "<div class='cplc-summary-block_header_month " + bg_color + "'><span>" + loan_term + " months</span></div>";
             htmlOutput += "</div>";

             htmlOutput += "<div class='cplc-summary-block_body'>";
             htmlOutput += "<div class='cplc-summary-block_body_interest_rate'><h5>" + cplc_card_block_interest_rate_el + "</h5><p class='" + highlight_interest + "'>" + interest_rate_value + "%</p></div>";
             htmlOutput += "<div class='cplc-summary-block_body_interest_amount'><h5>" + cplc_card_block_interest_amount_el + "</h5><p>" + formatCurrency(additional_interest_amount) + "</p></div>";
             htmlOutput += "<div class='cplc-summary-block_body_total_payment'><h5>" + cplc_card_block_total_amount_el + "</h5><p>" + formatCurrency(total_payment) + "</p></div>";
             htmlOutput += "</div>";
             htmlOutput += "</div>";

             jQuery('#cplc-results').append(htmlOutput);

         });

         jQuery('#cplc-results').slideDown(animation_delay)


     });

 }

 function get_custom_background_color(loan_term) {

     // return '';

     if (loan_term > 0 && loan_term <= 6) {
         return 'cplc_bg_6';
     } else if (loan_term > 6 && loan_term <= 12) {
         return 'cplc_bg_12';
     } else if (loan_term > 12 && loan_term <= 18) {
         return 'cplc_bg_18';
     } else if (loan_term > 18 && loan_term <= 24) {
         return 'cplc_bg_24';
     }

 }

 function get_highlight_interest(interest_rate) {
     if (0 == interest_rate) {
         return 'cplc_zero_interest';
     } else {
         return 'cplc_normal_rate';
     }
 }

 function get_custom_text_color(loan_term) {
     //return '';
     if (loan_term > 0 && loan_term <= 6) {
         return 'cplc_text_6';
     } else if (loan_term > 6 && loan_term <= 12) {
         return 'cplc_text_12';
     } else if (loan_term > 12 && loan_term <= 18) {
         return 'cplc_text_18';
     } else if (loan_term > 18 && loan_term <= 24) {
         return 'cplc_text_24';
     }

 }


 function formatCurrency(num) {
     num = num.toString().replace(/\$|\,/g, '');
     if (isNaN(num)) {
         num = "0";
     }

     sign = (num == (num = Math.abs(num)));
     num = Math.floor(num * 100 + 0.50000000001);
     cents = num % 100;
     num = Math.floor(num / 100).toString();

     if (cents < 10) {
         cents = "0" + cents;
     }
     for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++) {
         num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
     }

     return (((sign) ? '' : '-') + '$' + num + '.' + cents);
 }


 function numberWithCommas(x) {
     var parts = x.toString().split(".");
     parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     return "$" + parts.join(".");
 }