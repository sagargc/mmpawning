<?php
session_start();
include_once('loginchecker.php');
?>


<p>Click on the Relevant Transaction</p>
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

