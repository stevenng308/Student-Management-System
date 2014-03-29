<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- error -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
$layout = new Layout();
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_SESSION);
//var_dump($session);

echo $layout->loadFixedNavBar('Error', '');
?>

<!-- Begin page content -->
<div class="container">
		<div class="alert alert-danger">
			 <strong>Error!</strong> Something went wrong. Please try again.
		</div>
</div>
<?php
	echo $layout->loadFooter('');
?>
</html>
