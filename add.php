<?php
$con=new MongoClient();
  $db=$con->polling; 
  $collection=$db->candidates; 

if (isset($_POST["Submit"]))
{
	$candidates1=$_POST["candidates1"];
	if($candidates1!="null")
	{	$qry=array("candidates"=>$candidates1,"Vote_Count"=>0);
		$res1=$collection->insert($qry);
		if($res1)
		{
			header("Location: positions.php");
		}
	}
}

?>