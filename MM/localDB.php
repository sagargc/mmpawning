<?php
$logged = $_SESSION['logged'];
$database = "mm_pawning";
$username = "root";
$password = "";
mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die("Unable to open database!");
?>