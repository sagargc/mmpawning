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
	$data = array();
    $data['total'] = array();
    $data['anu_market'] = array();
    $data['anu_bus'] = array();
    $data['kekirawa'] = array();
    $data['mm'] = array();
    $data['wariyapola'] = array();
    $data['kurunegala'] = array();
    $data['medawachchiya'] = array();
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
    
    
	echo '<br/><br/><center><table width="98%" border="1" style="text-align:left">'
		.'<tr><th>Branch</th><th>Pawning</th><th>Redeem</th><th>Interest</th><th>Profit</th><th>Deposit</th>'
		.'<th>Withdrawal</th><th>Hand Cash</th><th>Expenses</th><th>Salary</th><th>Quantity</th></tr>';
	echo '<tr><td>MM</td><td>'.$data['mm']['pawning'].'</td><td>'.$data['mm']['redeem'].'</td><td>'.$data['mm']['interest'].'</td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['mm']['gold'].'</td>';
	echo '<tr><td>Market</td><td>'.$data['anu_market']['pawning'].'</td><td>'.$data['anu_market']['redeem'].'</td><td>'.$data['anu_market']['interest'].'</td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['anu_market']['gold'].'</td>';
	echo '<tr><td>Bus</td><td>'.$data['anu_bus']['pawning'].'</td><td>'.$data['anu_bus']['redeem'].'</td><td>'.$data['anu_bus']['interest'].'</td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['anu_bus']['gold'].'</td>';
	echo '<tr><td>Medawachchiya</td><td>'.$data['medawachchiya']['pawning'].'</td><td>'.$data['medawachchiya']['redeem'].'</td><td>'.$data['medawachchiya']['interest'].'</td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['medawachchiya']['gold'].'</td>';
	echo '<tr><td>Kekirawa</td><td>'.$data['kekirawa']['pawning'].'</td><td>'.$data['kekirawa']['redeem'].'</td><td>'.$data['mm']['interest'].'</td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['kekirawa']['gold'].'</td>';	
	echo '<tr><td>Kurunegala</td><td>'.$data['kurunegala']['pawning'].'</td><td>'.$data['kurunegala']['redeem'].'</td><td>'.$data['kurunegala']['interest'].'</td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['kurunegala']['gold'].'</td>';
	echo '<tr><td>Wariyapola</td><td>'.$data['wariyapola']['pawning'].'</td><td>'.$data['wariyapola']['redeem'].'</td><td>'.$data['wariyapola']['interest'].'</td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['wariyapola']['gold'].'</td>';					
	echo '</table></center>';
}