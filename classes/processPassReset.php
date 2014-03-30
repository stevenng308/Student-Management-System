<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process reseting passwords*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$pass = mysql_real_escape_string($_POST['password']);

$user = new User($database, $_POST['id'], $_POST['role']);
function createSalt()
{
	$text = md5(uniqid(rand(), true));
	return substr($text, 0, 3);
}
$hash = hash('sha256', $pass);		
$salt = createSalt();
//while (true)
//echo $salt;
$pass = hash('sha256', $salt . $hash); //salting password
$user->setPassword($pass);
$user->setSalt($salt);
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<div class="container" style="text-valign:center">
			<h3>Password has been reset. You may now log into your account.</h3>
			<a class="btn btn-primary" href="index.php" role="button">Return Home</a>
		</div>
	</div>
</div>