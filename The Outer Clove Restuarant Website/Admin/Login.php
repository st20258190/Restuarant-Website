<?php include('../Admin/DataBase/Dbconn.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Admin.css">
    <title> Admin Login Page</title>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form method="post" class="LoginForm">
                <h1 class="LoginH1">The Outer Clove Restaurant</h1>
                <h2 class="AdminLoginH2"> Admin Login</h2>

               

                <div class="Error">
                        <?php
                        if (isset($_SESSION["Login"])) {
                            echo $_SESSION["Login"];
                            unset($_SESSION["Login"]);
                        }

                        if (isset($_SESSION["AccessDenied"])) {
                            echo $_SESSION["AccessDenied"];
                            unset($_SESSION["AccessDenied"]);
                        }
                        ?>
                    </div>  
                

                <label for="username" class="LoginLabel">Username</label>
                <input type="text" id="username" name="AdminLoginUsername" class="LoginInput" required>

                <label for="password" class="LoginLabel">Password</label>
                <input type="password" id="password" name="AdminLoginPassword" class="LoginInput" required>

                <button type="submit" class="LoginButton" name="SubmitLogin">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['SubmitLogin'])) {
    $Username = $_POST['AdminLoginUsername'];
    $Password = md5($_POST['AdminLoginPassword']) ;

    
    $query = "SELECT * FROM admin_tb WHERE UserName=? AND Password=?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $Username, $Password);

    // Execute query
    mysqli_stmt_execute($stmt);

    
    $result = mysqli_stmt_get_result($stmt);

    
    $CountRows = mysqli_num_rows($result);

    if ($CountRows == 1) {
        $_SESSION['Login'] = "Login Successful ";

        $_SESSION["UserLogged"]=$Username;

        header("Location:" . ADMIN_HOME_URL . 'Admin/');
    } else {
        $_SESSION['Login'] = "Check your username and password";
        header("Location:" . ADMIN_HOME_URL . 'Admin/Login.php');
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
