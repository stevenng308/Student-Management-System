var values = 0; //global array of the id's values
$('input[id^="delete"]').on('change', function() { //adds the values to the array called values
    values = $('input:checked').map(function() {
        return this.value;
    }).get();
    
    //alert(values);
});

function deleteEmail(page) //deletes from the box views
{
	if (!values)
	{
		alert("No emails were selected.");
	}
	else
	{
		if (window.confirm("Do you want to delete?"))
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
				  $(lastBtn).toggleClass("active");
				  $('#inbox').toggleClass("active");
				  lastBtn = "inbox";
				  loadIn(page);
				}
			  );
		  return false;
		}
		else
		{
			;//do nothing
		}
	}
}

function deleteReadEmail(page, id) //deletes when reading the email
{
	var tempArray = [id]; //need to store in the array since the php script handling deletion is accepting values only in arrays
	if (window.confirm("Do you want to delete?"))
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
	}
}

function moveEmail(page)
{
	if (!values)
	{
		alert("No emails were selected.");
	}
	else if ($('#box').val() < 1)
	{
		alert("Please specify a box.");
	}
	else
	{
		if (window.confirm("Do you want to move to message/s?"))
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
	}
}

function checkAll(source) {
  var checkboxes = $('input[id^="delete"]').not(":hidden"); //insert into an array of all checkboxes that have the id=delete but are not hidden from the fitering
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked; //check all of them
	values = $('input:checked').map(function() {
        return this.value; //updating the global variable values
    }).get();
  }
}