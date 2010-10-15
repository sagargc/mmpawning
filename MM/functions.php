<?php
/**
 * MidiSL page include function
 * @param string $name name of the page to be included
 * @param array $namesAndPages Array mapping pagenames to actual pages
 */
function midiInclude($name, $namesAndPages) {
	include($namesAndPages[$name]);
}
/**
 * Function to delete a single record from the database
 * @param int $id the transaction id of the record that needs to be deleted
 * @param string $page the calling page
 * @return bool whether the deletion process was succesful
 */
function deleteRecord($id, $page) {
	if ( $page == 'pawning' ) {
		$transDeleted = mysql_query("DELETE FROM pawning WHERE ref_no='$id'");
		$refDelete = mysql_query("DELETE FROM customer_ref WHERE ref_no='$id'");
		$goldDelete = mysql_query("DELETE FROM gold WHERE ref_no='$id'");
		if ( $transDeleted && $refDelete ) {
			return true;
		}
	}
	if ( $page == 'redeem' ) {
		$redDeleted = mysql_query("DELETE FROM redeem WHERE ref_no='$id'");
		$goldExists = mysql_fetch_assoc(mysql_query("SELECT * FROM gold WHERE ref_no='$id'"));
		if ( $goldExists['ref_no'] == '' ) {
			$gold = mysql_fetch_assoc(mysql_query("SELECT * FROM pawning WHERE ref_no='$id'"));
			$goldInsert = mysql_query("INSERT INTO gold(ref_no,type,weight,status) "
						."VALUES('$id','{$gold['type']}','{$gold['weight']}','pawned');");
		}
		if ( $redDeleted ) {
			return true;
		}
	}
	if ( $page == 'expences' ) {
		$exDeleted = mysql_query("DELETE FROM expenses WHERE ex_id='$id'");
		if ( $exDeleted ) {
			return true;
		}
	}
	if ( $page == 'sinna' ) {
		$sinnaDeleted = mysql_query("DELETE FROM sinna WHERE ref_no='$id'");
		$goldUpdated = mysql_query("UPDATE gold SET status='pawned' WHERE ref_no='$id'");
		if ( $sinnaDeleted && $goldUpdated ) {
			return true;
		}
	}
	if ( $page == 'deposit' ) {
		$depositDeleted = mysql_query("DELETE FROM deposit WHERE trans_id='$id'");
		if ( $depositDeleted ) {
			return true;
		}
	}
	if ( $page == 'withdraw' ) {
		$wdDeleted = mysql_query("DELETE FROM withdrawals WHERE trans_id='$id'");
		if ( $wdDeleted ) {
			return true;
		}
	}
	if ( $page == 'view' ) {
		$transDeleted = mysql_query("DELETE FROM pawning WHERE ref_no='$id'");
		$refDelete = mysql_query("DELETE FROM customer_ref WHERE ref_no='$id'");
		if ( $transDeleted && $refDelete ) {
			return true;
		}
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
	if( $page == 'pawning' ){
		echo '<fieldset><legend>Pawning Details</legend>
        <table width="80%" border="1">
	<tr>
        <th>No</th>
        <th>Name</th>
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
		$viewQ = "SELECT * FROM pawning WHERE entryDate='$today' AND branch='$branch'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ref_no');
			$name = mysql_fetch_assoc(mysql_query("SELECT r.cus_id,c.name AS name FROM customer_ref AS r,customer_details AS c WHERE r.ref_no='$ref' AND c.cus_id=r.cus_id"));
			echo '<tr><td>'.$no++.'</td>'.
				'<td>'.$name['name'].'</td>'.
                 '<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td>'.mysql_result($view,$i,'weight').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'type').'</td>'.
		 '<td>'.mysql_result($view,$i,'branch').'</td>'.
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></fieldset>';
	}
	
	if( $page == 'redeems' ){
		echo '<fieldset><legend>Redeem Details</legend>
        <table width="80%" border="1">
		<tr>
        <th>ID</th>
        <th>Name</th>
		<th>Bill no</th>
		<th>Redeem ID</th>
		<th>Date</th>
		<th>Amount</th>
		<th>Interest</th>
		<th>Branch</th>
		<th>Delete</th>
	</tr>';
		$branch = $_SESSION['branch'];
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM redeem WHERE entryDate='$today' AND branch='$branch'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ref_no');
			$name = mysql_fetch_assoc(mysql_query("SELECT r.cus_id,c.name AS name FROM customer_ref AS r,customer_details AS c WHERE r.ref_no='$ref' AND c.cus_id=r.cus_id"));
			echo '<tr><td>'.$no++.'</td>'.
				'<td>'.$name['name'].'</td>'.
                 '<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'redeem_id').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'interest_gained').'</td>'.
		 '<td>'.mysql_result($view,$i,'branch').'</td>'.
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></fieldset>';
	}
	
	if( $page == 'expences' ){
		echo '<fieldset><legend>Expense Details</legend>
        <table width="80%" border="1">
	<tr>
		<th>No</th>
        <th>ID</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		<th>Branch</th>
		<th>Delete</th>
	</tr>';
		$branch = $_SESSION['branch'];
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM expenses WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ex_id');
			echo '<tr><td>'.$no++.'</td>'.
                 '<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'discription').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td>'.mysql_result($view,$i,'branch').'</td>'.
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></fieldset>';
	}
	
	if( $page == 'withdraw' ){
		echo '<fieldset><legend>Withdrawal Details</legend>
        <table width="80%" border="1">
	<tr>
		<th>No</th>
		<th>Source</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		<th>Delete</th>
	</tr>';
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM withdrawals WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'trans_id');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'source').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'description').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></fieldset>';
	}

	if( $page == 'deposit' ){
		echo '<fieldset><legend>Deposit Details</legend>
        <table width="80%" border="1">
		<tr>
		<th>No</th>
		<th>Source</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		<th>Delete</th>
		</tr>';
		$today = date('Y-m-d');
		//echo $today;
		$viewQ = "SELECT * FROM deposit WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'trans_id');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'source').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'discription').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></fieldset>';
	}
	if ( $page == 'sinna' ) {
		echo '<fieldset><legend>Sinna Details</legend>
        <table width="80%" border="1">
		<tr>
		<th>No</th>
		<th>Bill Number</th>
		<th>Date</th>
		<th>Delete</th>
		</tr>';
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM sinna WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ref_no');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'ref_no').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td style="text-align:center"><a href="home.php?page='.$page.'&func=delete&ref='.$ref.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></fieldset>';
	}
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
	$cusId = mysql_fetch_assoc(mysql_query("SELECT cus_id FROM customer_details WHERE name='$name' OR name LIKE '$name%' OR name LIKE '%$name'"));
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

/**
 * Function to display single transaction details
 * @param int $id
 * @param string $branch
 */
function dispSingle($id, $branch) {
	session_start();
	$_SESSION['ref_no'] = $id;
	$details = mysql_fetch_assoc(mysql_query("SELECT * FROM pawning WHERE ref_no='$id' AND branch='$branch'"));
	$cusDetails = mysql_fetch_assoc(mysql_query("SELECT cus_id FROM customer_ref WHERE ref_no='$id'"));
	$cusId = $cusDetails['cus_id'];
	$cusDetails = mysql_fetch_assoc(mysql_query("SELECT name FROM customer_details WHERE cus_id='{$cusDetails['cus_id']}'"));
	echo '<table width="120%" border="0">';
	echo '<tr><td>Name</td><td>'.$cusDetails['name'].'</td></tr>'
	.'<tr><td>NIC</td><td>'.$cusId.'</td></tr>'
	.'<tr><td>Type</td><td>'.$details['type'].'</td></tr>'
	.'<tr><td>Weight</td><td>'.$details['weight'].'</td></tr>'
	.'<tr><td>Amount</td><td>'.$details['amount'].'</td></tr>'
	.'<tr><td>Date</td><td>'.$details['date'].'</td></tr>';
	echo '</table>';
}

function displayWODelete($page) {
	if( $page == 'pawning' ){
		echo '<fieldset><legend>Pawning Details</legend>
        <table width="80%" border="1">
	<tr>
        <th>No</th>
		<th>Bill Id</th>
		<th>Date</th>
		<th>Weight</th>
		<th>Amount</th>
		<th>Type</th>
		<th>Branch</th>
	</tr>';
		$branch = $_SESSION['branch'];
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM pawning WHERE entryDate='$today' AND branch='$branch'";
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
		 '</tr>';
		}
		echo '</table></fieldset>';
	}
	
	if( $page == 'redeem' ){
		echo '<fieldset><legend>Redeem Details</legend>
        <table width="80%" border="1">
		<tr>
        <th>ID</th>
		<th>Bill no</th>
		<th>Redeem ID</th>
		<th>Date</th>
		<th>Amount</th>
		<th>Interest</th>
		<th>Branch</th>
		
	</tr>';
		$branch = $_SESSION['branch'];
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM redeem WHERE entryDate='$today' AND branch='$branch'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ref_no');
			echo '<tr><td>'.$no++.'</td>'.
                 '<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'redeem_id').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'interest_gained').'</td>'.
		 '<td>'.mysql_result($view,$i,'branch').'</td>'.
		 '</tr>';
		}
		echo '</table></fieldset>';
	}
	
	if( $page == 'expences' ){
		echo '<fieldset><legend>Expense Details</legend>
        <table width="80%" border="1">
	<tr>
		<th>No</th>
        <th>ID</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		<th>Branch</th>
		
	</tr>';
		$branch = $_SESSION['branch'];
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM expenses WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ex_id');
			echo '<tr><td>'.$no++.'</td>'.
                 '<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'discription').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td>'.mysql_result($view,$i,'branch').'</td>'.
		 '</tr>';
		}
		echo '</table></fieldset>';
	}
	
	if( $page == 'withdraw' ){
		echo '<fieldset><legend>Withdrawal Details</legend>
        <table width="80%" border="1">
	<tr>
		<th>No</th>
		<th>Source</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		
	</tr>';
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM withdrawals WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'trans_id');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'source').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'description').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '</tr>';
		}
		echo '</table></fieldset>';
	}

	if( $page == 'deposit' ){
		echo '<fieldset><legend>Deposit Details</legend>
        <table width="80%" border="1">
		<tr>
		<th>No</th>
		<th>Source</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		
		</tr>';
		$today = date('Y-m-d');
		//echo $today;
		$viewQ = "SELECT * FROM deposit WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'trans_id');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'source').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'discription').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '</tr>';
		}
		echo '</table></fieldset>';
	}
	if ( $page == 'sinna' ) {
		echo '<fieldset><legend>Sinna Details</legend>
        <table width="80%" border="1">
		<tr>
		<th>No</th>
		<th>Bill Number</th>
		<th>Date</th>
		
		</tr>';
		$today = date('Y-m-d');
		$viewQ = "SELECT * FROM sinna WHERE entryDate='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ref_no');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'ref_no').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '</tr>';
		}
		echo '</table></fieldset>';
	}
}
?>

