<?php
include('HFpart/header.php');
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
            <input type="text" name="PromotionName" class="FoodFormInput" required >

         <label for="PromotionDescription" class="FoodFormLabel">Description</label>
            <textarea name="PromotionDescription" cols="30" rows="10"></textarea>

        <label for="PromotionImage" class="FoodForm">Select Image</label>
            <input type="file" name="PromotionImage" class="FoodFormInput" >

         <button type="submit" class="FoodFormButton"  name="AddPromotion">Add Promotion</button>

    </form>

    <?php

if (isset($_POST["AddPromotion"])) {
    $PromotionName = $_POST["PromotionName"];
    $PromotionDescription = $_POST["PromotionDescription"];
    

    


        if (isset($_FILES["PromotionImage"]["name"])) {
            
            $PromotionImage = $_FILES["PromotionImage"]["name"];
            if ($PromotionImage != "") {
               
                $ImageExtensionParts = explode('.', $PromotionImage);
                $ImageExtension = end($ImageExtensionParts);

                $PromotionImage = "PromotionName" . rand(1000, 9999) . "_" . time() . "." . $ImageExtension;

                $SrcPath = $_FILES["PromotionImage"]["tmp_name"];
                $ImageDestinationPath = "Images/PromotionImages/" . $PromotionImage;

                $ImageUpload = move_uploaded_file($SrcPath, $ImageDestinationPath);

                if ($ImageUpload == false) {
                    $_SESSION["UploadImage"] = "Image Upload failed";
                    header("location:" . ADMIN_HOME_URL . 'Admin/AddPromotions.php');
                    die();
                }
            }

        } else {
            $PromotionImage = "";
        }

        // Escape special characters in description
        $PromotionDescription = mysqli_real_escape_string($conn,  $PromotionDescription);

        // Query to insert Data
        $query = "INSERT INTO promotion_tb (P_Name,	P_Description, P_Image) 
        VALUES ('$PromotionName', '$PromotionDescription','$PromotionImage')";

        


        // Execute the Query
        $result = mysqli_query($conn, $query);

        if ($result == true) {
            $_SESSION['addPromotion'] = "Promotion Added Successfully";
            header("location:" . ADMIN_HOME_URL . 'Admin/Managepromotions.php');
        } else {
            $_SESSION['addPromotion'] = "Failed to add Promotion";
            header("location:" . ADMIN_HOME_URL . 'Admin/Managepromotions.php');
        }

    }

        ?>
    
</body>
</html>

<?php 
include('HFpart/Footer.php');
?>