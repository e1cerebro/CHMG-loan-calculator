var animation_delay = 300;
jQuery(document).ready(function($) {

    //Listen to the keyup event on the input text field
    $(document).on('keyup', "#cplc-amount-input", function() {

        //The additional fee to add to the regular price of the product
        var cplc_chmg_additional_fee_el = cplc_vars.cplc_chmg_additional_fee_el;
        var increment_amount = parseFloat(cplc_chmg_additional_fee_el);

        //Minimum valid amount for financing
        var cplc_minimum_approved_amount_el = cplc_vars.cplc_minimum_approved_amount_el;
        var minimum_approved_value = parseFloat(cplc_minimum_approved_amount_el);

        var minimum_amount_error = "Please enter an amount larger than or equal to $" + minimum_approved_value;

        if (event.which >= 37 && event.which <= 40) {
            event.preventDefault();
        }


        $(this).val(function(index, value) {
            value = value.replace(/,/g, ''); // remove commas from existing input
            value = value.replace("$", ''); // remove commas from existing input
            $('#cplc-hidden-amount').html(value);
            return numberWithCommas(value); // add commas back in
        });

        var input_amount = parseFloat($('#cplc-hidden-amount').html());

        if (input_amount >= minimum_approved_value) {

            validation_passed();

            //var calculation_method = "multiply";
            var cplc_calculation_method_el = cplc_vars.cplc_calculation_method_el;

            var calculation_method = cplc_calculation_method_el;

            if ('fixed' == calculation_method) {
                var loan_amount = input_amount + increment_amount;
            } else if ('percentage' == calculation_method) {
                var loan_amount = input_amount * increment_amount;
            }


            calculate_interest_rate(loan_amount);

        } else {
            validation_failed(minimum_amount_error);
        }

    });


    $(document).on('click', '#cplc-launch-prequalify-modal', function() {
        jQuery('#pbModal').css("display", "block");
    });
});


function validation_passed() {
    $('#cplc-results').slideDown(animation_delay);
    $('.cplc-label').css('display', 'inline-block');
    $('.cplc-input-text').css('display', 'none');
    $('.cplc-footer-button').css('display', 'block');
    $('#cplc-error-messages').html("");
    $('#cplc-loading-shimmer').css('display', 'none');

}

function validation_failed(error_message) {
    $('#cplc-results').slideUp(animation_delay);
    $('.cplc-label').css('display', 'none');
    $('.cplc-input-text').css('display', 'block');
    $('#cplc-error-messages').html(error_message);
    $('.cplc-footer-button').css('display', 'none');
    $('#cplc-loading-shimmer').css('display', 'block');

}

function calculate_interest_rate(loan_amount) {


    var cplc_available_loan_term_el = cplc_vars.cplc_available_loan_term_el;
    var cplc_available_interest_rates_el = cplc_vars.cplc_available_interest_rates_el;


    var available_months = cplc_available_loan_term_el.split(",");
    var available_rates = cplc_available_interest_rates_el.split(",")


    var interest_rate_value = '';
    var pay_per_month = '';
    var total_payment = '';



    $('#cplc-results').empty();

    //Loop through all the available months
    available_months.forEach(function(loan_term, index) {
        //For each month, calculate interest amount by looping through the amount array
        available_rates.forEach(function(interest_rate, index) {
            if (interest_rate == 0) {

                var result = (loan_amount / loan_term);
                var Finalresult = result.toFixed(2);

            } else {
                var newinterestrate = interest_rate / 12;
                var result = ((loan_amount * (newinterestrate / 100) * Math.pow((1 + (newinterestrate / 100)), loan_term)) / ((Math.pow((1 + (newinterestrate / 100)), loan_term)) - 1));
                var Finalresult = result.toFixed(2);
            }

            interest_rate_value = parseFloat(interest_rate).toFixed(2);
            pay_per_month = Finalresult;
            total_payment_addition = parseFloat(loan_amount) + parseFloat(Finalresult);
            total_payment = total_payment_addition.toFixed(2)

            additional_interest_amount = (total_payment - loan_amount).toFixed(2);

            /*  console.log("Current Month: " + loan_term);
            console.log("Interest Rate: " + interest_rate_value);

            console.log("Monthly Pay: " + pay_per_month);
			console.log("Total Payment After " + loan_term + " Months: " + total_payment);
 */
            var htmlOutput = '';

            var bg_color = get_custom_background_color(loan_term);
            var text_color = get_custom_text_color(loan_term);
            var highlight_interest = get_highlight_interest(interest_rate);
            htmlOutput += "<div class='cplc-summary-block .cplc-mb-medium'>";

            htmlOutput += "<div class='cplc-summary-block_header'>";
            htmlOutput += "<div class='cplc-summary-block_header_monthly_pay'><span class='cplc-monthly-amount " + text_color + "'>" + formatCurrency(pay_per_month) + "</span><span class='cplc-month " + text_color + "'>/month</span></div>";
            htmlOutput += "<div class='cplc-summary-block_header_month " + bg_color + "'><span>" + loan_term + " months</span></div>";
            htmlOutput += "</div>";

            htmlOutput += "<div class='cplc-summary-block_body'>";
            htmlOutput += "<div class='cplc-summary-block_body_interest_rate'><h5>Interest Rate</h5><p class='" + highlight_interest + "'>" + interest_rate_value + "%</p></div>";
            htmlOutput += "<div class='cplc-summary-block_body_interest_amount'><h5>Interest Amount</h5><p>" + formatCurrency(additional_interest_amount) + "</p></div>";
            htmlOutput += "<div class='cplc-summary-block_body_total_payment'><h5>Total Payment</h5><p>" + formatCurrency(total_payment) + "</p></div>";
            htmlOutput += "</div>";

            htmlOutput += "</div>";

            $('#cplc-results').append(htmlOutput);

        });

        $('#cplc-results').slideDown(animation_delay)


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