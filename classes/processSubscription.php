<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- process editing topics*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
//var_dump($_POST);
$query = $database->query("SELECT id FROM subscribe WHERE accountID = " . $session->getID() . " AND role = " . $session->getUserType() . " AND topicID = " . $_POST['id'] . "");

if ($query->rowCount() == 0) //true if not subscribed
{
	$num = $_POST['num'] + 1;
	$database->exec("INSERT INTO subscribe(accountID, role, topicID, lastNum) VALUES('" . $session->getID() . "', '" . $session->getUserType() . "', '" . $_POST['id'] . "', '" . $num . "')");
	echo "true";
}
else
{
	echo "false";
}
?>