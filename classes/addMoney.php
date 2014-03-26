<?php
/*Student Management System -->
<!-- Author: Andre Vicente -->
<!-- process updating lunch allowance*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
var_dump($_POST);
//var_dump($session);

//$student_id = mysql_real_escape_string($_POST['studentID']);
//$addingBalance = mysql_real_escape_string($_POST['addingBalance']);
$student_id = mysql_real_escape_string($_POST['studentID']);
$adding_balance = mysql_real_escape_string($_POST['addingBalance']);

//$query = "UPDATE student SET balance = balance + '" . $adding_balance . "' WHERE studentID = '" . $student_id . "'";
//$stmt = $database->query($query);
//$result = $stmt->fetch();

$database->exec("UPDATE student SET balance = '" . $adding_balance . "' WHERE studentID = " . $student_id . "");
?>
