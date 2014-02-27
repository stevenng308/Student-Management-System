<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- session -->

<?php
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
class Session
{	
	private $userID, $userName, $userType, $firstName, $lastName, $database;
	public function __construct(array $userData, Database $db)
	{
		$this->userID = $userData['sess_user_id'];
		$this->userName = $userData['sess_username'];
		$this->userType = $userData['sess_role'];
		$this->firstName = $userData['sess_firstName'];
		$this->lastName = $userData['sess_lastName'];
		$this->database = $db;
	}
	
	public function getID()
	{
		return $this->userID;
	}
	
	public function getUserName()
	{
		return $this->userName;
	}
	
	public function getUserType()
	{
		return $this->userType;
	}
	
	public function getUserTypeFormatted()
	{
		//$queryResult = mysql_query("SELECT description FROM role WHERE role = ' . $this->userType . '");
		$queryResult = $this->database->runQuery("SELECT description FROM role WHERE role = '" . $this->userType . "'");
		$result = mysql_fetch_array($queryResult, MYSQL_ASSOC);
		return $result['description'];
	}
	
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	public function getLastName()
	{
		return $this->lastName;
	}
}
?>