<?php
include_once('localDB.php');
include_once('functions.php');
$name = $_GET['name'];
if ( $_GET['do'] == "getemp" ) {
	dispEmp($name);
}
if ( $_GET['do'] == "getrefs" ) {
	dispRefs($name);
}
if ( $_GET['do'] == "getdetails" ) {
	$branch = $_GET['branch'];
	dispSingle($name, $branch);
}

?>