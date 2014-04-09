/*
* Author: Steven Ng
* Javascript to handle validating edit form
*/
$(document).ready(function () {

	$("#birthDate").datepicker({
		maxDate: 0,
		changeMonth: true,
		changeYear: true,
		yearRange: "1900:2100",
		onSelect: function() { //after selection focus on that input box so validation can refresh
			this.focus();
		},
		onClose: function() {
			$('#street').focus();
		}
	});
	
	$('.date').keydown(function() { //disable keyboard input ont he date fields
		return false;
	});
	
	var email = document.getElementById('email').value;
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
        "Email has been registered. Please make sure the User you are trying to register is not already registered."
    );
	
	//rule for checking if student ID exist
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
        "One or more Student IDs do not exist. Please make sure the student you are trying to associate with has been created and has a Student ID number."
    );
	
	//rule for checking if student ID is unique
	$.validator.addMethod("checkStudentIDUnique", 
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
						result = false;
					}
					else
					{
						result = true;
					}
                    //result = (data) ? true : false;
                }
            });
            return result; 
        }, 
        "This Student ID has been taken"
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
	
	//rule for allowing some symbols in the city
	$.validator.addMethod("cityRule", 
        function(value, element, regexp) {
			var regex = new RegExp("^[a-zA-Z'. ]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Invalid character entered"
	);
	
	//rule for allowing spaces but no symbols in street field
	$.validator.addMethod("allowSpaces", 
        function(value, element, regexp) {
			var regex = new RegExp("^[a-zA-Z0-9. ]+$");
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
				cityRule: true,
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
			/*username: {
                required: true,
				alphanumeric: true,
				maxlength: 25,
				checkUsername: true	
            },*/
			password: {
                //required: true,
				//alphanumeric: true,
				noSpaces: true,
				minlength: 6,
				maxlength: 16
            },
			password2: {
                //required: true,
				minlength: 6,
				maxlength: 16,
				noSpaces: true,
				//alphanumeric: true,
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
            element.addClass('valid')
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
					'../classes/processEdit.php',
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