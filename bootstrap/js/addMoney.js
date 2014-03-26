function addMoney($studentID)
{
//var tempArray = [studentID];
	$.post(
		'../classes/addMoney.php',
		{
			'addingBalance' : $('#addingBalance').val(),
			'studentID' : $studentID
		},
		function(data){
		  //$("#mainDiv").html(data);
		  //$('#inboxNum').text(data);
		location.reload();
		}
	  );
return false;
}