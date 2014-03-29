<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process class edits -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_POST);
$course_num = mysql_real_escape_string($_POST['courseNum']);
$course_name= mysql_real_escape_string($_POST['courseName']);
$start_date = mysql_real_escape_string($_POST['startDate']);
$start_date = date('Y-m-d', strtotime($start_date));
$start_time = mysql_real_escape_string($_POST['startTime']);
$end_date = mysql_real_escape_string($_POST['endDate']);
$end_date = date('Y-m-d', strtotime($end_date));
$end_time = mysql_real_escape_string($_POST['endTime']);
$semester = mysql_real_escape_string($_POST['semester']);
$schoolYear = mysql_real_escape_string($_POST['schoolYear']);
$teacher = mysql_real_escape_string($_POST['username']);
if (isset($_POST['status']))
{
	$status = 1;
}
else
{
	$status = 0;
}

$class = $database->query("SELECT * FROM classroom WHERE classID = " . mysql_real_escape_string($_POST['classid']) ."");
$result = $class->fetchAll(PDO::FETCH_ASSOC);
$stmt =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $result[0]['teacherID'] . '"');
$teacherInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$classroom = new Classroom($result[0], $teacherInfo, $database);

$classroom->setCourseNumber($course_num);
$classroom->setCourseName($course_name);
$classroom->setStartDate($start_date);
$classroom->setEndDate($end_date);
$classroom->setStartTime($start_time);
$classroom->setEndTime($end_time);
$classroom->setSemester($semester);
$classroom->setSchoolYear($schoolYear);
$classroom->setTeacherID($teacher);
$classroom->setStatus($status);
?>
<!-- Custom styles for this template -->
<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
		<div class="container" style="text-valign:center">
			<h2><?php echo $course_num . ' ' . $course_name . ' '?> edited.</h2>
			<a class="btn btn-primary" href="../admin/viewClasses.php" role="button">Edit More Classes</a>
			<a class="btn btn-default" href="../admin/main.php" role="button">Return Home</a>
		</div>
	</div>
</div>
