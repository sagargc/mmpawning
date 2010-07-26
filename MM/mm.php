<?php
session_start();
include_once('loginchecker.php');
$day = date('d');
$month = date('F');
$numericMonth = date('m');
$year = date('Y');

?>


<p>Click on the Relavent Trancaction</p>
<table cellpadding="40px">
	<form method="post" action="">
		<tr>
			<td class="with">
            <a href="home.php"></a>
				<a href="home.php?page=withdraw"><img src="images/with.png"></a>
                
			</td>
			<td class="depo">
				<a href="home.php?page=deposit"><img src="images/depo.png"></a>
			</td>
		</tr>
		
	</form>
</table>

