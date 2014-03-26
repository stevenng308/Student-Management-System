<?php
/*Student Management System -->
<!-- Author: Brian Kennedy -->
<!-- process editing messages*/
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
$id = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
$msg = htmlentities($_POST['msg'], ENT_QUOTES, 'UTF-8');
$database->exec("UPDATE messageboard SET messageContent = '" . $msg . "' WHERE  messageID = '" . $id . "'");


?>
