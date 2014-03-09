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
	else
	{
		//$('#mainDiv').load('#');
	}
}