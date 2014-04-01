<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- change password form -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
$id = $_GET['id'] or die(header("Location: error.php"));
$myKey = $_GET['myKey'] or die(header("Location: error.php"));
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$query = $database->query("SELECT accountID, role, expire FROM reset WHERE id = " . $id . " AND myKey = '" . $myKey . "'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$current = new DateTime();
if ($query->rowCount() == 0)
{
	header('Refresh: 8; url=index.php');
	echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
	exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
	style="text-align: center; vertical-align: middle"><p>The reset link is incorrect or the link has expired. Please request another password reset. This page will redirect you to the SMS homepage.</p></div></body></html>');
}
else if ($result[0]['expire'] < $current->format('Y-m-d H:i:s'))
{
	header('Refresh: 8; url=index.php');
	echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
	exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
	style="text-align: center; vertical-align: middle"><p>The reset link has expired. Please request another password reset. This page will redirect you to the SMS homepage.</p></div></body></html>');
}
else
{
	$id = $result[0]['accountID'];
	$role = $result[0]['role'];
	//$database->exec("DELETE FROM reset WHERE myKey = '" . $myKey . "'");
	switch ($role)
	{
		case 1: $table = "Admin";
				break;
		case 2: $table = "Teacher";
				break;
		case 3: $table = "Student";
				break;
		case 4: $table = "Parent";
				break;
		default: header('Location: error.php');
				break;
	}
}
echo $layout->loadFixedNavBar('Reset Password Form', '');
?>
	<!-- Custom styles for this template -->
	<link href="bootstrap/css/grade.css" rel="stylesheet">
	
<div class="formDiv" id="result">
	<form name="changePassword" id="changePassword-form" class="form-signin" action="#" method="post">
		<h3>New Password</h3>
		<input name="id" id="id" hidden="hidden" value="<?php echo $id; ?>"></input>
		<input type="text" class="form-control" name="role" id = "role" value="<?php echo $table; ?>" readonly></input>
		<div class="control-group">
			<input type="password" class="form-control" name="password" id = "password" value="" placeholder="New Password"/>
		</div>
		<div class="control-group">
			<input type="password" class="form-control" name="password2" id = "password2" value="" placeholder="Confirm Password"/>
		</div>		
		<br />				
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="change" id="change" value="change password">Change Password</button>
	</form>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script>
$(document).ready(function () {
	//rule for checking password confirmation
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg != value;
	 }, "Value must not equal arg.");
	
	$('#changePassword-form').validate({
        rules: {
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
            }
		},
		messages: {
			password2: {
				equalTo: "Password confirmation does not match"
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
		$('#changePassword-form').submit(function () {
			if($(this).valid()) {
				//alert('Successful Validation');
				$.post(
					'classes/processPassReset.php',
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