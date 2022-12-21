<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php
    //include contants file
    include('../config/constants.php');
    // echo "Delete Page";
    //chck if id and image name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the value and delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file
        if($image_name!= ""){
            //image is available. so remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);
            
            //if failed to remove image then add an error message and stop the process
            if($remove==FALSE){
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove the Category Image</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-categories.php');
                //stop the process
                die();
            }
        }

        //delete data from the database
        //sql query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the data is deleted from the database or not
        if($res==TRUE){
            //set success message and redirect
            $_SESSION['delete'] = "<div class='seccess'>Category Deleted Successfully</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-categories.php');
        }
        else{
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Deleted Category</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-categories.php');
        }
        //redirect to manage category page with message

    }
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin.manage-categories.php');
    }
?>