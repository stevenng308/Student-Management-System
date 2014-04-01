<?php
/*Student Management System -->
<!-- Author: Brian Kennedy -->
<!-- process posting class messages*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}


$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);

$msg = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
$clssID = $_POST['clssID'];
$date = date('Y-m-d H:i:s');
$database->exec("INSERT INTO class_messageboard(accountID, authorFirstName, authorLastName, messageDate, messageContent, classID) 
VALUES('" . $session->getID() . "', '" . $session->getFirstName() . "', '" . $session->getLastName() . "', '" . $date . "', '" . $msg . "', '" . $clssID . "')");
?>