<?php

//start Session
session_start();

// url for redirect to the homepage
define("ADMIN_HOME_URL", 
"http://localhost/The Outer Clove Restuarant Website/");

// Define constants for database connection
define("LOCALHOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "outer_clove_web");

// Establish a connection to the MySQL database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the  database (outer_clove_web) on the established connection
$db_select = mysqli_select_db($conn, DB_NAME);

// Check if the database selection was successful
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}

?>
