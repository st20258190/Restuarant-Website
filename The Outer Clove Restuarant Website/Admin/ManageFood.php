<?php 

include('HFpart/header.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Admin.css">
    <title>Manage food</title>
</head>
<body>
<div class="main">
    <div class="Content">
        <h1 class="FH1">Manage Food</h1>

        <br/> 


        <a href="AddFood.php" class="button">Add Food</a>

        <br/> <br/> <br/>

        <div class="Error">
        <?php 
        
            if(isset($_SESSION["addFood"])){
                echo $_SESSION["addFood"];
                unset($_SESSION["addFood"]);
            }


            if(isset($_SESSION["deleteFood"])){
                echo $_SESSION["deleteFood"];
                unset($_SESSION["deleteFood"]);
            }

            
            if(isset($_SESSION["DeleteMessage"])){
                echo $_SESSION["DeleteMessage"];
                unset($_SESSION["DeleteMessage"]);
            }
            
            if(isset($_SESSION["DeleteFoodError"])){
                echo $_SESSION["DeleteFoodError"];
                unset($_SESSION["DeleteFoodError"]);
            }

            if(isset($_SESSION["UpdateUploadImage"])){
                echo $_SESSION["UpdateUploadImage"];
                unset($_SESSION["UpdateUploadImage"]);
            }

            if(isset($_SESSION["DeleteCImage"])){
                echo $_SESSION["DeleteCImage"];
                unset($_SESSION["DeleteCImage"]);
            }


            if(isset($_SESSION["FoodUpdate"])){
                echo $_SESSION["FoodUpdate"];
                unset($_SESSION["FoodUpdate"]);
            }
        ?>
        </div>

        <br/> <br/>

        <table class="TBStyle">
            <tr>
                <th>Item Number</th>
                <th>Category</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price(Rs)</th>
                <th>Update/Delete</th>
            </tr>

            <?php

                $query= "SELECT * FROM food_tb";

                $result = mysqli_query($conn, $query);

                $CountRows= mysqli_num_rows($result);

                $FoodNum=1;
                if ($CountRows>0) {
                    
                    while ($rows=mysqli_fetch_assoc($result)){

                        $ID= $rows['FID'];
                        $FoodCategory= $rows['FoodCatergory'];
                        $FoodName= $rows['Food_Name'];
                        $FoodImage= $rows['Food_Image'];
                        $FoodDescription= $rows['F_Description'];
                        $FoodPrice= $rows['F_Price'];
                        ?>

                             <tr>

                                <td><?php echo $FoodNum++ ?></td>
                                <td><?php echo $FoodCategory ?></td>
                                <td><?php echo $FoodName ?></td>
                                <td>
                                    <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/FoodImages/<?php echo $FoodImage ?>" width="180px" height="180px">
                                </td>
                                <td><?php echo $FoodDescription ?></td>
                                <td><?php echo $FoodPrice ?></td>
                                <td>
                                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/UpdateFood.php?FID=<?php echo $ID; ?>" class="FButton">Update</a>
                                <br /> <br /> 
                                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/DeleteFood.php?FID=<?php echo $ID; ?>&Food_Image=<?php echo $FoodImage; ?>" class="FButton">Delete</a>
                                </td>
                             </tr>

                        <?php
                                    }
                                }

                

                         ?>

            

             
        </table>

    </div>
</div>

</body>

<?php 
include('HFpart/Footer.php');
?>
</html>