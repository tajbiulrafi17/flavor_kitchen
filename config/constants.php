<?php    
    

    //session start
    session_start();

    // define('name','value') // create constant value
    define('SITEURL', 'http://localhost/flavor_kitchen/');

 
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
    $db_select = mysqli_select_db($conn, 'flavor_kitchen_database') or die(mysqli_error());

        // Database configuration    
    define('DB_HOST', 'localhost');   
    define('DB_USERNAME', 'root'); 
    define('DB_PASSWORD', '');   
    define('DB_NAME', 'flavor_kitchen_database'); 

    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);     
    if ($db->connect_errno) {   
        printf("Connect failed: %s\n", $db->connect_error);   
        exit();   
    }
 

    define('STRIPE_API_KEY', 'sk_test_51NAdgRGlMd3WOK0UfSxH4t0fY5upYIXODxr0XII6SU6yLrjkDHNJcTcuNf8Jlch8i0lmXySZsUOsPObZAvV1ON0100zXb2f1tj'); 
    define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51NAdgRGlMd3WOK0U7OraE89ArJOSN0plx6JDB4mdMnBjwtK8rgmDuODsQELpZUan4UgvOQk7nrGeMeXMrF3keknF00nU2T6VDw'); 
    define('STRIPE_SUCCESS_URL', 'http://localhost/flavor_kitchen/payment-success.php'); //Payment success URL 
    define('STRIPE_CANCEL_URL', 'http://localhost/flavor_kitchen/payment-cancel.php'); //Payment cancel URL 


    
?>