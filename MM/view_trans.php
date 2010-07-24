<?php
session_start();
include_once('localDB.php');
//include_once('hostingDB.php');

if ( $logged ) {
	$viewQ = "SELECT * FROM pawning LIMIT 20";
	$view = mysql_query($viewQ);
?>
<frameset><legend>Details</legend>
<table width="80%" border="0">
	<tr>
		<th>Bill Id</th>
		<th>Date</th>
		<th>Weight</th>
		<th>Amount</th>
		<th>Type</th>
		<th>Branch</td>
	</tr>
	
	
	
<?php } ?>