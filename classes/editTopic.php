<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- editing topics*/
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	if($_SESSION['sess_role'] == 4 || $_SESSION['sess_role'] == 3)
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
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
//var_dump($_POST);
//var_dump($session);
$topicid = $_POST['checkbox'][0];
$classid = $_POST['classID'];
$query = $database->query("SELECT * FROM forum WHERE topicID = " . $topicid . "");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$num = $database->query("SELECT * FROM response WHERE topicid = " . $topicid . "");
$topic = new Topic($result[0], $num->rowCount());
?>
<div class="container jumbotron">
	<ol class="breadcrumb">
	  <li><a class="btn btn-link" onclick="loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>)">Discussion Topics</a></li>
	  <li class="active">Edit Topic</li>
	</ol>
	<form name="compose" id="topic-form" action="#" method="post">
		<div class="control-group">
		  <input id="subject" name="subject" type="text" class="form-control" value="<?php echo $topic->getTopicSubject(); ?>" placeholder="Subject">
		</div>

		<pre><textarea id="message" name="message" class="emailMessage"><?php echo $topic->getTopicMessage(); ?></textarea></pre>
		<input name="id" value="<?php echo $topicid; ?>" hidden="hidden"/>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="send">Edit</button>
	</form>
</div>

<div id="dialog-error-edittopic" title="Invalid Fields" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>Please include a subject and message.</p>
</div>
<div id="dialog-message-edittopic" title="Topic Edited" hidden="hidden">
	<p><span class="ui-icon ui-icon-check" style="float:left; margin:0 7px 50px 0;"></span>Discussion Topic Edited.</p>
</div>
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>-->
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
				'classes/processEditTopic.php',
				$(this).serialize(),
				function(data){
				  //$("#forum").html(data);
				  //console.log(data);
				  //alert("Discussion Topic Edited.");
				  //loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>);
				  $(function() {
						$( "#dialog-message-edittopic" ).dialog({
							modal: true,
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
									loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>);
								}
							}
						});
					});
				}
			  );
		  return false;
		}
		else
		{
			//alert('Please include a subject and message.');
			$(function() {
				$( "#dialog-error-edittopic" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
			return false;
		}
	});
});
</script>