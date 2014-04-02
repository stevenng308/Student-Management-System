function deleteMsg($id)
{
	//alert('hey');
	if (window.confirm("Do you want to delete?"))
	{
		$.post(
			'../classes/deleteMessage.php',
			{
				'id' : $id
			},
			function(data){
				//alert(data);
			  //$("#mainDiv").html(data);
			  alert("Message has been deleted.");
			  location.reload();
			}
		);
	return false;
	}
	else
	{
		; //do nothing
	}
}

function editMsg($id, $mn)
{
	$msg = "#edtMessage";
	$msg = $msg + $mn;
	//alert($msg);
	if (window.confirm("Do you want to edit?"))
	{
		$.post(
			'../classes/editMessage.php',
			{
				'msg' : $($msg).val(),
				'id' : $id
			},
			function(data){
				//alert(data);
			  //$("#mainDiv").html(data);
			  alert("Message has been edited.");
			  location.reload();
			}
		);
	return false;
	}
	else
	{
		; //do nothing
	}
}

function postMsg()
{
	//alert("hi");
	if ($('#message').val())
	{
		$.post(
			'../classes/postMessage.php',
			{
				'message' : $('#message').val()
			},
			function(data){
				//alert(data);
			  //$("#mainDiv").html(data);
			  alert("Message has been posted.");
			  location.reload();
			}
		  );
	  return false;
	}
	else
	{
		alert('Please include a message.');
		return false;
	}
}

function postClassMsg($classID)
{
	//alert("hi");
	if ($('#classMessage').val())
	{
		$.post(
			'classes/postClassMessage.php',
			{
				'message' : $('#classMessage').val(),
				'clssID' : $classID
			},
			function(data){
				//alert(data);
			  //$("#mainDiv").html(data);
			  alert("Message has been posted.");
			  location.reload();
			}
		  );
	  return false;
	}
	else
	{
		alert('Please include a message.');
		return false;
	}
}

function editClassMsg($id, $mn)
{
	$msg = "#edtMessage";
	$msg = $msg + $mn;
	//alert($msg);
	if (window.confirm("Do you want to edit?"))
	{
		$.post(
			'classes/editClassMessage.php',
			{
				'msg' : $($msg).val(),
				'id' : $id,
			},
			function(data){
				//alert(data);
			  //$("#mainDiv").html(data);
			  alert("Message has been edited.");
			  location.reload();
			}
		);
	return false;
	}
	else
	{
		; //do nothing
	}
}

function deleteClassMsg($id)
{
	//alert('hey');
	if (window.confirm("Do you want to delete?"))
	{
		$.post(
			'classes/deleteClassMessage.php',
			{
				'id' : $id
			},
			function(data){
				//alert(data);
			  //$("#mainDiv").html(data);
			  alert("Message has been deleted.");
			  location.reload();
			}
		);
	return false;
	}
	else
	{
		; //do nothing
	}
}
