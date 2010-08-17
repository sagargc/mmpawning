<?php
include_once('localDB.php');
include_once('loginchecker.php');

?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<script type="text/javascript">
function getData(str)
{
if (str=="")
  {
  document.getElementById("data").innerHTML="";
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
    document.getElementById("data").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","router.php?do=cashbook&date="+str,true);
xmlhttp.send();
}
</script>
<link rel="stylesheet" href="calendar/calendar.css">
<table class="gt-notice-box" width="80%">
<form name="cashbook">
	<tr><td>Enter Date:</td>
	<td><input type="text" name="date" onclick="getData(this.value)"/>
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'cashbook',
		// input name
		'controlname': 'date'
	});

	</script></td></tr>
	<tr><td colspan="2">
	<div id="data">Data will appear here</div>
	</td></tr>
</form>
</table>