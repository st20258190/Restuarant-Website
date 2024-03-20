<?php
include('HFpart/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add food</title>
</head>
<body>
    
    <h1 class="AddFoodH1">Add food</h1>
    <form method="post" enctype="multipart/form-data" class="FoodForm">

        <?php 

                if(isset($_SESSION["UploadImage"])){
                    echo $_SESSION["UploadImage"];
                    unset($_SESSION["UploadImage"]);
                }
         ?>

        <label for="FoodCategory" class="FoodFormLabel">Food Category</label>
        <select name="FoodCategory">
            <option value="stater">stater</option>
            <option value="Main Food">Main Food</option>
            <option value="Fast Foods">Fast Foods</option>
            <option value="Desserts">Desserts</option>
            <option value="Beverages">Beverages</option>
        </select>


        <label for="FoodName" class="FoodFormLabel">Food Name</label>
        <input type="text" name="FoodName" class="FoodFormInput" required >

        <label for="FoodImage" class="FoodForm">Select Image</label>
        <input type="file" name="FoodImage" class="FoodFormInput" >

        <label for="FoodDescription" class="FoodForm">Food Description</label>
        <textarea rows="20" cols="5" name="FoodDescription" class="FoodFormInput"  required></textarea>

        <label for="FoodPrice" class="FoodForm">Food Price</label>
        <input type="number" name="FoodPrice" class="FoodFormInput"  required>

        <button type="submit" class="FoodFormButton"  name="AddFood">Add Food</button>

    </form>

<?php

if (isset($_POST["AddFood"])) {
    $FoodCategory = $_POST["FoodCategory"];
    $FoodName = $_POST["FoodName"];
    $FoodDescription = $_POST["FoodDescription"];
    $FoodPrice = $_POST["FoodPrice"];

    $checkQuery = "SELECT * FROM food_tb WHERE Food_Name = '$FoodName'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['addFood'] = "Food with the same name already exists!";
        header("location:" . ADMIN_HOME_URL . 'Admin/ManageFood.php');
        die();
    }

        if (isset($_FILES["FoodImage"]["name"])) {
            
            $ImageName = $_FILES["FoodImage"]["name"];
            if ($ImageName != "") {
               
                $ImageExtensionParts = explode('.', $ImageName);
                $ImageExtension = end($ImageExtensionParts);

                $ImageName = "FoodName" . rand(1000, 9999) . "_" . time() . "." . $ImageExtension;

                $SrcPath = $_FILES["FoodImage"]["tmp_name"];
                $ImageDestinationPath = "Images/FoodImages/" . $ImageName;

                $ImageUpload = move_uploaded_file($SrcPath, $ImageDestinationPath);

                if ($ImageUpload == false) {
                    $_SESSION["UploadImage"] = "Image Upload failed";
                    header("location:" . ADMIN_HOME_URL . 'Admin/AddFood.php');
                    die();
                }
            }

        } else {
            $ImageName = "";
        }

        // Escape special characters in description
        $FoodDescription = mysqli_real_escape_string($conn, $FoodDescription);

        // Query to insert Data
        $query = "INSERT INTO food_tb (FoodCatergory, Food_Name, Food_Image, F_Description, F_Price) 
        VALUES ('$FoodCategory','$FoodName', '$ImageName', '$FoodDescription', $FoodPrice)";

        


        // Execute the Query
        $result = mysqli_query($conn, $query);

        if ($result == true) {
            $_SESSION['addFood'] = "Food Added Successfully";
            header("location:" . ADMIN_HOME_URL . 'Admin/ManageFood.php');
        } else {
            $_SESSION['addFood'] = "Failed to add Food";
            header("location:" . ADMIN_HOME_URL . 'Admin/ManageFood.php');
        }
    }

?>

</body>
</html>

<?php
include('HFpart/footer.php');
?>
