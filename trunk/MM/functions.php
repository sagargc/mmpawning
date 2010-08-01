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
    $data['total']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date'"));
    $data['kekirawa']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='kekirawa'"));
    $data['anu_market']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='anu_market'"));
    $data['anu_bus']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='anu_bus'"));
    $data['mm']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='mm'"));
    $data['kurunegala']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='kurunegala'"));
    $data['wariyapola']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='wariyapola'"));
    $data['medawachchiya']['trans'] = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM pawning WHERE date='$date' AND branch='medawachchiya'"));
    $gold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date'");
    $num = mysql_num_rows($gold);
    $data['total']['pawning'] = 0;
    $data['total']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['total']['gold'] = $data['total']['gold'] + mysql_result($gold, $i, 'weight');
        $data['total']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
    $kekirawaGold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date' AND branch='kekirawa'");
    $num = mysql_num_rows($kekirawaGold);
    $data['kekirawa']['pawning'] = 0;
    $data['kekirawa']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['kekirawa']['gold'] = $data['kekirawa']['gold'] + mysql_result($gold, $i, 'weight');
        $data['kekirawa']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
    $anuMarketGold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date' AND branch='anu_market'");
    $num = mysql_num_rows($anuMarketGold);
    $data['anu_market']['pawning'] = 0;
    $data['anu_market']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['anu_market']['gold'] = $data['anu_market']['gold'] + mysql_result($gold, $i, 'weight');
        $data['anu_market']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
    $anuBusGold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date' AND branch='anu_bus'");
    $num = mysql_num_rows($anuBusGold);
    $data['anu_bus']['pawning'] = 0;
    $data['anu_bus']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['anu_bus']['gold'] = $data['anu_bus']['gold'] + mysql_result($gold, $i, 'weight');
        $data['anu_bus']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
    $mmGold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date' AND branch='mm'");
    $num = mysql_num_rows($mmGold);
    $data['mm']['pawning'] = 0;
    $data['mm']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['mm']['gold'] = $data['mm']['gold'] + mysql_result($gold, $i, 'weight');
        $data['mm']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
    $kurunegalaGold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date' AND branch='kurunegala'");
    $num = mysql_num_rows($kurunegalaGold);
    $data['kurunegala']['pawning'] = 0;
    $data['kurunegala']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['kurunegala']['gold'] = $data['kurunegala']['gold'] + mysql_result($gold, $i, 'weight');
        $data['kurunegala']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
    $wariyapolaGold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date' AND branch='wariyapola'");
    $num = mysql_num_rows($anuMarketGold);
    $data['wariyapola']['pawning'] = 0;
    $data['wariyapola']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['wariyapola']['gold'] = $data['wariyapola']['gold'] + mysql_result($gold, $i, 'weight');
        $data['wariyapola']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
    $medawachchiyaGold = mysql_query("SELECT amount,weight FROM pawning WHERE date='$date' AND branch='medawachchiya'");
    $num = mysql_num_rows($anuMarketGold);
    $data['medawachchiya']['pawning'] = 0;
    $data['medawachchiya']['gold'] = 0.00;
    for ( $i = 0; $i < $num; $i++ ) {
        $data['medawachchiya']['gold'] = $data['medawachchiya']['gold'] + mysql_result($gold, $i, 'weight');
        $data['medawachchiya']['pawning'] = $data['total']['pawning'] + mysql_result($gold, $i, 'amount');
    }
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
