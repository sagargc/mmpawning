<?php
session_start();
$day = date('d');
$month = date('F');
$numericMonth = date('m');
$year = date('Y');
$logged = $_SESSION['logged'];
if ( $logged ) {
	?>
<fieldset><legend><strong>Other</strong></legend>
<table>
	<form method="post" action="">
	<tr>
		<td>Extra Capital:</td>
		<td><input type="text" size="30" maxlength="50" name="name"></td>
	</tr>
	<tr>
		<td>DFCC Bank:</td>
		<td><input type="text" size="30" maxlength="50" name="name"></td>
	</tr>
	<tr>
		<td>Bank Deposit on MM:</td>
		<td><input type="text" size="30" maxlength="50" name="name"></td>
	</tr>

	<tr>
		<td>Date:</td>

		<td><select name="year">
			<option value="<?php echo $year;?>" selected="selected"><?php echo $year;?></option>
			<option value="2008">2008</option>
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
		</select> <select name="month">
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
		</select> <select name="date">
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
		<td></td>
		<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<INPUT
			type="submit" name="button" value="Update" /></td>
	</tr>


	</form>
</table>
</fieldset>
<?php } else { ?>
<p>You have not logged in. <a href="home.php?page=login">Click here to
login again.</a></p>
<?php } ?>