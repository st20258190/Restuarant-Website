<?php
include('HFpart/header.php');

if (isset($_GET["FID"])) {
    $ID = $_GET["FID"];
    $query = "SELECT * FROM faq_tb WHERE FID = $ID";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $ID = $rows['FID'];
        $FAQ = $rows['FAQ'];
        $FAQAnswer = $rows['Answer'];
    } else {
        header("location:" . ADMIN_HOME_URL . "Admin/ManageFAQ.php");
        exit();
    }
} else {
    header("location:" . ADMIN_HOME_URL . "Admin/ManageFAQ.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update FAQ</title>
</head>
<body>

<h1 class="AddFoodH1">Update FAQ</h1>
<form method="post" enctype="multipart/form-data" class="FoodForm">

    <br/>

    <label for="FAQQuestion" class="FoodForm">FAQ </label>
    <input type="text" name="FAQQuestion" class="FoodFormInput" value="<?php echo htmlspecialchars($FAQ); ?>" required>

    <label for="FAQAnswer" class="FoodForm">FAQ Answer</label>
    <textarea rows="20" cols="5" name="FAQAnswer" class="FoodFormInput" required><?php echo htmlspecialchars($FAQAnswer); ?></textarea>

    <button type="submit" class="FoodFormButton" name="UpdateFAQ">Update FAQ</button>

</form>

<?php
if (isset($_POST["UpdateFAQ"])) {
    $FAQ = mysqli_real_escape_string($conn, $_POST["FAQQuestion"]);
    $FAQAnswer = mysqli_real_escape_string($conn, $_POST["FAQAnswer"]);

    $query = "UPDATE faq_tb SET
        FAQ = '$FAQ',
        Answer = '$FAQAnswer'
        WHERE FID = $ID";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION["FAQUpdate"] = "FAQ Updated Successfully";
        header("location:" . ADMIN_HOME_URL . 'Admin/ManageFAQ.php');
        exit();
    } else {
        $_SESSION["FAQUpdate"] = "Failed to update FAQ";
        header("location:" . ADMIN_HOME_URL . 'Admin/ManageFAQ.php');
        exit();
    }
}
?>

</body>

<?php
include('HFpart/footer.php');
?>
</html>
