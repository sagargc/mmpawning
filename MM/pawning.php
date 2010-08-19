<?php
session_start();
include_once('loginchecker.php');
include_once('branch_checker.php');
include_once('localDB.php');
include_once('functions.php');
$day = date('Y-m-d');


?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<link rel="stylesheet" href="calendar/calendar.css">
<fieldset><legend><strong>Pawning</strong></legend>
<table>


	<form method="POST" action="home.php?page=pawning&amp;submitted=yes"
		name="myform">
	<tr>
		<td>Customer name:</td>
		<td><input type="text" size="30" maxlength="50" name="name"></td>
	</tr>
	<tr>
		<td>Customer ID:</td>
		<td><input type="text" size="30" maxlength="50" name="id"></td>
	</tr>
	<tr>
		<tr>
			<td>Customer Address:</td>
			<td><textarea name="address" rows="5" cols="" style="width: 215px;"></textarea></td>
		</tr>
		<tr>
			<td>Bill number:</td>
			<td><input type="text" size="30" maxlength="50" name="ref_no"></td>
		</tr>


		<tr>
			<td>Jewellary:</td>
			<td><select name="type">
				<option value="">Select</option>
				<option value="Chain">Chain</option>
				<option value="Ring">Ring</option>
				<option value="Bangle">Bangle</option>
				<option value="Bracelet">bracelet</option>
			</select></td>
		</tr>
		<tr>
			<td>Weight:</td>
			<td><input type="text" size="30" maxlength="50" name="weight"></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td><input type="text" size="30" maxlength="50" name="amount"></td>

		</tr>
		<tr><td>Enter Date:</td>
		<td><input type="text" name="date" value="<?php echo $day;?>" />
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
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<INPUT
				type="submit" name="button" value="Update" /></td>
		</tr>

	</tr>
	</form>
</table>
<legend></legend></fieldset>
<?php
showStats('pawning');
$dataSubmitted = $_GET['submitted'];



if( $dataSubmitted == "yes" ) {
	$customerCheck = mysql_fetch_assoc(mysql_query("SELECT name FROM customer_details WHERE cus_id='{$_POST['id']}'"));

	
	//include_once('localDB.php');
	

	$genericInsert = "INSERT INTO pawning(ref_no,amount,date,type,weight,branch) "
	."VALUES('{$_POST['ref_no']}','{$_POST['amount']}','{$_POST['date']}','{$_POST['type']}','{$_POST['weight']}','{$_SESSION['branch']}');";
	$pawningResult = mysql_query($genericInsert);

	if ( $customerCheck['name'] == "" ) {
		$cus_detailInsert = "INSERT INTO customer_details(cus_id,name,address,branch) "
		."VALUES('{$_POST['id']}','{$_POST['name']}','{$_POST['address']}','{$_SESSION['branch']}');";
		$cusResult = mysql_query($cus_detailInsert);
	}
	$cus_refInsert = "INSERT INTO customer_ref(cus_id,ref_no) "
	."VALUES('{$_POST['id']}','{$_POST['ref_no']}');";
	$referenceResult = mysql_query($cus_refInsert);

	$goldInsert = "INSERT INTO gold(ref_no,type,weight,status) "
	."VALUES('{$_POST['ref_no']}','{$_POST['type']}','{$_POST['weight']}','pawned');";
	$goldResult = mysql_query($goldInsert);
	if ( ($pawningResult && $referenceResult) != null ) {
		echo '<p>Data entered successfully</p>';
	}
	else {
		echo '<p>Failed to enter data</p>';
	}
	displayToday('pawning');

}
//session_start();
if ( $_GET['func'] == 'delete' ) {
	$id = $_GET['ref'];
	$deleted = deleteRecord($id, 'pawning');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
	displayToday('pawning');
}
?>
