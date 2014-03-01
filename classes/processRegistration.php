<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new Database();
var_dump($_POST);
$first = mysql_real_escape_string($_POST['firstname']);
$last = mysql_real_escape_string($_POST['lastname']);
$month = mysql_real_escape_string($_POST['month']);
$day = mysql_real_escape_string($_POST['day']);
$year = mysql_real_escape_string($_POST['year']);
$birth = $year . $month . $day;
$street = mysql_real_escape_string($_POST['street']);
$city = mysql_real_escape_string($_POST['city']);
$state = mysql_real_escape_string($_POST['state']);
$zip = mysql_real_escape_string($_POST['zip']);
$email = mysql_real_escape_string($_POST['email']);
$number = mysql_real_escape_string($_POST['contact']);
$table = mysql_real_escape_string($_POST['type']);
if ($_POST['type'] == "Student")
	$student_id = mysql_real_escape_string($_POST['studentid']);
$username = mysql_real_escape_string($_POST['username']);
$pass = mysql_real_escape_string($_POST['password']);

function createSalt()
{
	$text = md5(uniqid(rand(), true));
	return substr($text, 0, 3);
}
$hash = hash('sha256', $pass);		
$salt = createSalt();
//while (true)
//echo $salt;
$pass = hash('sha256', $salt . $hash);
$query = "INSERT INTO " . $table . " (username, password, firstName, lastName, email, DOB, contactNum, status, salt) 
			VALUES ('". $username ."', '". $pass ."', '". $first ."', '". $last ."', '". $email ."', '". $birth ."', '". $number ."', '1', '". $salt ."');";
mysql_query($query);
$queryResult = $database->runQuery("SELECT accountID, role from " . $table . " WHERE username = '" . $username ."'");
$result = mysql_fetch_array($queryResult, MYSQL_ASSOC);
$account_id = $result['accountID'];
$role = $result['role'];
$query = "INSERT INTO address (accountID, role, street, city, state, zip)
			VALUES ('" . $account_id . "', '" . $role . "','" . $street . "','" . $city . "','" . $state . "','" . $zip . "');";
mysql_query($query);
$query = "INSERT INTO newuser (accountID, role, username)
			VALUES ('" . $account_id . "', '" . $role . "','" . $username . "');";
mysql_query($query);
?>
