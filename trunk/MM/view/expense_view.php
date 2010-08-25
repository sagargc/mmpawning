<?php
include_once('localDB.php');
include_once('loginchecker.php');
include_once('admin_functions.php');
?>
<div class="gt-success">
<table width="80%" style="cell-padding: 5px">
	<form name="expenseForm" method="post"
		action="index.php?page=expenses&submitted=true">
	<tr>
		<td>Branch:</td>
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
		<td>Choose Month:</td>
		<td><select name="year">
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
		</select> <select name="month">
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
		</select></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Submit" /></td>
	</tr>
	</form>
</table>
<br/> <br/>
<?php
if ( $_GET['submitted'] ) {
	$branch = $_POST['branch'];
	$year = $_POST['year'];
	$month = $_POST['month'];
	$data = getExpenses($branch, $year, $month);
	$count = $data['count'];
	echo '<h3>Expenses Details for '.$branch.' branch for the month '.$year.'/'.$month.'</h3>';
	echo '<center><table width="90%" style="text-align:left" border="1">'
		.'<tr><th>Description</th><th>Amount</th><th>Date</th></tr>';
	for ( $i = 0; $i < $count; $i++ ) {
		echo '<tr><td>'.$data[$i]['description'].'</td>'
			.'<td>'.$data[$i]['amount'].'</td>'
			.'<td>'.$data[$i]['date'].'</td></tr>';
		
	}
	echo '<tr><td colspan="3"><strong>Total: '.$data['total'].'</strong></td></tr>';
	echo '</table></center>';
}


?></div>
