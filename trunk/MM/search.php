<?php
session_start();
$logged = $_SESSION['logged'];
$database = "mm_pawning";
$username = "root";
$password = "";
mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die("Unable to open database!");

if ( $logged ) {
?>
<form name="searchForm" method="post"
	action="home.php?page=search&submitted=yes">
<table width="80%" border="0">
	<tr>
		<td>Enter Search Data</td>
		<td><input type="text" name="searchData" size="30" /></td>
	</tr>
	<tr>
		<td>Search Type:</td>
		<td>
		<select name="type">
			<option value="cus_name">Customer</option>
			<option value="bill_id">Bill Id</option>
		</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Search" /></td>
	</tr>
</table>
</form>


<?php } else { ?>
<p>You have not logged in. <a href="home.php?page=login">Click here to login again.</a></p>
<?php } ?>
<?php 
if ( $_GET['submitted'] == 'yes' ) {
	if ( $_POST['type'] == 'cus_name' ) {
		
	}
}
