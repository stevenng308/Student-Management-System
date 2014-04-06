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
	if($_SESSION['sess_role'] != 3)
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
/*$query = $database->query('SELECT * FROM classroom WHERE classID = "' . $classid . '"');
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$stmt =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $result[0]['teacherID'] . '"');
$teach = $stmt->fetchAll(PDO::FETCH_ASSOC);
$class= new Classroom($result[0], $teach, $database);*/
$query = $database->query("SELECT studentID FROM student WHERE accountID = " . $session->getID() . "");
$student = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<br />
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-4"></div>
		<div class="table-responsive col-xs-6 col-sm-4">
			<table class="table-bordered table-hover">
				<thead>
					<tr>
						<th style="text-align: center;" colspan="6">
							<h3><?php echo $session->getFirstName() . ' ' . $session->getLastName() . '\'s Grades'; ?></h3>
						</th>
					</tr>
					<tr>
						<th style="text-align: center;">
							<h4>Label</h4>
						</th>
						<th style="text-align: center;">
							<h4>Grade</h4>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$query = $database->query('SELECT * FROM grade WHERE studentID = ' . $student[0]['studentID'] . ' AND classID = ' . $classid . '');
					if ($query->rowCount() == 0)
					{
						echo '<tr>
								<td colspan="2" style="text-align: center;">
									No Grades available.
								</td>
							</tr>';
					}
					else
					{
						foreach ($query as $row) //change 12 later
						{
							echo '<tr>
									<td style="text-align: center; width: 25%;">' . $row['label'] . '</td>
									<td style="text-align: center; width: 25%;">' . $row['grade'] . '</td>
								  </tr>';
						}
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-6 col-sm-4"></div>
	</div>
</div>
<script type="text/javascript" language="javascript" charset="utf-8">
</script>