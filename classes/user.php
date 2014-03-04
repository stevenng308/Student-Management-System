<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- User -->

<?php
class User
{
	private $userID, $studentID, /*$password,*/ $userName, $firstName, $lastName, $role, $email, $DOB, $contact, $status, $salt, $street, $city, $state, $zip, $studentArray = array(), $database;
	public function __construct(PDO $db, $id, $table)
	{
		$this->database = $db;
		$this->userID = $id;
		$query = "SELECT * FROM " . $table . " WHERE accountID = '" . $id . "'";
		$queryResults = $this->database->query($query);
		$result = $queryResults->fetchAll(PDO::FETCH_ASSOC);
		$this->userID = $result[0]['accountID'];
		$this->userName = $result[0]['username'];
		//$this->password = $result[0]['password'];
		$this->role = $result[0]['role'];
		$this->firstName = $result[0]['firstName'];
		$this->lastName = $result[0]['lastName'];
		$this->email = $result[0]['email'];
		$this->DOB = $result[0]['DOB'];
		$this->DOB = DateTime::createFromFormat('Y-m-d', $this->DOB);
		$this->contact = $result[0]['contactNum'];
		$this->status = $result[0]['status'];
		//$this->salt = $result[0]['salt'];
		if (!empty($result[0]['studentID']))
		{
			$this->studentID = $result[0]['studentID'];
		}
		
		if ($table == "Student")
		{
			$query = "SELECT street, city, state, zip FROM address WHERE accountID = '" . $this->userID . "' AND role ='" . $this->role . "'";
			$queryResults = $this->database->query($query);
			$result = $queryResults->fetchAll(PDO::FETCH_ASSOC);
			$this->street = $result[0]['street'];
			$this->city = $result[0]['city'];
			$this->state = $result[0]['state'];
			$this->zip = $result[0]['zip'];
		}
		else
		{
			$query = "SELECT street, city, state, zip FROM address WHERE accountID = '" . $this->userID . "' AND role ='" . $this->role . "'";
			$queryResults = $this->database->query($query);
			$result = $queryResults->fetchAll(PDO::FETCH_ASSOC);
			$this->street = $result[0]['street'];
			$this->city = $result[0]['city'];
			$this->state = $result[0]['state'];
			$this->zip = $result[0]['zip'];
			$query = "SELECT studentID FROM parent_student_assoc WHERE guardianID = '" . $this->userID . "' AND role ='" . $this->role . "'";
			$count = 0;
			foreach ($this->database->query($query) as $row)
			{
				$this->studentArray[$count] = $row['studentID'];
				$count++;
			}
		}
	}
	public function getUserID()
	{
		return $this->userID;
	}
	
	public function getStudentID()
	{
		return $this->studentID;
	}
	
	public function getUserName()
	{
		return $this->userName;
	}
	
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	public function getLastName()
	{
		return $this->lastName;
	}
	
	public function getRole()
	{
		return $this->role;
	}
	
	public function getRoleFormatted()
	{
		$stmt =  $this->database->query('SELECT description FROM role WHERE role = "' . $this->role . '"');
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result[0]['description'];
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getMonth()
	{
		//$newFormat = DateTime::createFromFormat('Y-m-d', $this->DOB);
		return date_format($this->DOB, "m");
	}
	
	public function getDay()
	{
		return date_format($this->DOB, "d");
	}
	
	public function getYear()
	{
		return date_format($this->DOB, "Y");
	}
	
	public function getContact()
	{
		return $this->contact;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getStreet()
	{
		return $this->street;
	}
	
	public function getCity()
	{
		return $this->city;
	}
	
	public function getState()
	{
		return $this->state;
	}
	
	public function getZip()
	{
		return $this->zip;
	}
	
	public function getChildID()
	{
		$str = "";
		foreach ($this->studentArray as &$student)
		{
			$next = current($this->studentArray);
			if ($next == NULL)
			{
				$str = $str . $student;
			}
			else
			{
				$str = $str . $student . ",";
			}
		}
		return $str;
	}
}
?>