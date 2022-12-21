<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php
    //Start Session
    session_start();

    //Create Contants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/atlantis/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'water-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysql_error()); //Selecting Database
?>