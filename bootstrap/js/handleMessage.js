function deleteMsg($id)
{
	//alert('hey');
	if (window.confirm("Do you want to delete?"))
	{
		$.post(
			'../classes/deleteMessage.php',
			{
				//'message' : $('#edtMessage').val()
				'id' : $id
			},
			function(data){
				//alert(data);
			  //$("#mainDiv").html(data);
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
	if (window.confirm("Edits submitted."))
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
	$.post(
		'../classes/postMessage.php',
		{
			'message' : $('#message').val()
		},
		function(data){
			//alert(data);
		  //$("#mainDiv").html(data);
		  location.reload();
		}
	  );
  return false;
}
