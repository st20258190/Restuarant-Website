
<?php


include('../Admin/DataBase/Dbconn.php');       //Include constants.php file here




$ID = $_GET['FID'];        // get the ID of Admin to be deleted


$query = "DELETE FROM `faq_tb` WHERE FID=$ID";   //SQL Query to Delete Admin


$result = mysqli_query($conn, $query); //execute the Query 


if($result== true){

    $_SESSION['delete'] = "FAQ Deleted Successfully";

    header("location:".ADMIN_HOME_URL.'Admin/ManageFAQ.php');

}else {

    $_SESSION['delete'] = "Failed to Delete FAQ";
    header("location:".ADMIN_HOME_URL.'Admin/ManageFAQ.php');
    
}








?>