var values = 0; //global array of the id's values
$('input[id^="status"]').on('change', function() { //adds the values to the array called values
    values = $('input:checked').map(function() {
        return this.value;
    }).get();
    
    //alert(values);
});

function deactivate()
{
	if (!values)
	{
		alert("No classes were selected.");
	}
	else
	{
		if (window.confirm("Do you want to set active to false?"))
		{
			//alert(values);
			//alert($('#box').val());
			$.post(
				'../classes/deactivateClass.php',
				{
					'checkbox' : values
				},
				function(data){
				  //$("#mainDiv").html(data);
				  //loadIn(page);
				  location.reload();
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

function activate()
{
	if (!values)
	{
		alert("No classes were selected.");
	}
	else
	{
		if (window.confirm("Do you want to set active to true?"))
		{
			//alert(values);
			//alert($('#box').val());
			$.post(
				'../classes/activateClass.php',
				{
					'checkbox' : values
				},
				function(data){
				  //$("#mainDiv").html(data);
				  //loadIn(page);
				  location.reload();
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
  var checkboxes = $('input[id^="status"]').not(":hidden"); //insert into an array of all checkboxes that have the id=delete but are not hidden from the fitering
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked; //check all of them
	values = $('input:checked').map(function() {
        return this.value; //updating the global variable values
    }).get();
  }
}