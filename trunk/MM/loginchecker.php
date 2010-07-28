<?php 
if ( !$_SESSION['logged'] ) {
	//header('Location:index.php');
	echo "<script type=\"text/javascript\">"
		 ."alert('You have not logged in');"
		 ."self.location='index.php';"
		 ."</script>";
}
?>