/*
Author: Steven Ng
JS for loading a PHP file within a another PHP document
*/
function loadIn(btnId)
{

	if (btnId == 'compose')
	{
		$('#mainDiv').load('classes/composeEmail.php');
	}
	else if (btnId == 'inbox')
	{
		$('#mainDiv').load('classes/inbox.php');
	}
	else if (btnId == 'sent')
	{
		$('#mainDiv').load('classes/sent.php');
	}
	else if (btnId == 'trash')
	{
		$('#mainDiv').load('classes/trash.php');
	}
	else
	{
		//$('#mainDiv').load('#');
	}
}

function reply(email)
{
	$('.modal-backdrop').remove();
	$('#mainDiv').load('classes/replyMail.php?id=' + email);
}