<?php
include('HFpart/header.php');
?>

<?php

   if (isset($_GET["FID"])) {
    
          $ID=$_GET["FID"];
          $query="SELECT * FROM food_tb WHERE FID=$ID";
          $result= mysqli_query($conn,$query);
          
          $rows = mysqli_fetch_assoc($result);
                        $FoodCategory= $rows['FoodCatergory'];
                        $FoodName= $rows['Food_Name'];
                        $CFoodImage= $rows['Food_Image'];
                        $FoodDescription= $rows['F_Description'];
                        $FoodPrice= $rows['F_Price'];
   }else {
    
    header("location:".ADMIN_HOME_URL."Admin/ManageFood.php");
   }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update food</title>
</head>
<body>
    
    <h1 class="AddFoodH1">Update food</h1>
    <form method="post" enctype="multipart/form-data" class="FoodForm">

        <?php 

                if(isset($_SESSION["UploadImage"])){
                    echo $_SESSION["UploadImage"];
                    unset($_SESSION["UploadImage"]);
                }
         ?>

        <label for="FoodCategory" class="FoodFormLabel">Food Category</label>
        <label for="FoodCategory" class="FoodFormLabel"> <Strong>Current Category:</Strong> <?php echo  $FoodCategory  ?></label>
            <select name="FoodCategory" >
                <option value="<?php echo  $FoodCategory  ?>"><?php echo  $FoodCategory  ?></option>
                <option value="Stater">Stater</option>
                <option value="Main Food">Main Food</option>
                <option value="Fast Foods">Fast Foods</option>
                <option value="Beverages">Beverages</option>
            </select>

        <label for="FoodName" class="FoodFormLabel">Food Name</label>
        <input type="text" name="FoodName" class="FoodFormInput" value="<?php echo $FoodName ?>" >

        <label for="FoodImage" class="FoodForm">Current Image</label>
        <br/><br/>
        <?php

            if ($CFoodImage=="") {
                
                echo"Image Not Available";
            }else {
                
                ?>
                <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/FoodImages/<?php echo $CFoodImage ?> "width="180px" height="180px">
                <?php
            }
        
        ?>
        <br/><br/><br/>

        <label for="FoodImage" class="FoodForm">Select New Image</label>
        <input type="file" name="FoodImage" class="FoodFormInput" >

        <label for="FoodDescription" class="FoodForm">Food Description</label>
        <textarea rows="20" cols="5" name="FoodDescription" class="FoodFormInput"  required><?php echo $FoodDescription ?></textarea>

        <label for="FoodPrice" class="FoodForm">Food Price</label>
        <input type="number" name="FoodPrice" class="FoodFormInput" value="<?php echo $FoodPrice ?>"  required>

        <input type="hidden" name="FID" value="<?php echo $ID ?>">
        <input type="hidden" name="CFoodImage" value="<?php echo $CFoodImage ?>">
        <button type="submit" class="FoodFormButton"  name="UpdateFood">Update Food</button>

    </form>

    </body>
</html>

<?php

 if (isset($_POST["UpdateFood"])) {
    $ID=$_POST["FID"];
    $FoodCategory=$_POST["FoodCategory"];
    $FoodName=$_POST["FoodName"];
    $CFoodImage=$_POST["CFoodImage"];
    $FoodDescription=$_POST["FoodDescription"];
    $FoodPrice=$_POST["FoodPrice"];

   
    
    // Check if a new image is selected
    if (isset($_FILES["FoodImage"]["name"])&& $_FILES["FoodImage"]["name"] != "") {
            
        $ImageName = $_FILES["FoodImage"]["name"];
        
           
            $ImageExtensionParts = explode('.', $ImageName);
            $ImageExtension = end($ImageExtensionParts);

            $ImageName = "FoodName" . rand(1000, 9999) . "_" . time() . "." . $ImageExtension;
            $SrcPath = $_FILES["FoodImage"]["tmp_name"];
            $ImageDestinationPath = "../Admin/Images/FoodImages/" . $ImageName;
            $ImageUpload = move_uploaded_file($SrcPath, $ImageDestinationPath);

            if ($ImageUpload == false) {
                $_SESSION["UploadImage"] = "Image Upload failed";
                header("location:" . ADMIN_HOME_URL . 'Admin/UpdateFood.php');
                die();
            }
        


    // Delete the previous image if it exists
    if ($CFoodImage != "") {
        $RemovePath = "../Admin/Images/FoodImages/" . $CFoodImage;
        $RemoveImage = unlink($RemovePath);

        if ($RemoveImage == false) {
            $_SESSION["DeleteCImage"] = " failed to delete current Image";
            header("location:" . ADMIN_HOME_URL . 'Admin/ManageFood.php');
            die();
        }
    }
} else {
    // Keep the existing image value if no new image is selected
    $ImageName = $CFoodImage;
}

$query2 = "UPDATE food_tb SET
FoodCatergory='$FoodCategory',
Food_Name='$FoodName',
Food_Image='$ImageName',
F_Description='$FoodDescription',
F_Price=$FoodPrice
WHERE FID=$ID";



    $result = mysqli_query($conn, $query2);

    if ($result==true) {
        $_SESSION["FoodUpdate"] = "Item Update Successfully";
        header("location:" . ADMIN_HOME_URL . 'Admin/ManageFood.php');
    }else {
        $_SESSION["FoodUpdate"] = " Failed to Item Update";
        header("location:" . ADMIN_HOME_URL . 'Admin/ManageFood.php');
    }

    
 }



?>

<?php
include('HFpart/footer.php');
?>
