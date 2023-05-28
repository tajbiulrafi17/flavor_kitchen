<?php 
 
// Include the configuration file 
require_once 'config/constants.php'; 
 
// Include the Stripe PHP library 
require_once 'stripe-php/init.php'; 
 
// Set API key 
$stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 
 
$response = array(
    'status' => 0,
    'error' => array(
        'message' => 'Invalid Request!'   
    )
);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$input = file_get_contents('php://input');
	$request = json_decode($input);	
}
if (json_last_error() !== JSON_ERROR_NONE) {
	http_response_code(400);
	echo json_encode($response);
	exit;
}

$productName = $request->Item; 
$productPrice = $request->Price; 
$currency = $request->Currency;

$cus_name = $request->CustomerName;
$cus_contact = $request->CustomerContact;
$cus_email = $request->CustomerEmail;
$cus_address = $request->CustomerAddress;

// Convert product price to cent 
$stripeAmount = round($productPrice*100, 2); 
 
if(!empty($request->checkoutSession)){ 
    // Convert product price to cent 
    $stripeAmount = round($productPrice*100, 2); 
 
    // Create new Checkout Session for the order 
    try { 
        $checkout_session = $stripe->checkout->sessions->create([ 
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'product_data' => [
                        'name' => $productName,
                        // 'description' => $productName,
                    ],
                    'unit_amount' => $stripeAmount,
                    'currency' => $currency,
                ],
                'quantity' => 1,
                
            ]],
            'mode' => 'payment',
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}&food='.$productName.'&total='.$productPrice.'&n='.$cus_name.'&e='.$cus_email.'&c='.$cus_contact.'&a='.$cus_address, 
            'cancel_url' => STRIPE_CANCEL_URL, 
        ]); 
    } catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $checkout_session){ 
        $response = array( 
            'status' => 1, 
            'message' => 'Checkout Session created successfully!', 
            'sessionId' => $checkout_session->id 
        ); 
    }else{ 
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Checkout Session creation failed! '.$api_error    
            ) 
        ); 
    } 
} 
 
// Return response 
echo json_encode($response); 
 
?>