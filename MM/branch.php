<?php
session_start();
$day = date('d');
$month = date('F');
$numericMonth = date('m');
$year = date('Y');
$logged = $_SESSION['logged'];
if ( $logged ) {
?>
<fieldset>
<legend><strong>Choose the Branch</strong></legend>
<table>
	<form method="post" action="">
		
		<tr>
			<td>Choose the Branch:</td>
			<td>
				<select>
                    <option value="">Select</option>
                    <option value="market">Anuradapura Market</option>
					<option value="bus">Anuradapura Bus stand</option>
					<option value="mm">MM Branch</option>
					<option value="kurunagala">Kurunagala</option>
					<option value="wariyapola">Wariyapola</option>
                    <option value="kekirawa">Kekirawa</option>
					<option value="madawachchiya">Madawachchiya</option>                    
			</select>
				
		</tr>
		
		
		<tr>
			<td> </td>
			<td>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
				<INPUT type="submit" name="button"  value="Update" /></td>
		</tr>
		
	</form>
	
</table>
</legend>
</fieldset>
<?php } else { ?>
<p>You have not logged in. <a href="home.php?page=login">Click here to login again.</a></p>
<?php } ?>