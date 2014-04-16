<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- view all classes in the system -->

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

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'View Classes', '../');
?>
<!-- Custom CSS for the arrow buttons on the table columns to sort -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.css">
<link href="../bootstrap/css/background.css" rel="stylesheet">
<link href="../bootstrap/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">

<div class="container bottomMargin">
	<div class="table-responsive">
		<h3 align="center">All Classes in the School Wide Communications Hub</h3>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="userTable">
			<div class="row">
				<div class="col-xs-3 col-sm-1">
					<button class="btn btn-danger btn-sm" onclick="deactivate()">Deactive</button>
				</div>
				<div class="col-xs-3 col-sm-1">
					<button class="btn btn-info btn-sm" onclick="activate()">Active</button>
				</div>
			</div>
			<br/>
			<thead>
				<tr>
					<th class="no-sort" style="text-align: center;">
						<input type="checkbox" onClick="checkAll(this)" />
					</th>
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
						foreach ($database->query('SELECT * FROM classroom') as $row)
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
<div id="dialog-confirm" title="Deactivate class?" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>Do you want to set <b>Active</b> to false?</p>
</div>
<div id="dialog-confirm2" title="Activate class?" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>Do you want to set <b>Active</b> to true?</p>
</div>
<div id="dialog-message" title="Deactivated" hidden="hidden">
	<p><span class="ui-icon ui-icon-check" style="float:left; margin:0 7px 50px 0;"></span>Class deactivated.</p>
</div>
<div id="dialog-message2" title="Activated" hidden="hidden">
	<p><span class="ui-icon ui-icon-check" style="float:left; margin:0 7px 50px 0;"></span>Class activated.</p>
</div>
<div id="dialog-error" title="No class selected" hidden="hidden">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>No classes were selected.</p>
</div>

<?php
	echo $layout->loadFooter('../');
?>
<!--<script src="../bootstrap/js/searchFilter.js"></script>-->
<script type="text/javascript" language="javascript" src="../bootstrap/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../bootstrap/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" language="javascript" src="../bootstrap/js/statusClass.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#userTable').dataTable(
		{
			"aaSorting": [[1, 'asc']],
			"aoColumnDefs" : [ {
				'bSortable' : false,
				'aTargets' : [ "no-sort" ]
			}]
		});
	});
</script>
</html>
