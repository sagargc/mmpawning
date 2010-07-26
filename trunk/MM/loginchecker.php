<?php session_start();
if ( !$_SESSION['logged'] ) {
	header('Location:index.php');
}