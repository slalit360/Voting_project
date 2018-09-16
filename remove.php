<?php
$con=new MongoClient();
  $db=$con->polling; 
  $collection=$db->candidates; 

if (isset($_POST["delete"]))
{
	$candidates2=$_POST["candidates2"];
	$qry=array("candidates"=>$candidates2);
	$res1=$collection->remove($qry);
	if($res1)
	{
		header("Location: positions.php");
	}
}

?>