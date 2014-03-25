<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process editing topics*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
//var_dump($_POST);

$date = date('Y-m-d H:i:s');
$msg = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');//need to make the message safe for storing in db. read htmlentities on their site
$msg = $msg . " --- Edited on " . $date . " by " . $session->getUserName();

if (!$_POST['type'])//true if editing OP message
{
	$database->exec("UPDATE forum SET topic_message='" . $msg . "' WHERE topicID='" . $_POST['id']. "';
					UPDATE forum SET last_post='" . $date . "' WHERE topicID='" . $_POST['id']. "';
					");
}
else
{
	$database->exec("UPDATE response SET response_message='" . $msg . "' WHERE responseID='" . $_POST['id']. "';
					UPDATE forum SET last_post='" . $date . "' WHERE topicID='" . $_POST['topicid']. "';
					");
}
?>