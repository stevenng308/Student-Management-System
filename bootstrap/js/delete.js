var values = 0;
$('input[id^="delete"]').on('change', function() {
    values = $('input:checked').map(function() {
        return this.value;
    }).get();
    
    //alert(values);
});

function deleteEmail(page)
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
					'checkbox' : values, 
					'box' : page
				},
				function(data){
				  //$("#mainDiv").html(data);
				  //console.log(data);
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

function deleteReadEmail(page, id)
{
	var tempArray = [id];
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

function checkAll(source) {
  var checkboxes = $('input[id^="delete"]').not(":hidden");
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
	values = $('input:checked').map(function() {
        return this.value;
    }).get();
  }
}