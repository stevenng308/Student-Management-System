<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process grade changes -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_POST);
$first = mysql_real_escape_string($_POST['firstname']);
$last = mysql_real_escape_string($_POST['lastname']);
$email = mysql_real_escape_string($_POST['email']);
$birth = mysql_real_escape_string($_POST['birthDate']);
$birth = date('Y-m-d', strtotime(mysql_real_escape_string($_POST['birthDate'])));
$id = mysql_real_escape_string($_POST['studentid']);
$query = $database->query("SELECT username FROM " . $_POST['role'] . " WHERE firstname = '" . $first . "' AND lastname = '" . $last . "' AND email = '" . $email . "' AND DOB = '" . $birth . "' AND studentID = '" . $id . "' LIMIT 1");
if ($query->rowCount() == 0)
{
	//echo $birth . ' ' . $query->rowCount();
	echo '
			<!-- Custom styles for this template -->
			<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

			<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
				<div class="jumbotron">
				<h2>Username could not be found.</h2>
					<div class="container" style="text-align: center;">
						<a class="btn btn-primary" href="index.php" role="button">Return Home</a>
					</div>
				</div>
			</div>
		';
}
else
{
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	echo '
			<!-- Custom styles for this template -->
			<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

			<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
				<div class="jumbotron">
				<h2>Username is: <b><u>' . $result[0]['username'] . '</u></b>.</h2>
					<div class="container" style="text-align: center;">
						<a class="btn btn-primary" href="index.php" role="button">Return Home</a>
					</div>
				</div>
			</div>
		';
}
?>
