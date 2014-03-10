<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process registration forms -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
//var_dump($_POST);
//var_dump($session);
function parseUserNames($input)
{
	$input = str_replace(" ", "", $input); //strip spaces
	$input = preg_split("/,+/", $input, NULL, PREG_SPLIT_NO_EMPTY); //delimiter using commas
	return $input;
}
$usernames = mysql_real_escape_string($_POST['username']);
$user_arr = parseUserNames($usernames); //store the parsed usernames into an array

$subject = htmlentities($_POST['subject'], ENT_QUOTES, 'UTF-8');
$msg = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
//var_dump($user_arr);
//var_dump($subject);
//var_dump($msg);

$query = $database->query("SELECT firstname, lastname FROM " . $session->getUserTypeFormatted() . " WHERE username = '" . $session->getUserName() . "'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$frm_first = $result[0]['firstname'];
$frm_last = $result[0]['lastname'];
$date = date('Y-m-d H:i:s');
foreach ($user_arr as $to)
{
	$query = $database->query("(SELECT firstname, lastname FROM admin WHERE username = '" . $to . "' LIMIT 1)
								UNION (SELECT firstname, lastname FROM teacher WHERE username = '" . $to . "' LIMIT 1)
								UNION (SELECT firstname, lastname FROM student WHERE username = '" . $to . "' LIMIT 1)
								UNION (SELECT firstname, lastname FROM parent WHERE username = '" . $to . "' LIMIT 1);
								");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($result);
	$database->exec("INSERT INTO email(dest_username, dest_first, dest_last, from_username, from_first, from_last, date_sent, subject, msg_content, box) 
					VALUES('" . $to . "', '" . $result[0]['firstname'] . "', '" . $result[0]['lastname'] . "', '" . $session->getUserName() . "', '" . $frm_first . "', '" . $frm_last . "', '" . $date . "', '" . $subject . "', '" . $msg . "', '1')");
	$database->exec("INSERT INTO email(dest_username, dest_first, dest_last, from_username, from_first, from_last, date_sent, subject, msg_content, box) 
					VALUES('" . $to . "', '" . $result[0]['firstname'] . "', '" . $result[0]['lastname'] . "', '" . $session->getUserName() . "', '" . $frm_first . "', '" . $frm_last . "', '" . $date . "', '" . $subject . "', '" . $msg . "', '2')");				
}
//$database->exec("INSERT INTO email(dest_username, dest_first, dest_last, from_username, from_first, from_last, date_sent, subject, msg_content) 
					//VALUES('" . $to . "', '" . $result[0]['firstname'] . "', '" . $result[0]['lastname'] . "', '" . $session->getUserName() . "', '" . $frm_first . "', '" . $frm_first . "', '" . $date . "', '" . $subject . "', '" . $msg . "', '2'");
?>
<!-- Custom styles for this template -->
<!--<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<form class="form-signin" style="text-valign:center">
			<h2><?php echo $username ?> registered.</h2>
			<a class="btn btn-primary" href="../admin/register.php" role="button">Register More Users</a>
			<a class="btn btn-default" href="../admin/main.php" role="button">Return Home</a>
		</form>
	</div>
</div>-->
