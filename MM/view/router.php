<?php
include_once('admin_functions.php');
include_once('localDB.php');
if ( $_GET['do'] == 'cashbook' ) {
	getCashbook( $_GET['date'] );
}