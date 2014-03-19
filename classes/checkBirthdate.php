<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- Check if the student's id is valid with 
jquery valdiation passing the data in the POST variable*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$month = sprintf("%02s", mysql_real_escape_string($_POST['month']));
$day = sprintf("%02s", mysql_real_escape_string($_POST['day']));
$year = mysql_real_escape_string($_POST['year']);
if (checkdate((int)$month, (int)$day, (int)$year))
{
	echo "true";
}
else
{
	echo "false";
}



//var_dump($_POST);
?>
