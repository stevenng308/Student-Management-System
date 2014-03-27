<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- add grades form -->

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
	if($_SESSION['sess_role'] == 2)
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

if ($session->getUserType() == 1)
{
	$header = "Location: ../admin/error.php";
}
else if ($session->getUserType() == 4)
{
	$header = "Location: ../parent/error.php";
}

else
{
	$header = "Location: error.php";
}
$id = $_GET['id'] or die(header($header));
if (isset($_GET['field']))
{
	$field = $_GET['field'];
	$year = $_GET['field'];
}
else
{
	$field = 0;
	$year = "Select a school year";
}
//var_dump($_SESSION);
//var_dump($session);
$query = $database->query("SELECT * FROM student WHERE studentid = " . $id . "");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), $result[0]['firstName'] . '  ' . $result[0]['lastName'] . '\'s Grades', '../');
?>
<div class="container bottomMargin">
	<div class="row">
		<div class="col-xs-6 col-md-3">
		</div>
		<div class="col-xs-6 col-md-2" style="text-align: right;">
			<h4>School Year:</h4>
		</div>
		<div class="col-xs-6 col-sm-3">
			<select id="field" class="form-control">
			<option selected="selected" value="<?php echo $field; ?>"><?php echo $year; ?></option>
			<?php
				/*for ($i = 0; $i < 11; $i++)
				{
					if ($field != $i)
					{
						echo '<option value="' . $i . '">' . $i . '</option>';
					}
				}*/
				$year_arr = [];
				$count = 0;//using for array index values
				foreach ($database->query("SELECT classID FROM grade WHERE studentID = " . $id . "") as $class)
				{
					$query = $database->query("SELECT year FROM classroom WHERE classID = " . $class[0] . "");
					$year = $query->fetchAll(PDO::FETCH_ASSOC);
					$year_arr[$count] = $year[0]['year'];
					$count++;
				}
				$year_arr = array_values(array_unique($year_arr)); //remove dupes and then normalize the indexes
				for ($i = 0; $i < count($year_arr); $i++)
				{
					if ($field != $year_arr[$i])
					{
						echo '<option value="' . $year_arr[$i] . '">' . $year_arr[$i] . '</option>';
					}
				}
				echo '</select></div>
					<div class="col-xs-6 col-sm-4"></div>
					</div>';
			?>
			
	<div class="row">
		<div class="col-xs-6 col-sm-4"></div>
		<div class="table-responsive col-xs-6 col-sm-4">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th style="text-align: center;" colspan="6">
							<h3><?php echo $result[0]['firstName'] . '  ' . $result[0]['lastName'] . '\'s Grades'; ?></h3>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if (isset($_GET['field']))
				{
					$class_arr = [];
					$name_arr = [];
					$count = 0; //using for array index values
					foreach ($database->query('SELECT classid FROM grade WHERE studentID = ' . $id . '') as $class)
					{
						$query = $database->query('SELECT classid, course_name FROM classroom WHERE classID = ' . $class[0] . ' AND year = "' . $_GET['field'] . '"');
						if ($query->rowCount() != 0)
						{
							$class = $query->fetchAll(PDO::FETCH_ASSOC);
							//var_dump($class);
							$class_arr[$count] = $class[0]['classid'];
							$name_arr[$count] = $class[0]['course_name'];
							//echo $count . ' ';
							$count++;
						}
					}
					$class_arr = array_values(array_unique($class_arr)); //remove dupes and then normalize the indexes
					$name_arr = array_values(array_unique($name_arr));
					//var_dump($class_arr);
					//var_dump($name_arr);
					for ($i = 0; $i < count($class_arr); $i++)
					{
						echo '<th style="text-align: center;" colspan="6">
								<h4>' . $name_arr[$i] . '</h4>
							</th>';
						foreach ($database->query('SELECT * FROM grade WHERE studentID = ' . $id . ' AND classID = ' . $class_arr[$i] . '') as $row) //change 12 later
						{
							echo '<tr>
									<td style="text-align: right; width: 25%;">' . $row['label'] . '</td>
									<td style="width: 25%;">' . $row['grade'] . '</td>
								  </tr>';
						}
					}
				}
				else
				{
					echo '<tr>
							<td style="text-align: center; width: 25%;">No grades available.</td>
						 </tr>';
				}
				?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-6 col-sm-4"></div>
	</div>
</div>
<?php
	echo $layout->loadFooter('../');
?>
<script>
$(function(){
	// bind change event to select
	$('#field').bind('change', function () {
		var field = $(this).val(); // get selected value
		var id = <?php echo $id ?>;
		if (field) { // require a URL
			window.location = "studentAllGrades.php?id=" + id + "&field=" + field ; // redirect
		}
		return false;
	});
});
</script>
</html>