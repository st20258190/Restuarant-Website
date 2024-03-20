<?php

    if (!isset($_SESSION["UserLogged"])) {
       
        $_SESSION["AccessDenied"] = "Please Log into the System";
        header("Location:" . ADMIN_HOME_URL . 'Admin/Login.php');
    }





?>