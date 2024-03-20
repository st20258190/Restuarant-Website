<?php
include('../Admin/DataBase/Dbconn.php');


// Check if the user is logged in
if (!isset($_SESSION['UserLogged'])) {
    // Redirect to login page if not logged in
    header("Location: " . ADMIN_HOME_URL . 'Client/LoginForm.php');
    exit();
}

// Retrieve cart data for the logged-in user
$U_ID = $_SESSION['UserLogged'];
$query = "SELECT c.*, f.Food_Name, f.F_Price, f.Food_Image
          FROM cart_tb c
          JOIN food_tb f ON c.food_id = f.FID
          WHERE c.U_ID = $U_ID ";

$result = mysqli_query($conn, $query);

// Check if there are items in the cart
if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <title>Cart</title>
        <link rel="stylesheet" href="../css/cart.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <div class="shopping-cart">
            <h2>Your Cart</h2>
            <div class="Error"><?php 
           
           if(isset($_SESSION["delete"])){
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }

            if(isset($_SESSION["update"])){
              echo $_SESSION["update"];
              unset($_SESSION["update"]);
          }

            ?> </div>
            <table>
                <thead>
                    <tr>
                        <th>Food Image</th>
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
         <tbody>
         <?php
                    $totalPrice = 0;

                    // Loop through cart items
                    while ($row = mysqli_fetch_assoc($result)) {
                        $CID= $row['CID'];
                        $FoodImage = $row['Food_Image'];
                        $foodName = $row['Food_Name'];
                        $price = $row['F_Price'];
                        $quantity = $row['quantity'];
                        $total = $price * $quantity;

          ?>
          <tr>
            <td>
              <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/FoodImages/<?php echo $FoodImage ?>" width="180px" height="180px">
            </td>
            <td><?php echo $foodName  ?></php></td>
            <td>Rs<?php echo $price  ?></td>
            <td>
              <form action="" method="post">
                <input type="hidden" name="update_quantity_id" value="">
                <input type="number" name="update_quantity" min="1" value="<?php echo $quantity  ?>">
                <input type="submit" value="Update" name="update_btn" class="update-btn" >
              </form>
            </td>
            <td>Rs<?php echo $total ?></td>
            <td><a href="<?php echo ADMIN_HOME_URL; ?>Client/RemoveCart.php?CID=<?php echo $CID ?>" class="delete-btn" >Remove</a></td>
          </tr>
          

          

        <?php
          $totalPrice += $total;
        }
        ?>
        <tr class="table-bottom">
            <td><button class="continue-shopping-btn" onclick="continueShopping()">Back to Home</button></td>
            <td><button class="continue-shopping-btn" >Proceed to Checkout</button></td>
            <td colspan="3"></td>
            
          </tr>
      </tbody>
            </table>
            <p>Total Price: Rs <?php echo $totalPrice; ?></p>
        </div>
    </body>
    <script src="../Client/Js/script.js"></script>
    </html>
    <?php
}else{
echo '<script>';
echo 'alert("Add item to view cart!");';
echo 'location.href = "' .ADMIN_HOME_URL. 'Client/Home.php";';
echo '</script>';
}
?>

<?php

if (isset($_POST['update_btn'])) {
  $updateQuantity = mysqli_real_escape_string($conn, $_POST["update_quantity"]);
  

  $update_query = "UPDATE cart_tb SET
   quantity = '$updateQuantity'
    WHERE CID = $CID";

  $update_result = mysqli_query($conn, $update_query);

  if ($update_result) {
      // Successful update
      $_SESSION['update'] = "Quantity updated successfully";
  } else {
      // Failed update
      $_SESSION['update'] = "Failed to update quantity";
  }


}



?>
