<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- process adding grades -->

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

$num = (count($_POST) - 2) / 2; //subtract 2 for the student id and class id halve because the label and grade are pairs
$stmt = $database->prepare("INSERT INTO grade(studentID, classID, label, grade) VALUES (:student, :class, :label, :grade)");
for ($i = 0; $i < $num; $i++)
{	
	$label = 'label' . $i;//constructing index position for POST array
	$grade = 'grade' . $i;
	//echo $_POST[$label] . ' ' . $_POST[$grade] . '//';
	$stmt->execute(array(':student' => $id, ':class' => $class, ':label' => $_POST[$label], ':grade' => $_POST[$grade]));
}
?>
<!-- Custom styles for this template -->
<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">

<div class="container jumbo-tron form-wrapper" style="text-align:center; vertical-align:middle">
	<div class="jumbotron">
	<h2>Grade entered for <?php echo $result[0]['username'] . ' &lt' . $result[0]['firstname'] . ' ' . $result[0]['lastname'] . '&gt';?></h2>
		<form class="form-signin" style="text-valign:center">
			<a class="btn btn-primary" href="../classPage.php?classid=<?php echo $class; ?>" role="button">Return To Class Page</a>
			<a class="btn btn-default" href="../index.php" role="button">Return Home</a>
		</form>
	</div>
</div>
