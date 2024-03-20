
<?php


include('../Admin/DataBase/Dbconn.php');       //Include constants.php file here


if(isset($_GET['FID']) && isset($_GET['Food_Image'])) {

    $ID = $_GET['FID'];       // get the ID of Admin to be deleted
    $FoodImage=$_GET['Food_Image'];

   if ($FoodImage!="") {

        $ImagePath="../Admin/Images/FoodImages/".$FoodImage;

        $remove=unlink($ImagePath);

        if ($remove==false) {
            
            $_SESSION['DeleteMessage']='Error Delete Image';
            header("location:".ADMIN_HOME_URL.'Admin/ManageFood.php');
            die(); //Stopping the process
        }
   }

    $query = "DELETE FROM `food_tb` WHERE FID=$ID";
    $result = mysqli_query($conn, $query); //execute the Query 
    
    if($result== true){

        $_SESSION['deleteFood'] = "Food Deleted Successfully";
    
        header("location:".ADMIN_HOME_URL.'Admin/ManageFood.php');
    
    }else {
    
        $_SESSION['deleteFood'] = "Failed to Delete Admin";
        header("location:".ADMIN_HOME_URL.'Admin/ManageFood.php');
        
    }
    
}else {
    $_SESSION['DeleteFoodError']="Item not Deleted";
    header("location:".ADMIN_HOME_URL.'Admin/ManageFood.php');
}







?>