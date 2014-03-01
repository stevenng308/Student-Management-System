<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if (!empty($_POST['username']))
{
	$field = mysql_real_escape_string($_POST['username']);
	$check = "username";
	//echo "hello1";
}
else if (!empty($_POST['email']))
{
	$field = mysql_real_escape_string($_POST['email']);
	$check = "email";
	//echo "hello";
}
$database = new Database();

$query = "(SELECT accountID as type FROM admin WHERE " . $check . " = '" . $field . "' LIMIT 1)
			UNION
		   (SELECT accountID as type FROM teacher WHERE " . $check . " = '" . $field . "' LIMIT 1)
			UNION
			(SELECT accountID as type FROM student WHERE " . $check . " = '" . $field . "' LIMIT 1)
			UNION
			(SELECT accountID as type FROM parent WHERE " . $check . " = '" . $field . "' LIMIT 1)";
$result = $database->runQuery($query);
if (mysql_num_rows($result) == 0)
{
	echo true;
}
else
{
	echo false;
}

//var_dump($_POST);
?>
