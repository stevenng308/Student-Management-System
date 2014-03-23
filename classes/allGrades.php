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
		header('Refresh: 1.5; url=../index.php');
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
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
$stmt =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $result[0]['teacherID'] . '"');
$teach = $stmt->fetchAll(PDO::FETCH_ASSOC);
$class= new Classroom($result[0], $teach, $database);
?>
<div class="container">
	<div class="row">	
		<div>
			<h3 align="center"><?php echo $class->getCourseNumber() . " " . $class->getCourseName(); ?> - All Grades</h3>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="gradeTable">
				<div class="row">
					<div class="col-xs-3 col-sm-1">
						<button class="btn btn-danger btn-sm" onclick="deleteAllGrades(<?php echo $classid ?>)">Del All</button>
					</div>
				</div>
				<thead>
					<tr>
						<th style="text-align: center;">
							Student ID
						</th>
						<th style="text-align: center;">
							Username
						</th>
						<th style="text-align: center;">
							Name
						</th>
						<th style="text-align: center;">
							Label
						</th>
						<th style="text-align: center;">
							Grade
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($database->query('SELECT * FROM enrolled JOIN student ON enrolled.studentid = student.studentid WHERE enrolled.classid = ' . $classid . '') as $row)
						{
							$query = $database->query("SELECT gradeID, label, grade FROM grade WHERE studentid = " . $row['studentID'] . " AND classid = " . $classid . "");
							$grade = $query->fetchAll(PDO::FETCH_ASSOC);
							//var_dump($grade);
							echo $layout->loadGradeRow($row['studentID'], $row['username'], $row['firstName'], $row['lastName'], $grade);
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" charset="utf-8">
$('#gradeTable').dataTable(
{
	"aaSorting": [[0, 'asc']],
	"aoColumnDefs" : [ {
		'bSortable' : false,
		'aTargets' : [ "no-sort" ]
	}]
});

function deleteAllGrades(id)
{
	if (window.confirm("Do you want to delete?"))
	{
		$.post(
			'classes/deleteGrades.php',
			{
				'class' : id
			},
			function(data){
			  //$("#result").html(data);
			  //console.log(data);
			  loadClassPages('#allGrades', 'classes/allGrades.php?classid=', <?php echo $classid; ?>); //load all grades first when navigating to class page
			  loadClassPages('#rosterList' , 'classes/roster.php?classid=', <?php echo $classid; ?>);
			}
		  );
		return false;
	}
}
</script>