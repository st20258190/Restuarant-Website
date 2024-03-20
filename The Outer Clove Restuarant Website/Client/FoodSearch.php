<?php include("../Admin/DataBase/Dbconn.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
     integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous"
      referrerpolicy="no-referrer"/> 

     <link
     rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="../css/Client.css">
    <title>Home</title>
</head>
<body>



            <div class="FoodSection" >
            <section class="FoodMenu" id="FoodMenu">

                <h3 class="MenuHeading">The Outer Clove </h3>
                <h1 class="categoryHeading">Search results</h1>
                <?php $search = $_POST['search'];?>

                <h3 class="MenuHeading">Food on your Search For "<?php echo $search ?>"</h3>
                <br/>
                
                <div class="boxContainer">
                    <?php
                    

                    $query = "SELECT * FROM food_tb WHERE 	Food_Name LIKE'%$search%' OR FoodCatergory LIKE '%$search%' OR F_Description LIKE '%$search%'";

                    $result = mysqli_query($conn, $query);

                    $CountRows=mysqli_num_rows($result);

                    if($CountRows>0){

                        while ($rows=mysqli_fetch_assoc($result)) {
                            
                            $ID= $rows['FID'];
                            $FoodCategory= $rows['FoodCatergory'];
                            $FoodName= $rows['Food_Name'];
                            $FoodImage= $rows['Food_Image'];
                            $FoodDescription= $rows['F_Description'];
                            $FoodPrice= $rows['F_Price'];
                            ?>
                            <div class="box">
                            <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/FoodImages/<?php echo $FoodImage ?>">
                            <h3><?php echo $FoodName ?></h3>
                            <p><?php echo $FoodDescription ?></p>
                                <span>Rs<?php echo $FoodPrice ?></span>
                                <a href="<?php echo ADMIN_HOME_URL; ?>Client/MenutoCart.php?FID=<?php echo $ID; ?>" class="MainButton" >Add to Cart</a>
                            </div>

                            <?php 
                        }

                    }else{
                        echo "<div class='error'>Food not Found</div>";
                    }
                    ?>

                </div>
            </section>
            </div>
</body>
</html>






