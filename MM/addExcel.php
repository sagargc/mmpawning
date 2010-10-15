<?php
include_once('loginchecker.php');
include_once('localDB.php');
include_once('functions.php');
?>
<form enctype="multipart/form-data" action="addExcel.php?submitted=true" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000000000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>
<?php 
if ( $_GET['submitted'] ) {
	
}
?>