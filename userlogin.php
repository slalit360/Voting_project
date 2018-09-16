<?php
	session_start();
?>

<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/user.js">
</script>
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b></center><br><br>
<div id="page">
<div id="header">
<a href="wel.php">Home</a> | <a href="adminlogin.php">Admin Login</a> | <a href="contact.php"> Contact Us</a>
<h1>Student Login </h1>
<div class="news"><marquee>New polls are up and running. But they will not be up forever! Just Login and then go to Current Polls to vote for your favourate candidates. </marquee></div>
</div>
<div id="container">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<form name="myForm" method="post" onsubmit="validateForm()">
<td>
<table width="326" border="0" cellpadding="3" cellspacing="1" bgcolor="tan">
<tr>
<td width="120">Random_Id</td>
<td width="6">:</td>
<td width="180"><input name="rnd_id" type="text" id="myid" required></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="pass" type="password" id="mypassword" required></td>
</tr>
<tr align="center">
<td  colspan="3"><input type="submit" name="submitform" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<center>
<p>Not yet registered? <a href="usersignup.php"><b>Register Here</b></a></p>
</center>
</div>
<?php include("footer.php");?>
</div>
</body></html>

<?php

if(isset($_POST['submitform']))
{
	$con=new MongoClient();
	$db=$con->polling;
	$collection=$db->login;
	
	$rid = $_POST['rnd_id'];
	
	$pass = $_POST['pass'];
	
	$qry1 = array("rid"=>$rid, "pass"=>$pass);
	
	$result = $collection->findOne($qry1);
		
		if($result) 
			{
				$fname=$result['fname'];
                echo"<script>window.alert('welcome : $fname');
				window.location ='http://localhost:81/poll/usermain.php';</script>";
				
				$_SESSION["result"]=$result;

				
            }
            else
			{
              echo"<script>window.alert('Please Enter a valid ID or password');window.location ='http://localhost:81/poll/userlogin.php';</script>";
			  
            }
}
?>
