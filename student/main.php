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
<?php
	echo $layout->loadFooter('../');
?>
</html>
