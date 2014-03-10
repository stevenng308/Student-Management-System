<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- compose an email -->

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
	/*if($_SESSION['sess_role'] != 1)
	{
		header('Refresh: 1.5; url=../index.php');
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}*/
}
else
{
	header('Location: ../index.php');
}
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
$email = new Email($database, $session->getUserName(), $_GET['id']);
?>
<!-- Custom styles for this template -->
<link rel="stylesheet" href="bootstrap/css/jquery-ui-1.10.4.custom.css" type="text/css" /> 

<!-- Begin page content -->
<div class="container jumbotron">
	<ol class="breadcrumb">
	  <li><a href="#" class="btn btn-sm disabled emailNav" role="button">Email</a></li>
	  <li><a a class="btn btn-sm emailNav" role="button" id="compose" onclick="loadIn('compose')">Compose</a></li>
	</ol>

	<form name="compose" id="compose-form" action="#" method="post">
		<div class="control-group">
		<div class="input-group">
		  <span class="input-group-addon">To:</span>
		  <input id="username" name="username" type="text" class="form-control" value="<?php echo $email->getFromUser(); ?>,">
		</div>
		</div>
		<div class="input-group">
		  <span class="input-group-addon">Subject:</span>
		  <input id="subject" name="subject" type="text" class="form-control" placeholder="" value="RE: <?php echo $email->getSubject(); ?>">
		</div><br />
		<pre><textarea id="message" name="message" class="emailMessage">&#13;&#10; --------------------------------------------------------
From: <?php echo $email->getFromUser()  . '<' . $email->getFromFirst() . ' ' . $email->getFromLast() . '>'; ?>
&#13;&#10;Subject: <?php echo $email->getSubject(); ?>&#13;&#10;<?php echo $email->getMessage(); ?></textarea></pre>
		<button class="btn btn-lg btn-primary btn-block pull-right" type="submit" name="submit" value="send">Send</button>
	</form>
</div>

<script src="bootstrap/js/jquery-ui-1.10.4.custom.js"></script>	
<script src="bootstrap/js/compose.js"></script>	
</html>
