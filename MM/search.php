<?php
session_start();
include_once('loginchecker.php');

include_once('localDB.php');
//include_once('hostingDB.php');


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



<?php 
if ( $_GET['submitted'] == 'yes' ) {
	$display = '<frameset><legend>Details</legend><table width="80%" border="0">';
				
	if ( $_POST['type'] == 'cus_name' ) {
		$display .= '<tr>'
					.'<th>Bill Id</th><th>Date</th><th>Weight</th>'
					.'<th>Amount</th><th>Type</th><th>Branch</td></tr>';
		$searchQuery = "SELECT cus_id FROM customer_details WHERE"
						." name LIKE '%{$_POST['searchData']}'"
						." OR name LIKE '{$_POST['searchData']}%'"
						." OR name LIKE '%{$_POST['searchData']}%'";
		$searchResult = mysql_query($searchQuery);
		$cusId = mysql_result($searchResult, 'cus_id');
		
		$transQuery = "SELECT ref_no FROM customer_ref WHERE"
						." cus_id='$cusId'";
		$transResult = mysql_query($transQuery);
		$num = mysql_num_rows($transResult);
		for ( $i = 0; $i < $num; $i++ ) {
			$transId = mysql_result($transResult,$i,'ref_no');
			$sql = "SELECT * FROM pawning WHERE ref_no='$transId'";
			$data = mysql_query($sql);
			$data = mysql_fetch_assoc($data);
			$x = 1;
			$display .= '<tr><td>'.$data['ref_no'].'</td>'
						.'<td>'.$data['date'].'</td>'
						.'<td>'.$data['weight'].'</td>'
						.'<td>'.$data['amount'].'</td>'
						.'<td>'.$data['type'].'</td>'
						.'<td>'.$data['branch'].'</td></tr>';
		}
	}
	else if ( $_POST['type'] == 'bill_id' ) {
		$display .= '<tr>'
					.'<th>Customer Name</th><th>Date</th><th>Weight</th>'
					.'<th>Amount</th><th>Type</th><th>Branch</td></tr>';
		$sql2 = "SELECT * FROM pawning WHERE ref_no='{$_POST['searchData']}'";
		$data = mysql_query($sql2);
		$data = mysql_fetch_assoc($data);
		$cusIdResult = mysql_query("SELECT cus_id FROM customer_ref WHERE ref_no='{$_POST['searchData']}'");
		$cusId = mysql_result($cusIdResult,'cus_id');
		$cusNameResult = mysql_query("SELECT name FROM customer_details WHERE cus_id='$cusId'");
		$cusName = mysql_result($cusNameResult,'name');
		$display .= '<tr><td>'.$cusName.'</td>'
					.'<td>'.$data['date'].'</td>'
					.'<td>'.$data['weight'].'</td>'
					.'<td>'.$data['amount'].'</td>'
					.'<td>'.$data['type'].'</td>'
					.'<td>'.$data['branch'].'</td></tr>';
	}
	$display .= '</table></frameset>';
	echo $display;
}
