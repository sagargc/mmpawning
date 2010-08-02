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
    
    $gold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date'"));
    
    $data['total']['pawning'] = $gold['SUM(amount)'];
    $data['total']['gold'] = $gold['SUM(weight)'];
    
    $kekirawaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date' AND branch='kekirawa'"));
    
    $data['kekirawa']['pawning'] = $kekirawaGold['SUM(amount)'];
    $data['kekirawa']['gold'] = $kekirawaGold['SUM(weight)'];
    
    $anuMarketGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date' AND branch='anu_market'"));
    
    $data['anu_market']['pawning'] = $anuMarketGold['SUM(amount)'];
    $data['anu_market']['gold'] = $anuMarketGold['SUM(weight)'];
    
    $anuBusGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date' AND branch='anu_bus'"));
    
    $data['anu_bus']['pawning'] = $anuBusGold['SUM(amount)'];
    $data['anu_bus']['gold'] = $anuBusGold['SUM(weight)'];
    
    $mmGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date' AND branch='mm'"));
    
    $data['mm']['pawning'] = $mmGold['SUM(amount)'];
    $data['mm']['gold'] = $mmGold['SUM(weight)'];
    
    $kurunegalaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date' AND branch='kurunegala'"));
    
    $data['kurunegala']['pawning'] = $mmGold['SUM(amount)'];
    $data['kurunegala']['gold'] = $mmGold['SUM(weight)'];
    
    $wariyapolaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date' AND branch='wariyapola'"));
    
    $data['wariyapola']['pawning'] = $wariyapolaGold['SUM(amount)'];
    $data['wariyapola']['gold'] = $wariyapolaGold['SUM(weight)'];
    
    $medawachchiyaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount),SUM(weight) FROM pawning WHERE date='$date' AND branch='medawachchiya'"));
    
    $data['medawachchiya']['pawning'] = $medawachchiyaGold['SUM(amount)'];
    $data['medawachchiya']['gold'] = $medawachchiyaGold['SUM(weight)'];
    
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
?>
