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
	<div class="input-group">
	  <span class="input-group-addon">To:</span>
	  <input id="username" name="username" type="text" class="form-control" placeholder="Username">
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Subject:</span>
	  <input type="text" class="form-control" placeholder="">
	</div><br />
	<textarea class="emailMessage"></textarea>
	<button class="btn btn-lg btn-primary btn-block pull-right" type="submit" name="submit" value="send">Send</button>
</div>

<script src="bootstrap/js/jquery-ui-1.10.4.custom.js"></script>	
<script>
var searchRequest = null;
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
                        value: data.value
                    };
                }));
            }
        }).fail(function() {
            searchRequest = null;
        });
    }
});
</script>
</html>
