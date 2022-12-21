<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Product</h1>
        <br>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class=tbl-30>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Product Title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="22" rows="10" placeholder="Product Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="num" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php 
                                //php code to display categories from database
                                //1. SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                //exwcute the query
                                $res = mysqli_query($conn, $sql);

                                //count rows to check if there is categories or not
                                $count = mysqli_num_rows($res);

                                //if count is graeter than zero, we have categories else we donnot have categories
                                if($count>0){
                                    //we have categories
                                    while($row = mysqli_fetch_assoc($res)){
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title']; 

                                        ?>
                                            <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                        <?php

                                    }
                                }
                                else{
                                    //there is no category
                                    ?>

                                    <option value="0">No Category Found</option>

                                    <?php
                                }
                                
                                //2. Display on dropdown
                            ?>
 
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
                
            </table>

        </form>

        <?php
            //check if th button is clicked or not
            if(isset($_POST['submit'])){
                //add the product in the database
                // echo "Clicked";

                //1. Get the data from form
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $category = $_POST['category'];

                //check if radio buttin for feature and active are checked or not 
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No";
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }

                //2. upload the image into the database
                //check if the select image is clicked or not and upload the image only if the imgae is selected  
                if(isset($_FILES['image']['name'])){
                    //get the datails of the selected image
                    $image_name = $_FILES['image']['name'];

                    //check if the image is selected or not
                    if($image_name != ""){
                        // image is selected
                        //A. rename the image
                        //get the extention of the selected image
                        $ext = end(explode('.', $image_name));

                        //create new name for image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //new image name

                        //B. upload the image
                        // get the source path and destiantion path

                        //souce path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //destiantion path or the image to be uploaded
                        $dst = "../images/product/".$image_name;

                        //upload the product image
                        $upload = move_uploaded_file($src, $dst);

                        //check if the imge is uploaded or not
                        if($upload==FALSE){
                            //failed to upload the image
                            //redirect to add product page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-product.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else{
                    $image_name = ""; //setting default value as blank
                }

                //3. insert into database

                //sql query to save or add product
                $sql2 = "INSERT INTO tbl_water SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                ";

                //executer query
                $res2 = mysqli_query($conn, $sql2);
                
                //check if data inserted or not
                //4. redirect with message to manage product page
                if($res==TRUE){
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Product Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-products.php');
                }
                else{
                    //failed to insert the data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Product</div>";
                    header('location:'.SITEURL.'admin/manage-products.php');
                }

            }
        ?>

    </div>
</div>



<?php include('partials/footer.php');?>