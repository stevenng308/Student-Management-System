<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- email class-->

<?php
class Email
{
	private $emailID, $owner, $destUsername, $destFirstName, $destLastName, $fromUsername, $fromFirstName, $fromLastName, $dateSent, $subject, $content, $boxNum;
	public function __construct($emailinfo)
	{
		$this->destUsername = $emailinfo['dest_username'];
		//$this->database = $db;
		$this->emailID = $emailinfo['emailID'];
		//$query = $this->database->query("SELECT * FROM email WHERE owner = '" . $this->destUsername . "' AND emailid = '" . $this->emailID . "'");
		//$result = $query->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($result);
		$this->owner = $emailinfo['owner'];
		$this->destFirstName = $emailinfo['dest_first'];
		$this->destLastName = $emailinfo['dest_last'];
		$this->fromUsername = $emailinfo['from_username'];
		$this->fromFirstName = $emailinfo['from_first'];
		$this->fromLastName = $emailinfo['from_last'];
		$this->dateSent = $emailinfo['date_sent'];
		$this->subject = $emailinfo['subject'];
		$this->content = $emailinfo['msg_content'];
		$this->boxNum = $emailinfo['box'];
	}
	
	public function getID()
	{
		return $this->emailID;
	}
	
	public function getOwner()
	{
		return $this->owner;
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
	
	public function getSubjectFormatted()
	{
		return (strlen($this->subject) > 25) ? substr($this->subject,0,22).'...' : $this->subject;
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
