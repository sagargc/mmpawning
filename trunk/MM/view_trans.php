<?php
//session_start();
include_once('localDB.php');
include_once('loginchecker.php');

$viewQ = "SELECT * FROM pawning LIMIT 20";
$view = mysql_query($viewQ);
$num = mysql_num_rows($view);
?>
<frameset><legend>Details</legend>
<table width="80%" border="1">
	<tr>
                <th>No</th>
		<th>Bill Id</th>
		<th>Date</th>
		<th>Weight</th>
		<th>Amount</th>
		<th>Type</th>
		<th>Branch</th>
		<th>Delete</th>
	</tr>
<?php
$no=1;
for ( $i = 0; $i < $num; $i++ ) {
	$ref = mysql_result($view,$i,'ref_no');
	echo '<tr><td>'.$no++.'</td>'.
         '<td>'.$ref.'</td>'.
         '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td>'.mysql_result($view,$i,'weight').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'type').'</td>'.
		 '<td>'.mysql_result($view,$i,'branch').'</td>'.
		 '<td style="text-align:center"><a href="home.php?page=view&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
}
if ( $_GET['func'] == 'delete' ) {
	$id = $_GET['ref'];
	$deleted = mysql_query("DELETE FROM pawning WHERE ref_no='$id'");
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
}
?>	
</table>
</frameset>	
	
