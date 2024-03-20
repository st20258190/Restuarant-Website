<?php
include('HFpart/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add FAQ</title>
</head>
<body>

<h1 class="AddFoodH1">Add FAQ</h1>
<form method="post" enctype="multipart/form-data" class="FoodForm">

    <br/>

    <label for="FAQQuestion" class="FoodForm">FAQ </label>
    <input type="text" name="FAQQuestion" class="FoodFormInput" required>

    <label for="FAQAnswer" class="FoodForm">FAQ Answer</label>
    <textarea rows="20" cols="5" name="FAQAnswer" class="FoodFormInput" required></textarea>

    <button type="submit" class="FoodFormButton" name="AddFAQ">Add FAQ</button>

</form>

<?php

if (isset($_POST["AddFAQ"])) {
    $FAQ = mysqli_real_escape_string($conn, $_POST["FAQQuestion"]);
    $FAQAnswer = mysqli_real_escape_string($conn, $_POST["FAQAnswer"]);

    // Query to insert Data
    $query = "INSERT INTO faq_tb (FAQ, Answer) VALUES ('$FAQ', '$FAQAnswer')";

    // Execute the Query
    $result = mysqli_query($conn, $query);

    if ($result == true) {
        $_SESSION['addFAQ'] = "FAQ Added Successfully";
        header("location: " . ADMIN_HOME_URL . 'Admin/ManageFAQ.php');
        exit();
    } else {
        $_SESSION['addFAQ'] = "Failed to add FAQ";
        header("location: " . ADMIN_HOME_URL . 'Admin/ManageFAQ.php');
        exit();
    }
}

?>

</body>

<?php
include('HFpart/Footer.php');
?>
</html>
