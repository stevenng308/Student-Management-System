<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- forgot username form -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$layout = new Layout();
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
echo $layout->loadFixedNavBar('Student Username Recovery Form', '');
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/grade.css" rel="stylesheet">
<link href="bootstrap/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<link href="bootstrap/css/jquery.ui.timepicker.css" rel="stylesheet">
	
<div class="formDiv" id="result">
	<form name="recoverUser" id="recoverUser-form" class="form-signin" action="#" method="post">
		<h3>Recover Username</h3>
		<h6>The fields are case sensitive</h6>
		<input type="text" class="form-control" name="role" id = "role" value="Student" readonly></input>
		<div class="control-group">
			<input type="text" class="form-control" name="studentid" id = "studentid" value="" placeholder="Student ID On Account"/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="firstname" id = "firstname" value="" placeholder="First Name On Account"/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="lastname" id = "lastname" value="" placeholder="Last Name On Account"/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="email" id = "email" value="" placeholder="Email Address On Account"/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control date" name="birthDate" id="birthDate" placeholder="Birthday On Account"/>
		</div>
		<br />				
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="recover" id="recover" value="recover username">Recover Username</button>
	</form>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script src="bootstrap/js/jquery-ui-1.10.4.custom.js"></script>
<script src="bootstrap/js/jquery.ui.timepicker.js"></script>
<script>
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
			$('#recover').focus();
		}
	});
	
	$('.date').keydown(function() { //disable keyboard input ont he date fields
		return false;
	});

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
	
	$('#recoverUser-form').validate({
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
			email: {
                required: true,
				maxlength: 50,
                email: true
            },
			studentid: {
                required: true,
				digits: true,
				maxlength: 20
            },
			birthDate: {
                required: true
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
		$('#recoverUser-form').submit(function () {
			if($(this).valid()) {
				//alert('Successful Validation');
				$.post(
					'classes/recoverStudentUsername.php',
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
</script>
</html>