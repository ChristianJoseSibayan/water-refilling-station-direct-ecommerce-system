<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>
        <!-- Add Category From Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>   
            </table>

        </form>
        <!-- Add Category From Starts -->

        <?php 
            //check if the submit button is clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";

                //1. get the value from category form
                $title = mysqli_real_escape_string($conn, $_POST['title']);

                //for rasio inpu type, check if the button is selected or not
                if(isset($_POST['featured'])){
                    //get the value from form
                    $featured = $_POST['featured'];
                }
                else{
                    //set the default value
                    $featured = "No";
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }

                //check if the image is selected or not and set the value for the image name accordingly
                // print_r($_FILES['image']);

                // die(); //break the code here

                if(isset($_FILES['image']['name'])){
                    //upload image
                    //uploadto upload image, we need image name, source path, and distination path
                    $image_name = $_FILES['image']['name'];

                    //upload the image only if image is selected
                    if($image_name != ""){
                        
                        //auto rename the image
                        //get the extension of image (jpg, png,...)
                        $ext = end(explode('.', $image_name));

                        //rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check if the image is uploaded or not
                        //if the image is not uploaded, it will stop process and redirect with error message
                        if($upload==FALSE){
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            //redirect to add-category.php
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();
                        }
                    }
                }                
                else{
                    //don't upload image and set the image_name value as blank
                    $image_name = "";
                }

                //2. Create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                //3. execute the query and save to database
                $res =  mysqli_query($conn, $sql);

                //4. check if the query is executed or not
                if($res==TRUE){
                    //query executed and category added    
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.<div>";
                    //redirect to manage-category page
                    header('location:'.SITEURL.'admin/manage-categories.php');
                }
                else{
                    //failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //redirect to manage-category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }


            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>