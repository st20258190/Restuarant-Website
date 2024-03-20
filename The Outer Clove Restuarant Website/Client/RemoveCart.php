

<?php


include('../Admin/DataBase/Dbconn.php');       //Include constants.php file here




$CID = $_GET['CID'];        // get the ID of Admin to be deleted


$query = "DELETE FROM `cart_tb` WHERE CID=$CID";   //SQL Query to Delete Admin


$result = mysqli_query($conn, $query); //execute the Query 


if($result== true){

    $_SESSION['delete'] = "Item Deleted";
    header("location:".ADMIN_HOME_URL.'Client/cart.php');

}else {

    $_SESSION['delete'] = "Failed to Delete";
    header("location:".ADMIN_HOME_URL.'Client/cart.php');
    
}








?>
