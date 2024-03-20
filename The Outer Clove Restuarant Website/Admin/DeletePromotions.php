
<?php


include('../Admin/DataBase/Dbconn.php');       //Include constants.php file here


if(isset($_GET['PID']) && isset($_GET['P_Image'])) {

    $ID = $_GET['PID'];       
    $PromotionImage=$_GET['P_Image'];

   if ($PromotionImage!="") {

        $ImagePath="../Admin/Images/PromotionImages/".$PromotionImage;

        $remove=unlink($ImagePath);

        if ($remove==false) {
            
            $_SESSION['DeleteMessage']='Error Delete Image';
            header("location:".ADMIN_HOME_URL.'Admin/Managepromotions.php');
            die(); //Stopping the process
        }
   }

    $query = "DELETE FROM `promotion_tb` WHERE PID=$ID";
    $result = mysqli_query($conn, $query); //execute the Query 
    
    if($result== true){

        $_SESSION['deletePromotions'] = "Promotion Deleted Successfully";
    
        header("location:".ADMIN_HOME_URL.'Admin/Managepromotions.php');
    
    }else {
    
        $_SESSION['deletePromotions'] = "Failed to Delete Admin";
        header("location:".ADMIN_HOME_URL.'Admin/Managepromotions.php');
        
    }
    
}else {
    $_SESSION['DeletePromotionError']="Item not Deleted";
    header("location:".ADMIN_HOME_URL.'Admin/Managepromotions.php');
}







?>