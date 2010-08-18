<?php
include_once('loginchecker.php');
include_once('localDB.php');
include_once('functions.php');
$day = date('d');
$month = date('F');
$numericMonth = date('m');
$year = date('Y');

?>
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
		
		
		
		<tr>
			<td>Date:</td>
			
<td>
<select name="year">
<option value="<?php echo $year;?>" selected="selected"><?php echo $year;?></option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
</select>
<select name="month">
<option value="<?php echo $numericMonth; ?>" selected="selected"><?php echo $month; ?></option>
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
</select>
<select name="date">
<option value="<?php echo $day; ?>"><?php echo $day; ?></option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>

		</tr>
		
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
        $date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['date'];

        $genericInsert = "INSERT INTO expenses(discription,ex_id,branch,date,amount) "
        ."VALUES('{$_POST['dis']}','','{$_POST['branch']}','{$date}','{$_POST['amount']}');";
        $exResult = mysql_query($genericInsert);

        
        if ( ($exResult) != null ) {
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

