<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php
    //Authorizartion - Access Control
    //Check whether the use is login or not
    if(!isset($_SESSION['user'])){ //if the user session is not set
        //user not logged in
        //redirect to login page with message
        $_SESSION['not-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>