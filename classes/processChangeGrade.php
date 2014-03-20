<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process registration forms -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}

//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
//var_dump($_POST);
$id = mysql_real_escape_string($_POST['id']);
$class = mysql_real_escape_string($_POST['class']);
$query = $database->query("SELECT username, firstname, lastname FROM student WHERE studentid = " . $id . "");
$result = $query->fetchAll(PDO::FETCH_ASSOC);

array_pop($_POST); //pop class
array_pop($_POST); //pop id

$database->exec("DELETE FROM grade WHERE studentID = " . $id  . " AND classID = " . $class . ""); //wipe the grades to reinsert the new updated grades
$delete = '';
$label = '';
$grade = '';
foreach ($_POST as $key => $element)
{
	if (substr($key, 0, 6) == "delete")
	{
		//$query = $database->exec("DELETE FROM grades WHERE gradeID = " . $element . "");
		$delete = substr($key, 6);
		$label = 'label' . $delete;
		$grade = 'grade' . $delete;
	}
	else if ($key != $label && substr($key, 0, 5) != "grade")
	{
		$stmt = $database->prepare("INSERT INTO grade(studentID, classID, label, grade) VALUES (:student, :class, :label, :grade)");
		$num = substr($key, 5);
		$gradenum = "grade" . $num;
		$stmt->execute(array(':student' => $id, ':class' => $class, ':label' => $element, ':grade' => $_POST[$gradenum]));
	}
}
?>
<!-- Custom styles for this template -->
<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
	<h2>Grade changed for <?php echo $result[0]['username'] . ' &lt' . $result[0]['firstname'] . ' ' . $result[0]['lastname'] . '&gt';?></h2>
		<form class="form-signin" style="text-valign:center">
			<a class="btn btn-primary" href="../classPage.php?classid=<?php echo $class; ?>" role="button">Return To Class Page</a>
			<a class="btn btn-default" href="../index.php" role="button">Return Home</a>
		</form>
	</div>
</div>
