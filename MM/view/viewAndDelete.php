<?php
include_once('loginchecker.php');
include_once('localDB.php');
include_once('admin_functions.php');
?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<link rel="stylesheet" href="calendar/calendar.css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<form name="viewPage" method="post" action="index.php?page=view&submitted=true">
<table class="gt-notice-box" width="80%">
	<tr><td>Enter Date:</td>
	<td><input type="text" name="date" />
	<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'viewPage',
		// input name
		'controlname': 'date'
	});

	</script></td></tr>
	<tr>
		<td></td><td><input type="submit" value="View" style="padding:4px" /></td>
	</tr>
</table>
</form>

<?php 
if ( $_GET['submitted'] ) {
	$date = $_POST['date'];
?>
<h3>You Are viewing transactions on <?php echo $date?></h3>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Pawning</li>
    <li class="TabbedPanelsTab" tabindex="0">Redeem</li>
    <li class="TabbedPanelsTab" tabindex="0">Expenses</li>
    <li class="TabbedPanelsTab" tabindex="0">Sinna</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><?php displayToday('pawning', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('redeem', $date);?></div>
     <div class="TabbedPanelsContent"><?php displayToday('expences', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('sinna', $date);?></div>
  </div>
</div>
	
<?php }
if ( $_GET['func'] == 'delPawn' ) {
	$id = $_GET['ref'];
	$date = $_GET['date'];
	$deleted = deleteRecord($id, 'pawning');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
?>
	<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Pawning</li>
    <li class="TabbedPanelsTab" tabindex="0">Redeem</li>
    <li class="TabbedPanelsTab" tabindex="0">Expenses</li>
    <li class="TabbedPanelsTab" tabindex="0">Sinna</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><?php displayToday('pawning', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('redeem', $date);?></div>
     <div class="TabbedPanelsContent"><?php displayToday('expences', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('sinna', $date);?></div>
  </div>
</div>
<?php }
if ( $_GET['func'] == 'delRed' ) {
	$id = $_GET['ref'];
	$date = $_GET['date'];
	$deleted = deleteRecord($id, 'redeem');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
?>
	<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Pawning</li>
    <li class="TabbedPanelsTab" tabindex="0">Redeem</li>
    <li class="TabbedPanelsTab" tabindex="0">Expenses</li>
    <li class="TabbedPanelsTab" tabindex="0">Sinna</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><?php displayToday('pawning', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('redeem', $date);?></div>
     <div class="TabbedPanelsContent"><?php displayToday('expences', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('sinna', $date);?></div>
  </div>
</div>

<?php }
if ( $_GET['func'] == 'delExp' ) {
	$id = $_GET['ref'];
	$date = $_GET['date'];
	$deleted = deleteRecord($id, 'expences');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
?>
	<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Pawning</li>
    <li class="TabbedPanelsTab" tabindex="0">Redeem</li>
    <li class="TabbedPanelsTab" tabindex="0">Expenses</li>
    <li class="TabbedPanelsTab" tabindex="0">Sinna</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><?php displayToday('pawning', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('redeem', $date);?></div>
     <div class="TabbedPanelsContent"><?php displayToday('expences', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('sinna', $date);?></div>
  </div>
</div>
<?php }
if ( $_GET['func'] == 'delSinna' ) {
	$id = $_GET['ref'];
	$date = $_GET['date'];
	$deleted = deleteRecord($id, 'sinna');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
?>
	<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">Pawning</li>
    <li class="TabbedPanelsTab" tabindex="0">Redeem</li>
    <li class="TabbedPanelsTab" tabindex="0">Expenses</li>
    <li class="TabbedPanelsTab" tabindex="0">Sinna</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent"><?php displayToday('pawning', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('redeem', $date);?></div>
     <div class="TabbedPanelsContent"><?php displayToday('expences', $date);?></div>
    <div class="TabbedPanelsContent"><?php displayToday('sinna', $date);?></div>
  </div>
</div>
<?php } ?>

<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
