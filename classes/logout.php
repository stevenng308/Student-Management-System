<?php
//Logout function
//Author: Steven Ng
if(!isset($_SESSION)){
	session_start();
}
session_destroy();
echo '<div align="center">
		<b>Signing-out successful!</b><br />
		<b>Redirecting to main page...</b>
		</div>';
header('Refresh: 0; URL=" ../index.php"');
exit;
?>