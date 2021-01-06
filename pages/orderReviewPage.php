<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc orderReviewPage - This is a page that shows the user a review of their order

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Order Review</title>

	<?php

	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Include the cartBusinessService and business services for each product to create instances
	include_once('../classes/business/userBusinessService.php');
	include_once('../classes/business/addressBusinessService.php');
	include_once('../classes/business/cartBusinessService.php');
	include_once('../classes/business/bottleBusinessService.php');
	include_once('../classes/business/bootBusinessService.php');
	include_once('../classes/business/lidBusinessService.php');

	// Start the session if its not started
	if(!isset($_SESSION)) {
	    include 'session.php';
	}

    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html')

    ?>
</head>

<body>
	<!-- Custom navbar to ensure user checks out-->
    	<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container">
        	<a class="navbar-brand logo"><img src="../assets/img/main/hydrologo.png" height="35px" width="28px" style="padding-bottom:8px">  H Y D R O F L A S K</a>
        </div>
    </nav>

    <main class="page shopping-cart-page">
        <section class="clean-block clean-cart dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Order Review</h2>
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
                                   
                                // For each cart in carts, create display the item in grid
                                foreach($carts as $cart) {
                                    
                                    if($cart->getProductType() == "bottle") {
                                        
                                        // Create instance of bottleBusinessService
                                        $bottleService = new bottleBusinessService();
                                        // Call getBottleFromId method in bottleBusinessService and set to variable
                                        $product = $bottleService->getBottleFromId($cart->getProductId());
                                    }
                                    else if($cart->getProductType() == "boot") {
                                        
                                        // Create instance of bootBusinessService
                                        $bootService = new bootBusinessService();
                                        // Call getBootFromId method in bootBusinessService and set to variable
                                        $product = $bootService->getBootFromId($cart->getProductId());
                                        
                                    }
                                    else if ($cart->getProductType() == "lid") {
                                        
                                        // Create instance of lidBusinessService
                                        $lidService = new lidBusinessService();
                                        // Call getLidFromId method in lidBusinessService and set to variable
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

                                            	<div class="col-6 col-md-2 quantity">
                                                	<label class="d-none d-md-block" for="quantity">Quantity</label>
                                                	<label id="number"><?php echo $cart->getQuantity()?></label>
                                                	<br>
                                                </div>
    										
    										<div class="col-6 col-md-2 price"><span><?php echo "$" . $product->getPrice()?></span></div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    // Continuously add to total by multiplying the price and the quantity of each product
                                    $subtotal += $product->getPrice() * $cart->getQuantity();
                                    
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
                                }
                                else {
                                    $discount = 0;
                                }
                                
                                // Calculate total using subtotal, tax, and shipping costs
                                $total = $subtotal + $tax + $shipping - $discount;

                                // Set subtotal and total to 2 decimals
                                $finalSubtotal = sprintf('%0.2f', $subtotal);
                                $finalTotal = sprintf('%0.2f', $total);
                                
                                // Create instance of userBusinessService
                                $userService = new userBusinessService();
                                // Call getUserFromId method in userBusinessService and set to variable
                                $user = $userService->getUserFromId($_SESSION['userId']);
                              
                                // Set variables to the session variables of the address obejct, billing address object, and cardInfo array
                                $address = $_SESSION['address'];
                                $billing = $_SESSION['billing'];
                                $card = $_SESSION['card'];
                                
                                ?>

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <form action="orderHandler.php" method=POST>
                            
                            	<!-- Pass finalTotal as hidden to orderHandler -->
                                <input type="hidden" id="total" name="total" value="<?php echo $finalTotal ?>">
                            
                            	<div class="summary">
                                    <h3>Order Information</h3>
                                    <h4><span class="text">Name</span><span class="price"><?php echo $user->getFirstName() . " " . $user->getLastName()?></span><br></h4>
                                    <h4><span class="text">Shipping Address</span><span class="price"><?php echo $address->getStreetAddress() . "<br>" . $address->getCity() . ", " . $address->getState() . "<br>" . $address->getZipCode() . " - " . $address->getCountry()?></span><br><br><br></h4>
									
                                    <h4><span class="text">Payment Method</span><span class="price"><?php echo $card[0] . "<br>" . $card[1] . "<br>Ex: " . $card[2] . "/" . $card[3] . "  CVC: " . $card[4]?></span><br><br><br></h4>
                                    <h4><span class="text">Billing Address</span><span class="price"><?php echo $billing->getStreetAddress() . "<br>" . $billing->getCity() . ", " . $billing->getState() . "<br>" . $billing->getZipCode() . " - " . $billing->getCountry()?></span><br><br><br></h4>

                                    <h4><span class="text">Costs</span><span class="price" style="text-align: right"><?php echo "Subtotal: $" . $finalSubtotal . "<br><br><b>Total: $" . $finalTotal . "</b>"?></span></h4>
                                    
                                    <h4><span class="text"></span><span class="price"></span><br></h4>
                                    
                                	<button class="btn btn-primary btn-block btn-lg" type="submit">Order</button>
                                	
                                		<a href="cartPage.php" style="text-decoration: none"><button class="btn btn-primary btn-block btn-lg editbtn" type="button">Edit Cart</button></a>
										<a href="checkoutPage.php" style="text-decoration: none"><button class="btn btn-primary btn-block btn-lg editbtn" type="button">Change Information</button></a>
								</div>
								
                            </form>
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
