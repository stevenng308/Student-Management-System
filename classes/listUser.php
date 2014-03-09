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
	
	function parseUserName($input)
	{
		$input = str_replace(" ", "", $input); //strip spaces
		$input = preg_split("/,+/", $input, NULL, PREG_SPLIT_NO_EMPTY); //delimiter using commas
		return $input;
	}
	$usernames = mysql_real_escape_string($_POST['term']);
	$user_arr = parseUserName($usernames); //store the parsed student id's into an array
	
	$result_arr = array();
	$stmt = $database->prepare('(SELECT username, firstname, lastname FROM admin WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM teacher WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM student WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM parent WHERE username LIKE :term)');
	if (count($user_arr) === 1)
	{
		$userName = mysql_real_escape_string($_POST['term']);
	}
	else
	{
		$index = count($user_arr) - 1;
		$userName = mysql_real_escape_string($user_arr[$index]);
	}
	$stmt->execute(array('term' => '%' . $userName . '%'));
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
	
	//start of working code
	/*$result_arr = array();
	$stmt = $database->prepare('(SELECT username, firstname, lastname FROM admin WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM teacher WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM student WHERE username LIKE :term)
								UNION(SELECT username, firstname, lastname FROM parent WHERE username LIKE :term)');

	$userName = mysql_real_escape_string($_POST['term']);
	$stmt->execute(array('term' => '%' . $userName . '%'));
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
	return;*/ //end of working code
}
else
{
	//header('Content-type: application/json');
	echo '[{"label":"POST"},{"label":"VAR"},{"label":"IS"},{"label":"EMPTY"}]';
	return;
}

?>