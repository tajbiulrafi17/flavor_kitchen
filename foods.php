<?php include('components-front/header.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
                <form action="<?php echo SITEURL; ?>food-search.php" method="GET" id="form-search">
                    <div class="form-group">
                        <input type="search" name="search" class="form-control"placeholder="Search for Food.." autocomplete="off" required>
                        <input type="submit" name="submit" value="Search" class="btn btn-primary">
                    
                    </div>
                    <div class="live-search-result">
                        <ul class="search-result " type="none">

                        </ul>
                    </div>
                    
                </form>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //Display Foods that are Active
                $sql = "SELECT * FROM food WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether the foods are availalable or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //CHeck whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" loading="lazy" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?> TK</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <form action="cart-manage.php" method="POST">
                                    <label for="qty">Quantity:</label>
                                    <input type="number" name="qty" id="qty"class="" value="1" min="1" max="10"required>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="name" value="<?php echo $title; ?>">
                                    <input type="hidden" name="image" value="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>">
                                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                                    <br>
                                    <input type="submit" name="btn" value="Add to Cart" class="btn btn-primary" style="margin-top:10px">
                                </form>
                                
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Food not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>


            <div class="clearfix"></div>


        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('components-front/footer.php'); ?>


