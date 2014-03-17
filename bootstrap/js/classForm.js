$(document).ready(function () {
	var searchRequest = null;
	$("#startDate").datepicker({
		minDate: 0,
		onSelect: function() { //after selection focus on that input box so validation can refresh
			this.focus();
		},
		onClose: function( selectedDate ) {
			var date = selectedDate.split('/');
			selectedDate = date[0] + "/" + (parseInt(date[1])+1) + "/" + date[2]; //advance the date by 1
			$( "#endDate" ).datepicker( "option", "minDate", selectedDate ); //sets the minimum date for the end date
		}
	});
	$("#endDate").datepicker({
		minDate: 0,
		onSelect: function() { //after selection focus on that input box so validation can refresh
			this.focus();
		},
		onClose: function( selectedDate ) {
			this.focus();
			$( "#startDate" ).datepicker( "option", "maxDate", selectedDate ); //set the max date to the end date
		}
	});
	$('.time').timepicker(
	{
		onSelect: function() { //after selection focus on that input box so validation can refresh
				this.focus();
			}
	});

	$("#username").autocomplete({
			minLength: 1,
			source: function(request, response) {
				if (searchRequest !== null) {
					searchRequest.abort();
				}
				searchRequest = $.ajax({
					url: '../classes/listTeacher.php',
					method: 'post',
					dataType: "json",
					data: {term: request.term},
					success: function(data) {
						searchRequest = null;
						response($.map(data, function(data) {
							return {
								label: data.username + '<' + data.first + ' ' + data.last + '>',
								value: data.value
							};
						}));
					}
				})
			}
	});
	
	$('.date').keydown(function() { //disable keyboard input ont he date fields
		return false;
	});
});