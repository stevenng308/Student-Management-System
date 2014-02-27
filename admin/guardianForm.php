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
	if($_SESSION['sess_role'] != 1)
	{
		echo '
			<div><p color="red">You do not have the correct privileges to acces this page.</p></div>
		';
	}
}
else
{
	header('Location: ../index.php');
}
$layout = new Layout();
$database = new Database();
$session = new Session($_SESSION, $database);
$clean = new Clean();

$userType = $_GET['role'] or die("Account type not provided");
//var_dump($_SESSION);
//var_dump($session);

echo $layout->loadFixedMainNavBar($session->getUserTypeFormatted(), 'Guardian Form', '../');
?>
	<!-- Custom styles for this template -->
	<link href="../bootstrap/css/register.css" rel="stylesheet">
	<div class="formDiv">
	<form name ="register" id="register-form" class="form-signin" action="" method="post">
		<h2 class="form-signin-heading">Personal Information</h2>
		<div class="control-group">
			<input type="text" class="form-control" name="firstname" id = "firstname" placeholder="First Name" autofocus/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="lastname" id = "lastname" placeholder="Last Name"/>
		</div>
		<br />
		<!--<label for="birthday">Birthdate: 01-01-1970</label>-->
		<div class="row">
			<div class="col-xs-6 col-md-4">
				<div class="control-group">
					<input type="text" class="form-control" name="month" id="month" placeholder="Month"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="control-group">
					<input type="text" class="form-control" name="day" id="day" placeholder="Day"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="control-group">
					<input type="text" class="form-control" name="year" id="year" placeholder="Year"/>
				</div>
			</div>
		</div>
		<br />
		<div class="control-group">
			<input type="text" class="form-control" name="street" id = "street" placeholder="Street Address"/>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-7">
				<div class="control-group">
					<input type="text" class="form-control" name="city" id="city" placeholder="City"/>
				</div>
			</div>
			<div class="col-xs-6 col-md-5">
				<div class="control-group">
					<select id="state" name="state" class="form-control">
						<option selected="selected">State</option>
							<option value="AL">AL</option>
							<option value="AK">AK</option>
							<option value="AZ">AZ</option>
							<option value="AR">AR</option>
							<option value="CA">CA</option>
							<option value="CO">CO</option>
							<option value="CT">CT</option>
							<option value="DE">DE</option>
							<option value="DC">DC</option>
							<option value="FL">FL</option>
							<option value="GA">GA</option>
							<option value="HI">HI</option>
							<option value="ID">ID</option>
							<option value="IL">IL</option>
							<option value="IN">IN</option>
							<option value="IA">IA</option>
							<option value="KS">KS</option>
							<option value="KY">KY</option>
							<option value="LA">LA</option>
							<option value="ME">ME</option>
							<option value="MD">MD</option>
							<option value="MA">MA</option>
							<option value="MI">MI</option>
							<option value="MN">MN</option>
							<option value="MS">MS</option>
							<option value="MO">MO</option>
							<option value="MT">MT</option>
							<option value="NE">NE</option>
							<option value="NV">NV</option>
							<option value="NH">NH</option>
							<option value="NJ">NJ</option>
							<option value="NM">NM</option>
							<option value="NY">NY</option>
							<option value="NC">NC</option>
							<option value="ND">ND</option>
							<option value="OH">OH</option>
							<option value="OK">OK</option>
							<option value="OR">OR</option>
							<option value="PA">PA</option>
							<option value="RI">RI</option>
							<option value="SC">SC</option>
							<option value="SD">SD</option>
							<option value="TN">TN</option>
							<option value="TX">TX</option>
							<option value="UT">UT</option>
							<option value="VT">VT</option>
							<option value="VA">VA</option>
							<option value="WA">WA</option>
							<option value="WV">WV</option>
							<option value="WI">WI</option>
							<option value="WY">WY</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-7">
				<div class="control-group">
					<input type="text" class="form-control" name="zip" id="zip" placeholder="Zip"/>
				</div>
			</div>
		</div>
		<br />
		<div class="control-group">
			<input type="text" class="form-control" name="email" id = "email" placeholder="Email Address"/>
		</div>
		<div class="control-group">
			<input type="text" class="form-control" name="contact" id = "contact" placeholder="Contact Number"/>
		</div>
		<h2 class="form-signin-heading">Account Information</h2>
		<div class="control-group">
			<input type="text" class="form-control" name="username" id = "username" placeholder="Username"/>
		</div>
		<div class="control-group">
			<input type="password" class="form-control" name="password" id="password" placeholder="Password (no symbols)"/>
		</div>
		<div class="control-group">
			<input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password"/>
		</div>
		<br />
		<div class="control-group">
			<textarea class="form-control" rows="3" cols="7" name="childrenID" id="childrenID" placeholder="Enter The Child's Student ID Number. If there are more than one, separate them with a comma (1234,5678)."></textarea>
		</div>
		<br />
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">Submit</button>				

	<?php
		/*$escape = true;
		if (isset($_POST['submit'])) 
		{
			foreach($_POST as &$str)
			{
				if (empty($str))
				{
					echo '<div class="alert alert-danger">
							<p><strong>Error!</strong> Please completely fill out the registration form.</p>
						  </div>
						  </form>
						  </div>';
					echo $layout->loadFooter('../');	  
					$escape = false;
					return;	
				}
				$str = $clean->cleanString($str);
			}
		
			/*if ($_POST['password'] != $_POST['password2'] && $escape)
			{
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p><strong>Error!</strong> The passwords do not match. Please check your input.</p>
					 </div>';
				echo $layout->loadFooter('../');	 
			}
			else if (strlen($_POST['firstname']) > 20 || strlen($_POST['lastname']) > 25 || strlen($_POST['email']) > 50  || strlen($_POST['username']) > 25)
			{
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p><strong>Error!</strong> First Name, Last Name, Email or Username is too long.</p>
					 </div>';
				echo $layout->loadFooter('../');	 
			}
			else
			{	
				//$database->insert($_POST);
				//header('location: login.php');	
			}
		}*/
	?>
	</div>
<?php
	echo $layout->loadFooter('../');
?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script>
$(document).ready(function () {

    $('#register-form').validate({
        rules: {
            firstname: {
                minlength: 2,
				maxlength: 20,
                required: true
            },
			lastname: {
                minlength: 2,
				maxlength: 25,
                required: true
            },
			month: {
				digits: true,
                minlength: 1,
				maxlength: 2,
                required: true
            },
			day: {
				digits: true,
                minlength: 1,
				maxlength: 2,
                required: true
            },
			year: {
				digits: true,
                minlength: 4,
				maxlength: 4,
                required: true,
            },
			street: {
				maxlength: 75,
                required: true,
            },
			city: {
                minlength: 2,
				maxlength: 20,
                required: true,
            },
			zip: {
				digits: true,
                minlength: 5,
				maxlength: 5,
                required: true,
            },
            email: {
                required: true,
				maxlength: 50,
                email: true
            },
            contact: {
				digits: true,
                minlength: 10,
				maxlength: 10,
                required: true,
            },
			username: {
                required: true,
				maxlength: 25,
            },
			password: {
                required: true,
				minlength: 6
            },
			password2: {
                required: true,
				minlength: 6,
				equalTo: "#password"
            },
        },
		messages: {
			month: {
				maxlength: "2 digits max",
				digits: "Numbers Only"
			},
			day: {
				maxlength: "2 digits max",
				digits: "Numbers Only"
			},
            year: {
                minlength: "Use 4 digits",
				maxlength: "Use 4 digits",
				digits: "Numbers Only"
			},
			contact: {
				digits: "Format contact number as shown (1237774567)"
			},
			password2: {
				equalTo: "Password confirmation does not match"
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

});
</script>
</html>