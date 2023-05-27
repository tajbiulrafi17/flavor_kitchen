<?php
    session_start();



		if (isset($_POST['btn'])){

			    $id = $_POST['id'];
    			$name = $_POST['name'];
    			$image = $_POST['image'];
    			$price = $_POST['price'];
    			$quantity = $_POST['qty'];

            if (isset($_SESSION['cart'])) 
			{
				$count = count($_SESSION['cart']);
				$_SESSION['cart'][$count]= array('Id' => $id, 'Name'=>$name, 'Image'=>$image, 'Price'=>$price,'Qty'=>$quantity);
				// echo "<script>
				// 		alert('Item  added in cart');
				// 		window.location.href='index.php';
				// 	</script>";

                header("location:foods.php?true=created");
				

			}else{
				$_SESSION['cart'][0]= array('Id' => $id, 'Name'=>$name, 'Image'=>$image, 'Price'=>$price,'Qty'=>$quantity);
				// echo "<script>
				// 		alert('Item  added in cart');
				// 		window.location.href='index.php';
				// 	</script>";

                header("location:foods.php?true=created");
			}
		}


		if (isset($_POST['remove_item'])) {
			foreach($_SESSION['cart'] as $key => $value){
				if ($value['Name']==$_POST['name']) {
					unset($_SESSION['cart'][$key]);
					$_SESSION['cart']=array_values($_SESSION['cart']);
					header("location:cart-view.php?true=created");
				}
			}
		}


    
?>