<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- reply class-->

<?php
class Reply
{
	private $responseID, $topicID, $response_message, $author_user, $author_first, $suthor_last, $date_posted;
	public function __construct($replyinfo)
	{
		$this->responseID = $replyinfo['responseID'];
		$this->topicID = $replyinfo['topicID'];
		$this->response_message = $replyinfo['response_message'];
		$this->author_user = $replyinfo['author_user'];
		$this->author_first = $replyinfo['author_first'];
		$this->author_last = $replyinfo['author_last'];
		$this->date_posted = $replyinfo['date_posted'];
	}
	
	public function getResponseID()
	{
		return $this->responseID;
	}
	
	public function getTopicID()
	{
		return $this->topicID;
	}
	
	public function getResponseMessage()
	{
		return $this->response_message;
	}
	
	public function getAuthorFirst()
	{
		return $this->author_first;
	}
	
	public function getAuthorLast()
	{
		return $this->author_last;
	}
	
	public function getAuthorUser()
	{
		return $this->author_user;
	}
	
	public function getPostDate()
	{
		return $this->date_posted;
	}
}
?>
