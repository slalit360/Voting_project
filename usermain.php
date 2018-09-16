<?php
session_start();
	if($_SESSION["result"]) 
	{ 
		$fname=$_SESSION["result"]["fname"]; 
		$con=new MongoClient();
		$db=$con->polling; 
		$collection=$db->login; 
	}
	else 
	{ 
		header("Location:userlogin.php"); 
	}
?>
<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b></center><br><br>
<div id="page">
<div id="header">
<h1>STUDENT HOME </h1>
<a href="usermain.php"> <?php echo $fname; ?></a>|<a href="voting.php">Current Polls</a> | <a href="userprofile.php">Manage My Profile</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<p> Click a link above to do some stuff.</p>
</div>
<?php include("footer.php");?>
</div>
</body></html>