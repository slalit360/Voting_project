<?php

	$con=new MongoClient();
	$db=$con->polling;
	$collection=$db->admin;
	$qry = array("uname"=>"admin", "pass"=>"admin123456");
	if(!$collection->findOne($qry);)
	{
		$result = $collection->insert($qry);
		if($result)
		{
			echo "inserted";
		}
	}
	else
	{
		echo "Not inserted";
	}
?>