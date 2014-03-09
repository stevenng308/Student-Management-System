<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- email class-->

<?php
class User
{
	private $emailID, $destUsername, $destFirstName, $destLastName, $fromUsername, $fromFirstName, $fromLastName, $dateSent, $subject, $content, $boxNum, $database;
	public function __construct(PDO $db, $username, $id)
	{
		$this->destUsername = $username;
		$this->emailID = $id;
		$this->database = $db;
	}
}
?>