<?php include('components-front/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>My Cart Items</h1>

        <br /><br />

                

                    <?php 

                        $sn=1;
                        $intotal=0;
                        $item ="";
					    if (isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
                            
                    ?>
                    <table class="tbl-full" style="width: 100%;">
                    <tr>
                        <th>S.N.</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>

                    <?php

						    foreach ($_SESSION['cart'] as $key => $value) {
                                $item = $item.$value['Name'].'['.$value['Qty'].'], ';
                                $total = $value['Price']*$value['Qty'];
						        $intotal = $intotal+$total;	
							
				    ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($value['Image']=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="<?php echo $value['Image'] ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $value['Name']; ?></td>
                                    <td><?php echo $value['Price']; ?>TK</td>
                                    <td><?php echo $value['Qty']; ?></td>
                                    <td><?php echo $total; ?>TK</td>

                                    
                                    <td>
                                        <form action="cart-manage.php" method="POST">
                                            <input type="hidden" name="name" value="<?php echo $value['Name']; ?>">
							                <button name="remove_item" class="btn btn-danger">Remove</button>
							                
						                </form>
                                    </td>
                                </tr>

                                <?php
                            }

                            ?>

                                <tr class="total" >
					                <td colspan="5" style="border-top:solid"><h3>Total Amount</h3></td>
					                <td style="border-top:solid"><h3><?php echo $intotal; ?>TK</h3></td>
                                    <td style="border-top:solid">     
                                </td>
                                    
				                </tr> 

                            </table>
        
                            <div class="container">
                                
                                <h3 class="text-center">Fill this form to confirm your order.</h3>

                                <form action="order.php" method="POST" class="order" accept-charset="uft-8">
                                    
                                    <fieldset class="field-set">
                                        <legend>Delivery Details</legend>
                                        <div class="order-label">Full Name</div>
                                        <input type="text" name="full-name" placeholder="E.g. Tajbiul" class="input-responsive" required>

                                        <div class="order-label">Phone Number</div>
                                        <input type="tel" name="contact" placeholder="E.g. 01xxxxxxxxx" class="input-responsive" required>

                                        <div class="order-label">Email</div>
                                        <input type="email" name="email" placeholder="E.g. tajbiul@gmail.com" class="input-responsive" required>

                                        <div class="order-label">Address</div>
                                        <textarea name="address" rows="10" placeholder="E.g. Street, City" class="input-responsive" required></textarea>
                                            
                                        <input type="hidden" name="amount" value="<?php echo $intotal; ?>">
                                        <input type="hidden" name="item" value="<?php echo $item; ?>">

                                        <input type="submit" name="order" value="Proceed" class="btn btn-secondary" style="float: right;">
                                        
                                    </fieldset>

                                </form>

                            </div>
    

                            <?php
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> No item added on cart. </td> </tr>";
                        }

                    ?>

                    
                

        

    </div>
    
</div>

<?php include('components-front/footer.php'); ?>