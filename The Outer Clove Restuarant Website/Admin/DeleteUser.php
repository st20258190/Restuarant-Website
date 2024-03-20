<?php


include('../Admin/DataBase/Dbconn.php');       //Include constants.php file here




$UID = $_GET['U_ID'];        // get the ID of Admin to be deleted


$query = "DELETE FROM `user_tb` WHERE U_ID=$UID";   //SQL Query to Delete Admin


$result = mysqli_query($conn, $query); //execute the Query 


if($result== true){

    $_SESSION['delete'] = "User Deleted Successfully";

    header("location:".ADMIN_HOME_URL.'Admin/ManageUsers.php');

}else {

    $_SESSION['delete'] = "Failed to Delete USer";
    header("location:".ADMIN_HOME_URL.'Admin/ManageUsers.php');
    
}


?>