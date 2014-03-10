<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- email class-->

<?php
class Email
{
	private $emailID, $destUsername, $destFirstName, $destLastName, $fromUsername, $fromFirstName, $fromLastName, $dateSent, $subject, $content, $boxNum, $database;
	public function __construct(PDO $db, $username, $id)
	{
		$this->destUsername = $username;
		$this->database = $db;
		$this->emailID = $id;
		$query = $this->database->query("SELECT * FROM email WHERE dest_username = '" . $this->destUsername . "' AND emailid = '" . $this->emailID . "'");
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$this->destFirstName = $result[0]['dest_first'];
		$this->destLastName = $result[0]['dest_last'];
		$this->fromUsername = $result[0]['from_username'];
		$this->fromFirstName = $result[0]['from_first'];
		$this->fromLastName = $result[0]['from_last'];
		$this->dateSent = $result[0]['date_sent'];
		$this->subject = $result[0]['subject'];
		$this->content = $result[0]['msg_content'];
		$this->boxNum = $result[0]['box'];
	}
	
	public function getID()
	{
		return $this->emailID;
	}
	
	public function getDestUser()
	{
		return $this->destUsername;
	}
	
	public function getDestFirst()
	{
		return $this->destFirstName;
	}
	
	public function getDestLast()
	{
		return $this->destLastName;
	}
	
	public function getFromUser()
	{
		return $this->fromUsername;
	}
	
	public function getFromFirst()
	{
		return $this->fromFirstName;
	}
	
	public function getFromLast()
	{
		return $this->fromLastName;
	}
	
	public function getDate()
	{
		return $this->dateSent;
	}
	
	public function getDateFormatted()
	{	
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $this->dateSent);
		return $date->format('m-d-Y H:i:s');
	}
	
	public function getSubject()
	{
		return $this->subject;
	}
	
	public function getMessage()
	{
		return $this->content;
	}
	
	public function getMessageFormatted()
	{
		return html_entity_decode($this->content);
	}
	
	public function getBoxNum()
	{
		return $this->boxNum;
	}
}
?>