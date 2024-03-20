<?php include('../Admin/DataBase/Dbconn.php');?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Responsive Form</title>
    <link rel="stylesheet" href="../css/Client.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="regmain">
    <div class="RegisterContainer">
        <div class="title">Login</div>
        <div class="content">
            <div class="error">
                <?php
                if (isset($_SESSION["Login"])) {
                    echo $_SESSION["Login"];
                    unset($_SESSION["Login"]);
                }
                ?>
            </div>
            <form method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" placeholder="Enter your email" name="Email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" placeholder="Enter your password" name="Password" required>
                    </div>
                    <br/>
                    <a href="../Client/ResgisterForm.php">Don't Have an Account</a>
                </div>
                <div class="button">
                    <input type="submit" value="Login" name="Login">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
// Check if the form is submitted
if (isset($_POST['Login'])) {
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $query = "SELECT U_ID FROM user_tb WHERE U_Email=? AND U_Password=?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    // Check if the user exists
    if ($user) {
        $_SESSION["UserLogged"] = $user['U_ID'];
        header("Location: " . ADMIN_HOME_URL . 'Client/Home.php');
    } else {
        $_SESSION['Login'] = "Check your Email and password";
        header("Location:" . ADMIN_HOME_URL . 'Client/LoginForm.php');
    }
}
?>
</body>
</html>
