<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- email page-->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__) ." for 1 directory up.
require_once '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	if($_SESSION['sess_role'] == 4)
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
if (isset($_GET['topicid']))
{
	session_regenerate_id();
	$_SESSION['topic'] = $_GET['topicid']; //set a session variable for use after refresh to get rid of the get variable topicid in url
	session_write_close();
	$respond = $database->query("SELECT * FROM response WHERE topicid = " . $_GET['topicid'] . "");
	$num = $respond->rowCount() + 1;
	$posts = $posts + ($num - $subscription[$i]['lastNum']);
	$database->exec("UPDATE subscribe SET lastNum = " . $num . " WHERE accountID = " . $session->getID() . " AND role = " . $session->getUserType() . " AND topicID = " . $_GET['topicid'] . ""); //update the number of posts in the subscription row
	//var_dump($_SESSION['topic']);
	header('Location: classPage.php?classid=' . $classid . '');
}
if (isset($_GET['roster']))
{
	session_regenerate_id();
	$_SESSION['roster'] = $_GET['roster']; //set a session variable for use after refresh to get rid of the get variable roster in url
	session_write_close();
	//var_dump($_SESSION['roster']);
	header('Location: classPage.php?classid=' . $classid . '');
}
$query = $database->query('SELECT * FROM classroom WHERE classID = "' . $classid . '"');
$result = $query->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
$query =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $result[0]['teacherID'] . '"');
$teacher = $query->fetchAll(PDO::FETCH_ASSOC);
$classroom = new Classroom($result[0], $teacher, $database);
if (!$classroom->getStatus() && $_SESSION['sess_role'] == 3)
{
	header('Refresh: 1.5; url=index.php');
		echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>Classroom is inactive. You cannot view the classroom\'s page.</p></div></body></html>');
}
else if($_SESSION['sess_role'] == 3) //check if the student is registered in this class
{
	$query = $database->query('SELECT studentID FROM student WHERE accountID = ' . $session->getID() . '');
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$query = $database->query('SELECT studentID FROM enrolled WHERE studentID = ' . $result[0]['studentID'] . ' AND classID = ' . $classid . ' LIMIT 1');
	if ($query->rowCount() == 0)
	{
		header('Refresh: 1.5; url=index.php');
		echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}	
else if($_SESSION['sess_role'] == 2) //check if the teacher is assigned to this class
{
	$query = $database->query('SELECT teacherID FROM classroom WHERE teacherID = ' . $session->getID() . ' AND classID = ' .  $classid . ' LIMIT 1');
	if ($query->rowCount() == 0)
	{
		header('Refresh: 1.5; url=index.php');
		echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}	
	
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), $classroom->getCourseNumber() . ' ' . $classroom->getCourseName() . ' &middot Class Page', '');
?>
<!-- Custom CSS for the arrow buttons on the table columns to sort -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/dataTables.bootstrap.css">

<!-- Begin page content -->
<div class="container bottomMargin">
	<div class="bs-example bs-example-tabs">
		<ul id="myTab" class="nav nav-tabs nav-justified">
			  <li id="homeTab" class="active"><a href="#home" data-toggle="tab"><b>Home</b></a></li>
			  <li id="forumTab"><a href="#forum" data-toggle="tab"><b>Forum</b></a></li>
			  <?php
				if ($_SESSION['sess_role'] != 3)
				{
					echo '
						 <li id="registerTab"><a href="#register" tabindex="-1" data-toggle="tab"><b>Register</b></a></li>
						 <li id="rosterTab"><a href="#rosterList" tabindex="-1" data-toggle="tab"><b>Roster</b></a></li>
						 <li id="allGradesTab"><a href="#allGrades" data-toggle="tab"><b>All Grades</b></a></li>
						 ';
					//echo '<li><a href="#grades" data-toggle="tab"><b>Grades</b></a></li>';
				}
				else
				{
					echo '	
						<li id="gradesTab"><a href="#grades" data-toggle="tab"><b>Grades</b></a></li>
						<li id="rosterTab"><a href="#rosterList" tabindex="-1" data-toggle="tab"><b>Roster</b></a></li>
						';
					
				}
			  ?>
		</ul>
	<div id="myTabContent" class="tab-content">
	  <div class="tab-pane fade in active" id="home">
		<br />

<!----Begin Class Messageboard ---->

<div class="panel-group" id="accordion">
<?php
	if ($session->getUserType() != 3)
	{
		echo '
		  <div class="panel panel-fb">
			<div class="panel-heading">
			  <h2 class="panel-title" align="center">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				  Create New ' . $classroom->getCourseNumber() . " " . $classroom->getCourseName() . ' Message
				</a>
			  </h2>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in">
			  <div class="panel-body">
			<div class="container messagetron">
				<form name="compose" id="compose-form" action="#" method="post">
					<pre><textarea id="classMessage" name="message" class="messageBoard"></textarea></pre>			
				</form>
				<button class="btn btn-lg btn-primary btn-block" onclick="postClassMsg(' . $_GET['classid'] . ')">Post Message</button> <!---Will have to do postClassMsg($classID)--->
			</div>
			  </div>
			</div>
		  </div>
		  ';
	}
?>

  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title" align="center">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
	 <?php echo $classroom->getCourseNumber() . " " . $classroom->getCourseName(); ?> Message Board
	</a>
      </h3>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse <?php echo ($session->getUserType() == 3) ? 'in' : ''; ?>">
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
						$classid = $_GET['classid'];
						$query = $database->query("SELECT * FROM class_messageboard  WHERE classID = " . $classid . " ORDER BY messageDate DESC");
						if ($query->rowCount() == 0)
						{
							echo '
									<tr>
										<td></td><td></td>
										<td>
											No class message available.
										</td>
										<td></td><td></td>
									</tr>
								';
						}
						else
						{
							foreach ($query as $row)
							{
									$message = new ClassMessage($row);
									echo $layout->loadClassMessages($message, $classid, $count, $session->getUserType());
									$count++;
									if ($count > 4)
										break;
							}
						}
					?>
					<tr>
				</tbody>
			</table>
		</div>
	</div>
      </div>
    </div>
  </div>
</div>

<!----End Class Messageboard ---->

	  </div>
	  <div class="tab-pane fade" id="forum">
		<!-- ajax load content -->
	  </div>
	  <div class="tab-pane fade" id="grades">
		<!-- ajax load content -->
	  </div>
	  <div class="tab-pane fade" id="register">
		<div class="jumbotron">
			<form name="register" id="register-student" class="" action="#" method="post">
				<div class="control-group">
					<h2>Registration: <?php echo $classroom->getCourseNumber() . " " . $classroom->getCourseName(); ?></h2> <input id="classID" value="<?php echo $classid; ?>" hidden="hidden"/> 
					<textarea class="form-control childrenID" rows="4" cols="11" name="studentID" id="studentID" placeholder="Enter The Student ID Number/s you wish register for the class. If there are more than one, separate them with a comma (1234,5678). Max length for a Student ID is 20." autofocus></textarea>
				</div>
			</form>
			<button class="btn btn-lg btn-primary btn-block" name="registerStudent" id="registerStudent" onclick="registerStudents()">Register Students</button>
		</div>
	  </div>
	  <div class="tab-pane fade" id="rosterList">
		<!-- ajax load content -->
	  </div>
	  <div class="tab-pane fade" id="allGrades">
		<!-- ajax load content -->
	  </div>
	</div>
	</div>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script type="text/javascript" language="javascript" src="bootstrap/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="bootstrap/js/loadInPage.js"></script>
<script type="text/javascript" language="javascript" src="bootstrap/js/handleMessage.js"></script>
<script type="text/javascript" charset="utf-8">
$(window).load(function(){
	//var topic = <?php echo (isset($_SESSION['topic'])) ? $_SESSION['topic'] : 0; ?>; //help fix the undefined index that happens when coming from main page to forum
	//var roster = <?php echo (isset($_SESSION['roster'])) ? $_SESSION['roster'] : 0; ?>; //help fix the undefined index that happens when coming from register tab to roster
	//alert(<?php echo $_SESSION['topic']; ?>);
	if (<?php echo $_SESSION['topic']; ?>) //true if topic id has been set. show the topic page.
	{
		loadClassPages('#forum', 'classes/topicPage.php?classid=<?php echo $classid; ?>&topicid=', <?php echo $_SESSION['topic']; ?>);
		$('#forumTab a[href="#forum"]').tab('show');
		<?php 
			session_regenerate_id(); //session write open here
			$_SESSION['topic'] = 0; //set the session[topic] variable to zero so it won't load the topic page on refresh
			//session_write_close(); //no close or else $_SESSION['roster'] variable below will never be set to 0 even if topic id is not set
		?>;
	}
	else
	{
		loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>); //load forum otherwise when navigating to class page
	}
	
	//alert(<?php echo $_SESSION['roster']; ?>);
	if (<?php echo $_SESSION['roster']; ?>) //true if roster has been set. show the roster page.
	{
		//alert(<?php echo $_SESSION['roster']; ?>);
		loadClassPages('#rosterList', 'classes/roster.php?classid=', <?php echo $classid; ?>);
		$('#rosterTab a[href="#rosterList"]').tab('show');
		<?php 
			//session_regenerate_id();	
			$_SESSION['roster'] = 0; //set the session[roster] variable to zero so it won't load the topic page on refresh
			session_write_close();
		?>;
		//alert(<?php echo $_SESSION['roster']; ?>);
	}
	//loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>);
	var role = <?php echo $_SESSION['sess_role']; ?>;
	if (role != 3) //true if user is an admin load these pages in the proper divs
	{
		loadClassPages('#rosterList' , 'classes/roster.php?classid=', <?php echo $classid; ?>); //load the class roster
		loadClassPages('#allGrades', 'classes/allGrades.php?classid=', <?php echo $classid; ?>); //load all grades first when navigating to class page
		//loadClassPages('#grades', 'classes/studentClassGrades.php?classid=', <?php echo $classid; ?>);
	}
	else if (role == 3)
	{
		loadClassPages('#grades', 'classes/studentClassGrades.php?classid=', <?php echo $classid; ?>); //load students grade in grade div
		loadClassPages('#rosterList', 'classes/rosterStudent.php?classid=', <?php echo $classid; ?>); //load students view of the roster in div
	}
});

$(document).ready(function () {
	//rule for checking existence of studentID
	$.validator.addMethod("checkStudentID", 
		function(value, element) {
			var result = false;
			$.ajax({
				type:"POST",
				async: false,
				url: "classes/checkStudentID.php", // script to validate in server side
				data: {childrenID: value},
				success: function(data) {
					//alert(data);
					if (data.match(/true/))
					{
						result = true;
					}
					else
					{
						result = false;
					}
					//result = (data) ? true : false;
				}
			});
			return result; 
		}, 
		"One or more Student IDs do not exist. Please make sure the Student ID is correct, the student does have an ID number and the account is active."
	);
	
	//rule for allowing some symbols in the first and last name field
	$.validator.addMethod("allowCommas", 
        function(value, element, regexp) {
			var regex = new RegExp("^[0-9,]+$");
			//var regex2 = new RegExp("^$");
			var key = value;
			if (!(key.length > 0)) { //check empty string. if resolved true return true that it is empty.
			   return true;
			}
			else if (!regex.test(key)) //if resolved true, the key has some illegal characters so return false that it is not valid
			{
				return false;
			}
			return true; //return true that everything is valid
		},
		"Numbers and commas only"
	);
	
	//rule for checking if the student has been registered
	$.validator.addMethod("checkRegister", 
		function(value, element) {
			var result = false;
			$.ajax({
				type:"POST",
				async: false,
				url: "classes/checkRegisteredStudent.php", // script to validate in server side
				data: {
					'classID' : $('#classID').val(),
					childrenID: value
					},
				success: function(data) {
					//alert(data);
					if (data.match(/true/))
					{
						result = true;
					}
					else
					{
						result = false;
					}
					//result = (data) ? true : false;
				}
			});
			return result; 
		}, 
		"One or more Student IDs have already been registered."
	);
	
	$('#register-student').validate({
        rules: {
			studentID: {
				required: true,
				checkStudentID: true,
				checkRegister: true,
				allowCommas: true
			}
        },
		
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            element.text('OK!').addClass('valid')
                .closest('.control-group').removeClass('has-error').addClass('has-success');
        }
    });
	
	$('#register-student').keydown(function() {
		$('#register-student').valid();
	});
});

function registerStudents()
{
	if($('#register-student').valid())
	{
		if (window.confirm("Do you want to register?"))
		{
			//alert(values);
			//alert($('#box').val());
			$.post(
				'classes/processClassRegistration.php',
				{ 
					'classID' : $('#classID').val(),
					'studentID' : $('#studentID').val()
				},
				function(data){
				  //$("#register").html(data);
				  //loadIn(page);
				  alert("Registered.");
				  //alert(data);
				  $('#studentID').val("");
				  //location.reload();
				  loadClassPages('#rosterList' , 'classes/roster.php?classid=', <?php echo $classid; ?>); //reload the class roster
				  $('#rosterTab a[href="#rosterList"]').tab('show'); //display the roster tab
				}
			  );
		  return false;
		}
		else
		{
			;//do nothing
		}
	}
	else
	{
		alert('Please correct the errors indicated.');
		return false;
	}
}       
</script>
</html>
