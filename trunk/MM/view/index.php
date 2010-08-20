<?php session_start(); 
include_once('admin_functions.php');
$logged = $_SESSION['isAdmin']; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>MM Pawning - Admin Panel</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />  
		<!--<meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />  -->
		<meta http-equiv="Pragma" content="no-cache" />
		<link rel="stylesheet" href="css/reset-fonts.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="css/gt-styles.css" type="text/css" media="screen, projection" />
	</head>
	<body>
		<!-- head -->
		<div class="gt-hd clearfix">
			<!-- logo -->
			<div class="gt-logo">
				MM Pawning - Admin Panel
			</div>
			<!-- / logo -->
			
			<!-- navigation -->
			<div class="gt-nav">
				<ul>
					<li><a href="index.php">Home</a></li>
					<?php 
					if ( !$logged ) {
						echo '<li><a href="index.php?page=login">Login</a></li>';
					} else {
						echo '<li><a href="index.php?page=logout">Logout</a></li>';
					} ?>
					<li><a href="index.php?page=cashbook">Cashbook</a></li>
					<li><a href="index.php?page=branchsummary">Monthly branch summary</a></li>
				</ul>
			</div>
			<!-- / navigation -->
			
		</div>
		<!-- / head -->
		
		<!-- body -->
		<div class="gt-bd gt-cols clearfix">
			
			<!-- main content -->
			<div class="gt-content">
				
				<h1>MM Pawning Accounts Management System - Administration</h1>
				
				<h4>Here you can view the details of the transactions made by MM Pawning.</h4>
				
				<?php 
					$pages = array( 'login' => 'login.php',
									'cashbook' => 'cashbook.php',
									'logout' => 'logout.php',
									'branchsummary' => 'branch_summary.php' );
					$pageName = $_GET['page'];
					midiInclude($pageName, $pages );
				?>
				
				
				
			</div>
			<!-- / main content -->
			
			<!-- sidebar -->
			<div class="gt-sidebar">
				
			</div>
			<!-- / sidebar -->
			
		</div>
		<!-- / body -->
		
		<!-- footer -->
		<div class="gt-footer">
			<p>Copyright &copy; MiDi Sri Lanka 2010 <a href="http://www.midisl.com" target="_blank">midisl.com</a></p>
		</div>
		<!-- /footer -->
	</body>
</html>