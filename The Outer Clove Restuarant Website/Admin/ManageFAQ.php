<?php 

include('HFpart/header.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Admin.css">
    <title>Manage FAQ</title>
</head>
<body>
<div class="main">
    <div class="Content">
        <h1 class="FH1">Manage FAQ</h1>

        <br/>

        <a href="../Admin/AddFaq.php" class="button">Add FAQ</a>

        <br/> <br/> <br/>
        <div class="Error"><?php 
        
            if(isset($_SESSION["addFAQ"])){
                echo $_SESSION["addFAQ"];
                unset($_SESSION["addFAQ"]);
            }

            if(isset($_SESSION["delete"])){
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }

            if(isset($_SESSION["FAQUpdate"])){
                echo $_SESSION["FAQUpdate"];
                unset($_SESSION["FAQUpdate"]);
            }
            
        ?></div>

        <br/> <br/>

        <table class="TBStyle">
            <tr>

                <th>FAQ Number</th>
                <th>FAQ</th>
                <th>Answer</th>
                
                <th>Actions</th>
            </tr>

            <?php

                $query= "SELECT * FROM faq_tb";

                $result = mysqli_query($conn, $query);

                $CountRows= mysqli_num_rows($result);

                $FAQNum=1;
                if ($CountRows>0) {
                    
                    while ($rows=mysqli_fetch_assoc($result)){

                        $ID= $rows['FID'];
                        $FAQ= $rows['FAQ'];
                        $FAQAnswer= $rows['Answer']
                        
                        ?>

            <tr>

                <td><?php echo $FAQNum++ ?> </td>
                <td><?php echo $FAQ?></td>
                <td><?php echo $FAQAnswer?></td>
                
                <td>
                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/UpdateFAQ.php?FID=<?php echo $ID ?>" class="FButton">Update</a>
                <br /> <br /> 
                <a href="<?php echo ADMIN_HOME_URL; ?>Admin/DeleteFAQ.php?FID=<?php echo $ID ?>" class="FButton">Delete</a>
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