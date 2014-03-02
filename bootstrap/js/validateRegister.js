$(document).ready(function () {
	//rule for checking password confirmation
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg != value;
	 }, "Value must not equal arg.");
	 
	 //rule for checking username uniqueness
	 $.validator.addMethod("checkUsername", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "../classes/checkUnique.php", // script to validate in server side
                data: {username: value},
                success: function(data) {
					//alert(data);
                    result = (data) ? true : false;
                }
            });
            return result; 
        }, 
        "Username not available"
    );
	
	//rule for checking email uniqueness
	$.validator.addMethod("checkEmail", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "../classes/checkUnique.php", // script to validate in server side
                data: {email: value},
                success: function(data) {
					//alert(data);
                    result = (data) ? true : false;
                }
            });
            return result; 
        }, 
        "Email has been registered. Please make sure the User you are trying to register is not already registered."
    );
	
	//rule for allowing some symbols in the first and last name field
	$.validator.addMethod("noSpecialChars", 
        function(value, element, regexp) {
			var regex = new RegExp("^[a-zA-Z'-]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Only alphabetic characters, apostrophe and dash"
	);
	
	//rule for allowing spaces but no symbols in street field
	$.validator.addMethod("allowSpaces", 
        function(value, element, regexp) {
			var regex = new RegExp("^[a-zA-Z0-9 ]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"No special characters allowed"
	);
	
    $('#register-form').validate({
        rules: {
            firstname: {
                minlength: 2,
				maxlength: 20,
				noSpecialChars: true,
                required: true
            },
			lastname: {
                minlength: 2,
				maxlength: 25,
				noSpecialChars: true,
                required: true
            },
			month: {
				digits: true,
                minlength: 1,
				maxlength: 2,
				alphanumeric: true,
                required: true
            },
			day: {
				digits: true,
                minlength: 1,
				maxlength: 2,
				alphanumeric: true,
                required: true
            },
			year: {
				digits: true,
                minlength: 4,
				maxlength: 4,
				alphanumeric: true,
                required: true
            },
			street: {
				maxlength: 75,
				allowSpaces: true,
                required: true
            },
			state: {
                valueNotEquals: "State"
            },
			city: {
                minlength: 2,
				maxlength: 20,
				alphanumeric: true,
                required: true
            },
			zip: {
				digits: true,
                minlength: 5,
				maxlength: 5,
				alphanumeric: true,
                required: true
            },
            email: {
                required: true,
				maxlength: 50,
                email: true,
				checkEmail: true
            },
            contact: {
				digits: true,
                minlength: 10,
				maxlength: 10,
				alphanumeric: true,
                required: true
            },
			username: {
                required: true,
				alphanumeric: true,
				maxlength: 25,
				checkUsername: true	
            },
			password: {
                required: true,
				alphanumeric: true,
				minlength: 6
            },
			password2: {
                required: true,
				minlength: 6,
				alphanumeric: true,
				equalTo: "#password"
            },
			studentid: {
                required: true,
				digits: true,
				maxlength: 20
            }
        },
		messages: {
			month: {
				maxlength: "2 digits max",
				digits: "Numbers Only"
			},
			day: {
				maxlength: "2 digits max",
				digits: "Numbers Only"
			},
            year: {
                minlength: "Use 4 digits",
				maxlength: "Use 4 digits",
				digits: "Numbers Only"
			},
			contact: {
				digits: "Format contact number as shown (1237774567)"
			},
			password2: {
				equalTo: "Password confirmation does not match"
			},
			state: {
                valueNotEquals: "Select a State"
            }
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            element.text('OK!').addClass('valid')
                .closest('.control-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	//handles the submit button onclick action. POSTs the form for processing and 
	//Success: loads the page into the div where the form was before
	//Fail: alerts the user that something is not correct
	$(function () {
		$('#register-form').submit(function () {
			if($(this).valid()) {
				//alert('Successful Validation');
				$.post(
					'../classes/processRegistration.php',
					$(this).serialize(),
					function(data){
					  $("#result").html(data);
					  //console.log(data);
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