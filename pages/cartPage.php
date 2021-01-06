<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc cartPage - This is a page that shows a user their cart

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Cart</title>

	<?php

	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Include the cartBusinessService and business services for each product to create instances
	include_once('../classes/business/cartBusinessService.php');
	include_once('../classes/business/bottleBusinessService.php');
	include_once('../classes/business/bootBusinessService.php');
	include_once('../classes/business/lidBusinessService.php');

	// Start the session if its not started
	if(!isset($_SESSION)) {
	    include 'session.php';
	}
	
	// If the userId isn't set in the session, the products in the cart that were unassigned to a user will be deleted
	if(!isset($_SESSION["userId"])) {
	    
	    // Create instance of cartBusinessService
	    $clearCartService = new cartBusinessService();
	    // Set id to 1 and call clearCart method in cartBusinessService to clear any old items unclaimed to a user
	    $id = 1;
	    $clearCartService->clearCart($id);
	}

    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html')

    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php')?>

    <main class="page shopping-cart-page">
        <section class="clean-block clean-cart dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Shopping Cart</h2>
                </div>
                <div class="content">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-8">
                            <div class="items">
                            	<?php
                                
                                // Create instance of cartBusinessService
                                $cartService = new cartBusinessService();
                                // Call getCart method in cartBusinessService and set to variable
                                $carts = $cartService->getCart();
                   
                                $subtotal = 0;
                                
                                if(empty($carts)) {
                                    echo "<div align=center><br><i>Your cart is currently empty.</i><br><br>";
                                    echo "<a href='bottlesPage.php?offset=0'><input class='btn btn-outline-primary' type='submit' value='Shop Now'></a></div>";
                                }
                                else {
                                   
                                    // For each cart in carts, create display the item in grid
                                    foreach($carts as $cart) {
                                        
                                        // If the product is a bottle
                                        if($cart->getProductType() == "bottle") {
                                            // Create instance of bottleBusinessService and call getBottleFromId
                                            $bottleService = new bottleBusinessService();
                                            $product = $bottleService->getBottleFromId($cart->getProductId());
                                        }
                                        // If the product is a boot
                                        else if($cart->getProductType() == "boot") {
                                            // Create instance of bootBusinessService and call getBootFromId
                                            $bootService = new bootBusinessService();
                                            $product = $bootService->getBootFromId($cart->getProductId());
                                        }
                                        // If the product is a lid
                                        else if ($cart->getProductType() == "lid") {
                                            // Create instance of lidBusinessService and call getLidFromId
                                            $lidService = new lidBusinessService();
                                            $product = $lidService->getLidFromId($cart->getProductId());
                                            
                                        }
                                        
                                    ?>
                                    
                                    <div class="product">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-3">
                                                <form action="productPage.php" method=POST>
                                                    <!-- Product ID and type variables needed in productPage (hidden) -->
                                                	<input type="hidden" name="id" id="id" value="<?php echo $product->getId()?>">
                                                    <input type="hidden" name="type" id="type" value="<?php echo $cart->getProductType()?>">
                                                    <div class="product-image"><input type="image" class="img-fluid d-block mx-auto imagehover" src="<?php echo $product->getPhoto()?>"></div>
                                                </form>
                                            </div>
                                            
                                            <div class="col-md-4 product-info">
                                            	<form action="productPage.php" method=POST>
                                            	    <!-- Product ID and type variables needed in productPage (hidden) -->
                                                	<input type="hidden" name="id" id="id" value="<?php echo $product->getId()?>">
                                                    <input type="hidden" name="type" id="type" value="<?php echo $cart->getProductType()?>">
                                            		<button class="buttonlink" style="font-size: 16px; text-align: left; font-weight: bold" type="submit"><?php echo $product->getName()?></button>
                                            	</form>
                                                <div class="product-specs">
                                                    <div><span>Color:&nbsp;</span><span class="value"><?php echo $product->getColor()?></span></div>
                                                    <div><span>Size:&nbsp;</span><span class="value"><?php echo $product->getSize()?></span></div>
                                                </div>
                                            </div>
                                            
                                            <form action="cartHandler.php" method=POST>
                                                <!-- Cart ID and type variables needed in cartHandler (hidden) -->
                                    			<input type="hidden" name="id" id="id" value="<?php echo $cart->getId()?>">
                                    			<input type="hidden" name="edit" id="edit" value="edit">
                                    			<input type="hidden" name="type" id="type" value="type">
                                    			
                                            	<div class="col-6 col-md-2 quantity">
                                                	<label class="d-none d-md-block" for="quantity">Quantity</label>
                                                	<input type="number" id="number" name="number" class="form-control quantity-input" value="<?php echo $cart->getQuantity()?>">
                                                	<br>
    												<button class="buttonlink" type="submit">Update</button>
                                                </div>
                                            </form>
    										
    										<div class="col-6 col-md-2 price"><span><?php echo "$" . $product->getPrice()?></span></div>
                      
                                            <form onsubmit="return confirm('Are you sure you want to remove this from your cart?')" action="cartHandler.php" method=POST>
                                                <!-- Cart ID and type variables needed in cartHandler (hidden) -->
                                    			<input type="hidden" name="id" id="id" value="<?php echo $cart->getId()?>">
                                    			<input type="hidden" name="delete" id="delete" value="delete">
                                            	<div class="col-6 col-md-2 price">
                                            		<input class="btn btn-outline-primary" type="submit" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px" value="X">
                                            	</div>
                                        	</form>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    // Continuously add to total by multiplying the price and the quantity of each product
                                    $subtotal += $product->getPrice() * $cart->getQuantity();
                                    
                                    }
                                   
                                
                                }
                                // If the subtotal is over $30 or $0, shipping is free
                                if($subtotal > 30 || $subtotal == 0) {
                                    $shipping = 0;
                                }
                                // Else, set the price of shipping
                                else {
                                    $shipping = 4.95;
                                }
                                
                                // Calculate tax as 8.5%
                                $tax = $subtotal * 0.085;
                                
                                // If the discount session is set, set to variable
                                if(isset($_SESSION['discount'])) {
                                    $discount = $_SESSION['discount'];
                                    $finalDiscount = sprintf('%0.2f', $discount);
                                }
                                else {
                                    $finalDiscount = sprintf('%0.2f', 0);
                                }
                                
                                // Calculate total using subtotal, tax, and shipping costs
                                $total = $subtotal + $tax + $shipping - $finalDiscount;
                                
                                // Set all prices to 2 decimals
                                $finalShipping = sprintf('%0.2f', $shipping);
                                $finalTax = sprintf('%0.2f', $tax);
                                $finalSubtotal = sprintf('%0.2f', $subtotal);
                                $finalTotal = sprintf('%0.2f', $total);
                                
                                ?>
                                

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="summary">
                                <h3>Summary</h3>
                                <h4><span class="text">Subtotal</span><span class="price"><?php echo "$" . $finalSubtotal?></span></h4>
                                <h4><span class="text">Tax</span><span class="price"><?php echo "$" . $finalTax?></span></h4>
                                <h4><span class="text">Shipping</span><span class="price"><?php echo "$" . $finalShipping?></span></h4>
                                
                                    
                                <h4><span class="text">Discount</span><span class="price"><?php echo "- $" . $finalDiscount?></span></h4>
                                    
                               
                                
                                <h4><span class="text">Total</span><span class="price"><?php echo "$" . $finalTotal?></span></h4>
                                
                                <hr>
                                                 					
                 					<!-- If the message variable is set, display it (error) -->                    
                                    <?php if(isset($message)) {
                				        ?><p align=center><?php echo $message?></p><?php
                				          }
                				    ?>	
                                
                                <form action="discountHandler.php" method=POST>
                                	<div align="center" class="form-group" style="float: left; padding-right: 10px">
                                		<input class="form-control item" style="width: 225px" type="text" maxlength="10" placeholder="discount code" name="discountEntered" id="discountEntered">
                 					</div>
                 					<div align="center" style="float: left">
                 						<button class="btn btn-outline-primary discountbtn" style="background-color: white; width: 70px; height: 40px; margin: 0px" type="submit">Apply</button>
                 					</div>
                 				</form>
                                
                                <form action="checkoutPage.php" method=POST>
                                	<button class="btn btn-primary btn-block btn-lg" type="submit">Checkout</button>
                                </form>
                            </div>
  
                        </div>
                     
                        
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Include the footer page fragment -->
    <footer class="page-footer dark">
		<?php include_once('../fragments/footer.html')?>
    </footer>
    
    <!-- Include the scripts page fragment -->
    <?php include_once('../fragments/scripts.html')?>

</body>
</html>
