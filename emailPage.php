<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- email page-->

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

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Email', '');
?>

<!-- Begin page content -->
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li><a class="btn btn-default emailNav" role="button" id="compose" onclick="loadIn('compose')">Compose</a></li>
				<li><a class="btn btn-default emailNav" role="button" id="inbox" onclick="loadIn('inbox')">Inbox</a></li>
				<li><a class="btn btn-default emailNav" role="button" id="sent" onclick="loadIn('sent')">Sent</a></li>
				<li><a class="btn btn-default emailNav" role="button" id="trash" onclick="loadIn('trash')">Trash</a></li>
			</ul>
		</div>
		<div id="mainDiv" class="col-xs-12 col-sm-6 col-md-8">
		</div>
	</div>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="bootstrap/js/loadInPage.js"></script>
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>-->
<script type="text/javascript">
$(window).load(function(){
	loadIn('inbox'); //load inbox first when navigating to email
});
	
function moveEmail()
{
	if (!values)
	{
		alert("No emails were selected.");
	}
	else if ($('#box').val() < 1)
	{
		alert("Please specify a box.");
	}
	else
	{
		if (window.confirm("Do you want to move to message/s?"))
		{
			//alert(values);
			//alert($('#box').val());
			$.post(
				'classes/moveEmail.php',
				{
					'checkbox' : values, 
					'box' : $('#box').val()
				},
				function(data){
				  //$("#mainDiv").html(data);
				  //console.log(data);
				  loadIn('inbox')
				}
			  );
		  return false;
		}
		else
		{
			;//do nothing
		}
	}
}
</script>
</html>
