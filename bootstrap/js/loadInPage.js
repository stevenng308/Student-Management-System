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
	else if (btnId == 'draft')
	{
		$('#mainDiv').load('classes/draft.php');
	}
	else
	{
		//$('#mainDiv').load('#');
	}
}

function reply(box, email)
{
	$('.modal-backdrop').remove();
	$('#compose').toggleClass("active")
	$('#' + box).toggleClass("active");
	lastBtn = 'compose';
	$('#mainDiv').load('classes/replyMail.php?id=' + email);
}

function loadSavedMail(box, email)
{
	$('#compose').toggleClass("active")
	$('#' + box).toggleClass("active");
	lastBtn = 'compose';
	$('#mainDiv').load('classes/loadSavedMail.php?id=' + email);
}