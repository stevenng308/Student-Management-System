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
	header('Location: index.php');
}
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
$query = $database->query("SELECT emailID FROM email WHERE owner = '" . $session->getUserName() . "' AND box = '1'");
$inboxNum = $query->rowCount();
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Email', '');
?>
<link href="bootstrap/css/background.css" rel="stylesheet">
<link href="bootstrap/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">

<!-- Begin page content -->
<div class="container">
	<div class="row">	
		<div class="col-xs-6 col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li><a class="btn btn-default emailNav" role="button" id="compose" onclick="loadIn('compose')">Compose</a></li>
				<li><a class="btn btn-default emailNav active" role="button" id="inbox" onclick="loadIn('inbox')">Inbox <span id="inboxNum" class="badge badge-success"><?php echo $inboxNum; ?></span></a></li>
				<li><a class="btn btn-default emailNav" role="button" id="sent" onclick="loadIn('sent')">Sent</a></li>
				<li><a class="btn btn-default emailNav" role="button" id="trash" onclick="loadIn('trash')">Trash</a></li>
				<li><a class="btn btn-default emailNav" role="button" id="draft" onclick="loadIn('draft')">Draft</a></li>
			</ul>
		</div>
		<div id="mainDiv" class="col-xs-12 col-sm-6 col-md-8">
		</div>
	</div>
</div>
<div id="dialog-error" title="No Emails Selected" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>No emails were selected.</p>
</div>
<div id="dialog-error2" title="No Box Selected" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>Please specify a box.</p>
</div>
<div id="dialog-error3" title="Invalid Field" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>Please include a username, subject and message.</p>
</div>
<div id="dialog-confirm" title="Delete Email?" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Do you want to delete?</p>
</div>
<div id="dialog-confirm2" title="Move Email?" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Do you want to move the message/s?</p>
</div>
<div id="dialog-message" title="Email Sent" hidden="hidden">
	<p><span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>Email sent.</p>
</div>
<div id="dialog-message2" title="Email Saved" hidden="hidden">
	<p><span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>Email saved in draft box.</p>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="bootstrap/js/jquery-ui-1.10.4.custom.js"></script>	
<script src="bootstrap/js/loadInPage.js"></script>
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>-->
<script type="text/javascript" charset="utf-8">
$(window).load(function(){
	loadIn('inbox'); //load inbox first when navigating to email
	//loadIn('compose');
});

var lastBtn = "inbox";
$(".emailNav").click(function() {
	$('#' + lastBtn).toggleClass("active");
	$(this).toggleClass("active");
	lastBtn = this.id;
});
</script>
</html>
