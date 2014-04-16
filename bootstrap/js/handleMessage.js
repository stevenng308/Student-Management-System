function deleteMsg($id)
{
	//alert('hey');
	//if (window.confirm("Do you want to delete?"))
	//{
	$(function() {
		$( "#dialog-confirm2" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"Delete": function() {
					$( "#dialog-confirm2" ).dialog("close");
					$.post(
						'../classes/deleteMessage.php',
						{
							'id' : $id
						},
						function(data){
							//alert(data);
						  //$("#mainDiv").html(data);
						  //alert("Message has been deleted.");
						  //location.reload();
						  $(function() {
							  $( "#dialog-message2" ).dialog({
									modal: true,
									buttons: {
										Ok: function() {
											location.reload();
											$( this ).dialog( "close" );
										}
									},
									close : function() {
										location.reload();
									}
							 });
						  });
						}
					);
				return false;
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
	//}
	//else
	//{
	//	; //do nothing
	//}
}

function editMsg($id, $mn)
{
	$msg = "#edtMessage";
	$msg = $msg + $mn;
	//alert($msg);
	//if (window.confirm("Do you want to edit?"))
	//{
	$(function() {
		$( "#dialog-confirm3" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"Edit": function() {
				$( "#dialog-confirm3" ).dialog("close");
					$.post(
						'../classes/editMessage.php',
						{
							'msg' : $($msg).val(),
							'id' : $id
						},
						function(data){
							//alert(data);
						  //$("#mainDiv").html(data);
						  //alert("Message has been edited.");
						  //location.reload();
						  $(function() {
							  $( "#dialog-message3" ).dialog({
									modal: true,
									buttons: {
										Ok: function() {
											$( this ).dialog( "close" );
											location.reload();
										}
									},
									close : function() {
										$( this ).dialog( "close" );
										location.reload();
									}
							 });
						  });
						}
					);
				return false;
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
	//}
	//else
	//{
	//	; //do nothing
	//}
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
			  //alert("Message has been posted.");
			   $(function() {
				$( "#dialog-message" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
							location.reload();
						}
					},
					close : function() {
						$( this ).dialog( "close" );
						location.reload();
					}
				});
				});
			  //location.reload();
			}
		  );
	  return false;
	}
	else
	{
		//alert('Please include a message.');
		$(function() {
			$( "#dialog-error" ).dialog({
				modal: true,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});
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
			  //alert("Message has been posted.");
			  //location.reload();
			  $(function() {
				$( "#dialog-message" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
							location.reload();
						}
					},
					close : function() {
						$( this ).dialog( "close" );
						location.reload();
					}
				});
				});
			}
		  );
	  return false;
	}
	else
	{
		//alert('Please include a message.');
		$(function() {
			$( "#dialog-error" ).dialog({
				modal: true,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});
		return false;
	}
}

function editClassMsg($id, $mn)
{
	$msg = "#edtMessage";
	$msg = $msg + $mn;
	//alert($msg);
	/*if (window.confirm("Do you want to edit?"))
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
	}*/
	$(function() {
		$( "#dialog-confirm3" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"Edit": function() {
				$( "#dialog-confirm3" ).dialog("close");
				$.post(
					'classes/editClassMessage.php',
					{
						'msg' : $($msg).val(),
						'id' : $id,
					},
					function(data){
						//alert(data);
					  //$("#mainDiv").html(data);
					  $(function() {
							  $( "#dialog-message3" ).dialog({
									modal: true,
									buttons: {
										Ok: function() {
											$( this ).dialog( "close" );
											location.reload();
										}
									},
									close : function() {
										$( this ).dialog( "close" );
										location.reload();
									}
							 });
						  });
						}
				);
				return false;
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
}

function deleteClassMsg($id)
{
	//alert('hey');
	/*if (window.confirm("Do you want to delete?"))
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
	}*/
	$(function() {
		$( "#dialog-confirm2" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"Delete": function() {
					$( "#dialog-confirm2" ).dialog("close");
					$.post(
					'classes/deleteClassMessage.php',
					{
						'id' : $id
					},
					function(data){
					$(function() {
						  $( "#dialog-message2" ).dialog({
								modal: true,
								buttons: {
									Ok: function() {
										location.reload();
										$( this ).dialog( "close" );
									}
								},
								close : function() {
									location.reload();
								}
						 });
					  });
					}
				);
				return false;
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
}
