<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- add grades form -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	if($_SESSION['sess_role'] == 3 || $_SESSION['sess_role'] == 4)
	{
		header('Refresh: 1.5; url=../index.php');
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}
else
{
	header('Location: ../index.php');
}
$layout = new Layout();
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);

if ($session->getUserType() == 1)
{
	$header = "Location: ../admin/error.php";
}
else
{
	$header = "Location: error.php";
}
$id = $_GET['id'] or die(header($header));
$class = $_GET['class'] or die(header($header));
if (isset($_GET['field']))
{
	$field = $_GET['field'];
}
else
{
	$field = 0;
}
//var_dump($_SESSION);
//var_dump($session);
$query = $database->query("SELECT username, firstname, lastname FROM student WHERE studentid = " . $id . "");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Grade Form', '../');
?>
	<!-- Custom styles for this template -->
	<link href="../bootstrap/css/grade.css" rel="stylesheet">
	<link href="../bootstrap/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	
	<div class="formDiv" id="result">
	<form name ="grade" id="grade-form" class="form-signin" action="#" method="post">
		<h4 class="form-signin-heading" style="text-align: center;"><?php echo $result[0]['username'] . ' &lt' . $result[0]['firstname'] . ' ' . $result[0]['lastname'] . '&gt '?>Grades</h4>
		<div class="row">
		<div class="col-xs-6 col-md-1">
		</div>
		<div class="col-xs-6 col-md-6">
			<h4>Num of grades:</h4>
		</div>
		<div class="col-xs-6 col-md-4">
		<select id="field" class="form-control">
			<option selected="selected" value="<?php echo $field; ?>"><?php echo $field; ?></option>
			<?php
				for ($i = 0; $i < 11; $i++)
				{
					if ($field != $i)
					{
						echo '<option value="' . $i . '">' . $i . '</option>';
					}
				}
				echo '</select></div>
					
					</div>
					<br />';
				for ($j = 0; $j < $field; $j++)
				{
					echo '
							<div class="control-group">
								<div class="row">
									<div class="col-xs-6 col-md-6">
										<div class="control-group">
											<input type="text" class="form-control" name="label' . $j . '" id="label' . $j . '" placeholder="Grade Label"/>
										</div>
									</div>
									<div class="col-xs-6 col-md-6">
										<div class="control-group">
											<input type="text" class="form-control grade" name="grade' . $j . '" id="grade' . $j . '" placeholder="Grade"/>
										</div>
									</div>
								</div>
							</div>
							<br />
						';
				}
			?>
		<input name="id" id="id" value="<?php echo $id; ?>" hidden="hidden"/>
		<input name="class" id="class" value="<?php echo $class; ?>" hidden="hidden"/>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="addGrade">Submit</button>
	</form>
</div>
<div id="dialog-error" title="Invalid Fields" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>Please correct the errors indicated.</p>
</div>
<?php
	echo $layout->loadFooter('../');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script src="../bootstrap/js/jquery-ui-1.10.4.custom.js"></script>

<script>
$(function(){
	// bind change event to select
	$('#field').bind('change', function () {
		var field = $(this).val(); // get selected value
		var id = <?php echo $id ?>;
		var classid = <?php echo $class ?>;
		if (field) { // require a URL
		window.location = "addGrade.php?id=" + id + "&class=" + classid + "&field=" + field ; // redirect
		}
		return false;
	});
});

$(document).ready(function () {

	//rule for checking unique labels within the form
	$.validator.addMethod("valueNotEquals", function(value, element){
			var labels = $('input[name^="label"]');
			for (i = 0; i < labels.length; i++)
			{
				//alert(element == $(labels[i]));
				if (element !== labels[i])
				{
					if (value === $(labels[i]).val())
						return false;
				}
			}
			return true;
		}, 
		"Grade label is being used in this form"
	 );
	 
	 //rule for checking if grade has been set
	$.validator.addMethod("checkStudentGrade", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "../classes/checkStudentGrade.php", // script to validate in server side
                data: { label: value,
						id: <?php echo $id; ?>,
						classid: <?php echo $class; ?>
						},
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
        "This Student has a grade with this label already"
    );
	
	//rule for allowing up to 2 decimal places
	$.validator.addMethod("twoDecimals", 
        function(value, element, regexp) {
			//var regex = new RegExp(/^(?!0\.00)[1-9](\d*\.\d{1,2}|\d+)$/);
			var regex = new RegExp(/^([0]\d{0}?)?([1-9]\d*)?(\.\d{1,2})?$/);
			var regexText = new RegExp("^[A-DF]+$");
			var key = value;
			
			/*if (!regex.test(key)) {
			   return false;
			}
			return true;*/
			if (regexText.test(key))
			{
				return true;
			}
			else
			{
				if (!regex.test(key)) {
				   return false;
				}
				else
				{
					return true;
				}
			}
		},
		"Invalid format. One leading 0, up to two decimal places (99.99) and letters A-D and F allowed"
	);
	
	//rule for allowing only 1 zero preceding decimal or just 0
	$.validator.addMethod("leadZero", 
        function(value, element, regexp) {
			//var regex = new RegExp(/^(?!0\.00)[1-9](\d*\.\d{1,2}|\d+)$/);
			var regexNum = new RegExp(/^\d$/);
			var key = value;

			//alert(key.charAt(2));
			if (key.charAt(0) == 0 && regexNum.test(key.charAt(1)))
			{
				return false;
			}
			return true;
		},
		"Invalid format. Remove leading zeroes if the number is not less than 1 or is not a decimal number"
	);
	
	//overloading range rule
	$.validator.addMethod("range", 
        function(value, element, regexp) {
			//var regex = new RegExp(/^(?!0\.00)[1-9](\d*\.\d{1,2}|\d+)$/);
			var regex = new RegExp("^[A-DF]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   if (key < 0 || key > 100)
			   {
					return false;
			   }
			   else
			   {
					return true
			   }
			}
			return true;
		},
		"Please enter a value between 0-100"
	);
	
	//overloading maxlength rule
	$.validator.addMethod("maxlengthGrade", 
        function(value, element, regexp) {
			//var regex = new RegExp(/^(?!0\.00)[1-9](\d*\.\d{1,2}|\d+)$/);
			var regex = new RegExp("^[A-DF]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   if (key.length < 7)
			   {
					return true;
			   }
			   else
			   {
					return false;
			   }
			}
			else
			{
				if (key.length < 2)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		},
		"Max length for letter grades is 1. Max length for numerical grades is 6 (including decimal)"
	);
	 
	//rule for allowing certain characters for grades
	$.validator.addMethod("noSpecial", 
        function(value, element, regexp) {
			var regex = new RegExp("^[A-DF0-9.]+$");
			var key = value;
			
			if (!regex.test(key)) {
			   return false;
			}
			return true;
		},
		"Letters A-D and F allowed"
	);
	
	//rule for allowing spaces
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
	
	$('#grade-form').validate({
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            $(element).addClass('valid')
                .closest('.control-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	$('input[name^="label"]').each(function () { //use .each on every input with name beginning label to add the rules to each of them
		$(this).rules("add", {
			required: true,
			maxlength: 50,
			allowSpaces: true,
			valueNotEquals: true,
			checkStudentGrade: true
		});
	});
	
	$('input[name^="grade"]').each(function () { //use .each on every input with name beginning grade to add the rules to each of them
		$(this).rules("add", {
			required: true,
			maxlengthGrade: true,
			range: true,
			twoDecimals: true,
			leadZero: true,
			noSpecial: true
		});
	});
	
	/*$('[name^="label"]').keyup(function() { //validate on key downs since no longer in the init of the validator above
		$(this).valid();
	});
	$('[name^="grade"]').keydown(function() { //validate on key downs since no longer in the init of the validator above
		$(this).valid();
	});*/
	
	$('[id^="label"]').change().keyup(function() { //validate when there is a change and a key is released on a input with label in its name
		$(this).valid();
		//$("#grade0").valid();
	});
	
	$('.grade').change().keyup(function() { //validate when there is a change and a key is released on a input with grade in its name
		$(this).valid();
		//$("#grade0").valid();
	});
	
	//handles the submit button onclick action. POSTs the form for processing and 
	//Success: loads the page into the div where the form was before
	//Fail: alerts the user that something is not correct
	$(function () {
		$('#grade-form').submit(function () {
			if($(this).valid()) {
				//alert('Successful Validation');
				$.post(
					'../classes/processAddGrade.php',
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
</script>
</html>