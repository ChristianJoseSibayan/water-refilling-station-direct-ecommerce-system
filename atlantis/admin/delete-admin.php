<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php
    //Include constans.php file here
    include('../config/constants.php');

    //1. Get the ID of admin to be deleted
    $id = $_GET['id'];

    //2. Create sql query to delte admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //check whether the query is executed successfully
    if($res==TRUE){
        //query executed successfully
        //echo "Admin deleted";
        //Create system variable to display message 
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //Redirect to manage admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //failed to delete admin
        //echo "Failed to delted admin";

        $_SESSION['delete'] = "<div class='error'>Failed to delete adminm, try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. Redirect to manage admin page with massage (success/error)

?>