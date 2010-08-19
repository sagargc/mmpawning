<?php
include_once('localDB.php');
include_once('loginchecker.php');
include_once('functions.php');

$day = date('Y-m-d');
?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<link rel="stylesheet" href="calendar/calendar.css">
<script type="text/javascript">
function showEmp(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","router.php?do=getemp&name="+str,true);
xmlhttp.send();
}
</script>
<fieldset><legend><strong>Salary</strong></legend>
<table>
	<form method="post" action="home.php?page=salary&sent=true" name="salaryForm">

	<tr>
		<td>Employee Name:</td>
		<td><select name="empname" onchange="showEmp(this.value)">
			<option value="">Select an Employee</option>
			<option value="Nimal">Nimal</option>
			<option value="Kamal">Kamal</option>
			<option value="Sugath">Sugath</option>
			<option value="Bandara">Bandara</option>
			<option value="Keerthi">Keerthi</option>
			<option value="Prabodha">Prabodha</option>
		</select></td>
	</tr>

	<tr>
		<td>Amount:</td>
		<td><input type="text" size="30" maxlength="50" name="amount"></td>
	</tr>

	<tr><td>Enter Date:</td>
		<td><input type="text" name="date" value="<?php echo $day;?>"/>
		<script language="JavaScript">
		new tcal ({
			// form name
			'formname': 'salaryForm',
			// input name
			'controlname': 'date'
		});

	</script></td></tr>

	<tr>
		<td></td>
		<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<INPUT
			type="submit" name="button" value="Update" /></td>
	</tr>
	</form>
</table>
<div id="txtHint"><b>Employee Salary Details for this month will appear here.</b></div>
</legend></fieldset>

<?php
if ( $_GET['sent'] == true ) {
	
	$emp_id = "SELECT emp_id FROM employees WHERE name='{$_POST['empname']}'";
	$emp_id = mysql_fetch_assoc(mysql_query($emp_id));
	$emp_id = $emp_id['emp_id'];
	$sql = "INSERT INTO salaries VALUES('','$emp_id','{$_POST['date']}','{$_POST['amount']}')";
	$inserted = mysql_query($sql);
	if ( $inserted ) {
		echo '<p>Update successful</p>';
	}
}

?>
