
<?php


include('../Admin/DataBase/Dbconn.php');       //Include constants.php file here




$ID = $_GET['ID'];        // get the ID of Admin to be deleted


$query = "DELETE FROM `admin_tb` WHERE ID=$ID";   //SQL Query to Delete Admin


$result = mysqli_query($conn, $query); //execute the Query 


if($result== true){

    $_SESSION['delete'] = "Admin Deleted Successfully";

    header("location:".ADMIN_HOME_URL.'Admin/index.php');

}else {

    $_SESSION['delete'] = "Failed to Delete Admin";
    header("location:".ADMIN_HOME_URL.'Admin/index.php');
    
}


?>