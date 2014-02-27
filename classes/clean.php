<!-- Student Management System -->
<!-- Author: Steven Ng -->
<!-- clean input -->

<?php
class Clean
{
	private $invalid = array("$", "%", "#", "<", ">", "|", "*");
	public function cleanString($text)
	{
		$invalid = array("$", "%", "#", "<", ">", "|", "*");
		return str_replace($invalid, '', $text);;
	}
}
?>