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
		//alert("No classes were selected.");
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
		/*if (window.confirm("Do you want to set active to false?"))
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
				  alert("Class deactivated.");
				  location.reload();
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
						"Proceed": function() {
							//var $dialog = $(this); //lose context of this once in post. Save it here
							$( "#dialog-confirm" ).dialog('close');
							$.post(
								'../classes/deactivateClass.php',
								{
									'checkbox' : values
								},
								function(data){
								  //$("#mainDiv").html(data);
								  //loadIn(page);
								  //alert("Class activated.");
								  $(function() {
										$( "#dialog-message" ).dialog({
											modal: true,
											buttons: {
												Ok: function() {
													$( this ).dialog( "close" );
													location.reload();
												}
											}
										});
									});
								}
							  );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
			return false;
	}
}

function activate()
{
	if (!values)
	{
		//alert("No classes were selected.");
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
		/*if (window.confirm("Do you want to set active to true?"))
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
				  alert("Class activated.");
				  location.reload();
				}
			  );
		  return false;*/
		  $(function() {
				$( "#dialog-confirm2" ).dialog({
					resizable: false,
					height:180,
					modal: true,
					buttons: {
						"Proceed": function() {
							//var $dialog = $(this); //lose context of this once in post. Save it here
							$( "#dialog-confirm2" ).dialog('close');
							$.post(
								'../classes/activateClass.php',
								{
									'checkbox' : values
								},
								function(data){
								  //$("#mainDiv").html(data);
								  //loadIn(page);
								  //alert("Class activated.");
								  $(function() {
										$( "#dialog-message2" ).dialog({
											modal: true,
											buttons: {
												Ok: function() {
													$( this ).dialog( "close" );
													location.reload();
												}
											}
										});
									});
								}
							  );
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
			return false;
		//else
		//{
		//	;//do nothing
		//}
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