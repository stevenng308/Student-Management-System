<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- Check for uniqueness using course num and name with 
jquery valdiation passing the data in the POST variable*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$query = $database->query('SELECT classID FROM classroom WHERE course_number = "' . $_POST['courseNum'] .  '" AND course_name = "' . $_POST['courseName'] .  '" LIMIT 1');
if ($query->rowCount() == 0) //if true input is unique
{
	echo "true";
}
else
{
	echo "false";
}					


//var_dump($_POST);
?>
