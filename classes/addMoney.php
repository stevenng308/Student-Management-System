<?php
/*Student Management System -->
<!-- Author: Andre Vicente -->
<!-- process updating lunch allowance*/

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

//$student_id = mysql_real_escape_string($_POST['studentID']);
//$addingBalance = mysql_real_escape_string($_POST['addingBalance']);
$student_id = mysql_real_escape_string($_POST['studentID']);
$adding_balance = mysql_real_escape_string($_POST['addingBalance']);

//$query = "UPDATE student SET balance = balance + '" . $adding_balance . "' WHERE studentID = '" . $student_id . "'";
//$stmt = $database->query($query);
//$result = $stmt->fetch();

$database->exec("UPDATE student SET balance = balance + '" . $adding_balance . "' WHERE studentID = " . $student_id . "");
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<form class="form-signin" style="text-valign:center">
			<h3>Amount has been added.</h3>
			<a class="btn btn-primary" href="<?php echo $session->getUserTypeFormatted(); ?>/main.php" role="button">Return Home</a>
		</form>
	</div>
</div>