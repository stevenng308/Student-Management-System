<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process deleting topics*/
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
	$database->exec("DELETE FROM forum WHERE topicID = '" . $id . "'");
	$database->exec("DELETE FROM response WHERE topicID = '" . $id . "'");
}
?>
