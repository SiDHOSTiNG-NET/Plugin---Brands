<?php

namespace P\Brands;

function config($virable){
	$PluginCodename = substr(__NAMESPACE__, 2); // Automatic Getting NameSpace Name after P
	if(is_file("include/config/CMS/Plugin/$PluginCodename/$virable.php")){
		$config=\config("CMS/Plugin/$PluginCodename/".$virable);
	} else {
		if(is_file("include/config/CMS/Plugin/$PluginCodename/$virable.cfg.php")){
			$config=\config("CMS/Plugin/$PluginCodename/".$virable);
		} else {
			$config=\config($virable);
		}
	}
	return $config;
}




function lists($Get=null){
    global $con; 
    $sql = "SELECT * FROM `sh_pl_brand_names` "; //
    $result = $con->query($sql);
    return $result;
}

function Id_to_Name($Id){
    global $con;
    $sql = "SELECT * FROM `sh_pl_brand_names`  WHERE `Id`='$Id'"; //
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $return=$row["Name"];
    return $return;
}

?>