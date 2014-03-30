<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- forgot form -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
$type = $_GET['type'] or die(header("Location: error.php"));
$layout = new Layout();
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
echo $layout->loadFixedNavBar('Recovery Form', '');
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/grade.css" rel="stylesheet">
	
<div class="formDiv" id="result">
	<form name="recover" id="recover-form" class="form-signin" action="#" method="post">
		<div align="center">
			<h2>Choose Account type:</h2>
			<select id="role" name="role" class="form-control">
			  <option selected="selected">Choose One</option>
			  <option value="1">Administrator</option>
			  <option value="2">Teacher</option>
			  <option value="3">Student</option>
			  <option value="4">Parent</option>
			</select>
		</div>
	</form>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script>
$(function(){
	// bind change event to select
	$('#role').bind('change', function () {
		var role = $(this).val(); // get selected value
		var type = <?php echo $type; ?>;
		if (role != 3) { // require a URL
			//need to keep role for the table this user will be inserted
			if (type == 1)
			{
				window.location.href = "forgotUserName.php?role=" + role;
			}
			else
			{
				window.location.href = "forgotPassword.php?role=" + role;
			}
		}
		else
		{
			if (type == 1)
			{
				window.location.href = "forgotUserNameStudent.php";
			}
			else
			{
				window.location.href = "forgotPassword.php?role=" + role;
			}
		}
		return false;
	});
});
</script>
</html>