<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- student main -->

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
	if($_SESSION['sess_role'] != 3)
	{
		header('Refresh: 1.5; url=../index.php');
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align:middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}
else
{
	header('Location: ../index.php');
}
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
$query = $database->query("SELECT accountID FROM newuser WHERE accountID = " . $session->getID() . "");
if ($query->rowCount() == 1)
{
	$new = $session->getID();
}
else
{
	$new = 0;
}

$query = $database->query("SELECT * FROM subscribe WHERE accountID = " . $session->getID() . " AND role = " . $session->getUserType() . "");
$subscription = $query->fetchAll(PDO::FETCH_ASSOC);
$topic_arr = [];
$posts = 0;
for ($i = 0; $i < count($subscription); $i++)
{
	$respond = $database->query("SELECT * FROM response WHERE topicid = " . $subscription[$i]['topicID'] . "");
	if ($respond->rowCount()+1 > $subscription[$i]['lastNum']) // if true new posts were made
	{
		$num = $respond->rowCount() + 1;
		$posts = $posts + ($num - $subscription[$i]['lastNum']);
		$query = $database->query("SELECT * FROM forum WHERE topicID = " . $subscription[$i]['topicID'] . "");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$topic = new Topic($result[0], $respond->rowCount());

		$topic_arr[$i] = $topic; //store the topic object for further use

	}
}

$user = new User($database, $session->getID(), 'Student');
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Student Main', '../');
?>
<!-- Custom CSS for this page -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/dataTables.bootstrap.css">

<!-- Begin page content -->
<div class="container">
 <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-4">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand">Hello <?php echo $session->getFirstName(); ?>.</a>
	</div>
	<ul class="nav navbar-nav navbar-right">
	<li><p class="navbar-text"><?php echo $user->getBalanceFormatted(); ?></p></li> 
	<li class="dropdown">
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-danger"><?php echo $posts . ' '; ?></span> New Forum Msgs <b class="caret"></b></a>
	  <ul class="dropdown-menu">
		<?php
			if (!empty($topic_arr)) //topic array and class array should be same size
			{
				foreach ($topic_arr as $newTopic)
				{
					echo '<li><a href="../classPage.php?classid=' . $newTopic->getClassID() . '&topicid=' . $newTopic->getTopicID() . '">' . $newTopic->getTopicSubjectFormatted() . '</a></li>';
				}
			}
			else
			{
				echo '<li class="disabled"><a>No New Forum Msgs</a></li>';
			}
		?>
	  </ul>
	</li>
  </ul>
  </div>
</nav>

 
<!-- Begin collapse -->
<div class="panel-group" id="accordion">
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title" align="center">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	 Message Board
	</a>
      </h3>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
	<div class="container messagetron">
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

<div class="container bottomMargin">
	<div class="table-responsive">
		<h3 align="center">Assigned Classes</h3>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="classTable">
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
						/*
						//$stdID = $database->query('SELECT studentID FROM student WHERE accountID = ' . $session->getID() . '');
						$query = $database->query("SELECT studentID FROM student WHERE accountID = " . $session->getID() . "");
						$student = $query->fetchAll(PDO::FETCH_ASSOC);
						$count = 0;
						//foreach ($database->query('SELECT * FROM classroom WHERE teacherID = ' . $session->getID() . '') as $row)
						//foreach ($database->query('SELECT * FROM enrolled WHERE studentID = ' . $stdID . '') as $cls)
						foreach ($database->query('SELECT * FROM enrolled WHERE studentID = ' . $student[0]['studentID'] . '') as $cls)
						{
							$tchr = $database->query('SELECT * FROM classroom WHERE classID = "' . $cls['classID'] . '"');
							//$tchrr = $tchr->fetchAll(PDO::FETCH_ASSOC);
							$clss = ($database->query('SELECT * FROM classroom WHERE teacherID = "' . $tchr['teacherID'] . '"'));
							$clss2 = $clss->fetchALL(PDO::FETCH_ASSOC);
							$stmt =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $tchrr[0]['teacherID'] . '"');
							$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$classroom = new Classroom($clss2, $result, $database);
							echo $layout->loadClassRow($classroom, $count, $session->getUserType());
							$count++;
						}
						*/
						//$stdID = $database->query('SELECT studentID FROM student WHERE accountID = ' . $session->getID() . '');
						$query = $database->query("SELECT studentID FROM student WHERE accountID = " . $session->getID() . "");
						$student = $query->fetchAll(PDO::FETCH_ASSOC);
						$count = 0;
						//$listOfEnrolled = $database->query('SELECT classID FROM enrolled WHERE studentID = ' . $student[0]['studentID'] . '');
						//$precursor = $database->query("SELECT * FROM classroom WHERE classID = " . $listOfEnrolled . "");
						foreach ($database->query('SELECT classID FROM enrolled WHERE studentID = ' . $student[0]['studentID'] . '') as $enrolled)
						{
						//foreach ($database->query('SELECT * FROM classroom WHERE classID = ' . $listOfEnrolled['studentID'] . '') as $class)
							foreach ($database->query('SELECT * FROM classroom WHERE classID = ' . $enrolled[0] . '') as $class)
							{
								$clss = $database->query('SELECT * FROM classroom WHERE classID = "' . $class['classID'] . '"');
								$clss = $clss->fetchAll(PDO::FETCH_ASSOC);
								$stmt =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $clss[0]['teacherID'] . '"');
								$teacher = $stmt->fetchAll(PDO::FETCH_ASSOC);
								$classroom = new Classroom($class, $teacher, $database);
								echo $layout->loadClassRow($classroom, $count, $session->getUserType());
								$count++;
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
<script type="text/javascript" language="javascript" src="../bootstrap/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" language="javascript" charset="utf-8">
$('#classTable').dataTable(
{
	"aaSorting": [[0, 'asc']],
	"aoColumnDefs" : [ {
		'bSortable' : false,
		'aTargets' : [ "no-sort" ]
	}]
});

if (<?php echo $new ?>)
{
	if (window.confirm('Please consider changing your password for account integrity.'))
	{
		window.location.replace('../changePassword.php?id=' + <?php echo $new ?>);
	}
}
</script>
</html>
