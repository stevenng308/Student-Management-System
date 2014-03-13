<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process saving emails*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
//var_dump($_POST);
//var_dump($session);

$subject = htmlentities($_POST['subject'], ENT_QUOTES, 'UTF-8'); //need to make the message safe for storing in db. read htmlentities on their site
$msg = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
//var_dump($user_arr);
//var_dump($subject);
//var_dump($msg);

$query = $database->query("SELECT firstname, lastname FROM " . $session->getUserTypeFormatted() . " WHERE username = '" . $session->getUserName() . "'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$frm_first = $result[0]['firstname'];
$frm_last = $result[0]['lastname'];
$date = date('Y-m-d H:i:s');

$database->exec("INSERT INTO email(owner, dest_username, from_username, from_first, from_last, date_sent, subject, msg_content, box) 
						VALUES('" . $session->getUserName() . "', '" . $_POST['username'] . "', '" . $session->getUserName() . "', '" . $frm_first . "', '" . $frm_last . "', '" . $date . "', '" . $subject . "', '" . $msg . "', '4')");
/*$query = $database->query("SELECT emailID FROM email WHERE dest_username = '" . $session->getUserName() . "' AND box = '1'");
$inboxNum = $query->rowCount();
echo $inboxNum;*/
?>