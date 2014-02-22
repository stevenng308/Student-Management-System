<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- index -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__)) ." for 1 directory up.
require_once '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
$layout = new Layout();
$loggedIn = false;
$database = new Database();

//var_dump($_SESSION);
//need a check if already logged in

echo $layout->loadFixedNavBar('Home', '');
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/signin.css" rel="stylesheet">

<!-- Begin page content -->
<div class="container">
  <form name="signin" class="form-signin" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">
		<h2 class="form-signin-heading">Existing Users</h2>
			<input type="text" class="form-control" name="user" id = "user" placeholder="Username" autofocus>
			<input type="password" class="form-control" name="password" id = "password" placeholder="Password">
			<br />
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button> 
	</form>
	<?php
		ob_start();
		if(!isset($_SESSION)){
			session_start();
		}
		if (isset($_POST['submit'])) 
		{		
			if (empty($_POST['user']) || empty($_POST['password']))
			{
				//echo $str;
				echo '<div class="alert alert-danger">
					<p><strong>Error!</strong> Please input your username and password to sign in.</p>
					 </div>';
				return;
			}
			
			//echo 'Past empty';
			$user = $_POST['user'];
			$user= mysql_real_escape_string($user);
			$password = $_POST['password'];
			
			//check if user exists
			$query = "SELECT accountID, username, role, firstName, lastName, password, email, DOB, contactNum, salt FROM admin WHERE username = '$user';";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0) // User not found.
			{
				echo '<div class="alert alert-danger">
					<p><strong>Error!</strong> Invalid Username. Please input your correct login information.</p>
				 </div>';
				return;
			}
			//check if password correct
			$userData = mysql_fetch_array($result, MYSQL_ASSOC);
			$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
			//echo $userData['salt'] . '<br />';
			//echo $hash . '<br />';
			//echo $userData['password'];
			if($hash != $userData['password']) // Incorrect password.
			{
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p><strong>Error!</strong> Invalid username or password. Please input your correct login information.</p>
				 </div>';
			}
			else
			{
				//$database->login($userData);
				session_regenerate_id();
				$_SESSION['sess_user_id'] = $userData['accountID'];
				$_SESSION['sess_username'] = $userData['username'];
				$_SESSION['sess_role'] = $userData['role'];
				$_SESSION['sess_firstName'] = $userData['firstName'];
				$_SESSION['sess_lastName'] = $userData['lastName'];
				session_write_close();
				header('Location: index.php');
			}
		}
	?>
</div>
	
<?php
echo $layout->loadFooter('');
?>
</html>
