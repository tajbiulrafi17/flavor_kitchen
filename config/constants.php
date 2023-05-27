<?php    
    

    //session start
    session_start();

    // define('name','value') // create constant value
    define('SITEURL', 'http://localhost/flavor_kitchen/');

 
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
    $db_select = mysqli_select_db($conn, 'flavor_kitchen_database') or die(mysqli_error());


    // Product Details  
// Minimum amount is $0.50 US  
$productName = "Codex Demo Product";  
$productID = "DP12345";  
$productPrice = 55; 
$currency = "usd"; 
  
/* 
 * Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY', 'sk_test_51NAdgRGlMd3WOK0UfSxH4t0fY5upYIXODxr0XII6SU6yLrjkDHNJcTcuNf8Jlch8i0lmXySZsUOsPObZAvV1ON0100zXb2f1tj'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51NAdgRGlMd3WOK0U7OraE89ArJOSN0plx6JDB4mdMnBjwtK8rgmDuODsQELpZUan4UgvOQk7nrGeMeXMrF3keknF00nU2T6VDw'); 
define('STRIPE_SUCCESS_URL', 'http://localhost/flavor_kitchen/payment-success.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'http://localhost/flavor_kitchen/payment-cancel.php'); //Payment cancel URL 

    
    
?>