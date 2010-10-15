<?php
$day = date('Y-m-d');
include_once('loginchecker.php');
//include_once('branch_checker.php');
include_once('localDB.php');
include_once('functions.php');
$branch = $_SESSION['branch'];
?>
<script
	language="JavaScript" src="calendar/calendar_db.js"></script>
<link
	rel="stylesheet" href="calendar/calendar.css">
<script type="text/javascript">
function showTrans(str)
{
if (str=="")
  {
  document.getElementById("detail").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("detail").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","router.php?do=getdetails&name="+str,true);
xmlhttp.send();
}
</script>

<fieldset><legend><strong>Sinna</strong></legend>
<table>
	<form method="POST" action="home.php?page=sinna&submitted=yes"
		name="sinnaForm">

	<tr>
		<td>Bill Number:</td>
		<td><input type="text" name="name" onclick="showTrans(this.value)" />
		</select></td>
	</tr>
	<tr>
		<td>Bill :</td>
		<td><div id="detail"></div></td>
	</tr>
	
	<tr>
		<td>Enter Date:</td>
		<td><input type="text" name="date" value="<?php echo $day;?>" /> <script
			language="JavaScript">
		new tcal ({
			// form name
			'formname': 'sinnaForm',
			// input name
			'controlname': 'date'
		});

	</script></td>
	</tr>
	
	
	<tr>
		<td></td>
		<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<INPUT
			type="submit" name="button" value="Update" /></td>
	</tr>

	</form>
	
</table>
</legend></fieldset>
<?php
$dataSubmitted = $_GET['submitted'];
if($dataSubmitted == "yes") {
	
	$genericInsert = "INSERT INTO sinna(ref_no,date) "
	."VALUES('{$_SESSION['ref_no']}','{$_POST['date']}');";
	$sinnaResult = mysql_query($genericInsert);
	$goldUpdate = "UPDATE gold SET status='sinna' WHERE ref_no='{$_SESSION['ref_no']}'";
	$goldUpdate = mysql_query($goldUpdate);

	if ( $sinnaResult && $goldUpdate ) {
		echo '<p>Data entered successfully</p>';
	}
	else {
		echo '<p>Failed to enter data</p>';
	}
	displayToday('sinna');

}
if ( $_GET['func'] == 'delete' ) {
	$id = $_GET['ref'];
	$deleted = deleteRecord($id, 'sinna');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
	displayToday('sinna');
}

?>