<?php

$day = date('Y-m-d');
include_once('loginchecker.php');
include_once('branch_checker.php');
include_once('localDB.php');
include_once('functions.php');
$branch = $_SESSION['branch'];

?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<link rel="stylesheet" href="calendar/calendar.css">
<script type="text/javascript">
function getRef(str)
{
if (str=="")
  {
  document.getElementById("refs").innerHTML="";
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
    document.getElementById("refs").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","router.php?do=getrefs&name="+str,true);
xmlhttp.send();
}
function showTrans(str)
{
var branch = "<?php echo $_SESSION['branch']; ?>";
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
xmlhttp.open("GET","router.php?do=getdetails&name="+str+"&branch="+branch,true);
xmlhttp.send();
}
</script>

<fieldset><legend><strong>Redeem To <?php echo $_SESSION['branch'] ?> Branch</strong></legend>
<table>
	<form method="post" action="home.php?page=redeems&amp;submitted=true" name="redeemForm">

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
		<td>Redeem amount:</td>
		<td><input type="text" size="20" maxlength="50" name="amount"></td>
	</tr>
	<tr>
		<td>Interest:</td>
		<td><input type="text" size="20" maxlength="50" name="interest"></td>
	</tr>
	<tr><td>Enter Date:</td>
		<td><input type="text" name="date" value="<?php echo $day;?>" />
		<script language="JavaScript">
		new tcal ({
			// form name
			'formname': 'redeemForm',
			// input name
			'controlname': 'date'
		});

	</script></td></tr>
	<tr>
		<td></td>
		<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<INPUT
			type="submit" name="button" value="Save" /></td>
	</tr>
	</form>
</table>
<p>Help: Type in a Bill Number in the correct field and click on it. <br/> </p>
</fieldset>

<?php 
if ( $_GET['submitted'] ) {
	$ref = $_SESSION['ref_no'];
	$today = date('Y-m-d');
	
	$genericInsert = "INSERT INTO redeem(redeem_id,ref_no,date,amount,interest_gained,branch,entryDate) "
        ."VALUES('','$ref','{$_POST['date']}','{$_POST['amount']}','{$_POST['interest']}','{$_SESSION['branch']}','$today');";
    $redeemResult = mysql_query($genericInsert);
    $redeemTotal = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS total FROM redeem WHERE ref_no='$ref'"));
    $pawnedAmount = mysql_fetch_assoc(mysql_query("SELECT amount FROM pawning WHERE ref_no='$ref'"));
    if ( $pawnedAmount['amount'] <= $redeemTotal['total'] ) {
    	$goldDelete = "DELETE FROM gold WHERE ref_no='$ref'";
    	$goldResult = mysql_query($goldDelete);
    }
	
	$cashResult = mysql_query("SELECT cash FROM hand_cash WHERE branch='{$_SESSION['branch']}'");
	$cash = mysql_fetch_array($cashResult);
	$updatedCash = ($cash['cash'] + $_POST['amount']);
	$cashUpdate = mysql_query("UPDATE hand_cash SET cash='$updatedCash' WHERE branch='{$_SESSION['branch']}'"); 
	
    if ( $redeemResult && $cashUpdate != null) {
    	echo '<p>Redeem entered successfully</p>';
    }
    displayToday('redeems');
}
if ( $_GET['func'] == 'delete' ) {
	$id = $_GET['ref'];
	$deleted = deleteRecord($id, 'redeem');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
	displayToday('redeems');
}
?>
