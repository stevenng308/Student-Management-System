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
$classid = $_GET['classid'] or die(header('Location: error.php'));
$forum = $classid . "_forum";
?>
<!-- Begin page content -->
<div class="container jumbotron">
	<ol class="breadcrumb">
	  <li><a class="btn btn-link" onclick="loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>)">Discussion Topics</a></li>
	  <li class="active">New Topic</li>
	</ol>
	<form name="compose" id="topic-form" action="#" method="post">
		<div class="control-group">
		  <input id="subject" name="subject" type="text" class="form-control" placeholder="Subject">
		</div>
		
		<pre><textarea id="message" name="message" class="emailMessage"></textarea></pre>
		<input name="forum" value="<?php echo $forum; ?>" hidden="hidden"/>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="send">Send</button>
	</form>
</div>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script type="text/javascript" language="javascript" charset="utf-8">
$('#topic-form').validate({
	rules: {
		subject: {
			maxlength: 50
		}
	},
	highlight: function (element) {
		$(element).closest('.control-group').removeClass('has-success').addClass('has-error');
	},
	success: function (element) {
		element.addClass('valid')
			.closest('.control-group').removeClass('has-error').addClass('has-success');
	}
});

$(function () {
	$('#topic-form').submit(function () {
		if(document.getElementById("message").value && document.getElementById("subject").value) {
			//alert('Successful Validation');
			$.post(
				'classes/createTopic.php',
				$(this).serialize(),
				function(data){
				  //$("#forum").html(data);
				  //console.log(data);
				  alert("Discussion Topic Created.");
				  loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>);
				}
			  );
		  return false;
		}
		else
		{
			alert('Please include a subject and message.');
			return false;
		}
	});
});
</script>
</html>
