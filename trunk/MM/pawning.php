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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<fieldset><legend><strong>Pawning To <?php echo $_SESSION['branch'] ?> Branch</strong></legend>

<form method="POST" action="home.php?page=pawning&amp;submitted=yes"
		name="myform">
<table>
	<tr>
		<td>Customer name:</td>
		<td><span id="sprytextfield1">
		  <input type="text" name="name" id="name" />
	    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
	</tr>
	<tr>
		<td>Customer ID:</td>
		<td><span id="sprytextfield2">
		  <input type="text" name="id" id="id" />
	    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
	</tr>
	<tr>
		<tr>
			<td>Customer Address:</td>
			<td><span id="sprytextarea1">
			  <textarea name="address" id="address" cols="30" rows="3"></textarea>
		    <span class="textareaRequiredMsg">A value is required.</span></span></td>
		</tr>
		<tr>
			<td>Bill number:</td>
			<td><span id="sprytextfield3">
			  <input type="text" name="ref_no" id="ref_no" />
		    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
		</tr>


		<tr>
			<td>Jewellary:</td>
			<td><span id="sprytextfield6">
			  <input type="text" name="type" id="ref_no" />
		    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
		</tr>
		<tr>
			<td>Weight:</td>
			<td><span id="sprytextfield4">
            <input type="text" name="weight" id="weight" />
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td>Rs.<span id="sprytextfield5">
            <input type="text" name="amount" id="amount" />
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>

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
	</table>
</form>
<legend></legend></fieldset>
<?php
$today = date('Y-m-d');
showStats('pawning');
$dataSubmitted = $_GET['submitted'];
if( $dataSubmitted == "yes" ) {
		//include_once('localDB.php');
	$genericInsert = "INSERT INTO pawning(ref_no,amount,date,type,weight,branch,entryDate) "
	."VALUES('{$_POST['ref_no']}','{$_POST['amount']}','{$_POST['date']}','{$_POST['type']}','{$_POST['weight']}','{$_SESSION['branch']}','".$today."');";
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
	
	
	$cashResult = mysql_query("SELECT cash FROM hand_cash WHERE branch='{$_SESSION['branch']}'");
	$cash = mysql_fetch_array($cashResult);
	$updatedCash = ($cash['cash'] - $_POST['amount']);
	$cashUpdate = mysql_query("UPDATE hand_cash SET cash='$updatedCash' WHERE branch='{$_SESSION['branch']}'"); 
	
	
	if ( ($pawningResult && $referenceResult && $cashUpdate) != null ) {
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
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "real", {validateOn:["change"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
//-->
</script>
