<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- edit guardians form -->

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

$account_id = $_GET['accountid'] or die("Account ID not provided");
$userType = $_GET['role'] or die("Account type not provided");
$table = "Student";

$user= new user($database, $account_id, $table);
//var_dump($user);
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Edit Guardian Form', '../');
?>
	<!-- Custom styles for this template -->
	<link href="../bootstrap/css/register.css" rel="stylesheet">
	<div class="formDiv" id="result">
	<form name ="register" id="register-form" class="form-signin" action="#" method="post">
		<h2 class="form-signin-heading">Personal Information</h2>
		<div class="control-group">
			<input type="text" class="form-control" name="firstname" id = "firstname" value="<?php echo $user->getFirstName(); ?>"/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="lastname" id = "lastname" value="<?php echo $user->getLastName(); ?>"/>
		</div>
		<br />
		<!--<label for="birthday">Birthdate: 01-01-1970</label>-->
		<div class="row">
			<div class="col-xs-6 col-md-4">
				<div class="control-group">
					<input type="text" class="form-control" name="month" id="month" value="<?php echo $user->getMonth(); ?>"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="control-group">
					<input type="text" class="form-control" name="day" id="day" value="<?php echo $user->getDay(); ?>"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="control-group">
					<input type="text" class="form-control" name="year" id="year" value="<?php echo $user->getYear(); ?>"/>
				</div>
			</div>
		</div>
		<br />
		<div class="control-group">
			<input type="text" class="form-control" name="street" id = "street" value="<?php echo $user->getStreet(); ?>"/>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-7">
				<div class="control-group">
					<input type="text" class="form-control" name="city" id="city" value="<?php echo $user->getCity(); ?>"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-5">
				<div class="control-group">
					<select id="state" name="state" class="form-control">
						<option selected="selected" value="<?php echo $user->getState(); ?>"><?php echo $user->getState(); ?></option>
							<option value="AL">AL</option>
							<option value="AK">AK</option>
							<option value="AZ">AZ</option>
							<option value="AR">AR</option>
							<option value="CA">CA</option>
							<option value="CO">CO</option>
							<option value="CT">CT</option>
							<option value="DE">DE</option>
							<option value="DC">DC</option>
							<option value="FL">FL</option>
							<option value="GA">GA</option>
							<option value="HI">HI</option>
							<option value="ID">ID</option>
							<option value="IL">IL</option>
							<option value="IN">IN</option>
							<option value="IA">IA</option>
							<option value="KS">KS</option>
							<option value="KY">KY</option>
							<option value="LA">LA</option>
							<option value="ME">ME</option>
							<option value="MD">MD</option>
							<option value="MA">MA</option>
							<option value="MI">MI</option>
							<option value="MN">MN</option>
							<option value="MS">MS</option>
							<option value="MO">MO</option>
							<option value="MT">MT</option>
							<option value="NE">NE</option>
							<option value="NV">NV</option>
							<option value="NH">NH</option>
							<option value="NJ">NJ</option>
							<option value="NM">NM</option>
							<option value="NY">NY</option>
							<option value="NC">NC</option>
							<option value="ND">ND</option>
							<option value="OH">OH</option>
							<option value="OK">OK</option>
							<option value="OR">OR</option>
							<option value="PA">PA</option>
							<option value="RI">RI</option>
							<option value="SC">SC</option>
							<option value="SD">SD</option>
							<option value="TN">TN</option>
							<option value="TX">TX</option>
							<option value="UT">UT</option>
							<option value="VT">VT</option>
							<option value="VA">VA</option>
							<option value="WA">WA</option>
							<option value="WV">WV</option>
							<option value="WI">WI</option>
							<option value="WY">WY</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-7">
				<div class="control-group">
					<input type="text" class="form-control" name="zip" id="zip" value="<?php echo $user->getZip(); ?>"/>
				</div>
			</div>
		</div>
		<br />
		<div class="control-group">
			<input type="text" class="form-control" name="email" id = "email" value="<?php echo $user->getEmail(); ?>"/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="contact" id = "contact" value="<?php echo $user->getContact(); ?>"/>
		</div>
		<h2 class="form-signin-heading">Account Information</h2>
		
		<input type="text" class="form-control" name="type" id = "type" value="<?php echo $table;?>" placeholder="Account Type" readonly/>
		<!-- <select id="type" name="type" class="form-control">
			  <option selected="selected" value=<?php echo $user->getRole(); ?>><?php echo $table; ?></option>
			  <?php 
				for ($i = 1; $i < 4; $i++)
				{
					if ($i != $user->getRole())
					{
						switch ($i)
						{
							case 1: $text = "Administrator";
									break;
							case 2: $text = "Teacher";
									break;
							case 3: $text = "Parent";
									break;
						}
						echo '<option value="' . $i . '">' . $text . '</option>';
					}
				}
			  ?>
			</select> -->

		<div class="control-group">
			<input type="text" class="form-control" name="username" id = "username" value="<?php echo $user->getUserName(); ?>" readonly/>
		</div>
		<div class="control-group">
			<input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
		</div>
		<div class="control-group">
			<input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password"/>
			<label for="password">Leave password fields blank if not changing the password</label>
		</div>
		<br />
		<div class="control-group">
			<input class="form-control" name="studentid" id="studentid" value="<?php echo $user->getStudentID(); ?>" readonly/>
		</div>
		<div class="checkbox"">
			<label>
				<?php ($user->getStatus() ? $check = '<input name="status" id="status" type="checkbox" checked> Active Account' : $check = '<input name="status" id="status" type="checkbox"> Active Account');
				echo $check;?>
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">Submit</button>				
	</div>
<?php
	echo $layout->loadFooter('../');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script src="../bootstrap/js/validateEditRegister.js"></script>
</html>