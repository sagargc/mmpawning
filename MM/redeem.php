<?php
$day = date('d');
$month = date('F');
$numericMonth = date('m');
$year = date('Y');
include_once('loginchecker.php');
include_once('localDB.php');
include_once('functions.php');
$branch = $_SESSION['branch'];
if ( $branch == "" ) {
	echo '<p><a href="home.php?page=branch">Select the branch</a> first!</p>';
}
$customerNames = mysql_query("SELECT name FROM customer_details WHERE branch='$branch'");
$num = mysql_num_rows($customerNames);
?>

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

<fieldset><legend><strong>Redeem</strong></legend>
<table>
	<form method="post" action="home.php?page=redeems&amp;submitted=true">

	<tr>
		<td>Customer Name:</td>
		<td><select name="name" onchange="getRef(this.value)">
			<option value="">Select name</option>
			<?php for ( $i = 0; $i < $num; $i++ ) {
					$name = mysql_result($customerNames, $i, "name");
					echo '<option value="'.$name.'">'.$name.'</option>';
			}?>
		</select></td>
	</tr>
	<tr>
		<td>Bill:</td>
		<td><div id="refs"></div></td>
	</tr>

	<tr>
		<td>Total Amount:</td>
		<td><input type="text" size="20" maxlength="50" name="amount"></td>
	</tr>
	<tr>
		<td>Interest:</td>
		<td><input type="text" size="20" maxlength="50" name="interest"></td>
	</tr>
	<tr>
		<td>Date:</td>

		<td><select name="year">
			<option value="&lt;?php echo $year;?&gt;" selected="selected"><?php echo $year;?></option>
			<option value="2008">2008</option>
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
		</select> <select name="month">
			<option value="&lt;?php echo $numericMonth; ?&gt;"
				selected="selected"><?php echo $month; ?></option>
			<option value="01">January</option>
			<option value="02">February</option>
			<option value="03">March</option>
			<option value="04">April</option>
			<option value="05">May</option>
			<option value="06">June</option>
			<option value="07">July</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select> <select name="date">
			<option value="&lt;?php echo $day; ?&gt;"><?php echo $day; ?></option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select></td>
	</tr>

	<tr>
		<td></td>
		<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<INPUT
			type="submit" name="button" value="Update" /></td>
	</tr>
	</form>
</table>
</fieldset>

<?php 
if ( $_GET['submitted'] ) {
	$ref = $_POST['ref_no'];
	$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['date'];
	$genericInsert = "INSERT INTO redeem(redeem_id,ref_no,date,amount,interest_gained) "
        ."VALUES('','$ref','{$date}','{$_POST['amount']}','{$_POST['interest']}');";
    $redeemResult = mysql_query($genericInsert);
    $redeemTotal = mysql_fetch_assoc(mysql_query("SELECT SUM(amount) AS total FROM redeem WHERE ref_no='$ref'"));
    $pawnedAmount = mysql_fetch_assoc(mysql_query("SELECT amount FROM pawning WHERE ref_no='$ref'"));
    if ( $pawnedAmount['amount'] <= $redeemTotal['total'] ) {
    	$goldDelete = "DELETE FROM gold WHERE ref_no='$ref'";
    	$goldResult = mysql_query($goldDelete);
    }
    if ( $redeemResult ) {
    	echo '<p>Redeem entered successfully</p>';
    }
}
?>
