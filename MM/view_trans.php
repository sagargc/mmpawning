<?php
//session_start();
include_once('localDB.php');
include_once('loginchecker.php');
include_once('functions.php');

display('view');
if ( $_GET['func'] == 'delete' ) {
        $id = $_GET['ref'];
	$deleted = deleteRecord($id);
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
        display('view');
}
?>	

	
