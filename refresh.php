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
    //session_destroy();
    $con=new MongoClient();
	$db=$con->polling;
	$collection=$db->candidates;

	?>
<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b><br><br>
<div id="page">
<div id="header">
<h1>POLL RESULTS </h1>
<?php
echo "<h1>Welcome : $user  </h1>";
 ?>
<a href="wel.php">Home</a> | <a href="positions.php">Manage Candidates</a> | <a href="refresh.php">Poll Results</a> | <a href="logout.php">Logout</a>
</div>
<p align="center">&nbsp;</p>
<div id="container">
	<?php
	$data = "<center><table width='600' align='center'  border='0px'>";
	$data .= "<thead align='center'>";
	$data .= "<tr align='center'>";
	$data .= "<th align='center'>Position Name</th>";
	$data .= "<th align='center'>Winner Candidates Name</th>";
	$data .= "<th align='center'>Vote Count</th>";
	$data .= "</tr>";
	$data .= "</thead>";
	$data .= "<tbody>";
	try{
		$cursor = $collection->find();
		$max=0;$sum=0;
		$winner="";
		$positions="Vice_President";
		foreach($cursor as $document)
		{
			$sum=$sum+$document["Vote_Count"] ;
			if($document["Vote_Count"] >$max)
			{	
				$max=$document["Vote_Count"];
				$winner=$document["candidates"];
			}
		}
		$data .= "<tr align='center'>
					<td>$positions</td>
					<td>$winner</td>
					<td><b>$max</b></td>
				  </tr>";
		$data .= "<tr align='center'><td colspan='3'>Total Votes Count : <b>$sum </b></td></tr>";
		$data .= "</tbody>";
		$data .= "</table></center>";
		echo $data;
		}catch(MongoException $mongoException)
		{
			print $mongoException;
			exit;
		}
?>
</div>

<?php include("footer.php");?>
</div>
</body></html>