<?php
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	/*if($_SESSION['sess_role'] != 1)
	{
		header('Refresh: 1.5; url=../index.php');
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}*/
}
else
{
	header('Location: ../index.php');
}
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//header('Content-type: application/json');
/*if (!empty($_POST['term']))
{
	echo '[{"label":"Admin"},{"label":"Rai"},{"label":"Vinod"},{"label":"Dave"}]';
	return;
}*/

if (!empty($_POST['term']))
{
	//header('Content-type: application/json');
	//echo '[{"label":"Admin"},{"label":"Rai"},{"label":"Vinod"},{"label":"Dave"}]';
	//return;
	$result_arr = array();
	$stmt = $database->prepare('(SELECT username, firstname, lastname FROM admin WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM teacher WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM student WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM parent WHERE username LIKE :term)');
	$stmt->execute(array('term' => '%'.$_POST['term'].'%'));
	while($row = $stmt->fetch())
	{
		$result_arr[] = array(
						'label' => $row['username'],
						'first' => $row['firstname'],
						'last' => $row['lastname'],
						'value' => $row['username']
						);
	};
	echo json_encode($result_arr);
	return;
}
else
{
	//header('Content-type: application/json');
	echo '[{"label":"POST"},{"label":"VAR"},{"label":"IS"},{"label":"EMPTY"}]';
	return;
}

?>