<?php include('../Admin/DataBase/Dbconn.php') ?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Form</title>
    <link rel="stylesheet" href="../css/Client.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
   </head>
<body >

<div class="regmain">
  <div class="RegisterContainer">
    <div class="title">Registration</div>
    <div class="content">
    <div class="error">
    <?php
                        if (isset($_SESSION["RegisterFailed"])) {
                            echo $_SESSION["RegisterFailed"];
                            unset($_SESSION["RegisterFailed"]);
                        }

        ?>

    </div>
      <form method="post">
        <div class="user-details">
        
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your name" name="U_Name" required>
          </div>

          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="U_Email" required>
          </div>
          
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="U_Password"  required>
          </div>

         
        </div>
         <div class="button">
          <input type="submit" value="Register" name="Register">
        </div>
      </form>
      
    </div>
  </div>
  </div>

  <?php


if (isset($_POST["Register"])) {
    $username = $_POST["U_Name"];
    $email = $_POST["U_Email"];
    $password = $_POST["U_Password"];

    // Check if the email is already registered
    $checkQuery = "SELECT * FROM user_tb WHERE U_Email='$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($checkResult) > 0) {
        // Email is already registered
        $_SESSION['RegisterFailed'] = "This Emails already Registered";
    } else {
        // Email is not registered, proceed with registration
        $query = "INSERT INTO user_tb SET
              U_Name= '$username',
              U_Email= '$email',
              U_Password= '$password'";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if ($result) {
            $_SESSION['Login'] = "Successfully Registered";
            header("location:" . ADMIN_HOME_URL . 'Client/LoginForm.php');
        }
    }
}
?>

</body>
</html>