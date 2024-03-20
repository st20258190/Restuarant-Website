<?php include('HFpart/header.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
</head>
<body>

<?php
    
    $ID = $_GET['ID'];        // get the ID of Admin to be update

    $query ="SELECT* FROM admin_tb WHERE ID=$ID";

    $result= mysqli_query($conn ,$query);

    if ($result==true) {
       $CountRows = mysqli_num_rows($result);

       if ($CountRows==1) {

        $rows=mysqli_fetch_assoc($result);
         $ID=$rows['ID'];
         $fullName=$rows['Full_Name'];
         $Username=$rows['UserName'];
        

  
       } else { 
        header("location:".ADMIN_HOME_URL.'Admin/index.php');
       }

    }
    
    ?>

    <div class="main">
       <div class="Content">
       <h1>Update Admin</h1>

       <form  method="post">

        <table class="TBStyle2">
            <tr>
                <td>Full name</td>
                <td><input type="text" name="fullName" value="<?php echo  $fullName; ?>"></td>
            </tr>

            <tr>
                <td>Username</td>
                <td><input type="text" name="Username" value="<?php echo  $Username; ?>"></td>
            </tr>

           
            <tr>
                <td colspan="2">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>">
                    <input type="submit" name="UpdateAdmin" value="Update" class="button">
                </td>
                
            </tr>
        </table>
       </form>
       </div>
    </div>
<?php

if (isset($_POST["UpdateAdmin"])) {
    $ID = isset($_POST['ID']) ? $_POST['ID'] : '';
    $fullName = isset($_POST['fullName']) ? $_POST['fullName'] : '';
    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';

    // Update query
    if (!empty($ID) && !empty($fullName) && !empty($Username)) {
        $Query = "UPDATE admin_tb SET Full_Name='$fullName', UserName='$Username' WHERE ID=$ID";
        $updateResult = mysqli_query($conn, $Query);

        if ($updateResult==true) {
            $_SESSION['update'] = "Admin Updated Successfully";

             header("location:".ADMIN_HOME_URL.'Admin/index.php');
        } else {
            $_SESSION['Update'] = "Admin Update Failed";

             header("location:".ADMIN_HOME_URL.'Admin/index.php');
        }
    } 
}

?>
   
</body>
</html>


<?php include('HFpart/Footer.php')?>