
<?php
session_start();
if(isset($_POST['submitform']))
{
	$con=new MongoClient();
	$db=$con->polling;
	$collection=$db->admin;
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$qry = array("uname"=>$uname, "pass"=>$pass);
	$result = $collection->findOne($qry);
            if($result) 
			{
                echo"<script>window.alert('welcome : $uname');
				window.location ='http://localhost:81/poll/adminmain.php';</script>";
				
				$_SESSION["result"]=$result;

				
            }
            else
			{
              echo"<script>window.alert('Please Enter a valid username or password');window.location ='http://localhost:81/poll/adminlogin.php';</script>";
			  
            }
}
?>


<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/user.js">
</script>
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b><br><br>
<div id="page">
<div id="header">
<a href="wel.php">Home</a> | <a href="userlogin.php">Student Login</a> | <a href="contact.php"> Contact Us</a>
<br>

<h1>Admin Login </h1>
</div>
<div id="container">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<form name="myForm" method="post" >
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="tan">
<tr>
<td width="90">Username</td>
<td width="6">:</td>
<td width="250"><input name="uname" type="text" id="myusername" required></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="pass" type="password" id="mypassword" required></td>
</tr>
<tr align="center">
<td colspan="3"><input type="submit" name="submitform" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</div>
<?php include("footer.php");?>
</div>
</body></html>