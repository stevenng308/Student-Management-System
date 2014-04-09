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
//$class_arr = [];
$topic_arr = [];
$posts = 0;
for ($i = 0; $i < count($subscription); $i++)
{
	$respond = $database->query("SELECT * FROM response WHERE topicid = " . $subscription[$i]['topicID'] . "");
	if ($respond->rowCount()+1 > $subscription[$i]['lastNum']) // if true new posts were made
	{
		$num = $respond->rowCount() + 1;
		$posts = $posts + ($num - $subscription[$i]['lastNum']);
		//$database->exec("UPDATE subscribe SET lastNum = " . $num . " WHERE id = " . $subscription[$i]['id'] . ""); //update the number of posts in the subscription row
		$query = $database->query("SELECT * FROM forum WHERE topicID = " . $subscription[$i]['topicID'] . "");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$topic = new Topic($result[0], $respond->rowCount());
		//$class_arr[$i] = $topic->getClassID();
		$topic_arr[$i] = $topic; //store the topic object for further use
		//var_dump($class_arr);
	}
}
//$class_arr = array_values(array_unique($class_arr)); //remove dupes and normalize the index values because of removal
//$topic_arr = array_values(array_unique($topic_arr)); //remove dupes and normalize the index values because of removal
//var_dump($class_arr);
//var_dump($topic_arr);
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Admin Main', '../');
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
	<li class="dropdown">
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge badge-danger"><?php echo $posts . ' '; ?></span> New Forum Msgs <b class="caret"></b></a>
	  <ul class="dropdown-menu">
		<?php
			/*if (!empty($class_arr))
			{
				foreach ($class_arr as $class)
				{
					$query = $database->query("SELECT course_name FROM classroom WHERE classID = " . $class . "");
					$classroom = $query->fetchAll(PDO::FETCH_ASSOC);
					echo '<li><a href="../classPage.php?classid=' . $class . '">' . $classroom[0]['course_name'] . ' ' . ' - Class Page </a></li>';
				}
			}*/
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
  <div class="panel panel-fb">
    <div class="panel-heading">
      <h2 class="panel-title" align="center">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Create New Message
        </a>
      </h2>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
	<div class="container admintron">
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

<!-- Andre Vicente - Loading Each Student Account Lunch Account depending on Student ID 
     We are assuming since this is the ADMIN Main page that their ROLE is automatically set to 1 -->
	 
<div class='container bottomMargin' id='lunch'>
	<div class='table-responsive'>
		<h3 align='center'>Students Associated To Current Account</h3>
			<table cellpadding='0' cellspacing='0' border='0' class='table table-hover' id='lunchTable'>
				<thead>
					<tr>
						<th style='text-align: center;'>Student ID</th>
						<th style='text-align: center;'>First Name</th>
						<th style='text-align: center;'>Last Name</th>
						<th style='text-align: center;'>Active</th>
						<th style='text-align: center;'>Account Balance</th>
						<th class="no-sort" style='text-align: center;'></th>
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
	"aaSorting": [[4, 'asc']],
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
