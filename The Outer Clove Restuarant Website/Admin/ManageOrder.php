<?php
include('HFpart/header.php');


$query = "SELECT c.*, f.Food_Name, f.F_Price, f.Food_Image, U_Name
          FROM cart_tb c
          JOIN food_tb f ON c.food_id = f.FID
          JOIN user_tb u ON c.U_ID = u.U_ID";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<body>
<div class="main">
<div class="Content">
        <h1>User Cart Details</h1>
        <table class="TBStyle">
           
                <tr>
                    <th>User</th>
                    <th>Food Image</th>
                    <th>Food Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            
            
                <?php
                $totalPrice = 0;

                // Loop through cart items
                while ($row = mysqli_fetch_assoc($result)) {
                    $username = $row['U_Name'];
                    $FoodImage = $row['Food_Image'];
                    $foodName = $row['Food_Name'];
                    $price = $row['F_Price'];
                    $quantity = $row['quantity'];
                    $total = $price * $quantity;
                ?>
                    <tr>
                     <td><?php echo $username ?></td>
                        <td>
                            <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/FoodImages/<?php echo $FoodImage ?>" width="180px" height="180px">
                        </td>
                        <td><?php echo $foodName ?></td>
                        <td>Rs<?php echo $price ?></td>
                        <td><?php echo $quantity ?></td>
                        <td>Rs<?php echo $total ?></td>
                    </tr>
                <?php
                    $totalPrice += $total;
                }
                ?>
                <tr>
                    <td colspan="5">Total Price:</td>
                    <td>Rs <?php echo $totalPrice; ?></td>
                </tr>
            
        </table>
    </div>

</div>
</body>

</html>

<?php 
include('HFpart/Footer.php');
?>
</html>