<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- admin main -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	if($_SESSION['sess_role'] != 1)
	{
		header('Refresh: 1.5; url=../index.php');
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}
else
{
	header('Location: ../index.php');
}
$layout = new Layout();
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
//var_dump($_SESSION);
//var_dump($session);

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Admin Main', '../');
?>

<!-- Begin page content -->
<div class="container">
	<h3>Hello <?php echo $session->getFirstName(); ?>.</h3>
	<div class="jumbotron">
		<form name="compose" id="compose-form" action="#" method="post">
			<pre><textarea id="message" name="message" class="messageBoard"></textarea></pre>			
		</form>
		<button class="btn btn-lg btn-primary btn-block" onclick="postMsg()">Post Message</button>
	</div>
<!-- Andre Vicente - Loading Each Student Account Lunch Account depending on Student ID 
     We are assuming since this is the ADMIN Main page that their ROLE is automatically set to 1 -->
<?php
$role = $session->getUserType();
$username = $session->getID();
$query = "SELECT studentID FROM parent_student_assoc WHERE guardianID = '" . $username . "' AND role ='" . $role . "'";
$count = 0;
	if (!$database->query($query)==NULL) {
	 echo "<tr>";
	 echo "<th><b>Student ID</b></th>";
	 echo "<th><b>Student Name</b></th>";
	 echo "<th><b>Current Balance</b></th>";
	 echo "</tr>";	
     echo "<br>";
	}
			foreach ($database->query($query) as $row)
			{
				$stmt = $database->query('SELECT * FROM student WHERE studentID = "' . $row['studentID'] . '"');
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$user = new User($database, $result[0]['accountID'], "student");
				echo $layout->loadStundentLunchRow($user, $count);
				$count++;
			} 
?>
</div>
<?php
	echo $layout->loadFooter('../');
?>
<script>
function postMsg()
{
	//alert("hi");
	$.post(
		'../classes/postMessage.php',
		{
			'message' : $('#message').val()
		},
		function(data){
			//alert(data);
		  //$("#mainDiv").html(data);
		  location.reload();
		}
	  );
  return false;
}
</script>
</html>
