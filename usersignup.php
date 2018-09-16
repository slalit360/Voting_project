<?php
session_start();

if(isset($_POST['submit']))
{	
  $con=new MongoClient();
  $db=$con->polling; 
  $collection=$db->login; 
  $out=" ";
  $fname=null;
  $lname=null;
  $pass =null; 
  $mob =null; 
  $email =null;  
  
  $pass = $_POST['pass'];
  $mob =$_POST['mob']; 
  $fname =$_POST['fname']; 
  $lname =$_POST['lname']; 
  $email =$_POST['email'];
  
  function randomPrefix($length)
{
$random= "";
srand((double)microtime()*1000000);
$data = "AB12CD23EF45GH56IJ7889M4OP41QR63ST4UV85WX89YZ52";
$data .= "1234567890";
for($i = 0; $i < $length; $i++)
{
	$random .= substr($data, (rand()%(strlen($data))), 1);
}

return $random;
}  
  $rid=randomPrefix(8);
  
  $qry = array("rid"=>$rid,"fname"=>$fname,"lname"=>$lname,"pass"=>$pass,"mob"=>$mob,"email"=>$email,"voted"=>0);
  $qry1 = array("mob"=>$mob);
  $qry2 = array("email"=>$email);
  
  $yes1=$collection->findOne($qry1);
  $yes2=$collection->findOne($qry2);
	
	echo "<script type='text/javascript'>function aa{ var a=confirm('Do you want to continue !');return a;}</script>";
	$b="aa()";
	
if(!$yes1 && !$yes2)
	{
		if(isset($b)) 
		{ $result=$collection->insert($qry); } 
		
		if(isset($result))
			{ 
					$out="You Successfully Registered! Your RId is : $rid";
					/*echo "<script type='text/javascript'>alert('You  successfully Registered ! Welcome :$fname , Your Unique Id is : $rid');
					</script>";*/
			} 
		else
			{ 
				//echo "<script type='text/javascript'>alert('! Sorry You Not Registered !')</script>"; 
				$out="Sorry You Not Registered !";
			} 
	}
	else
	{ 
		if($yes1 && $yes2)
			$out="Mobile and Email Id Already exist!";
			//echo "<script type='text/javascript'>alert('Mobile and Email Id Already exist!')</script>"; 
		elseif($yes1)
			$out="Mobile Already exist !";
			//echo "<script type='text/javascript'>alert('Mobile Already exist!')</script>"; 
		elseif($yes2)
			$out="Email Id Already exist !";
			//echo "<script type='text/javascript'>alert('Email Id Already exist!')</script>"; 
		
	}
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
<a href="wel.php">Home</a> | <a href="adminlogin.php">Admin Login</a> | <a href="contact.php"> Contact Us</a>
<br><br>
<h1>Student Registration </h1>
<div class="news"><marquee>New polls are up and running. But they will not be up forever! Just Login and then go to Current Polls to vote for your favourate candidates. </marquee></div>
</div>
<center><h3>Register an account by filling in the needed information below:</h3></center>
<form name="myForm" action="usersignup.php"  method="post" onsubmit="return registerValidate(this)">

<div id="container">
<table align="center" bgcolor="#FFFFFF"><tr><td>
<tr><td>First Name:</td><td><input type='text' style='background-color:#999999; font-weight:bold;' name='fname' maxlength='15' required></td></tr>
<tr><td>Last Name:</td><td><input type='text' style='background-color:#999999; font-weight:bold;' name='lname' maxlength='15' value=''required></td></tr>
<tr><td>Email Address:</td><td><input type='email' style='background-color:#999999; font-weight:bold;' name='email' maxlength='100' value=''required></td></tr>
<tr><td>Password:</td><td><input type='password' style='background-color:#999999; font-weight:bold;' name='pass' maxlength='15' value=''required></td></tr>
<tr><td>Mobile No.:</td><td><input type='text' style='background-color:#999999; font-weight:bold;' name='mob' maxlength='15' value=''required></td></tr>
<tr align="center"><td colspan="2"><input type='submit' name="submit" value='Register Account'/></td></tr>
<tr align="center"><td colspan = '2'><p>Already have an account? <a href='userlogin.php'><b>Login Here</b></a></td></tr>
</tr></td></table>

<div id="container2">
<table align="center" bgcolor="#FFFFFF">
	<tr align="center">
		<td colspan = '2'><b><?php echo $out; ?></b></td>
	</tr>
</table>
</div>
</div>
</form>
<?php include("footer.php");?>
</div>
</body></html>