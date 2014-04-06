<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- topic class-->

<?php
class Topic
{
	private $topicID, $forumName, $topic_subject, $topic_message, $author_user, $author_first, $author_last, $author_role, $date_posted, $last_post, $numMsgs;
	public function __construct($topicinfo, $num)
	{
		$this->topicID = $topicinfo['topicID'];
		$this->forumName = $topicinfo['forumName'];
		$this->topic_subject = $topicinfo['topic_subject'];
		$this->topic_message = $topicinfo['topic_message'];
		$this->author_user = $topicinfo['author_user'];
		$this->author_first = $topicinfo['author_first'];
		$this->author_last = $topicinfo['author_last'];
		$this->author_role = $topicinfo['role'];
		$this->date_posted = $topicinfo['date_posted'];
		$this->last_post = $topicinfo['last_post'];
		$this->numMsgs = $num + 1; //+1 to include the original poster's message
	}
	
	public function getTopicID()
	{
		return $this->topicID;
	}
	
	public function getClassID()
	{
		$classid = preg_split("/_+/", $this->forumName);
		return $classid[0];
	}
	
	public function getForumName()
	{
		return $this->forumName;
	}
	
	public function getTopicSubject()
	{
		return $this->topic_subject;
	}
	
	public function getTopicSubjectFormatted()
	{
		return (strlen($this->topic_subject) > 45) ? substr($this->topic_subject,0,42).'...' : $this->topic_subject;
	}
	
	public function getTopicMessage()
	{
		return $this->topic_message;
	}
	
	public function getAuthorFirst()
	{
		return $this->author_first;
	}
	
	public function getAuthorLast()
	{
		return $this->author_last;
	}
	
	public function getAuthorRole()
	{
		return $this->author_role;
	}
	
	public function getAuthorUser()
	{
		return $this->author_user;
	}
	
	public function getPostDate()
	{
		return $this->date_posted;
	}
	
	public function getLastPostDate()
	{
		return $this->last_post;
	}
	
	public function getNumMsgs()
	{
		return $this->numMsgs;
	}
}
?>
