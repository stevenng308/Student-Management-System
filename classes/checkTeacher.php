<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- Check for uniqueness using teacher's accountID with 
jquery valdiation passing the data in the POST variable*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$query = $database->query('SELECT accountID FROM teacher WHERE accountID = "' . $_POST['teacherID'] .  '" AND status = 1 LIMIT 1');
if ($query->rowCount() == 0) //if true input does not exist as a teacher
{
	echo "false";
}
else
{
	echo "true";
}					


//var_dump($_POST);
?>
