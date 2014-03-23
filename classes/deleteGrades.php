<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process grade changes -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_POST);
$class = mysql_real_escape_string($_POST['class']);

$database->exec("DELETE FROM grade WHERE classID = " . $class . ""); //wipe the grades
?>
