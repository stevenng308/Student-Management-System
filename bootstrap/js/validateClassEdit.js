/*
* Author: Steven Ng
* Javascript to handle validating registration form
*/
$(document).ready(function () {
	 //rule for checking password confirmation
	 $.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg != value;
	 }, "Value must not equal arg.");
	
	//rule for checking course number uniqueness
	 $.validator.addMethod("checkCourse", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "../classes/checkCourse.php", // script to validate in server side
                data: {
						courseNum: $("#courseNum").val(),
						classID: $("#classid").val(),
						courseName: value
					  },
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
        "A course with the same number and name already exists. Please specify another course number or section (1001-XXXX)."
    );
	
	//rule for checking course number uniqueness
	 $.validator.addMethod("checkTeacher", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "../classes/checkTeacher.php", // script to validate in server side
                data: {
						teacherID: value
					  },
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
        "Teacher ID does not exist or the account has been deactivated."
    );
	
	//rule for allowing numbers and dash
	$.validator.addMethod("allowDash", 
        function(value, element, regexp) {
			var regex = new RegExp("^[0-9-]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Only numbers and a dash allowed. The number after the dash denotes a different course section"
	);
	
	//rule for allowing some symbols in the first and last name field
	$.validator.addMethod("noSpecialChars", 
        function(value, element, regexp) {
			var regex = new RegExp("^[a-zA-Z '-]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Only alphabetic characters, space, apostrophe and dash"
	);
	
	//rule for what is allowed in the date input
	$.validator.addMethod("dateFormat", 
        function(value, element, regexp) {
			var regex = new RegExp("^[0-9/]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Format the date as mm/dd/yyyy"
	);
	
	//rule for checking time input
	$.validator.addMethod("checkTime", 
        function(value, element) {
			var time1 = ($('#startTime').val()).split(":");
			var time2 = value.split(":");
			if (time2[0] >= time1[0])
			{
				if (time2[0] > time1[0])
				{
					return true;
				}
				else
				{
					if (time2[1] > time1[1])
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			else
			{
				return false;
			}
		},
		"Please select a later time"
	);
	
    $('#register-form').validate({
        rules: {
            courseNum: {
                minlength: 4,
				maxlength: 9,
				allowDash: true,
                required: true
            },
			courseName: {
                minlength: 2,
				maxlength: 25,
				noSpecialChars: true,
				checkCourse: true,
                required: true
            },
			startDate: {
                minlength: 10,
				maxlength: 10,
				dateFormat: true,
                required: true
            },
			startTime: {
                minlength: 5,
				maxlength: 5,
				//timeFormat: true,
                required: true
            },
			endDate: {
                minlength: 10,
				maxlength: 10,
				dateFormat: true,
                required: true
            },
			endTime: {
                minlength: 5,
				maxlength: 5,
				//timeFormat: true,
				checkTime: true,
                required: true
            },
			semester: {
                valueNotEquals: "semester"
            },
			schoolYear: {
                valueNotEquals: "0"
            },
			username: {
                minlength: 1,
				digits: true,
				checkTeacher: true,
                required: true
            }
        },
		messages: {
			semester: {
                valueNotEquals: "Select a semester"
            },
			schoolYear: {
                valueNotEquals: "Select a year"
            },
			username: {
				digits: "Teacher ID is necessary. Search for the ID by typing the teacher's username." 
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
	
	//handles the submit button onclick action. POSTs the form for processing and 
	//Success: loads the page into the div where the form was before
	//Fail: alerts the user that something is not correct
	$(function () {
		$('#register-form').submit(function () {
			if($(this).valid()) {
				//alert('Successful Validation');
				$.post(
					'../classes/processEditClass.php',
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
				//alert('Please correct the errors indicated.');
				$(function() {
					$( "#dialog-error" ).dialog({
							modal: true,
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
								}
							}
						});
					});
				return false;
			}
		});
	});                   
});