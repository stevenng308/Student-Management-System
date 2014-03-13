<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- compose an email -->

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
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
?>
<!-- Custom styles for this template -->
<!-- Custom CSS for the arrow buttons on the table columns to sort -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/dataTables.bootstrap.css">

<!-- Begin page content -->
<div class="jumbotron bottomMargin">
	<!--<ol class="breadcrumb">
	  <li><a href="#" class="btn btn-sm disabled emailNav" role="button">Email</a></li>
	  <li><a a class="btn btn-sm emailNav" role="button" id="compose" onclick="loadIn('trash')">Trash</a></li>
	</ol>-->
	
	<div class="table-responsive">
		<!--<table class="table table-hover">
			<thead>
				<tr>
					<th style='text-align: center;' colspan="4">
						<h3><?php //echo $session->getUserName() . '\'s Trash Box'; ?></h3>
					</th>
				</tr>
			</thead>
			<thead>
				<tr>
					<td>
							<button class="btn btn-danger btn-sm" onclick="deleteEmail('inbox')">Del</button>
							
					</td>
					<td>
							<button class="btn btn-info btn-sm" onclick="moveEmail()">Move</button>
					</td>
					<th style="width: 35%;">
						<div class="row">
							<div class="col-xs-6 col-sm-8">
							<select id="box" name="box" class="form-control">
								  <option selected="selected" value="0">Move to</option>
								  <option value="1">Inbox</option>
								  <option value="2">Sent</option>
								  <option value="3">Trash</option>
							</select>
							</div>
							<div class="col-xs-6 col-sm-4">
							</div>
						</div>
					</th>
					<td>
						<div class="input-group col-xs-6 col-md-10">
							<span class="input-group-addon">Filter</span>
							<input type="text" class="form-control" id="filter" placeholder="Search Term">
						</div>
					</td>
				</tr>
				<tr>
					<th>
						<input type="checkbox" onClick="checkAll(this)" />
					</th>
					<th>
						From
					</th>
					<th>
						&nbsp;&nbsp;Subject
					</th>
					<th>
						Received
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					/*$count = 0;
					foreach ($database->query("SELECT * FROM email WHERE owner = '" . $session->getUserName() . "' AND box = '3' ORDER BY date_sent DESC") as $row)
					{
						$email = new Email($row);
						//var_dump($email);
						echo $layout->loadInbox($email, $count, 'trash');
						$count++;
					}*/
				?>
			</tbody>
		</table>-->
		<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="userTable">
			<h3 align="center"><?php echo $session->getUserName() . '\'s Draft Box'; ?></h3>
			<div class="row">
				<div class="col-xs-3 col-sm-1">
					<button class="btn btn-danger btn-sm" onclick="deleteEmail('draft')">Del</button>
				</div>
			</div>
			<thead>
				<tr>
					<th class="no-sort" class="no-sort" style="text-align: center;">
						<input type="checkbox" onClick="checkAll(this)" />
					</th>
					<th style="text-align: center;">
						To
					</th>
					<th>
						Subject
					</th>
					<th>
						Created On
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$count = 0;
					foreach ($database->query("SELECT * FROM email WHERE owner = '" . $session->getUserName() . "' AND box = '4'") as $row)
					{
						$email = new Email($row);
						//var_dump($email);
						echo $layout->loadDraft($email, $count, 'draft');
						$count++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript" language="javascript" src="bootstrap/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#userTable').dataTable(
		{
			"aaSorting": [[3, 'desc']],
			"aoColumnDefs" : [ {
				'bSortable' : false,
				'aTargets' : [ "no-sort" ]
			}]
		});
	});
</script>
<script src="bootstrap/js/deleteMove.js"></script>
</html>
