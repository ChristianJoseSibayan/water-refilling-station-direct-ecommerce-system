<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Product.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <br>
    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Product Categories</h2>

            <?php
                //create sql query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows to chech if the category is available
                $count = mysqli_num_rows($res);

                if($count>0){
                    //categories available
                    while($row=mysqli_fetch_assoc($res)){
                        //get value life id title image name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                    //check if image is available
                                    if($image_name==""){
                                        //display message
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else{
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="5 gallons" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                                <h3 class="float-text text-black"><?php echo $title;?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else{
                    //categories not available
                    echo "<div class='error'>Category Not Added</div>";
                }
            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    

    <!-- Product Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Product List</h2>

            <?php
                //getting product from database that are active and featured
                //sql query
                $sql2 = "SELECT * FROM tbl_water WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res);

                //check if product availble or not
                if($count2>0){
                    //product available
                    while($rows=mysqli_fetch_assoc($res2)){
                        //get all the details
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $price = $rows['price'];
                        $description = $rows['description'];
                        $image_name = $rows['image_name'];
                        ?>
                            <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check if image available or not
                                    if($image_name==""){
                                        //image not avail
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else{
                                        //image avail
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/product/<?php echo $image_name;?>" alt="Slim container: 5 gallons of mineral water." class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price">₱<?php echo $price;?></p>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?product_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
            </div>  
                        <?php

                    }
                }
                else{
                    echo "<div class='error'>Product Not Availble</div>";
                }
            ?>

            <div class="clearfix"></div>
            
        </div>

        <p class="text-center">
            <a href="#">Search Product</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>