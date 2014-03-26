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

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Admin Main', '../');
?>
<!-- Custom CSS for this page -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.css">

<!-- Begin page content -->
<div class="container">
	<h3>Hello <?php echo $session->getFirstName(); ?>.</h3>

<!-- Begin collapse -->
<div class="panel-group" id="accordion">
  <div class="panel panel-fb">
    <div class="panel-heading">
      <h2 class="panel-title" align="center">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Post Message
        </a>
      </h2>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
	<div class="jumbotron">
		<form name="compose" id="compose-form" action="#" method="post">
			<pre><textarea id="message" name="message" class="messageBoard"></textarea></pre>			
		</form>
		<button class="btn btn-lg btn-primary btn-block" onclick="postMsg()">Post Message</button>
	</div>
      </div>
    </div>
  </div>


  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title" align="center">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
	 Message Board
	</a>
      </h3>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
	<div class="jumbotron">
		<div class="table-responsive">
			<table class="table table-condensed" id="messageTable">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th>
							Message
						</th>
						<th style="text-align: center;">
							Posted By
						</th>
						<th style="text-align: center;">
							Time Posted
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$count = 0;
						foreach ($database->query("SELECT * FROM messageboard ORDER BY messageDate DESC") as $row)
						{
							$messge = new Message($row);
							echo $layout->loadMessages($messge, $count, $session->getUserType());
							$count++;
							if ($count > 4)
								break;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
      </div>
    </div>
  </div>
</div>

<!-- Andre Vicente - Loading Each Student Account Lunch Account depending on Student ID 
     We are assuming since this is the ADMIN Main page that their ROLE is automatically set to 1 -->
	 
<div class='container bottomMargin' id='lunch'>
	<div class='table-responsive'>
		<h3 align='center'>Students linked to Current Account</h3>
			<table cellpadding='0' cellspacing='0' border='0' class='table table-hover' id='lunchTable'>
				<thead>
					<tr>
						<th style='text-align: center;'>Student ID</th>
						<th style='text-align: center;'>First Name</th>
						<th style='text-align: center;'>Last Name</th>
						<th style='text-align: center;'>Account Balance</th>
						<th class="no-sort" style='text-align: center;'></th>
					</tr>
				</thead>
			<tbody>
			<?php
			$query = "SELECT studentID FROM parent_student_assoc WHERE guardianID = '" . $session->getID() . "' AND role ='" . $session->getUserType() . "'";
			$result = $database->query($query);
			if ($result->rowCount() == 0)
			{
				; //do nothing
			}
			else
			{
				foreach ($database->query($query) as $row)
				{
					$stmt = $database->query('SELECT * FROM student WHERE studentID = "' . $row['studentID'] . '"');
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$user = new User($database, $result[0]['accountID'], "student");
					echo $layout->loadStudentLunchRow($user);
				} 
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<?php
	echo $layout->loadFooter('../');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script type="text/javascript" language="javascript" src="../bootstrap/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../bootstrap/js/handleMessage.js"></script>
<script type="text/javascript" language="javascript" charset="utf-8">
$('#lunchTable').dataTable(
{
	"aaSorting": [[3, 'asc']],
	"aoColumnDefs" : [ {
		'bSortable' : false,
		'aTargets' : [ "no-sort" ]
	}]
});
</script>
</html>
