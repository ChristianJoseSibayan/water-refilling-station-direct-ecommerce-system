<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php
    //inlude constants page
    include('../config/constants.php');

    // echo "Delete Product Page";
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //process delete
        // echo "Deleted";
        //1. Get the id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. remove the image if available
        //check if image is available or not and delete oonly if available
        if($image_name != ""){
            // it has image and need to remove from folder
            //get the image path
            $path = "../images/product/".$image_name;

            //remove image file from folder
            $remove = unlink($path);

            //check if the image is removed or not
            if($remove==FALSE){
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove the Image</div>";
                //redirect to manage product
                header('location:'.SITEURL.'admin/manage-products.php');
                //stop the process of deleting
                die();
            }
        }

        //3. Delete product from database
        $sql = "DELETE FROM tbl_water WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed or not and set the session respectively
        //4. redirect to manage food with session
        if($res==TRUE){
            //product deleted
            $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-products.php');
        }
        else{
            //failed to delete product
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Product</div>";
            header('location:'.SITEURL.'admin/manage-products.php');
        }
    }
    else{
        //redirect to manage products page
        // echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-products.php');
    }
?>