$(document).ready(function () {
	var current = new Date();
	var year = current.getFullYear();
	$.validator.addMethod("noSpecial", 
        function(value, element, regexp) {
			var regex = new RegExp("^[A-Z0-9.]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Capital letters and Numbers Only"
	);
	
	//rule for allowing spaces but no symbols
	$.validator.addMethod("allowSpaces", 
        function(value, element, regexp) {
			var regex = new RegExp("^[a-zA-Z ]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"No numbers or special characters allowed"
	);
	
	$('#addBalance-form').validate({
        rules: {
			addingBalance: {
				//number: true,
				digits: true,
				range: [1, 100000],
				required: true
			},
			cardHolderName: {
				allowSpaces: true,
				required: true
			},
			creditCardNumber: {
				creditcard: true,
				required: true
			},
			monthExpiration: {
				digits: true,
				range: [1, 12],
				required: true
			},
			yearExpiration: {
				digits: true,
				range: [year, 2100],
				required: true
			}
		},
		messages: {
			addingBalance: {
				//number: "Please enter a valid amount"
				digits: "Please enter a valid whole amount greater than 0"
			}
		},
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            $(element).addClass('valid')
                .closest('.control-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	//handles the submit button onclick action. POSTs the form for processing and 
	//Success: loads the page into the div where the form was before
	//Fail: alerts the user that something is not correct
	$(function () {
		$('#addBalance-form').submit(function () {
			if($(this).valid()) {
				//alert('Successful Validation');
				  $.post(
						'classes/addMoney.php',
						$(this).serialize(),
						function(data){
							//alert("Amount has been added.");
							$("#result").html(data);
							//$('#inboxNum').text(data);
							//location.window();
						}
					);
					return false;
			}
			else
			{
				alert('Please correct the errors indicated.');
				return false;
			}
		});
	});                   
});