<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- register -->

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
	if($_SESSION['sess_role'] != 1)
	{
		header('Location: ../index.php');
		echo '
			<div><p color="red">You do not have the correct privileges to access this page.</p></div>
		';
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
//var_dump($_SESSION);
//var_dump($session);

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Registration', '../');
?>
<!-- Custom styles for this template -->
<link href="../bootstrap/css/register.css" rel="stylesheet">

<!-- Begin page content -->
<div class="container">
	<form class="form-signin" role="form">
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
	<div id="formDiv" class="formDiv">
	</div>
</div>
<?php
	echo $layout->loadFooter('../');
?>
<script>
$(function(){
	// bind change event to select
	$('#role').bind('change', function () {
		var role = $(this).val(); // get selected value
			if (role != 3) { // require a URL
				//need to keep role for the table this user will be inserted
				window.location.href = "guardianForm.php?role=" + role;
			}
			else
			{
				//$('#formDiv').load('studentForm.php');
				window.location.href = "studentForm.php";
			}
			return false;
		});
	});
</script>
</html>
