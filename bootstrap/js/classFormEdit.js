$(document).ready(function () {
	var searchRequest = null;
	var schoolYear = '';
	var tempYear = $('#schoolYear').val();
	tempYear = tempYear.split("-");
	$("#startDate").datepicker({
		minDate: 0,
		onSelect: function() { //after selection focus on that input box so validation can refresh
			this.focus();
			this.trigger('blur');
		},
		onClose: function( selectedDate ) {
			//this.focus();
			//this.trigger('blur');
			var date = selectedDate.split('/');
			//selectedDate = (date[0]) + "/" + (parseInt(date[1])+1) + "/" + date[2]; //advance the date by 1
			selectedDate = 1 + "/" + 1 + "/" + (parseInt(date[2])+1); //set min date for endDate to be Jan 1st of the next year
			maxDate = 12 + "/" + 31 + "/" + (parseInt(date[2])+1); //set max date for endDate to be dec 31st of the next year
			schoolYear = date[2] + '-' + (parseInt(date[2])+1); //assuming the school year to be the selected year and the next year
			$('#schoolYear').val(schoolYear); //select the select box as schoolYear
			if (parseInt(date[0]) < 8)
			{
				$('#semester').val('Spring');
			}
			else
			{
				$('#semester').val('Fall');
			}
			$( "#endDate" ).datepicker( "option", "minDate", selectedDate ); //sets the minimum date for the end date
			$( "#endDate" ).datepicker( "option", "maxDate", maxDate ); //sets the maximum date for the end date
		}
	});
	$("#endDate").datepicker({
		minDate: new Date(tempYear[1], 0, 1),
		onSelect: function() { //after selection focus on that input box so validation can refresh
			this.focus();
			this.trigger('blur');
		},
		onClose: function( selectedDate ) {
			//this.focus();
			//this.trigger('blur');
			var date = selectedDate.split('/'); //spliting the selected date to get the year
			var tempDate = schoolYear.split('-'); //remove the end year that was assumed in the startDate
			schoolYear = tempDate[0] + "-" + date[2]; //add the actual end year
			$('#schoolYear').val(schoolYear); //select the select box as schoolYear
			tempDate = schoolYear.split('-'); //remove the end year in case user picks endDate again right after selecting an end date
			schoolYear = tempDate[0] + "-";
			//schoolYear = '';
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