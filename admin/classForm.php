<html>
<?php
/**Student Management System -->
<!-- Author: Steven Ng -->
<!-- class creation form*/
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

//var_dump($_SESSION);
//var_dump($session);

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Add Class Form', '../');
?>
	<!-- Custom styles for this template -->
	<link href="../bootstrap/css/register.css" rel="stylesheet">
	<link href="../bootstrap/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<link href="../bootstrap/css/jquery.ui.timepicker.css" rel="stylesheet">
	
	<div class="formDiv" id="result">
	<form name ="register" id="register-form" class="form-signin" action="#" method="post">
		<h2 class="form-signin-heading">Classroom Info.</h2>
		<div class="control-group">
			<input type="text" class="form-control" name="courseNum" id="courseNum" placeholder="Course Number" autofocus/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="courseName" id="courseName" placeholder="Course Name"/>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-6 col-md-6">
				<div class="control-group">
					<label for="startDate">Start Date</label>
					<input type="text" class="form-control date" name="startDate" id="startDate" placeholder="Date"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-6">
				<div class="control-group">
					<label for="endDate">End Date</label>
					<input type="text" class="form-control date" name="endDate" id="endDate" placeholder="Date"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-6">
				<div class="control-group">
					<label for="startTime">Start Time</label>
					<input type="text" class="form-control time" name="startTime" id="startTime" placeholder="Time"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-6">
				<div class="control-group">
					<label for="endTime">End Time</label>
					<input type="text" class="form-control time" name="endTime" id="endTime" placeholder="Time"/>
				</div>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="col-xs-6 col-md-6">
				<div class="control-group">
					<select id="semester" name="semester" class="form-control">
						<option selected="selected" value="semester">Semester</option>
						<option value="Spring">Spring</option>
						<option value="Fall">Fall</option>
					</select>
				</div>
			</div>
			<div class="col-xs-6 col-md-6">
				<div class="control-group">
					<select id="schoolYear" name="schoolYear" class="form-control">
						<option selected="selected" value="0">Year</option>
						<?php
							$currentYear = date('Y');
							$nextYear = $currentYear + 1;
							$schoolYear = $currentYear . "-" . $nextYear;
							for ($i = 0; $i < 15; $i++)
							{
								echo "<option value=" . $schoolYear . ">" . $schoolYear . "</option>";
								$currentYear++;
								$nextYear++;
								$schoolYear = $currentYear . "-" . $nextYear;
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<input id="username" name="username" type="text" class="form-control" placeholder="Assigned Teacher's Username">
		<br />
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">Submit</button>
	</form>
</div>
<?php
	echo $layout->loadFooter('../');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script src="../bootstrap/js/jquery-ui-1.10.4.custom.js"></script>
<script src="../bootstrap/js/jquery.ui.timepicker.js"></script>
<script src="../bootstrap/js/classForm.js"></script>
<script src="../bootstrap/js/validateClassCreate.js"></script>
</html>