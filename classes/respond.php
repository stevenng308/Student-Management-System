<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- respond form*/

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
$topicid = $_GET['topicid'] or die(header('Location: error.php'));
$query = $database->query("SELECT * FROM forum WHERE topicID = " . $topicid . "");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$respond = $database->query("SELECT * FROM response WHERE topicid = " . $topicid . "");
$topic = new Topic($result[0], $respond->rowCount());
$classid = preg_split("/_+/", $topic->getForumName());
?>
<div class="container">
	<br />
	<ol class="breadcrumb">
		  <li><a class="btn btn-link" onclick="loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid[0]; ?>)">Discussion Topics</a></li>
		  <li><a class="btn btn-link" onclick="loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>)"><?php echo $topic->getTopicSubject(); ?></a></li>
		  <li class="active">Reply to: <?php echo $topic->getTopicSubject(); ?></a></li>
		</ol>
	<div class="jumbotron">
		<form name="respond" id="respond" class="" action="#" method="post">
<pre><textarea class="emailMessage" name="reply" id="reply" placeholder="Enter your response." autofocus></textarea></pre>
		</form>
		<button class="btn btn-lg btn-primary btn-block" name="reply" id="reply" onclick="sendReply()">Respond</button>
	</div>
</div>

<script type="text/javascript" language="javascript" charset="utf-8">
function sendReply()
{
	if(document.getElementById("reply").value) {
		//alert('Successful Validation');
		$.post(
				'classes/sendReply.php',
				{ 
					'reply' : $('#reply').val(),
					'id' : <?php echo $topicid; ?>
				},
				function(data){
				  //$("#forum").html(data);
				  loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
				}
			  );
		  return false;
	}
	else
	{
		alert('Please include a message.');
		return false;
	}
}
</script>