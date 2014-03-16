<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- classroom class-->

<?php
class Classroom
{
	private $classID, $course_number, $course_name, $start_date, $end_date, $start_time, $end_time, $semester, $year, $teacherID, $teacherUser, $teacherFirst, $teacherLast, $forumName, $status;
	public function __construct($classInfo, $teacherInfo)
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
	
	public function getCourseNumber()
	{
		return $this->course_number;
	}
	
	public function getCourseName()
	{
		return $this->course_name;
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
	
	public function getEndDate()
	{
		return $this->end_date;
	}
	
	public function getEndDateFormatted()
	{
		$date = Date('m-d-Y', strtotime($this->end_date));
		return $date;
	}
	
	public function getStartTime()
	{
		return $this->start_time;
	}
	
	public function getEndTime()
	{
		return $this->end_time;
	}
	
	public function getSemester()
	{
		return $this->semester;
	}
	
	public function getSchoolYear()
	{
		return $this->year;
	}
	
	public function getForumName()
	{
		return $this->forumName;
	}
	
	public function getTeacherID()
	{
		return $this->teacherID;
	}
	
	public function getTeacherUser()
	{
		return $this->teacherUser;
	}
	
	public function getTeacherFirst()
	{
		return $this->teacherFirst;
	}
	
	public function getTeacherLast()
	{
		return $this->teacherLast;
	}
}
?>
