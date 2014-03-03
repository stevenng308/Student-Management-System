<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- admin main -->

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
		echo '
			<div><p color="red">You do not have the correct privileges to acces this page.</p></div>
		';
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
		<table class="table table-hover">
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
						
					</th>
				</tr>
			</thead>
			<tbody class="searchable">
				<?php foreach ($database->query('(SELECT accountID, username, firstname, lastname, role FROM admin)
								UNION(SELECT accountID, username, firstname, lastname, role FROM teacher)
								UNION(SELECT accountID, username, firstname, lastname, role FROM student)
								UNION(SELECT accountID, username, firstname, lastname, role FROM parent);') as $row)
					{
						$stmt =  $database->query('SELECT description FROM role WHERE role = "' . $row['role'] . '"');
						$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$row['role'] = $result[0]['description'];
						//var_dump($row);
						echo $layout->loadUserRow($row);
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
