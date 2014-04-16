<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- quote form*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	if($_SESSION['sess_role'] == 4)
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
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
if (!$_POST['type']) //true if quoting the OP message
{
	//var_dump($_POST);
	$query = $database->query("SELECT * FROM forum WHERE topicID = " . $_POST['id'] . "");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$respond = $database->query("SELECT * FROM response WHERE topicid = " . $_POST['id'] . "");
	$orig = new Topic($result[0], $respond->rowCount());
	$classid = $_POST['classid'];
	$msg = preg_replace("/\n/", "\n>", $orig->getTopicMessage());
	$subject = $orig->getTopicSubject();
}
else
{
	$query = $database->query("SELECT * FROM forum WHERE topicID = " . $_POST['topicid'] . "");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$respond = $database->query("SELECT * FROM response WHERE topicid = " . $_POST['topicid'] . "");
	$topic = new Topic($result[0], $respond->rowCount());
	$query = $database->query("SELECT * FROM response WHERE responseID = " . $_POST['id'] . "");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$orig = new Reply($result[0]);
	$classid = $_POST['classid'];
	$msg = preg_replace("/\n/", "\n>", $orig->getResponseMessage());
	$subject = $topic->getTopicSubject();
}
?>
<div class="container">
	<br />
	<ol class="breadcrumb">
		  <li><a class="btn btn-link" onclick="loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>)">Discussion Topics</a></li>
		  <li><a class="btn btn-link" onclick="loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $orig->getTopicID() ?>)"><?php echo $subject; ?></a></li>
		  <li class="active">Reply to: <?php echo $subject; ?></a></li>
		</ol>
	<div class="jumbotron">
		<form name="respond" id="respond" class="" action="#" method="post">
<pre><textarea class="emailMessage" name="reply" id="reply" placeholder="Enter your response." autofocus>
&gt;Quote From: <?php echo $orig->getAuthorUser() . '&#13;&#10;&gt;' . $msg . '&#13;&#10;&#13;&#10;'; ?></textarea></pre>
		</form>
		<button class="btn btn-lg btn-primary btn-block" name="reply" id="reply" onclick="sendReply()">Respond</button>
	</div>
</div>
<div id="dialog-error-topicPage" title="Invalid Field" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>Please include a message.</p>
</div>
<script type="text/javascript" language="javascript" charset="utf-8">
function sendReply()
{
	if(document.getElementById("reply").value && $.trim($('#reply').val()) != '') {
		//alert('Successful Validation');
		$.post(
				'classes/sendReply.php',
				{ 
					'reply' : $('#reply').val(),
					'id' : <?php echo $_POST['topicid']; ?>
				},
				function(data){
				  //$("#forum").html(data);
				  loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $orig->getTopicID() ?>);
				}
			  );
		  return false;
	}
	else
	{
		//alert('Please include a message.');
		$(function() {
			$( "#dialog-error-topicPage" ).dialog({
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
}
</script>