<html>
	<form name ="register" class="form-signin" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">
		<h2 class="form-signin-heading">Personal Information</h2>
		<input type="text" class="form-control" name="firstname" id = "firstname" placeholder="First Name" autofocus/>
		<input type="text" class="form-control" name="lastname" id = "lastname" placeholder="Last Name"/>
		
		
			<!--<label for="birthday" class="col-xs-2 control-label">Birth: </label>-->
			<br />
			<div class="row">
				<div class="col-xs-6 col-md-4">
					<input type="text" class="form-control" name="month" id="month" placeholder="Month"/>
				</div>
				<div class="col-xs-6 col-md-4">
					<input type="text" class="form-control" name="day" id="day" placeholder="Day"/>
				</div>
				<div class="col-xs-6 col-md-4">
					<input type="text" class="form-control" name="year" id="year" placeholder="Year"/>
				</div>
			</div>
			<br />
		<input type="text" class="form-control" name="email" id = "email" placeholder="Email Address"/>
		<input type="text" class="form-control" name="contact" id = "contact" placeholder="Contact Number (7777777777)"/>
		
		<h2 class="form-signin-heading">Account Information</h2>
		<input type="text" class="form-control" name="username" id = "username" placeholder="Username"/>
		<input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
		<input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password"/>
		<input type="password" class="form-control" name="studentid" id="studentid" placeholder="Student ID"/>
		<br />
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">Submit</button>				
	</form>
</html>