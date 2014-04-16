<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process grade changes -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_POST);
$user = mysql_real_escape_string($_POST['username']);
$email = mysql_real_escape_string($_POST['email']);
$query = $database->query("SELECT accountID FROM " . $_POST['role'] . " WHERE BINARY username = '" . $user. "' AND email = '" . $email . "' AND status = '1' LIMIT 1");
if ($query->rowCount() == 0)
{
	//echo $birth . ' ' . $query->rowCount();
	echo '
			<!-- Custom styles for this template -->
			<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

			<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
				<div class="jumbotron">
				<h2>Account could not be found or is deactivated.</h2>
					<div class="container" style="text-align: center;">
						<a class="btn btn-primary" href="index.php" role="button">Return Home</a>
					</div>
				</div>
			</div>
		';
}
else
{
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$id = $result[0]['accountID'];
	switch ($_POST['role'])
	{
		case 'Admin': $table = 1;
				break;
		case 'Teacher': $table = 2;
				break;
		case 'Student': $table = 3;
				break;
		case 'Parent': $table = 4;
				break;
		default: header('Location: error.php');
				break;
	}
	$date = Date('F j, Y, H:i:s a');
	$expire = new DateTime();
	$expire->modify('+1 day');
	function createSalt()
	{
		$text = md5(uniqid(rand(), true));
		return substr($text, 0, 3);
	}
	$hash = hash('sha256', $date);		
	$salt = createSalt();
	$key = hash('sha256', $salt . $hash); //key for authentication
	//var_dump($key);
	$database->exec("INSERT INTO reset(accountID, role, myKey, expire) VALUES('" . $id . "', '" . $table . "', '" . $key . "', '" . $expire->format('Y-m-d H:i:s') . "')");
	
	//being creating email
	$subject = 'SMS - Password Reset Request (24HR Response Window)';

	$headers = "From: sms-autoemail@sms.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= '<th><h2>SWCH - Password Reset Request</h2></th>';
	$message .= '<tr style="background: #eee;">';
	$message .= '<td><p>A password request has been issued. If you did not authorize this please ignore this message. If you did authorize this please 
				click on the included <a href="http://ngine.dyndns.org/sms/passwordReset.php?id=' . $database->lastInsertId() . '&myKey=' . $key . '"  target="_blank">link</a> to reset your password.<br />The link will only be active for <strong>24 hours</strong>.<br /><br />
				Please do not reply to this message. This is an auto-generated message by the School Wide Communications Hub system and this email address is not being monitored.</p></td>';
	$message .= '</tr><tr style="background: #eee;">';
	$message .= '<td><a href="http://ngine.dyndns.org/sms/passwordReset.php?id=' . $database->lastInsertId() . '&myKey=' . $key . '"  target="_blank">Reset Password</a></td></tr>';
	$message .= '</table></body></html>';
	
	mail(strip_tags($email), $subject, $message, $headers);
	echo '
			<!-- Custom styles for this template -->
			<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

			<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
				<div class="jumbotron">
				<h2>An email has been sent to the email address on this account.<br />Please check the email for a password reset link.</h2>
					<div class="container" style="text-align: center;">
						<a class="btn btn-primary" href="index.php" role="button">Return Home</a>
					</div>
				</div>
			</div>
		';
}
?>
