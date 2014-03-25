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

$database->exec("DELETE FROM subscribe WHERE id = " . $_POST['id'] . "");

?>