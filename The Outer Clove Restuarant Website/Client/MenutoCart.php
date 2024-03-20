<?php
include('../Admin/DataBase/Dbconn.php');


// Check if the user is logged in
if (!isset($_SESSION['UserLogged'])) {
    // Redirect to login page if not logged in
    header("Location: " . ADMIN_HOME_URL . 'Client/LoginForm.php');
    exit();
}

// Retrieve food item details
if (isset($_GET["FID"])) {
    $ID = $_GET["FID"];

    // Assuming database connection established ($conn)
    $query = "SELECT * FROM food_tb WHERE FID=$ID";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $FoodCategory = $rows['FoodCatergory'];
        $FoodName = $rows['Food_Name'];
        $CFoodImage = $rows['Food_Image'];
        $FoodDescription = $rows['F_Description'];
        $FoodPrice = $rows['F_Price'];

        // Check if the item is already in the cart
        $U_ID = $_SESSION['UserLogged'];
        $check_query = "SELECT * FROM cart_tb WHERE U_ID='$U_ID' AND food_id='$ID'";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // Update the quantity if the item is already in the cart
            $update_query = "UPDATE cart_tb SET quantity = quantity + 1 WHERE U_ID='$U_ID' AND food_id='$ID'";
            mysqli_query($conn, $update_query);
        } else {
            // Insert the item into the cart if it's not already there
            $insert_query = "INSERT INTO cart_tb (U_ID, food_id, quantity) VALUES ('$U_ID', '$ID', 1)";
            mysqli_query($conn, $insert_query);
        }

        // Redirect to a page indicating the item has been added to the cart
        header("Location: " . ADMIN_HOME_URL . "Client/cart.php");
        exit();
    } else {
        // Handle database error
        echo "Error retrieving food item: " . mysqli_error($conn);
    }
} else {
    // Redirect to the home page if FID is not set
    header("Location: " . ADMIN_HOME_URL . "Client/Home.php");
    exit();
}
?>
