<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b></center><br>
<div id="page">
<div id="header">
<a href="wel.php">Home</a> | <a href="adminlogin.php">Admin Login</a> | <a href="userlogin.php">User Login</a> | <a href="contact.php"> Contact Us</a>
<h2>Logged Out Successfully </h2>
</div>
<?
session_start();
session_destroy();
?>
<div id="container">
<center>
<p>You have been successfully logged out of your control panel.<br>
Return to <a href="userlogin.php">Login</a></p></center>
</div>

<?php include("footer.php");?>
</div>
</body></html>