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
<link rel="stylesheet" href="bootstrap/css/jquery-ui-1.10.4.custom.css" type="text/css" /> 

<!-- Begin page content -->
<div class="container jumbotron">
	<ol class="breadcrumb">
	  <li><a href="#" class="btn btn-sm disabled emailNav" role="button">Email</a></li>
	  <li><a a class="btn btn-sm emailNav" role="button" id="compose" onclick="loadIn('inbox')">Inbox</a></li>
	</ol>
	
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th style='text-align: center;' colspan="4">
						<h3><?php echo $session->getUserName() . '\'s Trash Box'; ?></h3>
					</th>
				</tr>
			</thead>
			<thead>
				<tr>
					<td colspan="3">
						<button class="btn btn-danger btn-sm" onclick="deleteEmail('trash')">Delete</button>
					</td>
					
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
					$count = 0;
					foreach ($database->query("SELECT emailID FROM email WHERE dest_username = '" . $session->getUserName() . "' AND box = '3' ORDER BY date_sent DESC") as $row)
					{
						$email = new Email($database, $session->getUserName(), $row['emailID']);
						//var_dump($email);
						echo $layout->loadInbox($email, $count, 'trash');
						$count++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<script src="bootstrap/js/searchFilter.js"></script>
<script src="bootstrap/js/delete.js"></script>
</html>
