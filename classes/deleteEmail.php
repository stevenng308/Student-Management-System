<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process registration forms -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
//var_dump($_POST);
//var_dump($session);

if ($_POST['box'] == "inbox" || $_POST['box'] == "sent")
{
	foreach ($_POST['checkbox'] as $id)
	{
		$database->exec("UPDATE email SET box = '3' WHERE emailID = " . $id . "");
	}
}
else
{

	foreach ($_POST['checkbox'] as $id)
	{
		$database->exec("DELETE FROM email WHERE emailID = '" . $id . "'");
	}
}
?>
<!-- Custom styles for this template -->
<!--<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<form class="form-signin" style="text-valign:center">
			<h2><?php //echo $username ?> registered.</h2>
			<a class="btn btn-primary" href="../admin/register.php" role="button">Register More Users</a>
			<a class="btn btn-default" href="../admin/main.php" role="button">Return Home</a>
		</form>
	</div>
</div>-->
