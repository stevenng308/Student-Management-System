<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new Database();
//var_dump($_POST);
$first = mysql_real_escape_string($_POST['firstname']);
$last = mysql_real_escape_string($_POST['lastname']);
$month = sprintf("%02s", mysql_real_escape_string($_POST['month']));
$day = sprintf("%02s", mysql_real_escape_string($_POST['day']));
$year = mysql_real_escape_string($_POST['year']);
$birth = $year . $month . $day;
$street = mysql_real_escape_string($_POST['street']);
$city = mysql_real_escape_string($_POST['city']);
$state = mysql_real_escape_string($_POST['state']);
$zip = mysql_real_escape_string($_POST['zip']);
$email = mysql_real_escape_string($_POST['email']);
$number = mysql_real_escape_string($_POST['contact']);
$table = mysql_real_escape_string($_POST['type']);
if ($_POST['type'] == "Student")//if true, registering a student account
	$student_id = mysql_real_escape_string($_POST['studentid']);
$username = mysql_real_escape_string($_POST['username']);
$pass = mysql_real_escape_string($_POST['password']);

if (!empty($_POST['childrenID']))//true if the account being registered has (a) child/ren
{	
	function parseChildID($input)
	{
		$input = str_replace(" ", "", $input); //strip spaces
		$input = preg_split("/,+/", $input); //delimiter using commas
		return $input;
	}
	$child_id = mysql_real_escape_string($_POST['childrenID']);
	$child_arr = parseChildID($child_id); //store the parsed student id's into an array
}

function createSalt()
{
	$text = md5(uniqid(rand(), true));
	return substr($text, 0, 3);
}
$hash = hash('sha256', $pass);		
$salt = createSalt();
//while (true)
//echo $salt;
$pass = hash('sha256', $salt . $hash); //salting password

//begin inserting user info into main user tables
if ($_POST['type'] == "Student") //if true registering a student account, false for other account type
{
	$query = "INSERT INTO " . $table . " (studentID, username, password, firstName, lastName, email, DOB, contactNum, status, salt) 
			VALUES ('". $student_id ."','". $username ."', '". $pass ."', '". $first ."', '". $last ."', '". $email ."', '". $birth ."', '". $number ."', '1', '". $salt ."');";
}
else
{
	$query = "INSERT INTO " . $table . " (username, password, firstName, lastName, email, DOB, contactNum, status, salt) 
			VALUES ('". $username ."', '". $pass ."', '". $first ."', '". $last ."', '". $email ."', '". $birth ."', '". $number ."', '1', '". $salt ."');";
}

mysql_query($query);

//begin inserting into address table
$queryResult = $database->runQuery("SELECT accountID, role from " . $table . " WHERE username = '" . $username ."'");
$result = mysql_fetch_array($queryResult, MYSQL_ASSOC);
$account_id = $result['accountID'];
$role = $result['role'];
$query = "INSERT INTO address (accountID, role, street, city, state, zip)
			VALUES ('" . $account_id . "', '" . $role . "','" . $street . "','" . $city . "','" . $state . "','" . $zip . "');";
mysql_query($query);

//begin inserting into newuser table
$query = "INSERT INTO newuser (accountID, role, username)
			VALUES ('" . $account_id . "', '" . $role . "','" . $username . "');";
mysql_query($query);

if (!empty($_POST['childrenID']))//if true begin inserting into parent student assoc table
{
	foreach ($child_arr as $child_id)
	{
		$query = "INSERT INTO parent_student_assoc (studentID, role, guardianID)
			VALUES ('" . $child_id . "', '" . $role . "','" . $account_id . "');";
		mysql_query($query);
	}
}

?>
<form class="form-signin">
	<h2><?php echo $username ?> registered.</h2>
	<a class="btn btn-primary" href="../admin/register.php" role="button">Register More Users</a>
	<a class="btn btn-default" href="../admin/main.php" role="button">Return Home</a>
</form>
</div>
