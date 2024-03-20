
<?php


include('../Admin/DataBase/Dbconn.php');       //Include constants.php file here




$ID = $_GET['RID'];        // get the ID of Admin to be deleted


$query = "DELETE FROM `reservation_tb` WHERE RID=$ID";   //SQL Query to Delete Admin


$result = mysqli_query($conn, $query); //execute the Query 


if($result== true){

    $_SESSION['delete'] = "Reservation Deleted Successfully";

    header("location:".ADMIN_HOME_URL.'Admin/ManageReservations.php');

}else {

    $_SESSION['delete'] = "Failed to Delete Reservation";
    header("location:".ADMIN_HOME_URL.'Admin/ManageReservations.php');
    
}








?>