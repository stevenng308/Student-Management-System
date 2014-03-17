<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- classroom class-->

<?php
class Classroom
{
	private $classID, $course_number, $course_name, $start_date, $end_date, $start_time, $end_time, $semester, $year, $teacherID, $teacherUser, $teacherFirst, $teacherLast, $forumName, $status, $database;
	public function __construct($classInfo, $teacherInfo, PDO $db)
	{
		$this->classID = $classInfo['classID'];
		$this->course_number = $classInfo['course_number'];
		$this->course_name = $classInfo['course_name'];
		$this->start_date = $classInfo['start_date'];
		$this->end_date = $classInfo['end_date'];
		$this->start_time = $classInfo['start_time'];
		$this->end_time = $classInfo['end_time'];
		$this->semester = $classInfo['semester'];
		$this->year = $classInfo['year'];
		$this->forumName = $classInfo['forumName'];
		$this->status = $classInfo['status'];
		$this->teacherID = $classInfo['teacherID'];
		$this->teacherUser = $teacherInfo[0]['username'];
		$this->teacherFirst = $teacherInfo[0]['firstname'];
		$this->teacherLast = 	$teacherInfo[0]['lastname'];
		$this->database = $db;
	}
	
	public function getClassID()
	{
		return $this->classID;
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
		$this->database->exec("UPDATE classroom SET status='" . $tempStatus . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getCourseNumber()
	{
		return $this->course_number;
	}
		
	public function setCourseNumber($number)
	{
		$this->course_number = $number;
		$this->database->exec("UPDATE classroom SET course_number='" . $number . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getCourseName()
	{
		return $this->course_name;
	}
		
	public function setCourseName($name)
	{
		$this->course_name = $name;
		$this->database->exec("UPDATE classroom SET course_name='" . $name . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getStartDate()
	{
		return $this->start_date;
	}
	
	public function getStartDateFormatted()
	{
		$date = Date('m-d-Y', strtotime($this->start_date));
		return $date;
	}
	
	public function getStartDateFormatted2()
	{
		$date = Date('m/d/Y', strtotime($this->start_date));
		return $date;
	}
		
	public function setStartDate($tempDate)
	{
		$this->start_date = $tempDate;
		$this->database->exec("UPDATE classroom SET start_date='" . $tempDate . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getEndDate()
	{
		return $this->end_date;
	}
	
	public function getEndDateFormatted()
	{
		$date = Date('m-d-Y', strtotime($this->end_date));
		return $date;
	}
	
	public function getEndDateFormatted2()
	{
		$date = Date('m/d/Y', strtotime($this->end_date));
		return $date;
	}
		
	public function setEndDate($tempDate)
	{
		$this->end_date = $tempDate;
		$this->database->exec("UPDATE classroom SET end_date='" . $tempDate . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getStartTime()
	{
		return $this->start_time;
	}
	
	public function getStartTimeFormatted()
	{
		$time = Date('H:i', strtotime($this->start_time));
		return $time;
	}
		
	public function setStartTime($tempTime)
	{
		$this->start_time = $tempTime;
		$this->database->exec("UPDATE classroom SET start_time='" . $tempTime . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getEndTime()
	{
		return $this->end_time;
	}
	
	public function getEndTimeFormatted()
	{
		$time = Date('H:i', strtotime($this->end_time));
		return $time;
	}
		
	public function setEndTime($tempTime)
	{
		$this->end_time = $tempTime;
		$this->database->exec("UPDATE classroom SET end_time='" . $tempTime . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getSemester()
	{
		return $this->semester;
	}
		
	public function setSemester($tempSemester)
	{
		$this->semester = $tempSemester;
		$this->database->exec("UPDATE classroom SET semester='" . $tempSemester . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getSchoolYear()
	{
		return $this->year;
	}
		
	public function setSchoolYear($tempYear)
	{
		$this->year = $tempYear;
		$this->database->exec("UPDATE classroom SET year='" . $tempYear . "' WHERE classID='" . $this->classID . "'");
	}
	
	public function getForumName()
	{
		return $this->forumName;
	}
	
	public function getTeacherID()
	{
		return $this->teacherID;
	}
		
	public function setTeacherID($tempID)
	{
		$this->teacherID = $tempID;
		$this->database->exec("UPDATE classroom SET teacherID='" . $tempID . "' WHERE classID='" . $this->classID . "'");
		$query = $this->database->query("SELECT username, firstname, lastname FROM teacher WHERE accountID='" . $tempID . "'");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$this->setTeacherUser($result[0]['username']);
		$this->setTeacherFirst($result[0]['firstname']);
		$this->setTeacherLast($result[0]['lastname']);
	}
	
	public function getTeacherUser()
	{
		return $this->teacherUser;
	}
	
	private function setTeacherUser($tempUser)
	{
		$this->teacherUser = $tempUser;
	}
	
	public function getTeacherFirst()
	{
		return $this->teacherFirst;
	}
	
	private function setTeacherFirst($tempFirst)
	{
		$this->teacherFirst = $tempFirst;
	}
	
	public function getTeacherLast()
	{
		return $this->teacherLast;
	}
	
	private function setTeacherLast($tempLast)
	{
		$this->teacherLast = $tempLast;
	}
}
?>
