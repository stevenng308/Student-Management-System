<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- view teacher's classes in the system -->

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
	if($_SESSION['sess_role'] == 3 || $_SESSION['sess_role'] == 4)
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

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'View Classes', '../');
?>
<!-- Custom CSS for the arrow buttons on the table columns to sort -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.css">

<div class="container bottomMargin">
	<div class="table-responsive">
		<h3 align="center">Assigned Classes</h3>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="userTable">
			<div class="row">
				<div class="col-xs-3 col-sm-1">
					<!--<button class="btn btn-danger btn-sm" onclick="deactivate()">Deactive</button>-->
				</div>
				<div class="col-xs-3 col-sm-1">
					<!--<button class="btn btn-info btn-sm" onclick="activate()">Active</button>-->
				</div>
			</div>
			<br/>
			<thead>
				<tr>
					<th style="text-align: center;">
						Course Number
					</th>
					<th style="text-align: center;">
						Course Name
					</th>
					<th style="text-align: center;">
						Teacher
					</th>
					<th style="text-align: center;">
						Semester
					</th>
					<th style="text-align: center;">
						School Year
					</th>
					<th style="text-align: center;">
						Active
					</th>
					<th class="no-sort" style="text-align: center;">
						Info
					</th>
					<th class="no-sort" style="text-align: center;">
						Class Page
					</th>
				</tr>
			</thead>
			<tbody>
					<?php 
						$count = 0;
						foreach ($database->query('SELECT * FROM classroom WHERE teacherID = ' . $session->getID() . '') as $row)
						{
							$stmt =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $row['teacherID'] . '"');
							$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$classroom = new Classroom($row, $result, $database);
							echo $layout->loadClassRow($classroom, $count, $session->getUserType());
							$count++;
						}
					?>
			</tbody>
		</table>
	</div>
</div>
<?php
	echo $layout->loadFooter('../');
?>
<!--<script src="../bootstrap/js/searchFilter.js"></script>-->
<script type="text/javascript" language="javascript" src="../bootstrap/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="../bootstrap/js/statusClass.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#userTable').dataTable(
		{
			"aaSorting": [[0, 'asc']],
			"aoColumnDefs" : [ {
				'bSortable' : false,
				'aTargets' : [ "no-sort" ]
			}]
		});
	});
</script>
</html>
