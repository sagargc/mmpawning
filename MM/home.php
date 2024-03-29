<?php session_start();
$logged = $_SESSION['logged'];
include_once('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="shortcut icon"" type="image/png"  href="images/favicon(2).ico" />
<title>MM Pawning - Accounts Management System</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
<div id="page">
	<div id="sidebar">
		<div id="logo">
			<img src="images/MM.gif" />
		</div>
		<!-- end header -->
		<div id="menu">
				<ul>
					<li class="first"><a href="home.php">Home</a></li>
					<?php 
					//
					if ( !$logged ) {
						echo '<li><a href="home.php?page=login">Login</a></li>';
					} else {
						echo '<li><a href="home.php?page=logout">Logout</a></li>';
					} ?>
					<li><a href="home.php?page=pawning">Pawning</a></li>
					<li><a href="home.php?page=redeems">Redeems</a></li>
					<li><a href="home.php?page=sinna">Sinna</a></li>
					<li><a href="home.php?page=expences">Expenses</a></li>
					<li><a href="home.php?page=salary">Salary</a></li>
					<li><a href="home.php?page=mm">MM Bank</a></li>
					<li><a href="home.php?page=other">Other</a></li>
                    <li><a href="home.php?page=branch">Change Branch</a></li>
					<li><a href="home.php?page=view">View data</a></li>
					<li><a href="home.php?page=search">Search</a></li>
					<li><a href="home.php?page=upload">Upload a CSV file</a></li>
				</ul>
		</div>
		<!-- end menu -->
		
	</div>
	<!-- end sidebar -->
	<div id="content">
		<div><img src="images/banner.gif" alt="" width="740" height="240" /></div>
		<div class="boxed orange">
			<div id="form">
				<?php
					$pages = array ( 'pawning' => 'pawning.php',
									 'redeems' => 'redeem.php',
									 'sinna' => 'sinna.php',
									 'salary' => 'salary.php',
									 'expences' => 'expences.php',
									 'other' => 'other.php',
									 'login' => 'login.php',
									 'logout' => 'logout.php',
									 'mm' => 'mm.php',
									 'withdraw' => 'withdraw.php',
									 'deposit' => 'deposit.php',
									 'branch' => 'branch.php',
									 'search' => 'search.php',
									 'view' => 'view_trans.php',
									 'branch' => 'branch.php',
									 'upload' => 'addExcel.php' );
					$pageName = $_GET['page'];
					
					if( $pageName != "" ) {
						midiInclude($pageName, $pages);
					}
					else {
						print '<h4>Welcome to MM Pawning Control Center</h4>';
					}
				
					
				?>
			</div><!--close form-->	
		</div><!--close box orange-->	
		
			<div style="clear: both;">&nbsp;</div>
		</div>
	</div>
	<!-- end content -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<div id="footer">
	<p id="legal">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Copyright &copy; 2010. All Rights Reserved. Designed by MiDi Srilanka.</p>
	<p id="links"><a href="#">Help Section</a> | <a href="#">Terms of Use</a></p>
    
</div>

</body>
</html>
