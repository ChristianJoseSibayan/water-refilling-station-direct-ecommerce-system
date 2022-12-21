<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <!-- <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"Momo"</a></h2>

        </div>
    </section> -->
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Product List</h2>

            <?php
                //display food that are active
                $sql = "SELECT * FROM tbl_water WHERE active='Yes'";

                //execute the query
                $res=mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                //check if the product are available
                if($count>0){

                    while($rows=mysqli_fetch_assoc($res)){
                    //get the value
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $description = $rows['description'];
                    $price= $rows['price'];
                    $image_name = $rows['image_name'];      
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //image available?
                                    if($image_name == ""){
                                        //img not avail
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else{
                                        //img avail
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
                    //product not avail
                    echo "<div class='error'>Product and Found</div>";
                }

            ?>

            

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="index.html">Search Product</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>