<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- index -->

<html>
<?php
//Auto loads all the class files in the classes folder
//Use require_once "dirname(dirname(__FILE__)) ." without quotes in front of '\AutoLoader.php' if you need to go up 2 directories to root. "dirname(__FILE__)) ." for 1 directory up.
require_once dirname(__FILE__) . '/AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	switch ($_SESSION[sess_role])
	{
		case 1: header('Location: admin/main.php');
				break;
		case 2: header('Location: teacher/main.php');
				break;
		case 3: header('Location: student/main.php');
				break;
		case 4: header('Location: parent/main.php');
				break;			
	}
}
$layout = new Layout();
$database = new Database();
//var_dump($_SESSION);

echo $layout->loadFixedNavBar('Home', '');
?>
<!-- Custom styles for this template -->
<link href="bootstrap/css/signin.css" rel="stylesheet">

<!-- Begin page content -->
<div class="container bottomMargin">
  <form name="signin" class="form-signin" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">
		<h2 class="form-signin-heading">SMS Portal Login</h2>
			<input type="text" class="form-control" name="user" id = "user" placeholder="Username" autofocus>
			<input type="password" class="form-control" name="password" id = "password" placeholder="Password">
			<br/>
			<div class="row">
				<div class="col-md-4">
					<h4>Login as:</h4>
				</div>
				<div class="col-md-8">
					<select id="role" name="role" class="form-control">
					  <option selected="selected">Choose One</option>
					  <option value="1">Administrator</option>
					  <option value="2">Teacher</option>
					  <option value="3">Student</option>
					  <option value="4">Parent</option>
					</select>
				</div>
			</div>
			<br/>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submit">Sign in</button> 
	<div class="row">
		<div class="col-xs-6 col-sm-6" style="text-align: right;">
			<a href="forgot.php?type=1">Forgot Username</a>
		</div>
		<div class="col-xs-6 col-sm-6">
			<a href="forgot.php?type=2">Forgot Password</a>
		</div>
	</div>
	<div class="container" align="center">
		<p>Admin login: User - admin; Pass - admin</p>
	</div>
	<?php
		ob_start();
		if(!isset($_SESSION)){
			session_start();
		}
		if (isset($_POST['submit'])) 
		{		
			if (empty($_POST['user']) || empty($_POST['password']))//check if username and password field is empty
			{
				//echo $str;
				echo '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<p><strong>Error!</strong> Please input your username and password to sign in.</p>
					 </div>
					 </form>
				</div>';
				echo $layout->loadFooter('');
				return;
			}
			
			//echo 'Past empty';
			$user = $_POST['user'];
			$user= mysql_real_escape_string($user);
			$password = $_POST['password'];
			$role = $_POST['role'];
			//echo $role;
			switch ($role)
			{
				case 1: $table = 'admin';
				break;
				case 2: $table = 'teacher';
				break;
				case 3: $table = 'student';
				break;
				case 4: $table = 'parent';
				break;
				default: echo '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<p><strong>Error!</strong> Please specify an account type that you wish to login in as.</p>
							   </div>
						</form>
						</div>';
						echo $layout->loadFooter('');
						return;
			}
			//check if user exists
			$query = "SELECT accountID, username, role, firstName, lastName, password, email, DOB, contactNum, status, salt FROM " . $table . " WHERE username = '$user';";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0) // User not found.
			{
				echo '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p><strong>Error!</strong> Invalid username or password. Please input your correct login information.</p>
				 </div>
				 </form>
				 </div>';
				echo $layout->loadFooter('');
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
				 </div>
				 </form>
				 </div>';
				echo $layout->loadFooter('');
			}
			//check if the account is active
			else if ($userData['status'] == 0) //true if not active
			{
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p><strong>Error!</strong> This account has been deactivated. Please contact your school\'s SMS administrator about this issue.</p>
				 </div>
				 </form>
				 </div>';
				echo $layout->loadFooter('');
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
				header('Location: ' . $table . '/main.php');
			}
		}
	?>
</div>
<?php
	echo $layout->loadFooter('');
?>
<script type="text/javascript" charset="utf-8">
$(function(){
	// bind change event to select
	$('#role').bind('change', function () {	
		$('#submit').focus();
	});
});
</script>
</html>
