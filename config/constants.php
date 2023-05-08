<?php    
    
    //session start
    session_start();

    // define('name','value') // create constant value
    define('SITEURL', 'http://localhost/flavor_kitchen/');
    
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
    $db_select = mysqli_select_db($conn, 'flavor_kitchen_database') or die(mysqli_error());
    
?>