<?php
session_start(); 
if($_SESSION["result"]) 
{ 
	$user=$_SESSION["result"]["uname"]; 
}
else 
{ 
	header( "Location:adminlogin.php"); 
} 
    //$con=new MongoClient();
	//$db=$con->polling;
	//$collection=$db->candidates;
?>
<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b><br><br>
<div id="page">
<div id="header">
<h1>ADMINISTRATION CONTROL PANEL </h1>
<?php
echo "<h1>Welcome : $user  </h1>";
 ?>
<a href="wel.php">Home</a> | <a href="positions.php">Manage Candidates</a> | <a href="refresh.php">Poll Results</a> | <a href="logout.php">Logout</a>
</div>
<p align="center">&nbsp;</p>
<div id="container">

<p>Click a link above to perform an administrative operation.</p>


</div>
<?php include("footer.php");?>
</div>
</body></html>