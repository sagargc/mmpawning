<?php
session_start();
$day = date('d');
$month = date('F');
$numericMonth = date('m');
$year = date('Y');
$logged = $_SESSION['logged'];
if ( $logged ) {
?>


<p>Click on the Relavent Trancaction</p>
<table cellpadding="40px">
	<form method="post" action="">
		<tr>
			<td class="with">
            <a href="home.php">dfdsf</a>
				<!--<a href="home.php"?page="withdrawals"><img src="images/with.png"></a>-->
                
			</td>
			<td class="depo">
				<!--<a href="home.php"?page="withdrawals"><img src="images/depo.png"></a>-->
			</td>
		</tr>
		
	</form>
</table>
<?php } else { ?>
<p>You have not logged in. <a href="home.php?page=login">Click here to login again.</a></p>
<?php } ?>
