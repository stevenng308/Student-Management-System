<html>
<?php
include 'main.php';
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
?>


<!-- Custom styles for this template -->
<link rel="stylesheet" href="bootstrap/css/jquery-ui-1.10.4.custom.css" type="text/css" /> 


<head>
	<title>Admin's Message Board</title>
	</head>
	<body>
	Message Created on 01/10/2014 by Admin : New Discussion About the increase in Cafeteria Prizes: $Message<br />
	<form method ="post" action="Messagetest.php">
		Create New Message, Enter here:
		<input type="text" message="Message" />
		<input type = "Post" />
		</form>
		</body>


<div class="container jumbotron">
	<br />
	<form name="compose" id="compose-form" action="#" method="post">
		<pre><textarea id="message" name="message" class="emailMessage"></textarea></pre>
		<button class="btn btn-success btn-xs" onclick="postMsg()">Submit Post</button>
	</form>
</div>

<script src="bootstrap/js/jquery-ui-1.10.4.custom.js"></script>	
<script src="bootstrap/js/compose.js"></script>
<script>
function postMsg()
{
	$.post(
		'admin/postMessage.php',
		{
			'message' : $('#message').val()
		},
		function(data){
		  $("#mainDiv").html(data);
		}
	  );
  return false;
}
</script>
</html>