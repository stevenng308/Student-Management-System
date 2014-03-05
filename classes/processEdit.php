<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process edit forms -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_POST);
$first = mysql_real_escape_string($_POST['firstname']);
$last = mysql_real_escape_string($_POST['lastname']);
$month = sprintf("%02s", mysql_real_escape_string($_POST['month']));
$day = sprintf("%02s", mysql_real_escape_string($_POST['day']));
$year = mysql_real_escape_string($_POST['year']);
$birth = $year . $month . $day;
$birth2 = $year . "-" . $month . "-" . $day;
$birth2 = DateTime::createFromFormat('Y-m-d', $birth2);
$street = mysql_real_escape_string($_POST['street']);
$city = mysql_real_escape_string($_POST['city']);
$state = mysql_real_escape_string($_POST['state']);
$zip = mysql_real_escape_string($_POST['zip']);
$email = mysql_real_escape_string($_POST['email']);
$number = mysql_real_escape_string($_POST['contact']);
$newType = mysql_real_escape_string($_POST['type']);
if ($_POST['type'] == "Student")//if true, editing a student account
	$student_id = mysql_real_escape_string($_POST['studentid']);
$username = mysql_real_escape_string($_POST['username']);
$pass = mysql_real_escape_string($_POST['password']);

if ($newType != "Student")//true if the account being edited is not a student
{	
	function parseChildID($input)
	{
		$input = str_replace(" ", "", $input); //strip spaces
		$input = preg_split("/,+/", $input, NULL, PREG_SPLIT_NO_EMPTY); //delimiter using commas
		return $input;
	}
	$child_id = mysql_real_escape_string($_POST['childrenID']);
	$child_arr = parseChildID($child_id); //store the parsed student id's into an array
}

//get the id and role of the user account being edited
$query = $database->query('(SELECT accountID, role FROM admin WHERE username="' . $username . '")
							UNION (SELECT accountID, role FROM teacher WHERE username="' . $username . '")
							UNION (SELECT accountID, role FROM student WHERE username="' . $username . '")
							UNION (SELECT accountID, role FROM parent WHERE username="' . $username . '")
							');
$result = $query->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
$user_id = $result[0]['accountID'];
$user_role = $result[0]['role'];

//create a user object so that it will be updated later on by calling set methods
$stmt =  $database->query('SELECT description FROM role WHERE role = "' . $user_role . '"');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$user_role_formatted = $result[0]['description'];
$user = new User($database, $user_id, $user_role_formatted);
//var_dump($user);

if ($first != $user->getFirstName())
{
	$user->setFirstName($first);
}
if ($last != $user->getLastName())
{
	$user->setLastName($last);
}
if ($birth2 != $user->getDOB())
{
	$user->setDOB($birth, $birth2);
}
if ($street != $user->getStreet())
{
	$user->setStreet($street);
}
if ($city != $user->getCity())
{
	$user->setCity($city);
}
if ($state != $user->getState())
{
	$user->setState($state);
}
if ($zip != $user->getZip())
{
	$user->setZip($zip);
}
if ($email != $user->getEmail())
{
	$user->setEmail($email);
}
if ($number != $user->getContact())
{
	$user->setContact($number);
}
if (!empty($pass))
{
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
	$user->setPassword($pass);
	$user->setSalt($salt);
}
if ($newType != "Student")//true if the account being edited is not a student
{	
	if ($child_id != $user->getChildID())
	{
		$user->setChildID($child_arr);
	}
}
/*if ($newType != $user->getRole())
{
	
}*/
?>
<!-- Custom styles for this template -->
<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<form class="form-signin" style="text-valign:center">
			<h2><?php echo $username ?> Edited.</h2>
			<a class="btn btn-primary" href="../admin/viewUser.php" role="button">Edit More Users</a>
			<a class="btn btn-success" href="../admin/main.php" role="button">Return Home</a>
		</form>
	</div>
</div>
