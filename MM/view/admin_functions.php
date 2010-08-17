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
    $kekirawaGold = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS pawns, AS gold FROM pawning WHERE date='$date' AND branch='kekirawa'"));
    
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
    
	echo '<br/><br/><table width="98%" border="1">'
		.'<tr><th>Branch</th><th>Pawning</th><th>Redeem</th><th>Interest</th><th>Profit</th><th>Deposit</th>'
		.'<th>Withdrawal</th><th>Hand Cash</th><th>Expenses</th><th>Salary</th><th>Quantity</th></tr>';
	echo '<tr><td>MM</td><td>'.$data['mm']['pawning'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['mm']['gold'].'</td>';
	echo '<tr><td>Market</td><td>'.$data['anu_market']['pawning'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['anu_market']['gold'].'</td>';
	echo '<tr><td>Bus</td><td>'.$data['anu_bus']['pawning'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['anu_bus']['gold'].'</td>';
	echo '<tr><td>Medawachchiya</td><td>'.$data['medawachchiya']['pawning'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['medawachchiya']['gold'].'</td>';
	echo '<tr><td>Kekirawa</td><td>'.$data['kekirawa']['pawning'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['kekirawa']['gold'].'</td>';	
	echo '<tr><td>Kurunegala</td><td>'.$data['kurunegala']['pawning'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'
		.'<td></td><td>'.$data['kurunegala']['gold'].'</td>';					
	echo '</table>';
}