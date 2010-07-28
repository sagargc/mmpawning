<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="shortcut icon"" type="image/png"  href="images/favicon(2).ico" />
<title>Management Information System</title>
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
					<li class="first"><a href="home.php?page=home">Home</a></li>
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
					<li><a href="home.php?page=view">View data</a></li>
					<li><a href="home.php?page=search">Search</a></li>
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
					$pageName = $_GET['page'];
					if( $pageName == "pawning" ) {
						include("pawning.php");
					} else if( $pageName == "redeems" ) {
						include("redeem.php");
					} else if( $pageName == "sinna" ) {
						include("sinna.php");
					} else if( $pageName == "salary" ) {
						include("salary.php");
					} else if( $pageName == "expences" ) {
						include("expences.php");
					} else if( $pageName == "other" ) {
						include("other.php");
					} else if( $pageName == "home" ) {
						print 'Welcome to MM Pawning Control Center';
					} else if( $pageName == "login" ) {
						include("login.php");
					} else if( $pageName == "logout" ) {
						include("logout.php");
					}else if( $pageName == "mm" ) {
						include("mm.php");
					}else if( $pageName == "withdraw" ) {
						include("withdraw.php");
					}else if( $pageName == "deposit" ) {
						include("deposit.php");
					} else if( $pageName == "branch" ) {
						include("branch.php");
					} else if( $pageName == "search" ) {
						include("search.php");
					} else if( $pageName == "view" ) {
						include("view_trans.php");
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
