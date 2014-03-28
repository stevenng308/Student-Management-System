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
	<h3 align="center"><?php echo $classroom->getCourseNumber() . " " . $classroom->getCourseName(); ?> - Roster List</h3>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="studentTable">
		<div class="row">
			<div class="col-xs-3 col-sm-1">
				<button class="btn btn-danger btn-sm" onclick="unregister()">Del</button>
			</div>
		</div>
		<thead>
			<tr>
				<th class="no-sort" style="text-align: center;">
					<input type="checkbox" onClick="checkAll(this)" />
				</th>
				<th style="text-align: center;">
					Student ID
				</th>
				<th style="text-align: center;">
					Username
				</th>
				<th style="text-align: center;">
					First Name
				</th>
				<th style="text-align: center;">
					Last Name
				</th>
				<th class="no-sort" style="text-align: center;">
					Grades
				</th>
				<th class="no-sort" style="text-align: center;">
					Grades
				</th>
				<th class="no-sort" style="text-align: center;">
					Grades
				</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$count = 0;
				foreach ($database->query('SELECT * FROM enrolled JOIN student ON enrolled.studentid = student.studentid WHERE enrolled.classid = ' . $classid . '') as $row)
				{
					//var_dump($row);
					$query = $database->query("SELECT gradeID, label, grade FROM grade WHERE studentid = " . $row['studentID'] . " AND classid = " . $classid . "");
					$grade = $query->fetchAll(PDO::FETCH_ASSOC);
					echo $layout->loadRosterRow($row['studentID'], $row['username'], $row['firstName'], $row['lastName'], $grade, $classid, $count);
					$count++;
				}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript" language="javascript" charset="utf-8">
$('#studentTable').dataTable(
{
	"aaSorting": [[1, 'asc']],
	"aoColumnDefs" : [ {
		'bSortable' : false,
		'aTargets' : [ "no-sort" ]
	}]
});

var values = 0; //global array of the id's values
$('input[id^="delete"]').on('change', function() { //adds the values to the array called values
    values = $('input:checked').map(function() {
        return this.value;
    }).get();
    
    //alert(values);
});

function unregister()
{
	if (!values)
	{
		alert("No students were selected.");
	}
	else
	{
		if (window.confirm("Do you want to unregister?"))
		{
			//alert(values);
			//alert($('#box').val());
			$.post(
				'classes/unregisterStudents.php',
				{
					'checkbox' : values, 
				},
				function(data){
				  //$("#mainDiv").html(data);
				  loadClassPages('#rosterList' , 'classes/roster.php?classid=', <?php echo $classid; ?>); //refresh the roster
				  loadClassPages('#allGrades', 'classes/allGrades.php?classid=', <?php echo $classid; ?>); //load/unload all grades of the new students if they had existing grades
				}
			  );
		  return false;
		}
		else
		{
			;//do nothing
		}
	}
}

function checkAll(source) {
  var checkboxes = $('input[id^="delete"]').not(":hidden"); //insert into an array of all checkboxes that have the id=delete but are not hidden from the fitering
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked; //check all of them
	values = $('input:checked').map(function() {
        return this.value; //updating the global variable values
    }).get();
  }
}   
</script>