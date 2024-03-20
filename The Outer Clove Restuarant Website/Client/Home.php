<?php

include("../Admin/DataBase/Dbconn.php");

?>


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
    
<header>
        <a href="#" class="logo"> <img src="Images/OuterCloveLogo.png" alt="" height="80px" width="80px" ></a>

     <nav class="navigationBar">

        <a class="active" href="#home">home</a>
        <a href="#FoodMenu">Menu</a>
        <a href="#Reservations">Booking</a>
        <a href="#FAQ">FAQ</a>
        <a href="#about">About us</a>
        <a href="#Contact">Contact us</a>
     </nav>

</div>

    <div class="headerIcons">
        <i class="fas fa-bars" id="MenuButton"></i> 
       <i class="fas fa-search" id="searchIcon"></i> 
       <a href="../Client/cart.php" class="fas fa-shopping-cart" ></a>
       <a href="../Client/LoginForm.php" class="fas fa-user" ></a>
       

    </div>

 </header>


 <form id="search" action="<?php echo ADMIN_HOME_URL; ?>Client/FoodSearch.php" method="post" >

    <input type="search" placeholder="Search Food" name="search" id="SearchInput">
    <label for="SearchInput" class="fas fa-search" ></label>
    <i class="i fas fa-times" id="SearchClose"></i>



 </form>


 <Section class="home" id="home" >

    <div class="swiper HomeSlider" >
        <div class="swiper-wrapper HomeWrapper">

                        <?php
                            
                            $query= "SELECT * FROM `promotion_tb`";
                            $result = mysqli_query($conn, $query);

                            if ($result==true) {
                                
                                $CountRows= mysqli_num_rows($result);

                            $PromotionNum=1;

                                if ($CountRows>0) {
                                    while ($rows=mysqli_fetch_assoc($result)) {
                                    $ID=$rows['PID'];
                                    $PromotionName=$rows['P_Name'];
                                    $PromotionDescription=$rows['P_Description'];
                                    $PromotionImage=$rows['P_Image'];

                       ?>

                                <div class="swiper-slide slider">

                                    <div class="Content">

                                        <span>The Outer Clove Promotions</span>
                                        <h3><?php echo $PromotionName; ?></h3>
                                        <p><?php echo $PromotionDescription; ?></p>
                                        

                                    </div>

                                        <div class="MenuImages">
                                        <img src="<?php echo ADMIN_HOME_URL; ?>Admin/Images/PromotionImages/<?php echo  $PromotionImage ?>">
                                        </div>

                                </div>
                    <?php

                                    
                                    }
                                }
                            }
                            
            
                     ?>

            
        </div>

        <div class="swiper-pagination"></div>
    </div>
    

</Section>

            <div class="FoodSection" >
            <section class="FoodMenu" id="FoodMenu">

                <h3 class="MenuHeading">The Outer Clove Menu</h3>
                <h1 class="categoryHeading">Staters</h1>
                <div class="boxContainer">

                    <?php 
                    
                    $query = "SELECT * FROM food_tb WHERE FoodCatergory = 'Stater'";

                $result = mysqli_query($conn, $query);

                $CountRows= mysqli_num_rows($result);
                    
                if ($CountRows>0) {
                    
                    while ($rows= mysqli_fetch_assoc($result)){

                        $ID= $rows['FID'];
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
                                }

                

                         ?>
                 
                 </div>
                            
                <h1 class="categoryHeading1">Main Foods</h1>

                        <div class="boxContainer">

                        <?php 
                    
                $query = "SELECT * FROM food_tb WHERE FoodCatergory = 'Main Food'";

                $result = mysqli_query($conn, $query);

                $CountRows= mysqli_num_rows($result);
                    
                if ($CountRows>0) {
                    
                    while ($rows= mysqli_fetch_assoc($result)){

                        $ID= $rows['FID'];
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
                                }

                

                         ?>
                                    
                            </div>




                            <h1 class="categoryHeading1">Fast Foods</h1>

                        <div class="boxContainer">
                        <?php 
                    
                    $query = "SELECT * FROM food_tb WHERE FoodCatergory = 'Fast Foods'";

                $result = mysqli_query($conn, $query);

                $CountRows= mysqli_num_rows($result);
                    
                if ($CountRows>0) {
                    
                    while ($rows= mysqli_fetch_assoc($result)){

                        $ID= $rows['FID'];
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
                                }

                

                         ?>
                            </div>



                                <h1 class="categoryHeading1">Desserts</h1>

                            <div class="boxContainer">

                            <?php 
                    
                    $query = "SELECT * FROM food_tb WHERE FoodCatergory = 'Desserts'";

                $result = mysqli_query($conn, $query);

                $CountRows= mysqli_num_rows($result);
                    
                if ($CountRows>0) {
                    
                    while ($rows= mysqli_fetch_assoc($result)){

                        $ID= $rows['FID'];
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
                                }

                

                         ?>
                                        
                                </div>





                                <h1 class="categoryHeading1">Beverages</h1>

                                <div class="boxContainer">
                                <?php 
                    
                $query = "SELECT * FROM food_tb WHERE FoodCatergory = 'Beverages'";

                $result = mysqli_query($conn, $query);

                $CountRows= mysqli_num_rows($result);
                    
                if ($CountRows>0) {
                    
                    while ($rows= mysqli_fetch_assoc($result)){

                        $ID= $rows['FID'];
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
                                }

                

                         ?>
                                    </div>


                            
                    </section>
                
                    </div>  
                
                
<div class="FoodSection" >
<section class="orderSection" id="Reservations"  >
                <h3 class="MenuHeading">The Outer Clove Reservations</h3>
                <h1 class="categoryHeading">Book your Table</h1>
                
                
                <form method="post" enctype="multipart/form-data" class="ReservationForm">

        
                    <label for="CustomerName" class="ReserVationFormLabel">Customer Name</label>
                    <input type="text" name="CustomerName" class="ReservationFormInput" required >

                    <label for="ContactNumber" class="ReserVationFormLabel">Contact Number</label>
                    <input type="number" name="ContactNumber" minlength="10" maxlength="12" class="ReservationFormInput"  required>

                    <label for="ReservedDate" class="ReserVationFormLabel">Date</label>
                    <input type="date" name="ReservedDate" class="ReservationFormInput"  required>

                    <label for="ReservedTime" class="ReserVationFormLabel">Time</label>
                    <input type="time" name="ReservedTime" class="ReservationFormInput"  required>

                    

                    <button type="submit" class="MainButton"  name="AddReservation">Add Reservation</button>

                </form>

                <?php

                            if (isset($_POST["AddReservation"])) {
                                $CustomerName = $_POST["CustomerName"];
                                $CustomerNumber= $_POST["ContactNumber"];
                                $ReservedDate = $_POST["ReservedDate"];
                                $ReservedTime = $_POST["ReservedTime"];
                                ;
                                
                                


                                    

                                $query = "INSERT INTO reservation_tb (Customer_Name, Contact_Number, Date, Reserved_Time) VALUES (?, ?, ?, ?)";

                                // Use prepared statements to prevent SQL injection
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("sssi", $CustomerName, $CustomerNumber, $ReservedDate, $ReservedTime);

                                
                                // Execute the query
                                $result = $stmt->execute();
                                
                                
                                
                                // Close the statement
                                $stmt->close();
                                }

                ?>
</section>

</div>

<div class="FAQSection" >


         <section class="FAQSection1" id="FAQ" >

                    <h3 class="MenuHeading">The Outer Clove FAQ</h3>
                    <h1 class="categoryHeading">Frequently Asked Questions </h1>

                

                

                <?php

                    $query= "SELECT * FROM faq_tb";

                    $result = mysqli_query($conn, $query);

                    $CountRows= mysqli_num_rows($result);

                    $FAQNum=1;
                    if ($CountRows>0) {
                        
                        while ($rows=mysqli_fetch_assoc($result)){

                            $ID= $rows['FID'];
                            $FAQ= $rows['FAQ'];
                            $FAQAnswer= $rows['Answer']
        
                 ?>

                    <div class="FAQ">

                                <div class="Questions">
                                    <h3> <?php echo $FAQ?></h3>

                                    <svg width="15" height="10" viewBox="0 0 42 25">
                                        <path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"/>
                                    </svg>
                                </div>  
                                
                                <div class="answer">
                                    <p><?php echo $FAQAnswer?></p>
                                </div>

                     </div>

                                <?php
                            }
                        }

                            

                    ?>

                

         </section>

<div class="AboutSection" >
         <section class="about" id="about" >

                    <h3 class="MenuHeading">About us</h3>
                    <h1 class="categoryHeading">Why you Should Choose us </h1>
                    

                    <div class="row">
                        <div class="aboutImages">
                    

                            <img src="../Client/Images/food burger sauce_9113991.png" alt="food burger">

                         </div> 
                         
                         
                         
                            <div class="content">

                                <h3>Best Food Chain in the Country</h3>
                                <p>Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit. Corporis iste placeat,
                                praesentium necessitatibus atque aut saepe, 
                                eum architecto enim aspernatur perferendis sapiente ips
                                 voluptatum possimus velit ullam soluta qui illum.</p>
                                
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing 
                                    elit. Fugit quibusdam sequi nam nobis dolorum iure
                                     fuga culpa, modi sed excepturi voluptatem blanditiis eius sapiente
                                    ex facere ipsam consequuntur aperiam odit.
                                </p>
                                <div class="IconContainer">
                                    <div class="icons">
                                        <i class="fas fa-shipping-fast" ></i>
                                        <span>free Delivery</span>
        
                                    </div>

                                    
                                    <div class="icons">
                                        <i class="fas fa-car" ></i>
                                        <span>Parking Service</span>
        
                                    </div>

                                    <div class="icons">
                                        <i class="fas fa-coffee" ></i>
                                        <span>Dinning Service</span>
        
                                    </div>
                                </div>

                            </div>

                        
                    </div>

         </section>

 </div>

</div>

<div class="footerSection" >

    <section class="footer" id="Contact" >

        <div class="box-container">
            <div class="box">
                <h3> Location</h3>
                <a href="#">Kandy</a>
                <a href="#">Colombo</a>
                <a href="#">Kurunegala</a>
                <a href="#">Nuwara Eliya</a>
                <a href="#">Galle</a>
            </div>

            <div class="box">
                <h3> Quick Links</h3>
                <a href="#home">home</a>
                <a href="#FoodMenu">Menu</a>
                <a href="#Reservations">Booking</a>
                <a href="#FAQ">FAQ</a>
                <a href="#about">About us</a>
                <a href="#Contact">Contact us</a>
            </div>

            <div class="box">
                <h3> Contact Info</h3>
                <a href="#">081 2456035</a>
                <a href="#">011 2456035</a>
                <a href="#">OuterClove@gmail.com</a>
                <a href="#">OuterClove@.info</a>
                <a href="#">No 18 main Street Kandy</a>
            </div>

            <div class="box">
                <h3> Follow us</h3>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Linkedin</a>
            </div>
        </div>

        <div class="credit">copyright @ 2023 by <span>The Outer Clove</span> </div>

    </section>




</div>





<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="../Client/Js/script.js"></script>
</body>
</html>