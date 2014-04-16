/*
Author: Steven Ng
JS for autocomplete and email submission
*/
$(document).ready(function () {
var searchRequest = null;
var userNames = '';

	$("#username").autocomplete({
		minLength: 1,
		source: function(request, response) {
			if (searchRequest !== null) {
				searchRequest.abort();
			}
			searchRequest = $.ajax({
				url: 'classes/listUser.php',
				method: 'post',
				dataType: "json",
				data: {term: request.term},
				success: function(data) {
					searchRequest = null;
					response($.map(data, function(data) {
						return {
							label: data.label + '<' + data.first + ' ' + data.last + '>',
							value: data.value + ',',
						};
					}));
				}
			})
		},
		select: function(event, ui) { //handles the event when user selects a suggestion from the autocomplete and concatenate the string in the "to" field
			event.preventDefault(); // ignore the default event
			//return false;
			var username_arr = (document.getElementById("username").value).split(','); //splits the string and stores into an array
			if (username_arr.length === 1) //true if the array contains 1 element so the user is just building the list of users
			{
				var item = ui.item.value; //get the value from the selected suggestion and use only that
			}
			else
			{
				username_arr[username_arr.length - 1] = ui.item.value; //the last element has a partial string due to 'document.getElementById("username").value'
																		//remove the partial string and assign it the actual value that the user selected
				var item = username_arr.join(); //join the elements into a string
			}
			//var item = userNames + ui.item.value;
			$(this).val(item); //set the username input with this string
			userNames = document.getElementById("username").value; //update the variable with the name string value in the username field
		},
		focus: function(event, ui) { //stops the default action when user uses the arrow keys and press enter on a suggestion
			event.preventDefault();
			return false;
		}
	});
});

$(function () {
	$('#compose-form').submit(function () {
		if(document.getElementById("message").value && document.getElementById("subject").value && document.getElementById("username").value) {
			//alert('Successful Validation');
			$.post(
				'classes/sendEmail.php',
				$(this).serialize(),
				function(data){
				  //$("#mainDiv").html(data);
				  //console.log(data);
				  //alert("Email sent.");
				  $(function() {
						$( "#dialog-message" ).dialog({
							modal: true,
							buttons: {
								Ok: function() {
									$( this ).dialog( "close" );
								}
							}
						});
					});
				  $('#inboxNum').text(data);
				  $('#compose').toggleClass("active");
				  $('#inbox').toggleClass("active");
				  lastBtn = "inbox";
				  loadIn('inbox');
				}
			  );
		  return false;
		}
		else
		{
			//alert('Please include a username, subject and message.');
			$(function() {
			$( "#dialog-error3" ).dialog({
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
	});
});

function save()
{
	//alert(values);
	//alert($('#box').val());
	$.post(
		'classes/saveEmail.php',
		{
			'username' : $('#username').val(),
			'subject' : $('#subject').val(), 
			'message' : $('#message').val()
		},
		function(data){
		  //$("#mainDiv").html(data);
		  //$('#inboxNum').text(data);
		  //alert("Email saved in draft box.");
		  $(function() {
				$( "#dialog-message2" ).dialog({
					modal: true,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			});
		  $('#compose').toggleClass("active");
		  $('#inbox').toggleClass("active");
		  lastBtn = "inbox";
		  loadIn('inbox');
		}
	  );
  return false;
}