<?php    
    
    //session start
    session_start();

    // //---------- HOSTING on 000webhost -------------------------

    // define('SITEURL', 'https://flavorkitchen482.000webhostapp.com/');

    //     // Database configuration    
    // define('DB_HOST', 'localhost');   
    // define('DB_USERNAME', 'id20831625_flavor_kitchen_database'); 
    // define('DB_PASSWORD', 'Flavorkitchen123@');   
    // define('DB_NAME', 'id20831625_flavor_kitchen_database'); 
 
    // //--------------------------------------------------------


    //---------- For Localhost -------------------------

    // define('name','value') // create constant value
    define('SITEURL', 'http://localhost/flavor_kitchen/');


    // Database configuration    
    define('DB_HOST', 'localhost');   
    define('DB_USERNAME', 'root'); 
    define('DB_PASSWORD', '');   
    define('DB_NAME', 'flavor_kitchen_database'); 

    //--------------------------------------------------------

    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);     
    if ($db->connect_errno) {   
        printf("Connect failed: %s\n", $db->connect_error);   
        exit();   
    }

    define('STRIPE_API_KEY', 'sk_test_51NAdgRGlMd3WOK0UfSxH4t0fY5upYIXODxr0XII6SU6yLrjkDHNJcTcuNf8Jlch8i0lmXySZsUOsPObZAvV1ON0100zXb2f1tj'); 
    define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51NAdgRGlMd3WOK0U7OraE89ArJOSN0plx6JDB4mdMnBjwtK8rgmDuODsQELpZUan4UgvOQk7nrGeMeXMrF3keknF00nU2T6VDw'); 
    define('STRIPE_SUCCESS_URL', SITEURL.'payment-success.php'); //Payment success URL 
    define('STRIPE_CANCEL_URL', SITEURL.'payment-cancel.php'); //Payment cancel URL 


    
?>