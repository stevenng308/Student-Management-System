<?php
/*Student Management System -->
<!-- Author: Andre Vicente Integration/Validation: Steven Ng -->
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

$query = $database->query("SELECT balance FROM student WHERE studentID = '" . $student_id . "'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$bal = $result[0]['balance'];
$bal += $adding_balance;
if ($bal > 1000000)
{
	$confirm = 'Amount not added. The child\'s balance will exceed $1,000,000.<br />Please consider donating the excess money to a charitable cause (i.e. Me).';
}
else
{
	$confirm = 'Amount has been added.';
	$database->exec("UPDATE student SET balance = balance + '" . $adding_balance . "' WHERE studentID = " . $student_id . "");
}
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<div class="container" style="text-valign:center">
			<h3><?php echo $confirm; ?></h3>
			<a class="btn btn-primary" href="<?php echo $session->getUserTypeFormatted(); ?>/main.php" role="button">Return Home</a>
		</div>
	</div>
</div>