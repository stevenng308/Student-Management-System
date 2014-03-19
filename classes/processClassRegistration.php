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
//var_dump($_POST);
function parseStudentID($input)
{
	$input = str_replace(" ", "", $input); //strip spaces
	$input = preg_split("/,+/", $input, NULL, PREG_SPLIT_NO_EMPTY); //delimiter using commas
	return $input;
}
$student_id = mysql_real_escape_string($_POST['studentID']);
$student_arr = parseStudentID($student_id); //store the parsed student id's into an array
$student_arr = array_unique($student_arr);
//var_dump($student_arr);
//begin inserting students into enrolled table
foreach($student_arr as $key => $student)
{
	$query = $database->query('(SELECT studentID FROM enrolled WHERE studentID = "' . $student .  '" AND classID = "' . $_POST['classID'] .  '" LIMIT 1)
								UNION (SELECT studentID FROM student WHERE studentID = "' . $student .  '" LIMIT 1)
								');
	if ($query->rowCount() === 1) //if true input does not exist.
	{
		$database->exec("INSERT INTO enrolled(classid, studentid) VALUES ('" . $_POST['classID'] . "', '" . $student . "')");
	}
	else
	{
		; //do not insert
	}	
}
?>