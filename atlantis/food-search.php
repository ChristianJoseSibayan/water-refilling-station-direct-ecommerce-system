<!-- Christian Jose Sibayan·BSCS IV-A·2022 -->

<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <!-- <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"Momo"</a></h2>

        </div>
    </section> -->
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- food menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <?php
                //get the search keyword
                // $search = ($_POST['search']); "old"
                $search = mysqli_real_escape_string($conn, $_POST['search']);

            ?>
            <h2 class="text-center">Search Result for <a href="#" class="">"<?php echo $search;?>"</a> </h2>
            
            <?php
                //get the source keyword
                

                //sql query to get product based on search keyword
                //$search = slim'
                // "SELECT * FROM tbl_water WHERE title LIKE '%%' OR description LIKE '%%'";
                $sql = "SELECT * FROM tbl_water WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0){
                    //avail
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == ""){      
                                            //img not avail
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

                                    <a href="order.html" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else{
                   //not avil 
                   echo "<div class='error'>Product not Found</div>";
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