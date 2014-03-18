<?php
/*Student Management System -->
<!-- Author: Brian Kennedy -->
<!-- process posting messages*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}


$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);

$msg = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
$query = $database->query("SELECT firstname, lastname FROM " . $session->getUserTypeFormatted() . " WHERE username = '" . $session->getUserName() . "'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$athr_first = $result[0]['firstname'];
$athr_last = $result[0]['lastname'];
$acct_id = $result[0]['accountID'];
$date = date('Y-m-d H:i:s');

$database->exec("INSERT INTO messageboard(accountID, authorFirstName, authorLastName, messageDate, messageContent) 
						VALUES('" . $acct_id . "', '" . $athr_first . "', '" . $athr_last . "', '" . $date . "', '" . $msg . "')");
?>