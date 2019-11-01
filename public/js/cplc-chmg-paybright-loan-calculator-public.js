jQuery(document).ready(function($) {

    //Listen to the keyup event on the input text field
    $(document).on('keyup', "#cplc-amount-input", function() {

        var increment_amount = 250;
        var minimum_approved_value = 250;

        var amount_error = "Please enter an amount larger than or equal to $" + minimum_approved_value;

        //get the float version of the value
        //var input_amount = $(this).val();
        var input_amount = parseFloat($(this).val());

        if (input_amount >= minimum_approved_value) {

            validation_passed();

            //var calculation_method = "multiply";
            var calculation_method = "addition";

            if ('addition' == calculation_method) {
                var loan_amount = input_amount + increment_amount;
            } else {
                var loan_amount = input_amount * increment_amount;
            }


            calculate_interest_rate(loan_amount);

        } else {
            validation_failed(amount_error);
        }

    });
});


function validation_passed() {
    $('.cplc-label').css('display', 'inline-block');
    $('.cplc-input-text').css('display', 'none');
    $('.cplc-footer-button').css('display', 'block');
    $('#cplc-error-messages').html("");
}

function validation_failed(error_message) {
    $('#cplc-results').empty();
    $('.cplc-label').css('display', 'none');
    $('.cplc-input-text').css('display', 'block');
    $('#cplc-error-messages').html(error_message);
    $('.cplc-footer-button').css('display', 'none');

}

function calculate_interest_rate(loan_amount) {

    var available_months = ["6", "12"];
    var available_rates = ["0", "7.95"]


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

            htmlOutput += "<div class='cplc-summary-block'>";

            htmlOutput += "<div class='cplc-summary-block_header'>";
            htmlOutput += "<div class='cplc-summary-block_header_monthly_pay'><span class='cplc-monthly-amount'>$" + pay_per_month + "</span><span class='cplc-month'>/month</span></div>";
            htmlOutput += "<div class='cplc-summary-block_header_month'><span>" + loan_term + " months</span></div>";
            htmlOutput += "</div>";

            htmlOutput += "<div class='cplc-summary-block_body'>";
            htmlOutput += "<div class='cplc-summary-block_body_interest_rate'><h5>Interest Rate</h5><p>" + interest_rate_value + "%</p></div>";
            htmlOutput += "<div class='cplc-summary-block_body_interest_amount'><h5>Interest Amount</h5><p>$" + additional_interest_amount + "</p></div>";
            htmlOutput += "<div class='cplc-summary-block_body_total_payment'><h5>Total Payment</h5><p>$" + total_payment + "</p></div>";
            htmlOutput += "</div>";

            htmlOutput += "</div>";

            $('#cplc-results').append(htmlOutput);

        });


    });

}