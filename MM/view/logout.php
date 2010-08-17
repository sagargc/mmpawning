<?php
	session_start();
	$login = $_SESSION['logged'];
	if ( $login == true ) {
		session_destroy();
		echo "<p> You have logged out of the system. If you wish to log in again, <a href = \"index.php?page=login\">click here.</a></p>";
        }
	else {
		echo "<p> You must login in order to logout. <a href = \"index.php?page=login\">Click here</a> if you wish to login.</p>";
        }
?>	