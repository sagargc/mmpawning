<?php
include_once('loginchecker.php');
include_once('localDB.php');
include_once('functions.php');
$day = date('Y-m-d');

?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<link rel="stylesheet" href="calendar/calendar.css">
<fieldset>
<legend><strong>Expenses</strong></legend>
<table>
	<form method="POST" action="home.php?page=expences&submitted=yes"
		name="myform">
		<tr>
			<td>Select Branch:</td>
			<td><select name="branch">
                    <option value="" selected="selected">Select the branch</option>
                    <option value="anu_market">Anuradapura Market</option>
					<option value="anu_bus">Anuradapura Bus stand</option>
					<option value="mm">MM Branch</option>
					<option value="kurunegala">Kurunegala</option>
					<option value="wariyapola">Wariyapola</option>
                    <option value="kekirawa">Kekirawa</option>
					<option value="medawachchiya">Madawachchiya</option>
			</select></td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td><input type="text" size="30" maxlength="50" name="amount"></td>
		</tr>
		<tr>
			<td>Discription:</td>
			<td><textarea name="dis" rows="3" cols="" style="width: 205px;"></textarea></td>
		</tr>
		
		
		
		<tr><td>Enter Date:</td>
		<td><input type="text" name="date" value="<?php echo $day;?>"/>
		<script language="JavaScript">
		new tcal ({
			// form name
			'formname': 'myform',
			// input name
			'controlname': 'date'
		});

		</script></td></tr>
		
		<tr>
			<td> </td>
			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
			&nbsp;<INPUT type="submit" name="button"  value="Update" /></td>
		</tr>
	</form>
</table>
</legend>
</fieldset>

<?php
showStats('expenses');
$dataSubmitted = $_GET['submitted'];

if($dataSubmitted == "yes") {
        displayToday('expenses');
        include_once('localDB.php');
		
        $genericInsert = "INSERT INTO expenses(discription,ex_id,branch,date,amount) "
        ."VALUES('{$_POST['dis']}','','{$_POST['branch']}','{$_POST['date']}','{$_POST['amount']}');";
        $exResult = mysql_query($genericInsert);
		
		$cashResult = mysql_query("SELECT cash FROM hand_cash WHERE branch='{$_POST['branch']}'");
		$cash = mysql_fetch_array($cashResult);
		$updatedCash = ($cash['cash'] - $_POST['amount']);
		$cashUpdate = mysql_query("UPDATE hand_cash SET cash='$updatedCash' WHERE branch='{$_POST['branch']}'"); 

        
        if ( $exResult && $cashUpdate != null ) {
                echo '<p>Data entered successfully</p>';
        }
        else {
                echo '<p>Failed to enter data</p>';
        }

}
//session_start();
if ( $_GET['func'] == 'delete' ) {
	$id = $_GET['ref'];
	$deleted = deleteRecord($id);
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
        displayToday('expenses');
}
?>

