<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- User -->

<?php
class User
{
	private $userID, $studentID, /*$password,*/ $userName, $firstName, $lastName, $role, $email, $DOB, $contact, $status, /*$salt,*/ $street, $city, $state, $zip, $studentArray = array(), $database;
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
	
	public function setPassword($pass)
	{
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET password='" . $pass . "' WHERE accountID='" . $this->userID . "'");
	}
	
	public function setSalt($salt)
	{
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET salt='" . $salt . "' WHERE accountID='" . $this->userID . "'");
	}
	
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	public function setFirstName($first)
	{
		$this->firstName = $first;
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET firstName='" . $first . "' WHERE accountID='" . $this->userID . "'");
	}
	
	public function getLastName()
	{
		return $this->lastName;
	}
	
	public function setLastName($last)
	{
		$this->lastName = $last;
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET lastName='" . $last . "' WHERE accountID='" . $this->userID . "'");
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
	
	/*public function setRole($tempRole)
	{
		$this->database->exec("UPDATE address SET role='" . $tempRole . "' WHERE accountID='" . $this->userID . "' AND role='" . $this->role . "';
								UPDATE address SET role='" . $tempRole . "' WHERE accountID='" . $this->userID . "' AND role='" . $this->role . "';
								");
	}*/
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($tempEmail)
	{
		$this->email = $tempEmail;
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET email='" . $tempEmail . "' WHERE accountID='" . $this->userID . "'");
	}
	
	public function getDOB()
	{
		return $this->DOB;
	}
	
	public function setDOB($tempDOB, $DOB2)
	{
		$this->DOB = $DOB2;
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET DOB='" . $tempDOB . "' WHERE accountID='" . $this->userID . "'");
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
	
	public function setcontact($num)
	{
		$this->contact = $num;
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET contactNum='" . $num . "' WHERE accountID='" . $this->userID . "'");
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getStatusFormatted()
	{
		if ($this->status == 0)
			return "False";
		else
			return "True";
	}
	
	public function setStatus($tempStatus)
	{
		$this->status = $tempStatus;
		$this->database->exec("UPDATE " . $this->getRoleFormatted() . " SET status='" . $tempStatus . "' WHERE accountID='" . $this->userID . "'");
	}
	
	public function getStreet()
	{
		return $this->street;
	}
	
	public function setStreet($tempStreet)
	{
		$this->street = $tempStreet;
		$this->database->exec("UPDATE address SET street='" . $tempStreet . "' WHERE accountID='" . $this->userID . "' AND role='" . $this->role . "'");
	}
	
	public function getCity()
	{
		return $this->city;
	}
	
	public function setCity($tempCity)
	{
		$this->city = $tempCity;
		$this->database->exec("UPDATE address SET city='" . $tempCity . "' WHERE accountID='" . $this->userID . "' AND role='" . $this->role . "'");
	}
	
	public function getState()
	{
		return $this->state;
	}
	
	public function setState($tempState)
	{
		$this->state = $tempState;
		$this->database->exec("UPDATE address SET state='" . $tempState . "' WHERE accountID='" . $this->userID . "' AND role='" . $this->role . "'");
	}
	
	public function getZip()
	{
		return $this->zip;
	}
	
	public function setZip($tempZip)
	{
		$this->zip = $tempZip;
		$this->database->exec("UPDATE address SET zip='" . $tempZip . "' WHERE accountID='" . $this->userID . "' AND role='" . $this->role . "'");
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
	
	public function getChildIDFormatted()
	{
		$str = "";
		if (empty($this->studentArray))
		{
			$str = "N/A";
		}
		else
		{
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
		}
		return $str;
	}
	
	public function setChildID(array $tempArray)
	{
		if (empty($tempArray) && !empty($this->studentArray)) //if the user had children associated but now erased all of them just drop the rows if true
		{
			$this->database->exec("DELETE FROM parent_student_assoc WHERE guardianID='" . $this->userID . "' AND role='" . $this->role . "'");
			$this->studentArray = $tempArray;
		}
		else
		{
			$query = $this->database->query("SELECT studentID from parent_student_assoc WHERE guardianID='" . $this->userID . "' AND role='" . $this->role . "'");
			$numRows = $query->rowCount();
			if ($numRows == 0)
			{
				foreach ($tempArray as $child)
				{
					$this->database->exec("INSERT INTO parent_student_assoc(studentID, guardianID, role) VALUES('" . $child . "', '" . $this->userID . "', '" . $this->role . "')");
				}
				$this->studentArray = $tempArray;
			}
			else
			{
				$this->database->exec("DELETE FROM parent_student_assoc WHERE guardianID='" . $this->userID . "' AND role='" . $this->role . "'");
				foreach ($tempArray as $child)
				{
					$this->database->exec("INSERT INTO parent_student_assoc(studentID, guardianID, role) VALUES('" . $child . "', '" . $this->userID . "', '" . $this->role . "')");
				}
				$this->studentArray = $tempArray;
			}
		}
	}
}
?>