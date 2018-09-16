<?php
session_start(); 
if($_SESSION["result"]) 
{ 
	//$user=$_SESSION["result"]["uname"]; 
}
else 
{ 
	header( "Location:adminlogin.php"); 
} 

  $con=new MongoClient();
  $db=$con->polling; 
  $collection=$db->candidates; 
?>
<html>
<head>
<title>Administration Control Panel:Candidates</title>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/user.js">
</script>
</head>
<body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b></center>
<div id="page">
<div id="header">
  <h1>Manage Candidates</h1>
  <a href="wel.php">Home</a>  | <a href="refresh.php">Poll Results</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">


<table width="420" align="center"  border="0">
<CAPTION><h4>Add New Candidates</h4></CAPTION>
<form name="candidates1" id="fmPositions1" action="add.php" method="post" >
<tr>
    <td>Candidate Name : </td>
    <td><input type="text" name="candidates1" required /></td>
    <td><input type="submit" action="" name="Submit"  value="Add" /></td>
</tr>
</form>
</table>

<table style="margin-bottom:20px;" width="420" align="center"  border="0">
<CAPTION><h4>Delete Candidates </h4></CAPTION>
<form name="candidates2" id="fmPositions2" action="remove.php" method="post" >
<tr>
    <td>Candidate Name : </td>
    <td><input type="text" name="candidates2" required /></td>
    <td><input type="submit" name="delete" value="Remove" /></td>
</tr>
</form>
</table>

<hr>
<?php
	$positions="Vice President";
	$data = "<table width='420' align='center'  border='0'>";
	//$data .= "border-collapse:collapse' border='1px'>";
	//$data .= "<thead>";
	$data .= "<tr>";
	$data .= "<th>Position Name</th>";
	$data .= "<th>Candidates Name</th>";
	$data .= "<th>Vote Count</th>";
	$data .= "</tr>";
	$data .= "</thead>";
	$data .= "<tbody>";
	try{
		$cursor = $collection->find();
		foreach($cursor as $document)
		{
			$data .= "<tr>";
			$data .= "<td>" . $positions . "</td>";
			$data .= "<td>" . $document["candidates"] . "</td>";
			$data .= "<td>" . $document["Vote_Count"] . "</td>";
			$data .= "</tr>";
		}
		$data .= "</tbody>";
		$data .= "</table>";
		echo $data;
		}catch(MongoException $mongoException)
		{
			print $mongoException;
			exit;
		}
?>
</div>
</table>
<hr>
</div>
<?php include("footer.php");?>
</div>
</body> 
</html>
<?php  // session_destroy();?>