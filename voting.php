<?php
session_start();
if($_SESSION["result"]) 
{ 
	$con=new MongoClient();
	$db=$con->polling; 
	$collection=$db->login; 
	$rid=$_SESSION["result"]["rid"];
	$fname=$_SESSION["result"]["fname"];
}
?>

<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
</head><body bgcolor="tan">
<center><b><font color = "brown" size="6">Online Voting System</font></b></center><br><br>
<div id="page">
<div id="header">
<h1>STUDENT HOME </h1>
<a href="usermain.php"> <?php echo "welcome ".$fname." "; ?></a>|<a href="voting.php">Current Polls</a> | <a href="userprofile.php">Manage My Profile</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
	<form method="post" action="voting.php" >
		<table align="center">
			<tr align="center">
				<td >Select Candidate</td>
			</tr>
			<tr align="center">
				<td>
					<SELECT name="candidates"  id="candidates" required >
						<OPTION VALUE=""></OPTION>
						<?php 
							$con=new MongoClient();
							$db=$con->polling; 
							$collection=$db->candidates;
						
							$cursor = $collection->find();
							foreach($cursor as $document)
							{
								echo "<OPTION VALUE=$document[candidates]>$document[candidates]</OPTION>";
							}
						?>
					</SELECT>
				</td>
			</tr>
			<tr align="center">
				<td>
					<input type="submit" name="submitvote" value="Vote"/>
				</td>
			</tr>
			<tr align="center">
				<td>
					<?php echo $out;?>
				</td>
			</tr>
		</table>
	</form>

<p> Click a link above to do some stuff.</p>
</div>
<?php include("footer.php");?>
</div>
</body></html>


<?php
if (isset($_POST["submitvote"]))
{
		$rid=$_SESSION["result"]["rid"];
		$con=new MongoClient();
		$db=$con->polling; 
		$collection=$db->login;
		
		$qry1=array("rid"=>$rid);
		$res1=$collection->findOne($qry1);
		$voted=$res1["voted"];
		$out=" ";
		if($res1 && ($voted==0))
		{
			$qry2=array('$set'=>array("voted"=>1));
			$res2=$collection->update($qry1,$qry2);

				$con=new MongoClient();
				$db=$con->polling; 
				$collection=$db->candidates;

				$candidates=$_POST["candidates"];
				
				$qry3=array("candidates"=>$candidates);
				$res3=$collection->findOne($qry3);
				
				if($res3)
				{	$Vote_Count=$res3["Vote_Count"];
					
					$qry4=array('$set'=>array("Vote_Count"=>($Vote_Count+1)));
					$res4=$collection->update($qry3,$qry4);
					
					if($res4)
					{
						$out='ThankYou for Voting !';
						echo "<script type='text/javascript'>window.alert('ThankYou for Voting  !');</script>";
					}
					else
					{	$out="You Cannot Vote Again!";
						echo "<script type='text/javascript'>window.alert('You Cannot Vote Again!');</script>";
					}
				}
				else
				{	$out="You Cannot Vote Again!";
					echo "<script type='text/javascript'>window.alert('You Cannot Vote Again!');</script>";
				}
		}
		else
		{	$out="You Cannot Vote Again-!";
			echo "<script type='text/javascript'>window.alert('You Cannot Vote Again !');</script>";
		}
}
?>
