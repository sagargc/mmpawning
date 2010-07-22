<?php
session_start();
$logged = $_SESSION['logged'];
if ( $logged ) {
?>
<fieldset>
<legend><strong>Choose the Branch</strong></legend>
<table>
	<form method="post" action="home.php?page=branch&submitted=yes">
		
		<tr>
			<td>Choose the Branch:</td>
			<td>
				<select name="branch">
                    <option value="" selected="selected">Select the branch</option>
                    <option value="anu_market">Anuradapura Market</option>
					<option value="anu_bus">Anuradapura Bus stand</option>
					<option value="mm">MM Branch</option>
					<option value="kurunegala">Kurunegala</option>
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
<?php 
if ( $_GET['submitted'] == "yes" ) {
	$_SESSION['branch'] = $_POST['branch'];
	print 'you have chosen '.$_POST['branch'].' branch to input data';
}
?>
