
<?php
    include("config/constants.php");

    require_once "stripe-php/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51NAdgRGlMd3WOK0UfSxH4t0fY5upYIXODxr0XII6SU6yLrjkDHNJcTcuNf8Jlch8i0lmXySZsUOsPObZAvV1ON0100zXb2f1tj",
        "publishableKey" => "pk_test_51NAdgRGlMd3WOK0U7OraE89ArJOSN0plx6JDB4mdMnBjwtK8rgmDuODsQELpZUan4UgvOQk7nrGeMeXMrF3keknF00nU2T6VDw"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);

    $token = $_POST["stripeToken"];
    $token_card_type = $_POST["stripeTokenType"];

    $order_date = date("Y-m-d h:i:sa"); //Order DAte

    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    $amount          = $_POST["amount"]; 
    $desc            = $_POST["food"];


    $email = $_POST['email'];


    $charge = \Stripe\Charge::create([
      "amount" => str_replace(",","",$amount) * 100,
      "currency" => 'bdt',
      "description"=>$desc,
      "source"=> $token,
    ]);

    if($charge){
        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";

        unset($_SESSION['cart']);

                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$desc',
                        total = $amount,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_phone = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }
        
    }
    else
    {
        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
        header('location:'.SITEURL.'order.php');
    }

?>