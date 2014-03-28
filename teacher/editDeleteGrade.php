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

//var_dump($_SESSION);
//var_dump($session);
$query = $database->query("SELECT username, firstname, lastname FROM student WHERE studentid = " . $id . "");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$query = $database->query("SELECT gradeID, label, grade FROM grade WHERE studentid = " . $id . " AND classid = " . $class . "");
$grade = $query->fetchAll(PDO::FETCH_ASSOC);
//var_dump($grade);
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Edit/Delete Grade Form', '../');
?>
	<!-- Custom styles for this template -->
	<link href="../bootstrap/css/grade.css" rel="stylesheet">
	<div class="formDiv" id="result">
	<form name ="grade" id="grade-form" class="form-signin" action="#" method="post">
		<h4 class="form-signin-heading" style="text-align: center;"><?php echo $result[0]['username'] . ' &lt' . $result[0]['firstname'] . ' ' . $result[0]['lastname'] . '&gt '?>Grades</h4>
		<h6>Change the necessary grades or check the box of the grades you wish to delete.</h6>
			<?php
				for ($j = 0; $j < count($grade); $j++)
				{
					echo '	
							<div class="control-group">
								<div class="row">
									<div class="col-xs-6 col-md-2">
										<input name="delete' . $j . '" id="delete' . $j . '" type="checkbox" value="' . $grade[$j]['gradeID'] . '">
									</div>
									<div class="col-xs-6 col-md-5">
										<div class="control-group">
											<input type="text" class="form-control" name="label' . $j . '" id="label' . $j . '" value="' . $grade[$j]['label'] . '" placeholder="Grade Label"/>
										</div>
									</div>
									<div class="col-xs-6 col-md-5">
										<div class="control-group">
											<input type="text" class="form-control grade" name="grade' . $j . '" id="grade' . $j . '" value="' . $grade[$j]['grade'] . '" placeholder="Grade"/>
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
<?php
	echo $layout->loadFooter('../');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
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

	//rule for allowing spaces but no symbols
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
        /*groups: groupsObj,
		rules: rules,
		messages: messages*/
		highlight: function (element) { //defines the red highlight in the jquery validator setting
            $(element).closest('.control-group').removeClass('has-success').addClass('has-error'); 
        },
        success: function (element) { //defines the green highlight in the jquery validator setting
            $(element).addClass('valid')
                .closest('.control-group').removeClass('has-error').addClass('has-success'); 
        }
    });
	
	$('input[name^="label"]').each(function () { //use .each on every input with name beginning label to add the rules to each of them
		$(this).rules("add", {
			required: true,
			maxlength: 50,
			allowSpaces: true
		});
	});
	
	$('input[name^="grade"]').each(function () { //use .each on every input with name beginning grade to add the rules to each of them
		$(this).rules("add", {
			required: true,
			maxlength: 6,
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
					'../classes/processChangeGrade.php',
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