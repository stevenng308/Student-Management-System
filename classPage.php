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
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
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
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), $classroom->getCourseName() . ' &middot Class Page', '');
?>
<!-- Custom CSS for the arrow buttons on the table columns to sort -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/dataTables.bootstrap.css">

<!-- Begin page content -->
<div class="container">
	<div class="bs-example bs-example-tabs">
		<ul id="myTab" class="nav nav-tabs">
			  <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
			  <li><a href="#forum" data-toggle="tab">Forum</a></li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Roster <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="roster">
				  <li><a href="#register" tabindex="-1" data-toggle="tab">Register</a></li>
				  <li><a href="#rosterList" tabindex="-1" data-toggle="tab">Manage</a></li>
				</ul>
			  </li>
			  <li class="dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
				  <li><a href="#dropdown1" tabindex="-1" data-toggle="tab">@fat</a></li>
				  <li><a href="#dropdown2" tabindex="-1" data-toggle="tab">@mdo</a></li>
				</ul>
			  </li>
		</ul>
	<div id="myTabContent" class="tab-content">
	  <div class="tab-pane fade in active" id="home">
		<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
	  </div>
	  <div class="tab-pane fade" id="profile">
		<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
	  </div>
	  <div class="tab-pane fade" id="forum">
		<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
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
		<div class="table-responsive">
			<h3 align="center"><?php echo $classroom->getCourseNumber() . " " . $classroom->getCourseName(); ?> - Roster List</h3>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="studentTable">
				<div class="row">
					<div class="col-xs-3 col-sm-1">
						<button class="btn btn-danger btn-sm" onclick="unregister()">Del</button>
					</div>
				</div>
				<thead>
					<tr>
						<th class="no-sort" style="text-align: center;">
							<input type="checkbox" onClick="checkAll(this)" />
						</th>
						<th style="text-align: center;">
							Student ID
						</th>
						<th style="text-align: center;">
							Username
						</th>
						<th style="text-align: center;">
							First Name
						</th>
						<th style="text-align: center;">
							Last Name
						</th>
						<th class="no-sort" style="text-align: center;">
							Grades
						</th>
						<th class="no-sort" style="text-align: center;">
							Grades
						</th>
						<th class="no-sort" style="text-align: center;">
							Grades
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$count = 0;
						foreach ($database->query('SELECT * FROM enrolled JOIN student ON enrolled.studentid = student.studentid WHERE enrolled.classid = ' . $classid . '') as $row)
						{
							//var_dump($row);
							echo $layout->loadRosterRow($row['studentID'], $row['username'], $row['firstName'], $row['lastName'], $classid, $count);
							$count++;
						}
					?>
				</tbody>
			</table>
		</div>
	  </div>
	  <div class="tab-pane fade" id="dropdown1">
		<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
	  </div>
	  <div class="tab-pane fade" id="dropdown2">
		<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
	  </div>
	</div>
	</div><!-- /example -->
</div>
<?php
	echo $layout->loadFooter('');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script type="text/javascript" language="javascript" src="bootstrap/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="bootstrap/js/dataTables.bootstrap.js"></script>
<script  type="text/javascript" charset="utf-8">
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
		"The rightmost Student ID does not exist. Please make sure the Student ID is correct and that the student does have an ID number."
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
		"The rightmost Student ID has already been registered."
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

$('#studentTable').dataTable(
{
	"aaSorting": [[1, 'asc']],
	"aoColumnDefs" : [ {
		'bSortable' : false,
		'aTargets' : [ "no-sort" ]
	}]
});

var values = 0; //global array of the id's values
$('input[id^="delete"]').on('change', function() { //adds the values to the array called values
    values = $('input:checked').map(function() {
        return this.value;
    }).get();
    
    //alert(values);
});

function unregister()
{
	if (!values)
	{
		alert("No students were selected.");
	}
	else
	{
		if (window.confirm("Do you want to unregister?"))
		{
			//alert(values);
			//alert($('#box').val());
			$.post(
				'classes/unregisterStudents.php',
				{
					'checkbox' : values, 
				},
				function(data){
				  //$("#mainDiv").html(data);
				  location.reload();
				  //$('#roster').toggleClass("active");
				}
			  );
		  return false;
		}
		else
		{
			;//do nothing
		}
	}
}

function checkAll(source) {
  var checkboxes = $('input[id^="delete"]').not(":hidden"); //insert into an array of all checkboxes that have the id=delete but are not hidden from the fitering
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked; //check all of them
	values = $('input:checked').map(function() {
        return this.value; //updating the global variable values
    }).get();
  }
}          
</script>
</html>
