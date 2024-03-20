<?php

include('../Admin/DataBase/Dbconn.php');

    session_destroy();
    header("Location:" . ADMIN_HOME_URL . 'Admin/Login.php');


?>