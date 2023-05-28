<?php include('components-front/header.php'); ?>

<?php 
// Include configuration file  
require_once 'config/constants.php'; 
 
$payment_id = $statusMsg = ''; 
$status = 'error'; 
 
// Check whether stripe checkout session is not empty 
if(!empty($_GET['session_id'])){ 

    $session_id = $_GET['session_id']; 
    $food = $_GET['food'];
    $total = $_GET['total'];

    $cus_name = $_GET['n'];
    $cus_email = $_GET['e'];
    $cus_contact = $_GET['c'];
    $cus_address = $_GET['a'];
    $order_status = "Ordered";
    $order_date = date("Y-m-d h:i:sa");


    //----------------- Transaction table work------------------------------- 
    // Fetch transaction data from the database if already exists 
    $sqlQ = "SELECT * FROM transactions WHERE stripe_checkout_session_id = ?"; 
    $stmt = $db->prepare($sqlQ);  
    $db_session_id = $session_id; 
    $stmt->bind_param("s", $db_session_id);
    $stmt->execute(); 
    $result = $stmt->get_result(); 
 
    if($result->num_rows > 0){ 
        // Transaction details 
        $transData = $result->fetch_assoc(); 
        $payment_id = $transData['id']; 
        $transactionID = $transData['txn_id']; 
        $paidAmount = $transData['paid_amount']; 
        $paidCurrency = $transData['paid_amount_currency']; 
        $payment_status = $transData['payment_status']; 
         
        $customer_name = $transData['customer_name']; 
        $customer_email = $transData['customer_email']; 
         
        $status = 'success'; 
        $statusMsg = 'Your Payment has been Successful!'; 
    }else{

                    //----------------- Order table work------------------------------- 
    
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";

                    unset($_SESSION['cart']);
                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        total = $total,
                        order_date = '$order_date',
                        status = '$order_status',
                        customer_name = '$cus_name',
                        customer_phone = '$cus_contact',
                        customer_email = '$cus_email',
                        customer_address = '$cus_address'
                    ";

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //----------------- Order table work------------------------------- 

        // Include the Stripe PHP library 
        require_once 'stripe-php/init.php'; 
         
        // Set API key 
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 
         
        // Fetch the Checkout Session to display the JSON result on the success page 
        try { 
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id); 
        } catch(Exception $e) {  
            $api_error = $e->getMessage();  
        } 
         
        if(empty($api_error) && $checkout_session){ 
            // Get customer details 
            $customer_details = $checkout_session->customer_details; 
 
            // Retrieve the details of a PaymentIntent 
            try { 
                $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent); 
            } catch (\Stripe\Exception\ApiErrorException $e) { 
                $api_error = $e->getMessage(); 
            } 
             
            if(empty($api_error) && $paymentIntent){ 
                // Check whether the payment was successful 
                if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){ 
                    // Transaction details  
                    $transactionID = $paymentIntent->id; 
                    $paidAmount = $paymentIntent->amount; 
                    $paidAmount = ($paidAmount/100); 
                    $paidCurrency = $paymentIntent->currency; 
                    $payment_status = $paymentIntent->status; 
                     
                    // Customer info 
                    $customer_name = $customer_email = ''; 
                    if(!empty($customer_details)){ 
                        $customer_name = !empty($customer_details->name)?$customer_details->name:''; 
                        $customer_email = !empty($customer_details->email)?$customer_details->email:''; 
                    } 
                     
                    // Check if any transaction data is exists already with the same TXN ID 
                    $sqlQ = "SELECT id FROM transactions WHERE txn_id = ?"; 
                    $stmt = $db->prepare($sqlQ);  
                    $stmt->bind_param("s", $transactionID); 
                    $stmt->execute(); 
                    $result = $stmt->get_result(); 
                    $prevRow = $result->fetch_assoc(); 
                     
                    if(!empty($prevRow)){ 
                        $payment_id = $prevRow['id']; 
                    }else{ 
                        // Insert transaction data into the database 
                        $sqlQ = "INSERT INTO transactions (customer_name,customer_email,item_name,paid_amount,paid_amount_currency,txn_id,payment_status,stripe_checkout_session_id,created,modified) VALUES (?,?,?,?,?,?,?,?,NOW(),NOW())"; 
                        $stmt = $db->prepare($sqlQ); 
                        $stmt->bind_param("sssdssss", $customer_name, $customer_email, $food, $paidAmount, $paidCurrency, $transactionID, $payment_status, $session_id); 
                        $insert = $stmt->execute(); 
                         
                        if($insert){ 
                            $payment_id = $stmt->insert_id; 
                        } 
                    } 
                     
                    $status = 'success'; 
                    $statusMsg = 'Your Payment has been Successful!'; 
                }else{ 
                    $statusMsg = "Transaction has been failed!"; 
                } 
            }else{ 
                $statusMsg = "Unable to fetch the transaction details! $api_error";  
            } 
        }else{ 
            $statusMsg = "Invalid Transaction! $api_error";  
        } 

    } 
          

}else{ 
    $statusMsg = "Invalid Request!"; 
} 
?>

<?php if(!empty($payment_id)){ ?>

    <div class="main-content">
    <div class="wrapper">
        <h1 class="<?php echo $status; ?>"><?php echo $statusMsg; ?></h1>
        <br><br>
        <h3>Payment Information</h3>
        <br>
        <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
        <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
        <p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
        <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
        <br>
        <h3>Customer Information</h3>
        <p><b>Name:</b> <?php echo $customer_name; ?></p>
        <p><b>Email:</b> <?php echo $customer_email; ?></p>
        <br>
        <h3>Product Information</h3>
        <p><b>Item:</b> <?php echo $food; ?></p>
        <p><b>Total Price:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
        <br><br>
        <a href="index.php" class="btn btn-secondary">Back to Product Page</a>

    </div>
    </div>
<?php }else{ ?>
    <h1 class="error">Your Payment been failed!</h1>
    <p class="error"><?php echo $statusMsg; ?></p>
<?php } ?>

<?php include('components-front/footer.php'); ?>