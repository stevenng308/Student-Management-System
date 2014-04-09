<!-- Student Management System -->
<!-- Author: Andre Vicente Integration/Validation: Steven Ng -->
<!-- add grades form -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	if($_SESSION['sess_role'] == 3)
	{
		header('Refresh: 1.5; url=index.php');
		echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}
else
{
	header('Location: index.php');
}
$layout = new Layout();
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);

if ($session->getUserType() == 1)
{
	$header = "Location: admin/error.php";
}
else if ($session->getUserType() == 2)
{
	$header = "Location: teacher/error.php";
}
else
{
	$header = "Location: parent/error.php";
}
$id = $_GET['id'] or die(header($header));
//var_dump($_SESSION);
//var_dump($session);
$query = $database->query("SELECT * FROM student WHERE studentID = " . $id . "");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$user = new User($database, $result[0]['accountID'], 'student');
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Add Money Form', '');
?>
	<!-- Custom styles for this template -->
	<link href="bootstrap/css/register.css" rel="stylesheet">
	<div class="formDiv" id="result">
	<form name="addBalance" id="addBalance-form" class="form-signin" action="#" method="post">
		<h2 class="form-signin-heading" style="text-align: center;"><?php echo $user->getFirstName() . ' ' . $user->getLastName() . ' ';?></h2>
		<div class="table-responsive">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th style="text-align: center;" colspan="6">
							<h3>Account Information</h3>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Student ID</td>
						<td>
							<?php echo $user->getStudentID(); ?>
						</td>
					</tr>
					<tr>
						<td>Username</td>
						<td>
							<?php echo $user->getUserName(); ?>
						</td>
					</tr>
					<tr>
						<td>First Name</td>
						<td>
							<?php echo $user->getFirstName(); ?>
						</td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td>
							<?php echo $user->getLastName(); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
				<h3>Add Money to Balance</h3>
				<h4>Account Balance: <?php echo $user->getBalanceFormatted(); ?></h4>
				<div class="control-group">
					<input type="text" class="form-control" name="addingBalance" id = "addingBalance" value="" placeholder="Amount To Add"/>
				</div>
				<h3>Card Information</h3>
				<div class="control-group">
					<input type="text" class="form-control" name="cardHolderName" id = "cardHolderName" value="" placeholder="Cardholder's Name"/>
				</div>		
				<div class="control-group">
					<input type="text" class="form-control" name="creditCardNumber" id = "creditCardNumber" value="" placeholder="Credit Card Number"/>
				</div>
				<label for="expiration">Expiration Info: </label>
				<div class="row">
					<div class="col-xs-6 col-md-4">
						<div class="control-group">
							<input type="text" class="form-control" name="monthExpiration" id = "monthExpiration" value="" placeholder="Month"/>
						</div>
					</div>
					<div class="col-xs-6 col-md-5">
						<div class="control-group">
							<input type="text" class="form-control" name="yearExpiration" id = "yearExpiration" value="" placeholder="Year"/>
						</div>
					</div>
				</div>
				<br /> 
				<input id="studentID" name="studentID" value="<?php echo $id; ?>" hidden="hidden"/>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="add" id="add" value="add money">Add to Account</button>
	</form>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script src="bootstrap/js/addMoney.js"></script>
</html>