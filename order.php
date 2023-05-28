<?php include('components-front/header.php'); ?>

    <?php
        if (isset($_POST['order'])){
            $amount = $_POST['amount'];
            $item = $_POST['item'];

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-order">
        <div class="container">

                <!-- Display errors returned by checkout session -->
		<div id="paymentResponse" class="text-white"></div>
            
            <h2 class="text-center text-white">Confirm your order.</h2>

            <form action="checkout.php" method="POST" class="order" accept-charset="uft-8">

                <fieldset class="text-white">
                    <legend>Your Selected item</legend>

                    <h3><?php echo $item; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $item; ?>">

                </fieldset>
                <fieldset class="text-white">
                    <legend>Payable Amount</legend>

                    <h3><?php echo $amount; ?> TK</h3>
                    <input type="hidden" name="amount" value="<?php echo $amount; ?>">

                </fieldset>

                
                <fieldset class="text-white">
                    <legend>Delivery Details</legend>
                    <p>Full Name: <b><?php echo $customer_name; ?></b></p>
                    <br>
                    <p>Phone Number: <b><?php echo $customer_contact; ?></b></p>
                    <br>
                    <p>Email: <b><?php echo $customer_email; ?></b></p>
                    <br>
                    <p>Address: <b><?php echo $customer_address; ?></b></p>
                    <br>
                    
                    <input type="hidden" name="full-name" value="<?php echo $customer_name; ?>">
                    <input type="hidden" name="contact" value="<?php echo $customer_contact; ?>">
                    <input type="hidden" name="email" value="<?php echo $customer_email; ?>">
                    <input type="hidden" name="address" value="<?php echo $customer_address; ?>">

                        <!-- <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="pk_test_51NAdgRGlMd3WOK0U7OraE89ArJOSN0plx6JDB4mdMnBjwtK8rgmDuODsQELpZUan4UgvOQk7nrGeMeXMrF3keknF00nU2T6VDw"
                        data-amount=<?php echo str_replace(",","",$amount) * 100?>
                        data-name="Flavor Kitchen"
                        data-description="Feel like your own kitchen"
                        data-image="images/logo-square.png"
                        data-currency="bdt"
                        data-locale="auto">
                        </script> -->

                </fieldset>

                <fieldset >
                <!-- Buy button -->
				<div id="buynow" >
                    <<a href="cart-view.php"class="btn btn-primary" id="cart" style="float: left;"> Back to Cart </a> 
					<button class="btn btn-secondary" id="payButton" style="float: right;"> Proceed to Pay </button>
				</div>
                </fieldset>

            </form>




        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    
    <!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<script>

var buyBtn = document.getElementById('payButton');
var responseContainer = document.getElementById('paymentResponse');    
// Create a Checkout Session with the selected product

// Specify Stripe publishable key to initialize Stripe.js
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

buyBtn.addEventListener("click", function (evt) {
    buyBtn.disabled = true;
    buyBtn.textContent = 'Please wait...';
    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            console.log("Error")
            handleResult(data);
        }
    });
});

var createCheckoutSession = function (stripe) {
    return fetch("payment-init.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            checkoutSession: 1,
			Item:"<?php echo $item; ?>",
			Price:"<?php echo $amount; ?>",
			Currency:"bdt",
            CustomerName:"<?php echo $customer_name; ?>",
            CustomerContact:"<?php echo $customer_contact; ?>",
            CustomerEmail:"<?php echo $customer_email; ?>",
            CustomerAddress:"<?php echo $customer_address; ?>",
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
var handleResult = function (result) {
    if (result.error) {
        responseContainer.innerHTML = '<p>'+result.error.message+'</p>';
    }
    buyBtn.disabled = false;
    buyBtn.textContent = 'Buy Now';
};


</script>

<?php include('components-front/footer.php'); ?>