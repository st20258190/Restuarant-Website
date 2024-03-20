<?php 

include('HFpart/header.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Admin.css">
    <title>Manage Reservations</title>
</head>
<body>
<div class="main">
    <div class="Content">
        <h1 class="FH1">Manage Reservations</h1>

        <br/>

        <a href="../Admin/AddReservations.php" class="button">Add Reservations</a>

        <br/> <br/>

        <div class="Error">

        <?php 
        
        if(isset($_SESSION["addReservation"])){
            echo $_SESSION["addReservation"];
            unset($_SESSION["addReservation"]);
        }


        if(isset($_SESSION["delete"])){
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }

        if(isset($_SESSION["ReservationUpdate"])){
            echo $_SESSION["ReservationUpdate"];
            unset($_SESSION["ReservationUpdate"]);
        }

        ?>

        </div>

        <table class="TBStyle">
            <tr>

                <th>Reservation Number</th>
                <th>Customer Name</th>
                <th>Contact Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Table</th>
                <th>Actions</th>
            </tr>

            <?php 

                        $query= "SELECT * FROM reservation_tb ";

                        $result = mysqli_query($conn, $query);

                        $CountRows= mysqli_num_rows($result);

                        $ReservationNum=1;

                        if ($CountRows>0) {
                            while ($rows=mysqli_fetch_assoc($result)) {
                                
                                $ID= $rows['RID'];
                                $CustomerName= $rows['Customer_Name'];
                                $CustomerNumber= $rows['Contact_Number'];
                                $ReservedDate = $rows['Date'];
                                $ReservedTime= $rows['Reserved_Time'];
                                $ReservedTable= $rows['Reserved_Table']; 

                            ?>

                                        <tr>

                                        <td><?php echo $ReservationNum++ ?></td>
                                        <td><?php echo $CustomerName ?></td>
                                        <td><?php echo $CustomerNumber ?></td>
                                        <td><?php echo $ReservedDate ?></td>
                                        <td><?php echo $ReservedTime ?></td>
                                        <td><?php echo $ReservedTable ?></td>
                                        <td>
                                        <a href="<?php echo ADMIN_HOME_URL; ?>Admin/UpdateReservations.php?RID=<?php echo $ID ?>" class="button">Update</a>
                                        <a href="<?php echo ADMIN_HOME_URL; ?>Admin/DeleteReservations.php?RID=<?php echo $ID ?>" class="button">Delete</a>
                                        </td>
                                        </tr>

                            <?php
                                        }
                                    }

                            ?>

            

            
        </table>

    </div>
</div>

</body>

<?php 
include('HFpart/Footer.php');
?>
</html>