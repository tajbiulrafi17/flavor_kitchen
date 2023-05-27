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
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

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


                    
                        <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="pk_test_51NAdgRGlMd3WOK0U7OraE89ArJOSN0plx6JDB4mdMnBjwtK8rgmDuODsQELpZUan4UgvOQk7nrGeMeXMrF3keknF00nU2T6VDw"
                        data-amount=<?php echo str_replace(",","",$amount) * 100?>
                        data-name="Flavor Kitchen"
                        data-description="Feel like your own kitchen"
                        data-image="images/logo-square.png"
                        data-currency="bdt"
                        data-locale="auto">
                        </script>
                     



                </fieldset>

            </form>


        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


<?php include('components-front/footer.php'); ?>