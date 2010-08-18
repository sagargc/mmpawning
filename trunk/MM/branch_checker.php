<?php
if ( !$_SESSION['branch'] ) {
	//header('Location:index.php');
	echo "<script type=\"text/javascript\">"
		 ."alert('No branch Selected');"
		 ."self.location='home.php?page=branch';"
		 ."</script>";
}
?>