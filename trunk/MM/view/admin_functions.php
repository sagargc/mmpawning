<?php
/**
 * MidiSL page include function
 * @param string $name name of the page to be included
 * @param array $namesAndPages Array mapping pagenames to actual pages
 */
function midiInclude($name, $namesAndPages) {
	include($namesAndPages[$name]);
}

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
		.'<td></td><td></td><td></td><td>'.$data['mm']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['mm']['gold'].'</td>';
	echo '<tr><td>Market</td><td>'.$data['anu_market']['pawning'].'</td><td>'.$data['anu_market']['redeem'].'</td><td>'.$data['anu_market']['interest'].'</td>'
		.'<td></td><td></td><td></td><td>'.$data['anu_market']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['anu_market']['gold'].'</td>';
	echo '<tr><td>Bus</td><td>'.$data['anu_bus']['pawning'].'</td><td>'.$data['anu_bus']['redeem'].'</td><td>'.$data['anu_bus']['interest'].'</td>'
		.'<td></td><td></td><td></td><td>'.$data['anu_bus']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['anu_bus']['gold'].'</td>';
	echo '<tr><td>Medawachchiya</td><td>'.$data['medawachchiya']['pawning'].'</td><td>'.$data['medawachchiya']['redeem'].'</td><td>'.$data['medawachchiya']['interest'].'</td>'
		.'<td></td><td></td><td></td><td>'.$data['medawachchiya']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['medawachchiya']['gold'].'</td>';
	echo '<tr><td>Kekirawa</td><td>'.$data['kekirawa']['pawning'].'</td><td>'.$data['kekirawa']['redeem'].'</td><td>'.$data['mm']['interest'].'</td>'
		.'<td></td><td></td><td></td><td>'.$data['kekirawa']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['kekirawa']['gold'].'</td>';	
	echo '<tr><td>Kurunegala</td><td>'.$data['kurunegala']['pawning'].'</td><td>'.$data['kurunegala']['redeem'].'</td><td>'.$data['kurunegala']['interest'].'</td>'
		.'<td></td><td></td><td></td><td>'.$data['kurunegala']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['kurunegala']['gold'].'</td>';
	echo '<tr><td>Wariyapola</td><td>'.$data['wariyapola']['pawning'].'</td><td>'.$data['wariyapola']['redeem'].'</td><td>'.$data['wariyapola']['interest'].'</td>'
		.'<td></td><td></td><td></td><td>'.$data['wariyapola']['hand_cash'].'</td><td></td>'
		.'<td></td><td>'.$data['wariyapola']['gold'].'</td>';					
	echo '</table></center>';
}

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
		echo $pawns['pawnSum'];
		
		$data['pawning'][$i] = $pawns['pawnSum'];
		$data['income'][$i] = $redeems['redeems'];
		$data['interest'][$i] = $redeems['interest'];
		$data['expenses'][$i] = $expenses['expense'];
		$data['salary'][$i] = $salarySum;
	}
	return $data;
}
?>