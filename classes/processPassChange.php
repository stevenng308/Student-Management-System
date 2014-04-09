<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process updating new user passwords*/

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

$pass = mysql_real_escape_string($_POST['password']);
if ($session->getUserType() == 1)
{
	$stmt = "SELECT * FROM admin WHERE accountID = " . $session->getID() . "";
}
else if ($session->getUserType() == 2)
{
	$stmt = "SELECT * FROM teacher WHERE accountID = " . $session->getID() . "";
}
else if ($session->getUserType() == 3)
{
	$stmt = "SELECT * FROM student WHERE accountID = " . $session->getID() . "";
}
else
{
	$stmt = "SELECT * FROM parent WHERE accountID = " . $session->getID() . "";
}

$query = $database->query($stmt);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$user = new User($database, $result[0]['accountID'], $session->getUserTypeFormatted());
function createSalt()
{
	$text = md5(uniqid(rand(), true));
	return substr($text, 0, 3);
}
$hash = hash('whirlpool', $pass);		
$salt = createSalt();
//while (true)
//echo $salt;
$pass = hash('sha256', $salt . $hash); //salting password
$user->setPassword($pass);
$user->setSalt($salt);
$database->exec("DELETE FROM newuser WHERE accountID = " . $session->getID() . "");
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<div class="container" style="text-valign:center">
			<h3>Password has been changed. Thank You.</h3>
			<a class="btn btn-primary" href="<?php echo $session->getUserTypeFormatted(); ?>/main.php" role="button">Return Home</a>
		</div>
	</div>
</div>