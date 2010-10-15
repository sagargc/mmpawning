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
 * Function to generate the cashbook for a certain date
 * @param string $date the date for which the cashbook should be generated
 */
function getCashbook($date) {
	//declaration section
	$data = array();
    $data['total'] = array();
    $data['anu_market'] = array();
    $data['anu_bus'] = array();
    $data['kekirawa'] = array();
    $data['mm'] = array();
    $data['wariyapola'] = array();
    $data['kurunegala'] = array();
    $data['medawachchiya'] = array();
    
    //pawning and gold section
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
    
    $data['kurunegala']['pawning'] = $kurunegalaGold['pawns'];
    $data['kurunegala']['gold'] = $kurunegalaGold['gold'];
    
    $wariyapolaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='wariyapola'"));
    
    $data['wariyapola']['pawning'] = $wariyapolaGold['pawns'];
    $data['wariyapola']['gold'] = $wariyapolaGold['gold'];
    
    $medawachchiyaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns,SUM(weight) AS gold FROM pawning WHERE date='$date' AND branch='medawachchiya'"));
    
    $data['medawachchiya']['pawning'] = $medawachchiyaGold['pawns'];
    $data['medawachchiya']['gold'] = $medawachchiyaGold['gold'];
    
    //redeems and interest section
    $redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems,SUM(interest_gained) AS interest FROM redeem WHERE date='$date' AND branch='kekirawa'"));
    
    $data['kekirawa']['redeem'] = $redeems['redeems'];
    $data['kekirawa']['interest'] = $redeems['interest'];
    
    $redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems,SUM(interest_gained) AS interest FROM redeem WHERE date='$date' AND branch='anu_market'"));
    
    $data['anu_market']['redeem'] = $redeems['redeems'];
    $data['anu_market']['interest'] = $redeems['interest'];
    
    $redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems,SUM(interest_gained) AS interest FROM redeem WHERE date='$date' AND branch='anu_bus'"));
    
    $data['anu_bus']['redeem'] = $redeems['redeems'];
    $data['anu_bus']['interest'] = $redeems['interest'];
    
    $redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems,SUM(interest_gained) AS interest FROM redeem WHERE date='$date' AND branch='mm'"));
    
    $data['mm']['redeem'] = $redeems['redeems'];
    $data['mm']['interest'] = $redeems['interest'];
    
    $redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems,SUM(interest_gained) AS interest FROM redeem WHERE date='$date' AND branch='kurunegala'"));
    
    $data['kurunegala']['redeem'] = $redeems['redeems'];
    $data['kurunegala']['interest'] = $redeems['interest'];
    
    $redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems,SUM(interest_gained) AS interest FROM redeem WHERE date='$date' AND branch='wariyapola'"));
    
    $data['wariyapola']['redeem'] = $redeems['redeems'];
    $data['wariyapola']['interest'] = $redeems['interest'];
    
    $redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems,SUM(interest_gained) AS interest FROM redeem WHERE date='$date' AND branch='medawachchiya'"));
    
    $data['medawachchiya']['redeem'] = $redeems['redeems'];
    $data['medawachchiya']['interest'] = $redeems['interest'];
    
    //expenses section
    $expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expenses FROM expenses WHERE date='$date' AND branch='anu_market'"));
    $data['anu_market']['expenses'] = $expenses['expenses'];
    $expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expenses FROM expenses WHERE date='$date' AND branch='anu_bus'"));
    $data['anu_bus']['expenses'] = $expenses['expenses'];
    $expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expenses FROM expenses WHERE date='$date' AND branch='kekirawa'"));
    $data['kekirawa']['expenses'] = $expenses['expenses'];
    $expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expenses FROM expenses WHERE date='$date' AND branch='mm'"));
    $data['mm']['expenses'] = $expenses['expenses'];
    $expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expenses FROM expenses WHERE date='$date' AND branch='kurunegala'"));
    $data['kurunegala']['expenses'] = $expenses['expenses'];
    $expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expenses FROM expenses WHERE date='$date' AND branch='wariyapola'"));
    $data['wariyapola']['expenses'] = $expenses['expenses'];
    $expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expenses FROM expenses WHERE date='$date' AND branch='medawachchiya'"));
    $data['medawachchiya']['expenses'] = $expenses['expenses'];
    
    //deposits section
    $deposits  = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS deposit FROM deposit WHERE date='$date' AND source='anu_market'"));
    $data['anu_market']['deposit'] = $deposits['deposit'];
    $deposits  = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS deposit FROM deposit WHERE date='$date' AND source='anu_bus'"));
    $data['anu_bus']['deposit'] = $deposits['deposit'];
    $deposits  = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS deposit FROM deposit WHERE date='$date' AND source='kekirawa'"));
    $data['kekirawa']['deposit'] = $deposits['deposit'];
    $deposits  = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS deposit FROM deposit WHERE date='$date' AND source='mm'"));
    $data['mm']['deposit'] = $deposits['deposit'];
    $deposits  = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS deposit FROM deposit WHERE date='$date' AND source='kurunegala'"));
    $data['kurunegala']['deposit'] = $deposits['deposit'];
    $deposits  = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS deposit FROM deposit WHERE date='$date' AND source='wariyapola'"));
    $data['wariyapola']['deposit'] = $deposits['deposit'];
    $deposits  = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS deposit FROM deposit WHERE date='$date' AND source='medawachchiya'"));
    $data['medawachchiya']['deposit'] = $deposits['deposit'];
    
    //withdrawals section
    $withdraw = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS withdrawal FROM withdrawals WHERE date='$date' AND source='anu_market'"));
    $data['anu_market']['withdrawal'] = $withdraw['withdrawal'];
    $withdraw = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS withdrawal FROM withdrawals WHERE date='$date' AND source='anu_bus'"));
    $data['anu_bus']['withdrawal'] = $withdraw['withdrawal'];
    $withdraw = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS withdrawal FROM withdrawals WHERE date='$date' AND source='kekirawa'"));
    $data['kekirawa']['withdrawal'] = $withdraw['withdrawal'];
    $withdraw = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS withdrawal FROM withdrawals WHERE date='$date' AND source='mm'"));
    $data['mm']['withdrawal'] = $withdraw['withdrawal'];
    $withdraw = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS withdrawal FROM withdrawals WHERE date='$date' AND source='kurunegala'"));
    $data['kurunegala']['withdrawal'] = $withdraw['withdrawal'];
    $withdraw = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS withdrawal FROM withdrawals WHERE date='$date' AND source='wariyapola'"));
    $data['wariyapola']['withdrawal'] = $withdraw['withdrawal'];
    $withdraw = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS withdrawal FROM withdrawals WHERE date='$date' AND source='medawachchiya'"));
    $data['medawachchiya']['withdrawal'] = $withdraw['withdrawal'];
    
    //handcash section
    $handCash = mysql_fetch_assoc(mysql_query("SELECT cash FROM hand_cash WHERE branch='anu_market'"));
    $data['anu_market']['hand_cash'] = $handCash['cash'];
    $handCash = mysql_fetch_assoc(mysql_query("SELECT cash FROM hand_cash WHERE branch='anu_bus'"));
    $data['anu_bus']['hand_cash'] = $handCash['cash'];
    $handCash = mysql_fetch_assoc(mysql_query("SELECT cash FROM hand_cash WHERE branch='kekirawa'"));
    $data['kekirawa']['hand_cash'] = $handCash['cash'];
    $handCash = mysql_fetch_assoc(mysql_query("SELECT cash FROM hand_cash WHERE branch='mm'"));
    $data['mm']['hand_cash'] = $handCash['cash'];
    $handCash = mysql_fetch_assoc(mysql_query("SELECT cash FROM hand_cash WHERE branch='kurunegala'"));
    $data['kurunegala']['hand_cash'] = $handCash['cash'];
    $handCash = mysql_fetch_assoc(mysql_query("SELECT cash FROM hand_cash WHERE branch='wariyapola'"));
    $data['wariyapola']['hand_cash'] = $handCash['cash'];
    $handCash = mysql_fetch_assoc(mysql_query("SELECT cash FROM hand_cash WHERE branch='medawachchiya'"));
    $data['medawachchiya']['hand_cash'] = $handCash['cash'];
    
	echo '<br/><br/><center><table width="98%" border="1" style="text-align:left">'
		.'<tr><th>Branch</th><th>Pawning</th><th>Redeem</th><th>Interest</th><th>Profit</th><th>Deposit</th>'
		.'<th>Withdrawal</th><th>Hand Cash</th><th>Expenses</th><th>Salary</th><th>Quantity</th></tr>';
	echo '<tr><td>MM</td><td>'.$data['mm']['pawning'].'</td><td>'.$data['mm']['redeem'].'</td><td>'.$data['mm']['interest'].'</td>'
		.'<td></td><td>'.$data['mm']['deposit'].'</td><td>'.$data['mm']['withdrawal'].'</td>'
		.'<td>'.$data['mm']['hand_cash'].'</td><td>'.$data['mm']['expenses'].'</td>'
		.'<td></td><td>'.$data['mm']['gold'].'</td>';
	echo '<tr><td>Market</td><td>'.$data['anu_market']['pawning'].'</td><td>'.$data['anu_market']['redeem'].'</td><td>'.$data['anu_market']['interest'].'</td>'
		.'<td></td><td>'.$data['anu_market']['deposit'].'</td><td>'.$data['anu_market']['withdrawal'].'</td>'
		.'<td>'.$data['anu_market']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['anu_market']['gold'].'</td>';
	echo '<tr><td>Bus</td><td>'.$data['anu_bus']['pawning'].'</td><td>'.$data['anu_bus']['redeem'].'</td><td>'.$data['anu_bus']['interest'].'</td>'
		.'<td></td><td>'.$data['anu_bus']['deposit'].'</td><td>'.$data['anu_bus']['withdrawal'].'</td>'
		.'<td>'.$data['anu_bus']['hand_cash'].'</td><td>'.$data['anu_bus']['expenses'].'</td>'
		.'<td></td><td>'.$data['anu_bus']['gold'].'</td>';
	echo '<tr><td>Medawachchiya</td><td>'.$data['medawachchiya']['pawning'].'</td><td>'.$data['medawachchiya']['redeem'].'</td><td>'.$data['medawachchiya']['interest'].'</td>'
		.'<td></td><td>'.$data['medawachchiya']['deposit'].'</td><td>'.$data['medawachchiya']['withdrawal'].'</td>'
		.'<td>'.$data['medawachchiya']['hand_cash'].'</td><td>'.$data['medawachchiya']['expenses'].'</td>'
		.'<td></td><td>'.$data['medawachchiya']['gold'].'</td>';
	echo '<tr><td>Kekirawa</td><td>'.$data['kekirawa']['pawning'].'</td><td>'.$data['kekirawa']['redeem'].'</td><td>'.$data['mm']['interest'].'</td>'
		.'<td></td><td>'.$data['kekirawa']['deposit'].'</td><td>'.$data['kekirawa']['withdrawal'].'</td>'
		.'<td>'.$data['kekirawa']['hand_cash'].'</td><td>'.$data['kekirawa']['expenses'].'</td>'
		.'<td></td><td>'.$data['kekirawa']['gold'].'</td>';	
	echo '<tr><td>Kurunegala</td><td>'.$data['kurunegala']['pawning'].'</td><td>'.$data['kurunegala']['redeem'].'</td><td>'.$data['kurunegala']['interest'].'</td>'
		.'<td></td><td>'.$data['kurunegala']['deposit'].'</td><td>'.$data['kurunegala']['withdrawal'].'</td>'
		.'<td>'.$data['kurunegala']['hand_cash'].'</td><td>'.$data['kurunegala']['expenses'].'</td>'
		.'<td></td><td>'.$data['kurunegala']['gold'].'</td>';
	echo '<tr><td>Wariyapola</td><td>'.$data['wariyapola']['pawning'].'</td><td>'.$data['wariyapola']['redeem'].'</td><td>'.$data['wariyapola']['interest'].'</td>'
		.'<td></td><td>'.$data['wariyapola']['deposit'].'</td><td>'.$data['wariyapola']['withdrawal'].'</td>'
		.'<td>'.$data['wariyapola']['hand_cash'].'</td><td>'.$data['wariyapola']['expenses'].'</td>'
		.'<td></td><td>'.$data['wariyapola']['gold'].'</td>';					
	echo '</table></center>';
}

/**
 * Function to get a summary of certain month for a certain branch
 * @param string $branch 
 * @param string $month
 * @param string $year
 */
function getSummary($branch, $month, $year) {
	$data = array();
	$data['pawning'] = array();
	$data['income'] = array();
	$data['interest'] = array();
	$data['expenses'] = array();
	$data['salary'] = array();
	$isLeapYear = ((((int)$year%4==0) && ((int)$year%100)) || (int)$year%400==0) ? (true):(false);
	if ( $month == '01' || $month == '03' || $month == '05' || $month == '07' || $month == '08' || $month == '10' || $month == '12') {
		$days = 31;
	}
	else if ( $month == '02' && !$isLeapYear) {
		$days = 28;
	}
	else if ( $month == '02' && $isLeapYear ) {
		$days = 29;
	}
	else {
		$days = 30;
	}
	$date = $year.'-'.$month.'-'.$days;
	$data['days'] = $days;
	$emps = mysql_query("SELECT emp_id FROM employees WHERE branch='$branch'");
	$empAmount = mysql_num_rows($emps);
	for ( $i = 1; $i <= $days; $i++ ) {
		if ( $i < 10 ) {
			$j = '0'.$i;
		}
		else {
			$j = $i;
		}
		$queryDate = $year.'-'.$month.'-'.$j;
		$pawns = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawnSum FROM pawning WHERE branch='$branch' AND date='$queryDate'"));
		$redeems = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS redeems, SUM(interest_gained) AS interest FROM redeem WHERE branch='$branch' AND date='$queryDate'"));
		$expenses = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS expense FROM expenses WHERE branch='$branch' AND date='$queryDate'"));
		$salarySum = 0;
		for ( $n = 0; $n < $empAmount; $n++ ) {
			$emp_id = mysql_result($emps, $i, "emp_id");
			$salariesPaid = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) as salary FROM salaries WHERE date='$queryDate'"));
			$salarySum = $salarySum + $salariesPaid['salary'];
		}
		//echo $pawns['pawnSum'];
		$data['pawning'][$i] = $pawns['pawnSum'];
		$data['income'][$i] = $redeems['redeems'];
		$data['interest'][$i] = $redeems['interest'];
		$data['expenses'][$i] = $expenses['expense'];
		$data['salary'][$i] = $salarySum;
		
		if ( $data['pawning'][$i] == '' ) {
			$data['pawning'][$i] = 0;
		}
		if ( $data['income'][$i] == '' ) {
			$data['income'][$i] = 0;
		}
		if ( $data['interest'][$i] == '' ) {
			$data['interest'][$i] = 0;
		}
		if ( $data['expenses'][$i] == '' ) {
			$data['expenses'][$i] = 0;
		}
	}
	return $data;
}

function getExpenses($branch, $year, $month) {
	$expenses = array();
	$requiredMonth = $year.'-'.$month;
	$exDb = mysql_query("SELECT * FROM expenses WHERE branch='$branch'");
	$num = mysql_num_rows($exDb);
	$total = 0;
	for ( $i = 0; $i < $num; $i++ ) {
		$expenses[$i] = array();
		$date = mysql_result($exDb,$i,"date");
		$month = substr($date,0,7);
		if ( $month == $requiredMonth ) {
			$expenses[$i]['description'] = mysql_result($exDb, $i, "discription");
			$expenses[$i]['date'] = mysql_result($exDb, $i, "date");
			$expenses[$i]['amount'] = mysql_result($exDb, $i, "amount");
			$total = $total + (int)mysql_result($exDb, $i, "amount");
		}
	}
	$expenses['total'] = $total;
	$expenses['count'] = $num;
	return $expenses;
}

function checkAvail($username) {
	
	$userExists = mysql_fetch_assoc(mysql_query("SELECT user_id FROM users WHERE username='$username'"));
	if ( $userExists['user_id'] == '' ) {
		echo '<div class="gt-success"><p>Username '.$username.' is available</p></div>';
	}
	else {
		echo '<div class="gt-error"><p>Username '.$username.' is already being used. Please choose another</p></div>';
	}
}

function displayToday($page, $date) {
	if( $page == 'pawning' ){
		echo '<frameset><legend>Pawning Details</legend>
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
		$today = $date;
		$viewQ = "SELECT * FROM pawning WHERE date='$today'";
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
		 '<td style="text-align:center"><a href="index.php?page=view&func=delPawn&ref='.$ref.'&date='.$date.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></frameset>';
	}
	
	if( $page == 'redeem' ){
		echo '<frameset><legend>Redeem Details</legend>
        <table width="80%" border="1">
		<tr>
        <th>ID</th>
		<th>Bill no</th>
		<th>Redeem ID</th>
		<th>Date</th>
		<th>Amount</th>
		<th>Interest</th>
		<th>Branch</th>
		<th>Delete</th>
	</tr>';
		$today = $date;
		$viewQ = "SELECT * FROM redeem WHERE date='$today'";
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
		 '<td style="text-align:center"><a href="index.php?page=view&func=delRed&ref='.$ref.'&date='.$date.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></frameset>';
	}
	
	if( $page == 'expences' ){
		echo '<frameset><legend>Expense Details</legend>
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
		$today = $date;
		$viewQ = "SELECT * FROM expenses WHERE date='$today'";
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
		 '<td style="text-align:center"><a href="index.php?page=view&func=delExp&ref='.$ref.'&date='.$date.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></frameset>';
	}
	
	if( $page == 'withdraw' ){
		echo '<frameset><legend>Withdrawal Details</legend>
        <table width="80%" border="1">
	<tr>
		<th>No</th>
		<th>Source</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		<th>Delete</th>
	</tr>';
		$today = $date;
		$viewQ = "SELECT * FROM withdrawals WHERE date='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			//$ref = mysql_result($view,$i,'ex_id');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'source').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'description').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td style="text-align:center"><a href="index.php?page=view&func=delWith&ref='.$ref.'&date='.$date.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></frameset>';
	}

	if( $page == 'deposit' ){
		echo '<frameset><legend>Deposit Details</legend>
        <table width="80%" border="1">
		<tr>
		<th>No</th>
		<th>Source</th>
		<th>Amount</th>
		<th>Description</th>
		<th>Date</th>
		<th>Delete</th>
		</tr>';
		$today = $date;
		$viewQ = "SELECT * FROM deposit WHERE date='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			//$ref = mysql_result($view,$i,'ex_id');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'source').'</td>'.
		 '<td>'.mysql_result($view,$i,'amount').'</td>'.
		 '<td>'.mysql_result($view,$i,'discription').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td style="text-align:center"><a href="index.php?page=view&func=delDep&ref='.$ref.'&date='.$date.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></frameset>';
	}
	if ( $page == 'sinna' ) {
		echo '<frameset><legend>Sinna Details</legend>
        <table width="80%" border="1">
		<tr>
		<th>No</th>
		<th>Bill Number</th>
		<th>Date</th>
		<th>Delete</th>
		</tr>';
		$today = $date;
		$viewQ = "SELECT * FROM sinna WHERE date='$today'";
		$view = mysql_query($viewQ);
		$num = mysql_num_rows($view);
		$no=1;
		for ( $i = 0; $i < $num; $i++ ) {
			$ref = mysql_result($view,$i,'ref_no');
			echo '<tr><td>'.$no++.'</td>'.
                 //'<td>'.$ref.'</td>'.
		 '<td>'.mysql_result($view,$i,'ref_no').'</td>'.
		 '<td>'.mysql_result($view,$i,'date').'</td>'.
		 '<td style="text-align:center"><a href="index.php?page=view&func=delSinna&ref='.$ref.'&date='.$date.'"><img src="images/b_drop.png" /></a></td></tr>';
		}
		echo '</table></frameset>';
	}
}

function deleteRecord($id, $page) {
	if ( $page == 'pawning' ) {
		$transDeleted = mysql_query("DELETE FROM pawning WHERE ref_no='$id'");
		$refDelete = mysql_query("DELETE FROM customer_ref WHERE ref_no='$id'");
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
}
?>