<?php
session_start();
include_once('loginchecker.php');
//include_once('branch_checker.php');
include_once('localDB.php');
include_once('functions.php');
?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<link rel="stylesheet" href="calendar/calendar.css">
<fieldset>
<legend><strong>Withdrawals</strong></legend>
<form method="POST" action="home.php?page=withdraw&submitted=true"
		name="myform">
<table>
	<tr>
		<td>Incoming Source:</td>
		<td><select name="type">
			<option value="sampath_bank">Sampath Bank</option>
			<option value="anu_market">Anuradapura Market</option>
			<option value="anu_bus">Anuradapura Bus stand</option>
			<option value="mm">MM Branch</option>
			<option value="kurunegala">Kurunegala</option>
			<option value="wariyapola">Wariyapola</option>
            <option value="kekirawa">Kekirawa</option>
			<option value="medawachchiya">Madawachchiya</option>
			<option value="other">Other</option>
		</select></td>
	</tr>
	<tr>
		<td>Amount:</td>
		<td><input type="text" size="30" maxlength="50" name="amount"></td>
	</tr>
	<tr>
		<td>Discription:</td>
		<td><textarea name="description" rows="5"></textarea></td>

	</tr>
	<tr><td>Transaction Date:</td>
		<td><input type="text" name="date" />
		<script language="JavaScript">
		new tcal ({
			// form name
			'formname': 'myform',
			// input name
			'controlname': 'date'
		});

	</script></td></tr>

	<tr>
		<td></td>
		<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<INPUT type="submit" name="button" value="Enter" style="padding:4px" /></td>
	</tr>


</table>
</form>
</legend></fieldset>

<?php

$today = date('Y-m-d');
if( $_GET['submitted'] ) {
    $genericInsert = "INSERT INTO withdrawals(trans_id,source,amount,description,date,entryDate) "
      				."VALUES('','{$_POST['type']}','{$_POST['amount']}','{$_POST['description']}','{$_POST['date']}','$today');";
    $withdrawResult = mysql_query($genericInsert);

    if ( ($withdrawResult) != null ) {
    	echo '<p>Data entered successfully</p>';
    }
    else {
       	echo '<p>Failed to enter data</p>';
    }
    displayToday('withdraw');

}
if ( $_GET['func'] == 'delete' ) {
	$id = $_GET['ref'];
	$deleted = deleteRecord($id, 'withdraw');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
	displayToday('withdraw');
}

?>