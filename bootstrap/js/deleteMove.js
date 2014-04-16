var values = 0; //global array of the id's values
$('input[id^="delete"]').on('change', function() { //adds the values to the array called values
    values = $('input:checked').map(function() {
        return this.value;
    }).get();
    
    //alert(values);
});

function deleteEmail(page) //deletes from the box views
{
	if (!values.length)
	{
		//alert("No emails were selected.");
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
	}
	else
	{
		/*if (window.confirm("Do you want to delete?"))
		{
			//alert(values);
			$.post(
				'classes/deleteEmail.php',
				{
					'checkbox' : values, //sending the values
					'box' : page //sending the box where these values are located
				},
				function(data){
				  //$("#mainDiv").html(data);
				  //console.log(data);
				  $('#inboxNum').text(data);
				  //$(lastBtn).toggleClass("active");
				  //$('#inbox').toggleClass("active");
				  //lastBtn = page;
				  loadIn(page);
				}
			  );
		  return false;
		}
		else
		{
			;//do nothing
		}*/
		$(function() {
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: {
					"Delete": function() {
						$( this ).dialog( "close" );
							$.post(
								'classes/deleteEmail.php',
								{
									'checkbox' : values, //sending the values
									'box' : page //sending the box where these values are located
								},
								function(data){
								  //$("#mainDiv").html(data);
								  //console.log(data);
								  $('#inboxNum').text(data);
								  //$(lastBtn).toggleClass("active");
								  //$('#inbox').toggleClass("active");
								  //lastBtn = page;
								  loadIn(page);
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
	
}

function deleteReadEmail(page, id) //deletes when reading the email
{
	var tempArray = [id]; //need to store in the array since the php script handling deletion is accepting values only in arrays
	/*if (window.confirm("Do you want to delete?"))
	{
		//alert(values);
		$.post(
			'classes/deleteEmail.php',
			{
				'checkbox' : tempArray, 
				'box' : page
			},
			function(data){
			  //$('.modal-backdrop').remove();
			  //$("#mainDiv").html(data);
			  //console.log(data);
			  //alert(data);
			  $('.modal-backdrop').remove();
			  $('#inboxNum').text(data);
			  loadIn(page);
			}
		  );
	  return false;
	}
	else
	{
		;//do nothing
	}*/
	$(function() {
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
						$.post(
							'classes/deleteEmail.php',
							{
								'checkbox' : tempArray, 
								'box' : page
							},
							function(data){
							  //$('.modal-backdrop').remove();
							  //$("#mainDiv").html(data);
							  //console.log(data);
							  //alert(data);
							  $('.modal-backdrop').remove();
							  $('#inboxNum').text(data);
							  loadIn(page);
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

function moveEmail(page)
{
	if (!values)
	{
		//alert("No emails were selected.");
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
	}
	else if ($('#box').val() < 1)
	{
		//alert("Please specify a box.");
		 $(function() {
				$( "#dialog-error2" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
	}
	else
	{
		/*if (window.confirm("Do you want to move the message/s?"))
		{
			//alert(values);
			//alert($('#box').val());
			$.post(
				'classes/moveEmail.php',
				{
					'checkbox' : values, 
					'box' : $('#box').val()
				},
				function(data){
				  //$("#mainDiv").html(data);
				  $('#inboxNum').text(data);
				  loadIn(page);
				}
			  );
		  return false;
		}
		else
		{
			;//do nothing
		}
	}*/
		$(function() {
			$( "#dialog-confirm2" ).dialog({
				resizable: false,
				height:180,
				modal: true,
				buttons: {
					"Move": function() {
						$( this ).dialog( "close" );
							$.post(
								'classes/moveEmail.php',
								{
									'checkbox' : values, 
									'box' : $('#box').val()
								},
								function(data){
								  //$("#mainDiv").html(data);
								  $('#inboxNum').text(data);
								  loadIn(page);
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
}

/*function deleteMessage(id) //deletes when editing the message
{
	var tempArray = [id]; //need to store in the array since the php script handling deletion is accepting values only in arrays
	if (window.confirm("Do you want to delete?"))
	{
		//alert(values);
		$.post(
			'classes/deleteMessage.php',
			{
				'test' : tempArray
			},
			function(data){
			  //$('.modal-backdrop').remove();
			  //$("#mainDiv").html(data);
			  //console.log(data);
			  //alert(data);
			  $('.modal-backdrop').remove();;
			  loadIn(page);
			}
		  );
	  return false;
	}
	else
	{
		;//do nothing
	}
	$(function() {
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$.post(
						'classes/deleteMessage.php',
						{
							'test' : tempArray
						},
						function(data){
						  //$('.modal-backdrop').remove();
						  //$("#mainDiv").html(data);
						  //console.log(data);
						  //alert(data);
						  $('.modal-backdrop').remove();;
						  loadIn(page);
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
}*/

function checkAll(source) {
  var checkboxes = $('input[id^="delete"]').not(":hidden"); //insert into an array of all checkboxes that have the id=delete but are not hidden from the fitering
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked; //check all of them
	values = $('input:checked').map(function() {
        return this.value; //updating the global variable values
    }).get();
  }
}