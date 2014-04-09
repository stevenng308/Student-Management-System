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
if ($session->getUserType() == 1)
{
	$header = "Location: admin/error.php";
}
else
{
	$header = "Location: error.php";
}
$classid = $_GET['classid'] or die(header($header));
$query = $database->query('SELECT * FROM classroom WHERE classID = "' . $classid . '"');
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$stmt =  $database->query('SELECT username, firstname, lastname FROM teacher WHERE accountID = "' . $result[0]['teacherID'] . '"');
$teach = $stmt->fetchAll(PDO::FETCH_ASSOC);
$class = new Classroom($result[0], $teach, $database);
?>
<div class="container">
	<div class="row">	
		<div>
			<h3 align="center"><?php echo $class->getCourseNumber() . " " . $class->getCourseName(); ?> - Discussion Topics</h3>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="forumTable">
				<div class="row">
					<div class="col-xs-3 col-md-6">
						<button class="btn btn-primary btn-sm" onclick="loadClassPages('#forum' , 'classes/forumForm.php?classid=', <?php echo $classid; ?>)">New Topic</button>
					
					<?php
					if ($_SESSION['sess_role'] != 3)
					{
						echo '
							
								<button class="btn btn-info btn-sm" onclick="editTopic()">Edit</button>
								<button class="btn btn-danger btn-sm" onclick="deleteTopic()">Del</button>
							</div>
							';
					}
					?>
				</div>
				<thead>
					<tr>
						<?php
						if ($_SESSION['sess_role'] != 3)
						{
							echo '
								<th class="no-sort" style="text-align: center;">
									<input type="checkbox" onClick="checkAllForum(this)" />
								</th>
								';
						}
						?>
						<th style="text-align: center;">
							Topic
						</th>
						<th style="text-align: center;">
							Author
						</th>
						<th style="text-align: center;">
							Msgs
						</th>
						<th style="text-align: center;">
							Last Post
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 0;
						foreach ($database->query("SELECT * FROM forum WHERE forumName = '" . $class->getForumName() . "'") as $row)
						{
							$num = $database->query("SELECT * FROM response WHERE topicid = " . $row['topicID'] . "");
							$topic = new Topic($row, $num->rowCount());
							//var_dump($email);
							echo $layout->loadTopicRow($topic, $count, $session->getUserType());
							$count++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript" charset="utf-8">
if (<?php echo $session->getUserType(); ?> == 3)
{
	$('#forumTable').dataTable(
	{
		"aaSorting": [[3, 'desc']],
		"aoColumnDefs" : [ {
			'bSortable' : false,
			'aTargets' : [ "no-sort" ]
		}]
	});
}
else
{
	$('#forumTable').dataTable(
	{
		"aaSorting": [[4, 'desc']],
		"aoColumnDefs" : [ {
			'bSortable' : false,
			'aTargets' : [ "no-sort" ]
		}]
	});
}

var vals = 0; //global array of the id's values
$('input[id^="remove"]').on('change', function() { //adds the values to the array called vals
    vals = $('input:checked').map(function() {
        return this.value;
    }).get();
    
    //alert(vals);
});

function checkAllForum(source) {
  var checkboxes = $('input[id^="remove"]').not(":hidden"); //insert into an array of all checkboxes that have the id=delete but are not hidden from the fitering
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked; //check all of them
	vals = $('input:checked').map(function() {
        return this.value; //updating the global variable values
    }).get();
  }
}

function deleteTopic()
{
	if (!vals)
	{
		alert("No topics were selected.");
	}
	else
	{
		if (window.confirm("Do you want to delete?"))
		{
			//alert(values);
			$.post(
				'classes/deleteTopic.php',
				{
					'checkbox' : vals, //sending the values
				},
				function(data){
				  //$("#forum").html(data);
				  //console.log(data);
				  loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>);
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

function editTopic()
{
	if (!vals)
	{
		alert("No topics were selected.");
	}
	else if (vals.length > 1) //select only one
	{
		alert("Select one discussion topic to edit.");
	}
	else
	{
		if (window.confirm("Do you want to edit?"))
		{
			//alert(values);
			$.post(
				'classes/editTopic.php',
				{
					'checkbox' : vals, //sending the values
					'classID' : <?php echo $classid; ?>
				},
				function(data){
				  $("#forum").html(data);
				  //console.log(data);
				  //loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>);
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
</script>