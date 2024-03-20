<?php
include('HFpart/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation</title>
</head>
<body>
    
    <h1 class="AddFoodH1">Add Reservation</h1>
    <form method="post" enctype="multipart/form-data" class="FoodForm">

        

        
        <label for="CustomerName" class="FoodFormLabel">Customer Name</label>
        <input type="text" name="CustomerName" class="FoodFormInput" required >

        <label for="ContactNumber" class="FoodForm">Contact Number</label>
        <input type="tel" name="ContactNumber" minlength="10" maxlength="12" class="FoodFormInput"  required>

        <label for="ReservedDate" class="ReserVationFormLabel">Date</label>
        <input type="date" name="ReservedDate" class="ReservationFormInput"  required>
            <br/> <br/>
        <label for="ReservedTime" class="FoodForm">Reserved Time</label>
        <input type="time" name="ReservedTime" class="FoodFormInput"  required>

        <label for="ReservedTable" class="FoodForm">Reserved Table</label>
        <input type="number" name="ReservedTable" class="FoodFormInput"  required>

        <button type="submit" class="FoodFormButton"  name="AddReservation">Add Reservation</button>

    </form>

<?php

if (isset($_POST["AddReservation"])) {
    $CustomerName = $_POST["CustomerName"];
    $CustomerNumber= $_POST["ContactNumber"];
    $ReservedDate = $_POST["ReservedDate"];
    $ReservedTime = $_POST["ReservedTime"];
    $ReservedTable = $_POST["ReservedTable"];
    
    


        

    $query = "INSERT INTO reservation_tb (Customer_Name, Contact_Number, Date, Reserved_Time, Reserved_Table) VALUES (?, ?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $CustomerName, $CustomerNumber, $ReservedDate, $ReservedTime, $ReservedTable);

    
    // Execute the query
    $result = $stmt->execute();
    
    // Check for success or failure
    if ($result) {
        $_SESSION['addReservation'] = "Reservation Successful";
        header("location:" . ADMIN_HOME_URL . 'Admin/ManageReservations.php');
    } else {
        $_SESSION['addReservation'] = "Reservation Failed";
        header("location:" . ADMIN_HOME_URL . 'Admin/ManageReservations.php');
    }
    
    // Close the statement
    $stmt->close();
    }

?>

</body>
</html>

<?php
include('HFpart/footer.php');
?>
