<?php 
if(isset($_POST["SubmitForm"])){
    $ValueBrandStatus=mysqli_real_escape_string($con, $_POST["FormBrand_Status"]);
    $ValueBrandName=mysqli_real_escape_string($con, $_POST["FormBrand_Name"]);
    $sql = "SELECT Id FROM `sh_pl_brand_names` WHERE `Name`='$ValueBrandName'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ExistBrandNameID=$row["Id"];
        $Error_Name="This Brand name is alrady exist!";
    } else {
		$sql = "INSERT INTO `sh_pl_brand_names` (`Status`, `Name`)
        VALUES ('$ValueBrandStatus', '$ValueBrandName')";
    }

    if(isset($_POST["EditBarndNameID"]) && $_POST["EditBarndNameID"]==$ExistBrandNameID){
        $sql = "UPDATE `sh_pl_brand_names` SET `Status`='$ValueBrandStatus', `Name`='$ValueBrandName' WHERE `Id`='$_POST[EditBarndNameID]'";
    } else {
        
    }
    if($con->query($sql)===TRUE){
        header("Location: /".$AdminFolder."/Plugin/".$Plugin."/dashboard");
    }
}
if(isset($_GET["EditBarndNameID"])){
    $sql = "SELECT * FROM `sh_pl_brand_names` WHERE `Id`='$_GET[EditBarndNameID]'";
	$result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(!isset($_POST["SubmitForm"])){
            $ValueBrandStatus=$row["Status"];
            $ValueBrandName=$row["Name"];
        }
        
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
	<?php include("pages/inc/Header.php"); ?>
</head>
<body class="v3">
<?php \template\navbar(array("Btn_Search"=>false,"Btn_BackLink"=>"$AdminFolder/Plugin/$Plugin/dashboard")); ?>
<?php if(is_file("pages/Plugin/".$Plugin."/Sidebar.php")){ include("pages/Plugin/".$Plugin."/Sidebar.php"); } ?>
<div class="modal" id="sh-Modal-Ajax"></div>
<div class="modal" id="sh-Modal-Waiting"><div class="modal-dialog modal-dialog-centered text-center"><i class="fas fa-cog fa-spin fa-5x mx-auto"></i></div></div>
<!-- Start : Your Page Source -->


<main class="<?php echo \template\cfg("WebWidth"); ?>">
	<div class="row">

		<?php if(isset($Error_Name)){ ?>
		<div class="alert alert-danger">
    		<strong>Error!</strong> <?php echo $Error_Name; ?>
  		</div><?php } ?>

		<form action='' Method='POST' class=" pt-3">
            <div class="form-floating">
  				<select class="form-select" id="sel1" name="FormBrand_Status">
   					<option <?php if(isset($ValueBrandStatus) && $ValueBrandStatus=="Enable"){ echo "selected"; } ?>>Enable</option>
   					<option <?php if(isset($ValueBrandStatus) && $ValueBrandStatus=="Disable"){ echo "selected"; } ?>>Disable</option>
  				</select>
  				<label for="sel1" class="form-abel">Select list (select one):</label>
			</div>
            <div class="form-floating mb-3 mt-3">
      			<input name="FormBrand_Name" class="form-control"  placeholder="Brand Name" value="<?php if(isset($ValueBrandName)){ echo stripslashes($ValueBrandName); } ?>" >
      			<label for="Link">Brand name</label>
   			</div>
            <?php if(isset($_GET["EditBarndNameID"])){ ?>
                <input type="hidden" name="EditBarndNameID" value="<?php echo $_GET["EditBarndNameID"]; ?>">
            <?php } ?>
            <button type="submit" name="SubmitForm" value="BrandName" class="btn btn-lg  btn-primary w-100">Submit</button>

        </form>

    </div>
</main>

<!-- End : Your Page Source -->
<?php include("pages/inc/bs4_bottombar.php"); ?>
</body>
</html>