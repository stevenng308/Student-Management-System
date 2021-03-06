﻿<!-- Student Management System -->
<!-- Author: Brian Kennedy -->
<!-- class message board message class-->

<?php
class ClassMessage
{
	private $msgID, $acct_ID, $athr_first, $athr_last, $date_posted, $msg_content, $clssID;
	public function __construct($messageinfo)
	{
		$this->msgID = $messageinfo['class_messageID'];
		$this->acct_ID = $messageinfo['accountID'];
		$this->athr_first = $messageinfo['authorFirstName'];
		$this->athr_last = $messageinfo['authorLastName'];
		$this->date_posted = $messageinfo['messageDate'];
		$this->msg_content = $messageinfo['messageContent'];
		$this->clssID = $messageinfo['classID'];
	}
	
	public function getID()
	{
		return $this->msgID;
	}
	
	public function getOwner()
	{
		return $this->acct_ID;
	}
	
	public function getAuthorFirst()
	{
		return $this->athr_first;
	}
	
	public function getAuthorLast()
	{
		return $this->athr_last;
	}
	
	public function getDate()
	{
		return $this->date_posted;
	}
	
	public function getDateFormatted()
	{	
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $this->date_posted);
		return $date->format('m-d-Y H:i:s');
	}
	
	public function getMessage()
	{
		return $this->msg_content;
	}
	
	public function getMessageFormatted()
	{
		return html_entity_decode($this->content);
	}

	public function getClassID()
	{
		return $this->clssID;
	}
	
}
?>
