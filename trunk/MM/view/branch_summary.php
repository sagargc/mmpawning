<?php
include_once('localDB.php');
include_once('loginchecker.php');
include_once('admin_functions.php');
?>

<table class="gt-notice-box" width="80%" style="cell-padding:5px">
<form name="summary" method="post" action="index.php?page=branchsummary&submitted=true">
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
	<tr><td>Choose Month:</td>
	<td>
		<select name="year">
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
		</select> 
		<select name="month">
			<option value="01">January</option>
			<option value="02">February</option>
			<option value="03">March</option>
			<option value="04">April</option>
			<option value="05">May</option>
			<option value="06">June</option>
			<option value="07">July</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select> </td></tr>
		<tr><td></td><td><input type="submit" value="Submit" /></td></tr>
</form>
</table>
<br/> <br/>
<?php 
if ( $_GET['submitted'] ) {
	$branch = $_POST['branch'];
	$year= $_POST['year'];
	$month = $_POST['month'];
	$data = getSummary($branch, $month, $year);
	$days = count($data['pawning']);
	echo '<center><table width="90%" style="text-align:left" border="1" class="gt-notice-box">'
		.'<tr><th>Date</th><th>Income</th><th>Interest</th><th>Pawn Took</th><th>Bank Deposit</th>'
		.'<th>Salary</th><th>Expenses</th><th>Hand Cash</th></tr>';
	for ( $i = 1; $i <= $days; $i++ ) {
		if ( $i < 10 ) {
			$j = '0'.$i;
		}
		else {
			$j = $i;
		}
		echo '<tr><td>'.$year.'.'.$month.'.'.$j.'</td><td>'.$data['income'][$i].'</td>'
			.'<td>'.$data['interest'][$i].'</td><td>-'.$data['pawning'][$i].'<td></td>'
			.'<td>-'.$data['salary'][$i].'</td><td>-'.$data['expenses'][$i].'<td></td></tr>';
	}
	echo '</table></center>';
}
?>