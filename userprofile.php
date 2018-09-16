<?php
session_start(); 
if(!isset($_POST['update']))
{	if($_SESSION["result"])
	{
		$rid=$_SESSION["result"]["rid"];
	}
	/*else
	{
		header("Location:userprofile.php");
	}*/

		$con=new MongoClient();
		$db=$con->polling; 
		$collection=$db->login; 
		
		$rid=$_SESSION["result"]["rid"];
		$qryid=array("rid"=>$rid);
		$result1=$collection->findOne($qryid);
		//if(isset($result1)
			
		$pass = $result1["pass"];
		$mob =  $result1["mob"];
		$fname =$result1["fname"];
		$lname =$result1["lname"];
		$email =$result1["email"];
		//}
}
if(isset($_POST['update']))
{	
  $con=new MongoClient();
  $db=$con->polling; 
  $collection=$db->login; 
  
  $pass = $_POST['pass'];
  $mob =$_POST['mob']; 
  $fname =$_POST['fname']; 
  $lname =$_POST['lname']; 
  $email =$_POST['email'];
  $rid=$_SESSION["result"]["rid"];
  $qry2 = array('$set'=>array("fname"=>$fname,"lname"=>$lname,"pass"=>$pass,"mob"=>$mob,"email"=>$email));
	$qry1=array("rid"=>$rid);
	echo "<script type='text/javascript'>function aa{ var a=confirm('Do you want to continue !');return a;}</script>";
	$b="aa()";
	
		if(isset($b)) 
		{ $result=$collection->update($qry1,$qry2);
			if(isset($result))
			{ echo "<script type='text/javascript'>window.alert('Your Profile Is Updated successfully!');</script>";} 
			else
			{ echo "<script type='text/javascript'>window.alert('!Updation Error. ')</script>"; } 
		}
		
		echo "<script type='text/javascript'>window.location='userprofile.php';</script>"; 
  $con->close();
}

		
?>

<html>
<head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/user.js">
</script>
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b><br><br>
<div id="page">
<div id="header">
<a href="wel.php">Home</a> | <a href="usermain.php"> Back</a>| <a href="adminlogin.php">Admin Login</a> | <a href="contact.php"> Contact Us</a>| <a href="logout.php">Logout</a>
<br><br>
<h1>Student Profile : <?php echo $rid; ?> </h1>
<div class="news"><marquee>New polls are up and running. But they will not be up forever! Just Login and then go to Current Polls to vote for your favourate candidates. </marquee></div>
</div>
<center><h3>Register an account by filling in the needed information below:</h3></center><br><br>
<form action="userprofile.php"  method="post" onsubmit="return registerValidate(this)">
<table align="center"><tr><td>
<tr><td>First Name:</td><td><input type='text' style='background-color:#999999; font-weight:bold;' name='fname' value='<?php echo $fname; ?>' maxlength='15' required></td></tr>
<tr><td>Last Name:</td><td><input type='text' style='background-color:#999999; font-weight:bold;' name='lname' value='<?php echo $lname; ?>' maxlength='15' value=''required></td></tr>
<tr><td>Email Address:</td><td><input type='email' style='background-color:#999999; font-weight:bold;' name='email' value='<?php echo $email; ?>' maxlength='100' value=''required></td></tr>
<tr><td>Password:</td><td><input type='text' style='background-color:#999999; font-weight:bold;' name='pass' value='<?php echo $pass; ?>' maxlength='15' value=''required></td></tr>
<tr><td>Mobile No.:</td><td><input type='text' style='background-color:#999999; font-weight:bold;' name='mob' value='<?php echo $mob; ?>' maxlength='15' value=''required></td></tr>
<tr align="center"><td colspan="2"><input type='submit' name="update" value='Update Profile'/></td></tr>
</tr></td></table>
</form>

<div id="container">

</div> 
<?php include("footer.php");?>
</div>
</body></html>
