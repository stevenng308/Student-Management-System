<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- view all users in the system -->

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

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'View Users', '../');
?>

<!-- Begin page content -->
<div class="container">
	<div class="table-responsive">
		<table class="table table-hover dataTable">
			<thead>
				<tr>
					<th style='text-align: center;' colspan="6">
						<h3>All Users in the Student Management System</h3>
						<div class=row>
							<div class="col-xs-6 col-md-4"></div>
							<div class="input-group input-group-lg col-xs-6 col-md-4">
								  <span class="input-group-addon">Filter</span>
								  <input type="text" class="form-control" id="filter" placeholder="Search Term">
							</div>
						</div>
					</th>
				</tr>
			</thead>
			<thead>
				<tr>
					<th>
						ID
					</th>
					<th>
						Username
					</th>
					<th>
						First Name
					</th>
					<th>
						Last Name
					</th>
					<th>
						Role
					</th>
					<th>
						Active
					</th>
					<th>
						<!-- Empty for button coloumn -->
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$count = 0;
					/*foreach ($database->query('(SELECT accountID, username, firstname, lastname, role, email, dob, contactNum, status FROM admin)
						UNION(SELECT accountID, username, firstname, lastname, role, email, dob, contactNum, status FROM teacher)
						UNION(SELECT accountID, username, firstname, lastname, role, email, dob, contactNum, status FROM student)
						UNION(SELECT accountID, username, firstname, lastname, role, email, dob, contactNum, status FROM parent);') as $row)
						{
							$roleNum = $row['role'];
							$row['role'] = $result[0]['description'];
						}*/
					foreach ($database->query('(SELECT accountID, role FROM admin)
						UNION(SELECT accountID, role FROM teacher)
						UNION(SELECT accountID, role FROM student)
						UNION(SELECT accountID, role FROM parent);') as $row)
					{
						$stmt =  $database->query('SELECT description FROM role WHERE role = "' . $row['role'] . '"');
						$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$user = new User($database, $row['accountID'], $result[0]['description']);
						//echo $layout->loadUserRow($row, $roleNum, $count);
						echo $layout->loadUserRow($user, $count);
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
<script src="../bootstrap/js/searchFilter.js"></script>
</html>
