<?php
include_once('localDB.php');
include_once('loginchecker.php');
?>

<table width="90%" border="0" class="gt-notice-box">
	<form method="post" action="index.php?page=newEmp&submitted=true" name="empForm">
	<tr>
		<td>Employee ID:</td>
		<td><input type="text" size="30" name="empID" /></td>
	</tr>
	<tr>
		<td>Employee Name:</td>
		<td><input type="text" size="30" name="empName" /></td>
	</tr>

	<tr>
		<td>Total Salary:</td>
		<td><input type="text" size="30" maxlength="50" name="salary" /></td>
	</tr>
	<tr><td>Branch:</td>
		<td><select name="branch"><option value="" selected="selected">Select the branch</option>
            <option value="anu_market">Anuradapura Market</option>
			<option value="anu_bus">Anuradapura Bus stand</option>
			<option value="mm">MM Branch</option>
			<option value="kurunegala">Kurunegala</option>
			<option value="wariyapola">Wariyapola</option>
            <option value="kekirawa">Kekirawa</option>
			<option value="medawachchiya">Madawachchiya</option>
		</select></td></tr>
	<tr><td></td><td style="text-align:center">
	<input type="submit" value="Add" style="padding:3px" /></td></tr>
	</form>
</table>

<?php 
if ( $_GET['submitted'] ) {
	$empInsert = "INSERT INTO employees "
				."VALUES('{$_POST['empID']}','{$_POST['empName']}','{$_POST['salary']}','{$_POST['branch']}')";
	$inserted = mysql_query($empInsert);
	if ( isset($inserted) ) {
		echo '<p>Employee details added to database</p>';
	}
	else {
		echo '<p>Failed to add employee data</p>';
	}
}
?>