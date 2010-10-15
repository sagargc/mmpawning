<?php
include_once('loginchecker.php');
include_once('localDB.php');
?>
<script type="text/javascript">
function checkUsr(str)
{
	/*var usernameField = document.getElementById("usr");
	var str = usernameField.value;*/
	if (str=="")
	  {
	  document.getElementById("user").innerHTML="";
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
	    document.getElementById("user").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","router.php?do=newuser&name="+str,true);
	xmlhttp.send();
}
function chekPwd(form) {
	with(form) {
		if(pwd1.value != pwd2.value) {
			document.getElementyById("pwd").innerHTML = "<div class=\"gt-error\"><p>Passwords do not match!</p></div>";
			return false;
		}
		else {
			return true;
		}
	}	
}
</script>
<form name="newUserForm" method="post" action="index.php?page=newUser&submitted=true" onsubmit="return chekPwd(this)">
<table class="gt-notice-box" width="80%" style="cell-padding:5px">

	<tr>
		<td>Username:</td>
		<td><input type="text" size="30" name="userName" id="usr" onblur="checkUsr(this.value)"/></td>
	</tr>
	<!--<tr>
		<td></td><td><a href="" onclick="checkUsr()">Check Availability</a></td>
	</tr>-->
	<tr><td colspan="2"><div id="user"></div></td></tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" size="30" name="pwd1"  id="pwd1"/></td>
	</tr>
	<tr>
		<td>Re-type password:</td>
		<td><input type="password" size="30" name="pwd2" id="pwd2" /></td>
	</tr>
	<tr><td colspan="2"><div id="pwd"></div></td></tr>
	<tr>
		<td>Is this an Admin user?:</td>
		<td>Yes: <input type="checkbox" name="isAdmin" value="yes" /> &nbsp; No: <input type="checkbox" name="isAdmin" value="no" checked="checked" /></td>
	</tr>
	<tr>
		<td></td><td><input type="submit" value="Add" style="padding:4px"/></td>
	</tr>
	
</table>
</form>
<?php 
if ( $_GET['submitted'] ) {
	$pwd = md5($_POST['pwd1']);
	$isAdmin = 0;
	if ( $_POST['isAdmin'] == 'yes' ) {
		$isAdmin = 1;
	}
	$inserted = mysql_query("INSERT INTO users VALUES('','{$_POST['userName']}','$pwd','$isAdmin')");
	if ( $inserted ) {
		echo '<div class="gt-success"><p>New user entered successfully</p></div>';
	}
}
?>
