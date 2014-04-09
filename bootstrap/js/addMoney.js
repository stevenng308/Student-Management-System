$(document).ready(function () {
	var current = new Date();
	var month = current.getMonth() + 1;
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
	
	//rule for allowing up to 2 decimal places
	$.validator.addMethod("twoDecimals", 
        function(value, element, regexp) {
			//var regex = new RegExp(/^(?!0\.00)[1-9](\d*\.\d{1,2}|\d+)$/);
			var regex = new RegExp(/^[1-9]\d*(\.\d{1,2})?$/);
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Invalid format. Please format your input like the example shown (ex. 1000.75)"
	);
	
	//rule for checking the expiration info
	$.validator.addMethod("checkExpire", 
        function(value, element, regexp) {
			if (value == year)
			{
				if ($('#monthExpiration').val() >= month)
					return true;
				else
					return false;
			}
			else
			{
				if (value > year)
					return true;
				else
					return false;
			}
		},
		"Card has expired"
	);
	
	$('#addBalance-form').validate({
        rules: {
			addingBalance: {
				//digits: true,
				//number: true,
				range: [1, 100000],
				twoDecimals: true,
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
				checkExpire: true,
				required: true
			}
		},
		messages: {
			addingBalance: {
				//number: "Please enter a valid amount"
				digits: "Please enter a valid whole amount greater than 0. No decimals."
			},
			monthExpiration: {
				//number: "Please enter a valid amount"
				range: "Please enter a valid whole amount greater than 0. No decimals."
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
				if (window.confirm('Do you wish to process this transaction?'))
				{
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
					window.location.href = 'index.php';
					return false;
				}
			}
			else
			{
				alert('Please correct the errors indicated.');
				return false;
			}
		});
	});

	$('#monthExpiration').change().keyup(function () {
		$('#yearExpiration').val('');
		$('#yearExpiration').valid();
	});
});