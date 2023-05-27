<?php include('components-front/header.php'); 
    $startTime = microtime(true);
?>


        <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                require_once("cache.class-old.php");

                $cache = new Cache('cache');

                $cacheMaxAge = 60;

                $cacheCat = $cache->read('resCat', $cacheMaxAge);

                if($cacheCat!= NULL){
                    $res = json_decode($cacheCat, true);
                }
                else{
                    //Create SQL Query to Display CAtegories from Database
                    $sql = "SELECT id, title, image FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                    //Execute the Query
                    $res = mysqli_query($conn, $sql);
                    //Count rows to check whether the category is available or not
                
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        $array =array();
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $array[] = $row;
                        }
                    }

                    $cache->write('resCat', json_encode($array));
                    $cacheCat = $cache->read('resCat', $cacheMaxAge);
                    $res = json_decode($cacheCat, true);

                }         

                if($res)
                {
                    //CAtegories Available
                   foreach($res as $row)
                    {
                        //Get the Values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display MEssage
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Food Category Image" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

             $cache = new Cache('cache');

                $cacheMaxAge = 60;

                $cacheFood = $cache->read('resFood', $cacheMaxAge);

                if($cacheFood!= NULL){
                    $res2 = json_decode($cacheFood, true);
                }
                else{
                    //Create SQL Query to Display CAtegories from Database
                    $sql2 = "SELECT id,title,price,description,image FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);
                    //Count rows to check whether the category is available or not
                
                    $count = mysqli_num_rows($res2);

                    if($count>0)
                    {
                        $array =array();
                        while($row=mysqli_fetch_assoc($res2))
                        {
                            $array[] = $row;
                        }
                    }

                    $cache->write('resFood', json_encode($array));
                    $cacheFood = $cache->read('resFood', $cacheMaxAge);
                    $res2 = json_decode($cacheFood, true);

                }         

            if($res2)
            {
                //CAtegories Available
                foreach($res2 as $row)
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Check whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" loading="lazy" alt="Food Image" class="img-responsive img-curve">
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
                //Food Not Available 
                echo "<div class='error'>Food not available.</div>";
            }
            
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php 

$endTime = microtime(true);
// echo 'Execution time '.number_format($endTime - $startTime, 10).' seconds';

include('components-front/footer.php'); 

?>

