<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- unregister Students -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_POST);
foreach ($_POST['checkbox'] as $id)
{
	$database->exec("DELETE FROM enrolled WHERE studentID = " . $id . "");
}
?>