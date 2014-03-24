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

$subject = htmlentities($_POST['subject'], ENT_QUOTES, 'UTF-8'); //need to make the message safe for storing in db. read htmlentities on their site
$date = date('Y-m-d H:i:s');
$msg = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
function parseEdit($input) //get rid of the last edit timestamp
{
	$input = preg_split("/-+/", $input, NULL, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE); //delimiter using commas
	return $input;
}
$msg_arr = parseEdit($msg);
$msg = $msg_arr[0] . " --- Edited on " . $date;
$database->exec("UPDATE forum SET topic_subject='" . $subject . "' WHERE topicID='" . $_POST['id']. "';
							UPDATE forum SET topic_message='" . $msg . "' WHERE topicID='" . $_POST['id']. "';
							UPDATE forum SET last_post='" . $date . "' WHERE topicID='" . $_POST['id']. "';
						");
?>