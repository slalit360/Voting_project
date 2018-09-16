<html>
<head></head>
<body>
<h2>
<?php
session_start();
if($_SESSION["result"]) 
{ 
	$con=new MongoClient();
	$db=$con->polling; 
	$collection=$db->login; 
	$rid=$_SESSION["result"]["rid"];
}
if (isset($_POST["submitvote"]))
{
	//$candidates=$_POST["candidate"];
	//if(!$candidates)
	//{
		$rid=$_SESSION["result"]["rid"];
		$con=new MongoClient();
		$db=$con->polling; 
		$collection=$db->login;
		
		$qry1=array("rid"=>$rid);
		$res1=$collection->findOne($qry1);
		$voted=$res1["voted"];
		if($res1 && ($voted==0))
		{
			//$qry1=array("rid"=>$rid);
			$qry2=array('$set'=>array("voted"=>1));
			$res2=$collection->update($qry1,$qry2);
			//if($res2)
			//{
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
						//header("Location: positions.php");
						echo "<script type='text/javascript'>window.alert('ThankYou for Voting  !');</script>";
						//header("Location: usermain.php");
					}
					else
					{
						echo "<script type='text/javascript'>window.alert('You Can't Vote Again!');</script>";
						//header("Location: usermain.php");
					}
				}
				else
				{
					echo "<script type='text/javascript'>window.alert('You Can't Vote Again!');</script>";
						//header("Location: usermain.php");
				}
			//}
				//header("Location: positions.php");
		}
		else
		{
			//header("Location: positions.php");
			echo "not voted";
			echo "<script type='text/javascript'>window.alert('You Can't Vote Again!');</script>";
			//header("Location: usermain.php");
		}
	//}
}
?>
</h2>
</body>
</html>