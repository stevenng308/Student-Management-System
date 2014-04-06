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
	if($_SESSION['sess_role'] == 4)
	{
		header('Refresh: 1.5; url=index.php');
		echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}
else
{
	header('Location: index.php');
}
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
$classid = $_GET['classid'] or die(header('Location: error.php'));
$query = $database->query('SELECT * FROM classroom WHERE classID = "' . $classid . '"');
$result = $query->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
$query =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $result[0]['teacherID'] . '"');
$teacher = $query->fetchAll(PDO::FETCH_ASSOC);
$classroom = new Classroom($result[0], $teacher, $database);
?>
<div class="table-responsive">
	<h3 align="center"><?php echo $classroom->getCourseNumber() . " " . $classroom->getCourseName(); ?> - Class Roster</h3>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="studentTable">
		<thead>
			<tr>
				<th style="text-align: center;">
					Username
				</th>
				<th style="text-align: center;">
					First Name
				</th>
				<th style="text-align: center;">
					Last Name
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach ($database->query('SELECT * FROM enrolled JOIN student ON enrolled.studentid = student.studentid WHERE enrolled.classid = ' . $classid . '') as $row)
				{
					//var_dump($row);
					echo $layout->loadRosterStudentRow($row['username'], $row['firstName'], $row['lastName']);
				}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript" language="javascript" charset="utf-8">
$('#studentTable').dataTable(
{
	"aaSorting": [[2, 'asc']],
	"aoColumnDefs" : [ {
		'bSortable' : false,
		'aTargets' : [ "no-sort" ]
	}]
});
</script>