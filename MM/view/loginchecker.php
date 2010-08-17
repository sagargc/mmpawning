<?php 
if ( !$_SESSION['isAdmin'] ) {
	//header('Location:index.php');
	echo "<script type=\"text/javascript\">"
		 ."alert('Admin - You have not logged in');"
		 ."self.location='index.php?page=login';"
		 ."</script>";
}
?>