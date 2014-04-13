<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process moving emails*/
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

foreach ($_POST['checkbox'] as $id)
{
	$database->exec("UPDATE email SET box = '" . $_POST['box'] . "' WHERE emailID = " . $id . "");
}

$query = $database->query("SELECT emailID FROM email WHERE owner = '" . $session->getUserName() . "' AND box = '1'");
$inboxNum = $query->rowCount();
echo $inboxNum;
?>
