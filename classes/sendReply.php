<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process sending reply*/

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
$msg = htmlentities($_POST['reply'], ENT_QUOTES, 'UTF-8');

$query = $database->query("SELECT firstname, lastname FROM " . $session->getUserTypeFormatted() . " WHERE username = '" . $session->getUserName() . "'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$frm_first = $result[0]['firstname'];
$frm_last = $result[0]['lastname'];
$date = date('Y-m-d H:i:s');

$database->exec("INSERT INTO response(topicID, response_message, author_user, author_first, author_last, role, date_posted)
				VALUES('" . $_POST['id'] . "', '" . $msg . "', '" . $session->getUserName() . "', '" . $frm_first . "', '" . $frm_last . "', '" . $session->getUserType() . "', '" . $date . "')");
$database->exec("UPDATE forum SET last_post='" . $date . "' WHERE topicID='" . $_POST['id']. "'");
$database->exec("UPDATE subscribe SET lastNum = lastNum + 1 WHERE topicID='" . $_POST['id']. "' AND accountID = '" . $session->getID(). "' AND role= '" . $session->getUserType(). "'");
?>