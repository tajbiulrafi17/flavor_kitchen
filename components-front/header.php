<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Flavor Kitchen Website.">
    <title>Flavor Kitchen</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">


</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="header text-right">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="foods.php">Foods</a></li>
                    <?php 
					$count=0;
					if (isset($_SESSION['cart'])) {
						$count=count($_SESSION['cart']);
					}
				    ?>
                    <li><a href="cart-view.php"><img src="images/cart.png" alt="cart logo" height="30px"><sup><?php echo $count; ?></sup></a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->