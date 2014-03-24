<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process creating topics*/

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
$msg = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');

$query = $database->query("SELECT firstname, lastname FROM " . $session->getUserTypeFormatted() . " WHERE username = '" . $session->getUserName() . "'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$frm_first = $result[0]['firstname'];
$frm_last = $result[0]['lastname'];
$date = date('Y-m-d H:i:s');

$database->exec("INSERT INTO forum(forumName, topic_subject, topic_message, author_user, author_first, author_last, date_posted, last_post) VALUES('" . $_POST['forum'] . "', '" . $subject . "', '" . $msg . "', '" . $session->getUserName() . "', '" . $frm_first . "', '" . $frm_last . "', '" . $date . "', '" . $date . "')");
?>