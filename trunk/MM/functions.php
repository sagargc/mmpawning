<?php
/**
 * Function to delete a single record from the database
 * @param int $id the transaction id of the record that needs to be deleted
 * @return bool whether the deletion process was succesful
 */
function deleteRecord($id) {
   $transDeleted = mysql_query("DELETE FROM pawning WHERE ref_no='$id'");
   $refDelete = mysql_query("DELETE FROM customer_ref WHERE ref_no='$id'");
   if ( $transDeleted && $refDelete ) {
       return true;
   }
   
}
/**
 * Display function to get data from tables and display
 * @param string $page page which is calling the function in a way that can be passed to $_GET
 */
function display($page) {
    echo '<frameset><legend>Details</legend>
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
	</tr>';
    $viewQ = "SELECT * FROM pawning LIMIT 20";
    $view = mysql_query($viewQ);
    $num = mysql_num_rows($view);
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
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
    }
    echo '</table></frameset>';
}
/**
 * Display function to get today's transactions and display them
 * @param string $page the calling page
 */
function displayToday($page) {
    echo '<frameset><legend>Details</legend>
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
	</tr>';
    $branch = $_SESSION['branch'];
    $today = date('Y-m-d');
    $viewQ = "SELECT * FROM pawning WHERE date='$today' AND branch='$branch'";
    $view = mysql_query($viewQ);
    $num = mysql_num_rows($view);
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
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
    }
    echo '</table></frameset>';
}
/**
 * Function to return a full data set from pawning table for stats
 * @param string $page the calling pagename as should be passed to $_GET
 * @return array $data array containing all data
 */
function showStats($page) {
    $date = date('Y-m-d');
    $data = array();
    $data['total'] = array();
    $data['anu_market'] = array();
    $data['anu_bus'] = array();
    $data['kekirawa'] = array();
    $data['mm'] = array();
    $data['wariyapola'] = array();
    $data['kurunegala'] = array();
    $data['medawachchiya'] = array();
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date'"));
    $data['total']['trans'] = $temp['COUNT(*)'];
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='kekirawa'"));
    $data['kekirawa']['trans'] = $temp['COUNT(*)'];
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='anu_market'"));
    $data['anu_market']['trans'] = $temp['COUNT(*)']; 
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='anu_bus'"));
    $data['anu_bus']['trans'] = $temp['COUNT(*)'];
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='mm'"));
    $data['mm']['trans'] = $temp['COUNT(*)'];
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='kurunegala'"));
    $data['kurunegala']['trans'] = $temp['COUNT(*)'];
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='wariyapola'"));
    $data['wariyapola']['trans'] = $temp['COUNT(*)'];
    $temp = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='medawachchiya'"));
    $data['medawachchiya']['trans'] = $temp['COUNT(*)'];
    
    $gold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date'"));
    
    $data['total']['pawning'] = $gold['pawns'];
    $data['total']['gold'] = $gold['gold'];
    
    $kekirawaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='kekirawa'"));
    
    $data['kekirawa']['pawning'] = $kekirawaGold['pawns'];
    $data['kekirawa']['gold'] = $kekirawaGold['gold'];
    
    $anuMarketGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='anu_market'"));
    
    $data['anu_market']['pawning'] = $anuMarketGold['pawns'];
    $data['anu_market']['gold'] = $anuMarketGold['gold'];
    
    $anuBusGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='anu_bus'"));
    
    $data['anu_bus']['pawning'] = $anuBusGold['pawns'];
    $data['anu_bus']['gold'] = $anuBusGold['gold'];
    
    $mmGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='mm'"));
    
    $data['mm']['pawning'] = $mmGold['pawns'];
    $data['mm']['gold'] = $mmGold['gold'];
    
    $kurunegalaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='kurunegala'"));
    
    $data['kurunegala']['pawning'] = $mmGold['pawns'];
    $data['kurunegala']['gold'] = $mmGold['gold'];
    
    $wariyapolaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='wariyapola'"));
    
    $data['wariyapola']['pawning'] = $wariyapolaGold['pawns'];
    $data['wariyapola']['gold'] = $wariyapolaGold['gold'];
    
    $medawachchiyaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='medawachchiya'"));
    
    $data['medawachchiya']['pawning'] = $medawachchiyaGold['pawns'];
    $data['medawachchiya']['gold'] = $medawachchiyaGold['gold'];
    
    /*$display = '<h3>Today\'s transactions</h3><br/><table border="0" width="80%">'
                .'<tr><td>Total transactions</td><td>'.$pawnNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>Anuradhapura Market transactions</td><td>'.$anuMarketNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>Anuradhapura Bus Stand transactions</td><td>'.$anuBusNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>Kekirawa transactions</td><td>'.$kekirawaNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>MM transactions</td><td>'.$mmNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>Kurunegala transactions</td><td>'.$kurunegalaNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>Wariyapola transactions</td><td>'.$wariyapolaNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>Medawachchiya transactions</td><td>'.$medawachchiyaNumber['COUNT(*)'].'</td></tr>'
                .'<tr><td>Total gold weight</td><td>'.$totalGold.'</td></tr>'
                .'</table>';
    echo $display;*/
    //echo $data['total']['pawning'];
    return $data;
}
/**
 * Function called by getEmp.php to get employee details (related to showEmp() ajax function)
 * @param string $name name of the employee as returned by the HTML select
 */
function dispEmp($name) {
	$empName = $name;
	$thisMonth = date('Y-m');
	$emp = mysql_fetch_assoc(mysql_query("SELECT emp_id,total_salary FROM employees WHERE name='$empName'"));
	echo '<p>Employee Total Salary: '.$emp['total_salary'].'</p>';
	echo '<table width="80%" border="0" style="text-align:center"><tr><th>Payment</th><th>Date</th></tr>';
	$payments = mysql_query("SELECT * FROM salaries WHERE emp_id='{$emp['emp_id']}'");
	$num = mysql_num_rows($payments);
	for ( $i = 0; $i < $num; $i++ ) {
		$date = mysql_result($payments,$i,"date");
		$month = substr($date,0,7);
		if ( $month == $thisMonth ) {
			echo '<tr><td>Rs. '.mysql_result($payments,$i,"amount").'</td><td>'.$date.'</td></tr>';
		}
	}
	echo '</table>';
}

/**
 * Function called by getRefs.php to get REF_NO details (related to shoRefs() ajax function)
 * @param string $name name of the customer
 */
function dispRefs($name) {
	$cusId = mysql_fetch_assoc(mysql_query("SELECT cus_id FROM customer_details WHERE name='$name'"));
	$cusId = $cusId['cus_id'];
	$refs = mysql_query("SELECT ref_no FROM customer_ref WHERE cus_id='$cusId'");
	$num = mysql_num_rows($refs);
	echo '<select name="ref_no" onchange="showTrans(this.value)"><option value="">Select Bill</option>';
	for ( $i = 0; $i < $num; $i++ ) {
		$id = mysql_result($refs, $i, "ref_no");
		echo '<option value="'.$id.'">'.$id.'</option>';
	}
	echo '</select>';
	echo '<div id="detail">Transaction details</div>';
}

function dispSingle($id) {
	$details = mysql_fetch_assoc(mysql_query("SELECT * FROM pawning WHERE ref_no='$id'"));
	echo '<table width="70%" border="0">';
	echo '<tr><td>Type</td><td>'.$details['type'].'</td></tr>'
		.'<tr><td>Weight</td><td>'.$details['weight'].'</td></tr>'
		.'<tr><td>Amount</td><td>'.$details['amount'].'</td></tr>'
		.'<tr><td>Date</td><td>'.$details['date'].'</td></tr>';
	echo '</table>';
}
?>
