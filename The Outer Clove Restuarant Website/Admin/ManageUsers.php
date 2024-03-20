<?php 

include('HFpart/header.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Manage Users</title>
</head>
<body>


<div class="main">
    <div class="Content">
        <h1>Manage Users</h1>

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

        

        <br/> <br/>

        <table class="TBStyle">
            <tr>

                <th>Number</th>
                <th>ManageUsers Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>


            <?php
            
            $query= "SELECT * FROM `user_tb`";
            $result = mysqli_query($conn, $query);

            if ($result==true) {
                
                $CountRows= mysqli_num_rows($result);

            $UserNum=1;

                if ($CountRows>0) {
                    while ($rows=mysqli_fetch_assoc($result)) {
                       $UID=$rows['U_ID'];
                       $Name=$rows['U_Name'];
                       $Email=$rows['U_Email'];

                       ?>

                                <tr>

                                <td><?php echo $UserNum++; ?> </td>
                                <td><?php echo $Name; ?></td>
                                <td><?php echo $Email; ?></td>
                                <td>
                                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/DeleteUSer.php?U_ID=<?php echo $UID ?>" class="button">Delete</a> 
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