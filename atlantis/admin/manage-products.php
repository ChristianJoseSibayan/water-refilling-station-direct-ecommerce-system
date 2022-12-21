<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Products</h1>

        <br>

            <!-- Button to Add Admin -->
            <a href="<?php echo SITEURL;?>admin/add-product.php" class="btn-primary">Add Products</a>

            <br><br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorize'])){
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>

            <table class="tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Title:</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //create a query to get all the product
                    $sql = "SELECT * FROM tbl_water";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check if there are products
                    $count = mysqli_num_rows($res);

                    //create number varialble set default number as 1
                    $sn=1;

                    if($count>0){
                        //there a product in database
                        //get the product from database and display
                        while($row = mysqli_fetch_assoc($res)){
                            //get the value from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td><?php echo $price;?></td>
                                    <td>
                                        <?php
                                            //check if there are image or not
                                            if($image_name==""){
                                                //there is no image, display error message.
                                                echo "<div class='erro'>Image not Added</div>";
                                            }
                                            else{
                                                // display image
                                                ?>
                                                    <img src="<?php echo SITEURL;?>images/product/<?php echo $image_name;?>" width="100">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-product.php?id=<?php echo $id;?>" class="btn-secondary">Update Product</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-product.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Product</a>
                                    </td>
                                </tr>
                            <?php

                        }
                    }
                    else{
                        //product are not added in database
                        echo "<tr><td colspan='7' class='error'>Food not Added Yet</td></tr>";
                    }
                ?>     
                
            </table>
    </div>
</div>


<?php include("partials/footer.php") ?>