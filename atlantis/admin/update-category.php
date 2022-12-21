<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>

        <?php
            //check if the id is set or not
            if(isset($_GET['id'])){
                //get the id and all other details
                // echo "Getting the data";
                $id = $_GET['id'];
                //create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count the rows to check if the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1){
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    //redirect tp manage categories with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found</div>";
                    header('location:'.SITEURL.'admin/manage-categories.php');
                }
            }
            else{
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-categories.php');
            }
            
        ?>

        <form action="" method="POST" enctype="miltipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != ""){
                                //display the image
                                ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="500px" >
                                <?php
                            }
                            else{
                                //display message
                                echo "<div class='error'>Image not Added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" new="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                // echo "clicked";
                //1. get all the values from the form

                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. updating new image if selected
                //chech if the image is selected or not
                if(isset($_FILES['image']['name'])){
                    //get the image details
                    $image_name = $_FILES['image']['name'];
                    //check if the image is available
                    if($image_name != ""){
                        //image available

                        //A. upload the new image

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
                            header('location:'.SITEURL.'admin/manage-categories.php');
                            //stop the process
                            die();
                        }
                        
                        //B. remove the current image if available
                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);
    
                            //check if the image is removed or not
                            //if failed to remove then display message and stop the process
                            if($remove==false){
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove the Current Image</div>";
                                header('location:'.SITEURL.'admin/manage-categories.php');
                                die();//stop the process
                            }    
                        }
                        
                    }
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

                //3. update the database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
            
                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //4. redirect to manage category with message
                //check if ececuted or not
                if($res2==TRUE){
                    //category update
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-categories.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                    header('location:'.SITEURL.'admin/manage-categories.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?> 