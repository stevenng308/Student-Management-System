function addMoney($studentID, $num)
{
//var tempArray = [studentID];
	$.post(
		'../classes/addMoney.php',
		{
			'addingBalance' : $('#addingBalance'+$num).val(),
			'studentID' : $studentID
		},
		function(data){
		  //$("#lunch").html(data);
		  //$('#inboxNum').text(data);
			location.reload();
		}
	  );
return false;
}