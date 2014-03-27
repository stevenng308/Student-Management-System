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
$classid = $_GET['classid'] or die(header('Location: error.php'));
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
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
if($_SESSION['sess_role'] == 3)
{
	$query = $database->query('SELECT studentID FROM enrolled WHERE studentID = ' . $session->getID() . ' AND classID = ' . $classid . ' LIMIT 1');
	if ($query->rowCount() == 0)
	{
		header('Refresh: 1.5; url=index.php');
		echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}	
if($_SESSION['sess_role'] == 2)
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
			  <li class="active"><a href="#home" data-toggle="tab"><b>Home</b></a></li>
			  <li><a href="#forum" data-toggle="tab"><b>Forum</b></a></li>
			  <?php
				if ($_SESSION['sess_role'] != 3)
				{
					echo '
						 <li><a href="#register" tabindex="-1" data-toggle="tab"><b>Register</b></a></li>
						 <li><a href="#rosterList" tabindex="-1" data-toggle="tab"><b>Roster</b></a></li>
						 <li><a href="#allGrades" data-toggle="tab"><b>All Grades</b></a></li>
						 ';
					//echo '<li><a href="#grades" data-toggle="tab"><b>Grades</b></a></li>';
				}
				else
				{
					echo '<li><a href="#grades" data-toggle="tab"><b>Grades</b></a></li>';
				}
			  ?>
		</ul>
	<div id="myTabContent" class="tab-content">
	  <div class="tab-pane fade in active" id="home">
		<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
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
<script type="text/javascript" charset="utf-8">
$(window).load(function(){
	loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>); //load forum first when navigating to class page
	var role = <?php echo $_SESSION['sess_role']; ?>;
	if (role != 3)
	{
		loadClassPages('#rosterList' , 'classes/roster.php?classid=', <?php echo $classid; ?>); //load the class roster
		loadClassPages('#allGrades', 'classes/allGrades.php?classid=', <?php echo $classid; ?>); //load all grades first when navigating to class page
		//loadClassPages('#grades', 'classes/studentClassGrades.php?classid=', <?php echo $classid; ?>);
	}
	else if (role == 3)
	{
		loadClassPages('#grades', 'classes/studentClassGrades.php?classid=', <?php echo $classid; ?>); //load students grade in grade div
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
				  location.reload();
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
