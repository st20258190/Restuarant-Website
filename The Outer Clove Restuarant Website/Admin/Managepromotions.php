<?php 

include('HFpart/header.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Manage Promotions</title>
</head>
<body>


<div class="main">
    <div class="Content">
        <h1 class="FH1">Manage Promotions</h1>

        <br/>

        <a href="AddPromotions.php" class="button">Add Promotions</a>

        <br/> <br/>

        <div class="Error">   
        <?php 

                if(isset($_SESSION["addPromotion"])){
                    echo $_SESSION["addPromotion"];
                    unset($_SESSION["addPromotion"]);
                }

                if(isset($_SESSION["DeleteMessage"])){
                    echo $_SESSION["DeleteMessage"];
                    unset($_SESSION["DeleteMessage"]);
                }

                if(isset($_SESSION["deletePromotions"])){
                    echo $_SESSION["deletePromotions"];
                    unset($_SESSION["deletePromotions"]);
                }

                if(isset($_SESSION["DeletePromotionError"])){
                    echo $_SESSION["DeletePromotionError"];
                    unset($_SESSION["DeletePromotionError"]);
                }

                if(isset($_SESSION["DeleteCImage"])){
                    echo $_SESSION["DeleteCImage"];
                    unset($_SESSION["DeleteCImage"]);
                }

                if(isset($_SESSION["PromotionUpdate"])){
                    echo $_SESSION["PromotionUpdate"];
                    unset($_SESSION["PromotionUpdate"]);
                }
             ?>

    </div>

        <table class="TBStyle">
            <tr>

                <th>Promotion Number</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>

            <?php
            
            $query= "SELECT * FROM `promotion_tb`";
            $result = mysqli_query($conn, $query);

            if ($result==true) {
                
                $CountRows= mysqli_num_rows($result);

            $PromotionNum=1;

                if ($CountRows>0) {
                    while ($rows=mysqli_fetch_assoc($result)) {
                       $ID=$rows['PID'];
                       $PromotionName=$rows['P_Name'];
                       $PromotionDescription=$rows['P_Description'];
                       $PromotionImage=$rows['P_Image'];

                       ?>

                                <tr>

                                <td><?php echo $PromotionNum++; ?> </td>
                                <td><?php echo $PromotionName; ?></td>
                                <td><?php echo $PromotionDescription; ?></td>
                                <td>
                                <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/PromotionImages/<?php echo  $PromotionImage ?>" width="180px" height="180px">
                                </td>
                                <td>
                                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/UpdatePromotions.php?PID=<?php echo $ID ?>" class="button">Update</a>
                                <br/> <br/>
                                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/DeletePromotions.php?PID=<?php echo $ID ?>&P_Image=<?php echo $PromotionImage; ?>" class="button">Delete</a> 
                                </td>
                                </tr>   
                                
                       <?php

                       
                    }
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