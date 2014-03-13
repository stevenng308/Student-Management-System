<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process deleting emails*/
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

if ($_POST['box'] == "inbox" || $_POST['box'] == "sent") //move mail to trash if they were in inbox or sent. delete if in the trash
{
	foreach ($_POST['checkbox'] as $id)
	{
		$database->exec("UPDATE email SET box = '3' WHERE emailID = " . $id . "");
	}
	$query = $database->query("SELECT emailID FROM email WHERE dest_username = '" . $session->getUserName() . "' AND box = '1'");
	$inboxNum = $query->rowCount();
	echo $inboxNum;
}
else
{

	foreach ($_POST['checkbox'] as $id)
	{
		$database->exec("DELETE FROM email WHERE emailID = '" . $id . "'");
	}
}
?>
