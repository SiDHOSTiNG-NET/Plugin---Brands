<?php

namespace P\Brands;

function brandID_to_Name($brandID){
	global $con;

	
	$sql = "SELECT * FROM `sh_brand_names` WHERE `Id`='$brandID'  ";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		$row2 = $result->fetch_assoc();
	}
	$return=$row2["Name"];
	return $return;

}

?>
