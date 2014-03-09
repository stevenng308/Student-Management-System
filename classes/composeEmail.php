<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- compose an email -->

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
	/*if($_SESSION['sess_role'] != 1)
	{
		header('Refresh: 1.5; url=../index.php');
		echo '<link href="../bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}*/
}
else
{
	header('Location: ../index.php');
}
$layout = new Layout();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$session = new Session($_SESSION, $database);
?>
<!-- Custom styles for this template -->
<link rel="stylesheet" href="bootstrap/css/jquery-ui-1.10.4.custom.css" type="text/css" /> 

<!-- Begin page content -->
<div class="container jumbotron">
	<ol class="breadcrumb">
	  <li><a href="#" class="btn btn-sm disabled emailNav" role="button">Email</a></li>
	  <li><a a class="btn btn-sm emailNav" role="button" id="compose" onclick="loadIn('compose')">Compose</a></li>
	</ol>

	<form name="compose" id="compose-form" action="#" method="post">
		<div class="control-group">
		<div class="input-group">
		  <span class="input-group-addon">To:</span>
		  <input id="username" name="username" type="text" class="form-control" placeholder="Username">
		</div>
		</div>
		<div class="input-group">
		  <span class="input-group-addon">Subject:</span>
		  <input id="subject" name="subject" type="text" class="form-control" placeholder="">
		</div><br />
		<textarea id="message" name="message" class="emailMessage"></textarea>
		<button class="btn btn-lg btn-primary btn-block pull-right" type="submit" name="submit" value="send">Send</button>
	</form>
</div>

<script src="bootstrap/js/jquery-ui-1.10.4.custom.js"></script>	
<script>
$(document).ready(function () {
var searchRequest = null;
var userNames = '';

	$("#username").autocomplete({
		minLength: 2,
		source: function(request, response) {
			if (searchRequest !== null) {
				searchRequest.abort();
			}
			searchRequest = $.ajax({
				url: 'classes/listUser.php',
				method: 'post',
				dataType: "json",
				data: {term: request.term},
				success: function(data) {
					searchRequest = null;
					response($.map(data, function(data) {
						return {
							label: data.label + '<' + data.first + ' ' + data.last + '>',
							value: data.value + ',',
						};
					}));
				}
			})
		},
		select: function(event, ui) { //handles the event when user selects a suggestion from the autocomplete and concatenate the string in the "to" field
			event.preventDefault(); // ignore the default event
			//return false;
			var username_arr = (document.getElementById("username").value).split(','); //splits the string and stores into an array
			if (username_arr.length === 1) //true if the array contains 1 element so the user is just building the list of users
			{
				var item = ui.item.value; //get the value from the selected suggestion and use only that
			}
			else
			{
				username_arr[username_arr.length - 1] = ui.item.value; //the last element has a partial string due to 'document.getElementById("username").value'
																		//remove the partial string and assign it the actual value that the user selected
				var item = username_arr.join(); //join the elements into a string
			}
			//var item = userNames + ui.item.value;
			$(this).val(item); //set the username input with this string
			userNames = document.getElementById("username").value; //update the variable with the name string value in the username field
		},
		focus: function(event, ui) { //stops the default action when user uses the arrow keys and press enter on a suggestion
			event.preventDefault();
			return false;
		}
	});
});

$(function () {
	$('#compose-form').submit(function () {
		if(document.getElementById("message").value) {
			//alert('Successful Validation');
			$.post(
				'classes/sendEmail.php',
				$(this).serialize(),
				function(data){
				  //$("#mainDiv").html(data);
				  //console.log(data);
				  alert("Email sent.");
				  loadIn('compose');
				}
			  );
		  return false;
		}
		else
		{
			alert('Please include a message in your email.');
			return false;
		}
	});
});
</script>
</html>
