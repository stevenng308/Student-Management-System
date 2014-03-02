<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- Check for uniqueness in the email and username with 
jquery valdiation passing the data in the POST variable -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if (!empty($_POST['username']))//if true checking username
{
	$field = mysql_real_escape_string($_POST['username']);
	$check = "username";
	//echo "hello1";
}
else if (!empty($_POST['email']))//if true checking email
{
	$field = mysql_real_escape_string($_POST['email']);
	$check = "email";
	//echo "hello";
}
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//query is getting data from all 4 user tables and storing it in array
/*$query = "(SELECT accountID as type FROM admin WHERE " . $check . " = '" . $field . "' LIMIT 1)
			UNION
		   (SELECT accountID as type FROM teacher WHERE " . $check . " = '" . $field . "' LIMIT 1)
			UNION
			(SELECT accountID as type FROM student WHERE " . $check . " = '" . $field . "' LIMIT 1)
			UNION
			(SELECT accountID as type FROM parent WHERE " . $check . " = '" . $field . "' LIMIT 1)";
$result = $database->runQuery($query);

if (mysql_num_rows($result) == 0) //if true input is unique
{
	echo "true";
}
else
{
	echo "false";
}
*/
$query = $database->query('(SELECT accountID as id FROM admin WHERE ' . $check .  ' = "' . $field .  '" LIMIT 1)
							UNION (SELECT accountID as id FROM teacher WHERE ' . $check .  ' = "' . $field .  '" LIMIT 1)
							UNION (SELECT accountID as id FROM student WHERE ' . $check .  ' = "' . $field .  '" LIMIT 1)
							UNION (SELECT accountID as id FROM parent WHERE ' . $check .  ' = "' . $field .  '" LIMIT 1);
							');
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
