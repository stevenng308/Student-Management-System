<?php
echo "Hello World";
session_start();
$_SESSION[$_POST['fieldname']] = $_POST['value'];
header('Location: ../index.php');
}
?>