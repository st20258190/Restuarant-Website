<?php
include('HFpart/header.php');
?>
<?php

if (isset($_GET["RID"])) {
 
       $ID=$_GET["RID"];
       $query="SELECT * FROM reservation_tb WHERE RID=$ID";
       $result= mysqli_query($conn,$query);
       
       $rows = mysqli_fetch_assoc($result);
       $ID= $rows['RID'];
       $CustomerName= $rows['Customer_Name'];
       $CustomerNumber= $rows['Contact_Number'];
       $ReservedDate= $rows['Date'];
       $ReservedTime= $rows['Reserved_Time'];
       $ReservedTable= $rows['Reserved_Table'];
}else {
 
 header("location:".ADMIN_HOME_URL."Admin/ManageReservations.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
</head>
<body>
    
    <h1 class="AddFoodH1">Update Reservation</h1>
    <form method="post" enctype="multipart/form-data" class="FoodForm">

        

        
        <label for="CustomerName" class="FoodFormLabel" >Customer Name</label>
        <input type="text" name="CustomerName" class="FoodFormInput" value="<?php echo $CustomerName ?>" required >

        <label for="ContactNumber" class="FoodForm">Contact Number</label>
        <input type="number" name="ContactNumber" class="FoodFormInput" minlength="10" maxlength="10" value="<?php echo $CustomerNumber ?>" required>
        
        <label for="ReservedDate" class="ReserVationFormLabel">Date</label>
        <input type="date" name="ReservedDate" class="ReservationFormInput" value="<?php echo $ReservedDate ?>"  required>
            <br/> <br/>
        <label for="ReservedTime" class="FoodForm" >Reserved Time</label>
        <input type="time" name="ReservedTime" class="FoodFormInput" value="<?php echo $ReservedTime ?>"  required>

        <label for="ReservedTable" class="FoodForm">Reserved Table</label>
        <input type="number" name="ReservedTable" class="FoodFormInput" value="<?php echo $ReservedTable ?>" required>

        <button type="submit" class="FoodFormButton"  name="UpdateReservation">Update Reservation</button>

    </form>

<?php

if (isset($_POST["UpdateReservation"])) {
    $CustomerName = $_POST["CustomerName"];
    $CustomerNumber= $_POST["ContactNumber"];
    $ReservedDate = $_POST["ReservedDate"];
    $ReservedTime = $_POST["ReservedTime"];
    $ReservedTable = $_POST["ReservedTable"];
    
    $query = "UPDATE reservation_tb SET
    Customer_Name='$CustomerName',
    Contact_Number='$CustomerNumber',
    Date= '$ReservedDate',
    Reserved_Time='$ReservedTime',
    Reserved_Table='$ReservedTable'
    
    WHERE RID=$ID";
    
    
    
        $result = mysqli_query($conn, $query);
    
        if ($result==true) {
            $_SESSION["ReservationUpdate"] = "Reservation Updated Successfully";
            header("location:" . ADMIN_HOME_URL . 'Admin/ManageReservations.php');
        }else {
            $_SESSION["ReservationUpdate"] = " Failed to Update Reservation";
            header("location:" . ADMIN_HOME_URL . 'Admin/ManageReservations.php');
        }

    }

?>

</body>
</html>

<?php
include('HFpart/footer.php');
?>
