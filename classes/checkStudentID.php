<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- Check for uniqueness using course num and name with 
jquery valdiation passing the data in the POST variable*/

require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');

function parseStudentID($input)
{
	$input = str_replace(" ", "", $input); //strip spaces
	$input = preg_split("/,+/", $input, NULL, PREG_SPLIT_NO_EMPTY); //delimiter using commas
	return $input;
}
$childIDs = mysql_real_escape_string($_POST['childrenID']);
$child_arr = parseStudentID($childIDs); //store the parsed student ids into an array

if (count($child_arr) === 1) //true if the list of student ids has just started being built. look using the id that was posted
{
	$child = mysql_real_escape_string($_POST['childrenID']);
}
else
{
	$index = count($child_arr) - 1; //get the index of the last element because the preceding elements have ids that are completed and don't need to be looked up
	$child = mysql_real_escape_string($child_arr[$index]); //search using the ID in the last element
}
$query = $database->query('SELECT accountID FROM student WHERE studentID = "' . $child .  '" LIMIT 1');
if ($query->rowCount() == 0 && !empty($_POST['childrenID'])) //if true input does not exist. if there is no child's Id being checked it is false
{
	echo "false";
}
else
{
	echo "true";
}					


//var_dump($_POST);
?>
