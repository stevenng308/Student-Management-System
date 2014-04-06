<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- Check if the student has a certain grade with 
jquery valdiation passing the data in the POST variable*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$query = $database->query("SELECT * FROM grade WHERE label = '" . $_POST['label'] . "' AND studentID = " . $_POST['id'] . " AND classID = " . $_POST['classid'] . " LIMIT 1");
if ($query->rowCount() == 0)
{
	echo "true";
}
else
{
	echo "false";
}

//var_dump($_POST);
?>
