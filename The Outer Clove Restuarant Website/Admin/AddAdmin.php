<?php
include("HFpart/header.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
</head>
<body>
    <div class="main">
       <div class="Content">
       <h1>Add Admin</h1>

       <form action="", method="post">

        <table class="TBStyle2">
            <tr>
                <td>Full name</td>
                <td><input type="text" name="fullName" placeholder="Enter Full Name"></td>
            </tr>

            <tr>
                <td>Username</td>
                <td><input type="text" name="Username" placeholder="Enter  UserName"></td>
            </tr>

            <tr>
                <td>Password</td>
                <td><input type="password" name="Password" placeholder="Enter Password"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="Add_Admin" value="Add Admin" class="button">
                </td>
                
            </tr>
        </table>
       </form>
       </div>
    </div>
</body>

<?php
include("HFpart/Footer.php");
?>

<?php
if (isset($_POST["Add_Admin"])) {
    $fullName = $_POST['fullName'];
    $Username = $_POST['Username'];
    $Password = md5($_POST['Password']);

    $query = "INSERT INTO admin_tb SET 

            Full_Name='$fullName',
            UserName='$Username',
            Password='$Password'
         ";
    

    //Executing the query
   $result = mysqli_query($conn, $query); 
   if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($result==true) {
    $_SESSION['addData']="Admin Added Successfully";
    header("location:".ADMIN_HOME_URL.'Admin/index.php');
}else{
    $_SESSION['addData']="Failed add an admin";
    header("location:".ADMIN_HOME_URL.'Admin/AddAdmin.php');
}

     
}
?>
</html>
