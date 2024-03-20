<?php
include('HFpart/header.php');
?>

<?php

   if (isset($_GET["PID"])) {
    
          $ID=$_GET["PID"];
          $query="SELECT * FROM promotion_tb WHERE PID=$ID";
          $result= mysqli_query($conn,$query);
          
          $rows = mysqli_fetch_assoc($result);
          $ID = $rows['PID'];
          $PromotionName=$rows['P_Name'];
          $PromotionDescription=$rows['P_Description'];       
          $CPromotionImage=$rows['P_Image'];
                        
   }else {
    
    header("location:".ADMIN_HOME_URL."Admin/ManagePromotions.php");
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotions</title>
</head>
<body>

<h1 class="AddFoodH1">Add Promotions</h1>
    <form method="post" enctype="multipart/form-data" class="FoodForm">

    <div class="Error">   
        <?php 

                if(isset($_SESSION["UploadImage"])){
                    echo $_SESSION["UploadImage"];
                    unset($_SESSION["UploadImage"]);
                }
             ?>

    </div>

        <label for="PromotionName" class="FoodFormLabel">Name</label>
            <input type="text" name="PromotionName" class="FoodFormInput" value="<?php echo  $PromotionName ?> "required >

            <label for="PromotionDescription" class="FoodFormLabel">Description</label>
            <textarea name="PromotionDescription" cols="30" rows="10"><?php echo $PromotionDescription; ?></textarea>

            <label for="CPromotionImage" class="FoodForm">Current Image</label>
        <br/><br/>
        <?php

            if ($CPromotionImage=="") {
                
                echo"Image Not Available";
            }else {
                
                ?>
                <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/PromotionImages/<?php echo $CPromotionImage?> "width="180px" height="180px">
                <?php
            }
        
        ?>
        <br/><br/><br/>
        
        <label for="PromotionImage" class="FoodForm">Select New Image</label>
            <input type="file" name="PromotionImage" class="FoodFormInput" >

         <button type="submit" class="FoodFormButton"  name="UpdatePromotion">Update Promotion</button>

    </form>

    <?php

if (isset($_POST["UpdatePromotion"])) {
   
   $PromotionName = $_POST["PromotionName"];
   $PromotionDescription = $_POST["PromotionDescription"];
   
  
   
   // Check if a new image is selected
   if (isset($_FILES["PromotionImage"]["name"])&& $_FILES["PromotionImage"]["name"] != "") {
           
    $PromotionImage = $_FILES["PromotionImage"]["name"];
       
          
           $ImageExtensionParts = explode('.', $PromotionImage);
           $ImageExtension = end($ImageExtensionParts);

           $PromotionImage = "PromotionName" . rand(1000, 9999) . "_" . time() . "." . $ImageExtension;
           $SrcPath = $_FILES["PromotionImage"]["tmp_name"];
           $ImageDestinationPath = "../Admin/Images/PromotionImages/" . $PromotionImage;
           $ImageUpload = move_uploaded_file($SrcPath, $ImageDestinationPath);

           if ($ImageUpload == false) {
               $_SESSION["UploadImage"] = "Image Upload failed";
               header("location:" . ADMIN_HOME_URL . 'Admin/UpdatePromotions.php');
               die();
           }
       


   // Delete the previous image if it exists
   if ($CPromotionImage != "") {
       $RemovePath = "../Admin/Images/PromotionImages/" . $CPromotionImage;
       $RemoveImage = unlink($RemovePath);

       if ($RemoveImage == false) {
           $_SESSION["DeleteCImage"] = " failed to delete current Image";
           header("location:" . ADMIN_HOME_URL . 'Admin/Managepromotions.php');
           die();
       }
   }
} else {
   // Keep the existing image value if no new image is selected
   $PromotionImage = $CPromotionImage;
}

$query2 = "UPDATE promotion_tb SET
P_Name='$PromotionName',
P_Description='$PromotionDescription',
P_Image='$PromotionImage'
";



   $result = mysqli_query($conn, $query2);

   if ($result==true) {
       $_SESSION["PromotionUpdate"] = "Item Update Successfully";
       header("location:" . ADMIN_HOME_URL . 'Admin/Managepromotions.php');
   }else {
       $_SESSION["PromotionUpdate"] = " Failed to Item Update";
       header("location:" . ADMIN_HOME_URL . 'Admin/Managepromotions.php');
   }

   
}



?>
    
</body>
</html>

<?php 
include('HFpart/Footer.php');
?>