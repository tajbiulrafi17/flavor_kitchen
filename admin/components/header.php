<?php 
    include('../config/constants.php');
    include('login-check.php');
?>



<html>
    <head>
        <title>Flavor Kitchen</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>

        <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="../images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="header text-right">
                <ul>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
        <!-- Menu Section Ends -->