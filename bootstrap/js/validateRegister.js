/*
* Author: Steven Ng
* Javascript to handle validating registration form
*/
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
					if (data.match(/true/)) //the data passed back from the checkUnique.php may contain other stuff besides exactly true and false. 
					{						//this is somewhat less strict comparison. it ensures that the output contains the string "true" (at any position).
						result = true;
					}
					else
					{
						result = false;
					}
                    //result = (data) ? true : false;
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
					if (data.match(/true/))
					{
						result = true;
					}
					else
					{
						result = false;
					}
                    //result = (data) ? true : false;
                }
            });
            return result; 
        }, 
        "Email has been registered. Please make sure the User you are trying to register is not already registered."
    );
	
	//rule for checking email uniqueness
	$.validator.addMethod("checkStudentID", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "../classes/checkStudentID.php", // script to validate in server side
                data: {childrenID: value},
                success: function(data) {
					//alert(data);
					if (data.match(/true/))
					{
						result = true;
					}
					else
					{
						result = false;
					}
                    //result = (data) ? true : false;
                }
            });
            return result; 
        }, 
        "The rightmost Student ID does not exist. Please make sure the student you are trying to associate with has been created and has a Student ID number."
    );
	
	//rule for checking birthdate validity
	$.validator.addMethod("checkBirth", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "../classes/checkBirthdate.php", // script to validate in server side
                data: {
					year: value,
					month: $('#month').val(),
					day: $('#day').val()
				},
                success: function(data) {
					//alert(data);
					if (data.match(/true/) || value === email)
					{
						result = true;
					}
					else
					{
						result = false;
					}
                    //result = (data) ? true : false;
                }
            });
            return result; 
        }, 
        "Birthdate does not exist. This year does not have this date"
    );
	
	//rule for checking date validity
	$.validator.addMethod("checkDate", 
        function(value, element) {
			var result = false;
			var current = new Date();
			if (value <= current.getFullYear())
			{
				if ($('#month').val() <= current.getMonth() + 1)
				{
					if ($('#day').val() <= current.getDate())
					{
						result = true;
					}
					else
					{
						result = false;
					}
				}
				else
				{
					result = false;
				}
			}
			else
			{
				result = false;
			}
			return result;
		}, 
        "Birthdate not valid. Is month, date and year correct?"
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
	
	//rule for allowing some symbols in the first and last name field
	$.validator.addMethod("allowCommas", 
        function(value, element, regexp) {
			var regex = new RegExp("^[0-9,]+$");
			//var regex2 = new RegExp("^$");
			var key = value;
			if (!(key.length > 0)) { //check empty string. if resolved true return true that it is empty.
			   return true;
			}
			else if (!regex.test(key)) //if resolved true, the key has some illegal characters so return false that it is not valid
			{
				return false;
			}
			return true; //return true that everything is valid
		},
		"Numbers and commas only"
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
				range: [1,12],
				alphanumeric: true,
                required: true
            },
			day: {
				digits: true,
                minlength: 1,
				maxlength: 2,
				range: [1,31],
				alphanumeric: true,
                required: true
            },
			year: {
				digits: true,
                minlength: 4,
				maxlength: 4,
				range: [1900,2100],
				alphanumeric: true,
				checkBirth: true,
				checkDate: true,
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
				noSpecialChars: true,
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
            },
			childrenID: {
				checkStudentID: true,
				allowCommas: true
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
            $(element).text('OK!').addClass('valid')
                .closest('.control-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	$('#childrenID').keydown(function() {
		$('#childrenID').valid();
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