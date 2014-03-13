<?php
include 'main.php';

echo '<tr>';
    echo '<td class="leftpart">';
        echo '<h3>Message Board : Welcome to The Message Board<br />
		
		</a></h3>';
    echo '</td>';
 
    echo '</td>';
echo '</tr>';

if (isset($_POST['Message'])) $Message = $_POST['Message'];
else $Message = "(Posted on 02/10/2014)";
echo <<<_END
<html>
	<head>
	<title>Admin's Message Board</title>
	</head>
	<body>
	Message Created on 01/10/2014 by Admin : New Discussion About the increase in Cafeteria Prizes: $Message<br />
	<form method ="post" action="Messagetest.php">
		Create New Message, Enter here:
		<input type="text" message="Message" />
		<input type = "Post" />
		</form>
		</body>
</html>
_END;

?>