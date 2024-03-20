<?php 

include('HFpart/header.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Manage Admin</title>
</head>
<body>


<div class="main">
    <div class="Content">
        <h1>Manage Admin</h1>

        <br/>

        <?php
            if(isset($_SESSION["addData"])){
                echo $_SESSION["addData"];
                unset($_SESSION["addData"]);
            }

            if(isset($_SESSION["delete"])){
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }

            if(isset($_SESSION["update"])){
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }

            if(isset($_SESSION["Login"])){
                echo $_SESSION["Login"];
                unset($_SESSION["Login"]);
            }
        
        ?>

        <br/> <br/>

        <a href="AddAdmin.php" class="button">Add Admin</a>

        <br/> <br/>

        <table class="TBStyle">
            <tr>

                <th>Number</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


            <?php
            
            $query= "SELECT * FROM `admin_tb`";
            $result = mysqli_query($conn, $query);

            if ($result==true) {
                
                $CountRows= mysqli_num_rows($result);

            $AdminNum=1;

                if ($CountRows>0) {
                    while ($rows=mysqli_fetch_assoc($result)) {
                       $ID=$rows['ID'];
                       $fullName=$rows['Full_Name'];
                       $Username=$rows['UserName'];

                       ?>

                                <tr>

                                <td><?php echo $AdminNum++; ?> </td>
                                <td><?php echo $fullName; ?></td>
                                <td><?php echo $Username; ?></td>
                                <td>
                                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/UpdateAdmin.php?ID=<?php echo $ID ?>" class="button">Update</a>
                                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/DeleteAdmin.php?ID=<?php echo $ID ?>" class="button">Delete</a> 
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