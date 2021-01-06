<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc accountPage - This is a page that shows a user's account details

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Order Details</title>

	<?php
	
	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Include the orderBusinessService, userBusinessService, and addressBusinessService to create an instance
	include_once('../classes/business/orderBusinessService.php');
	include_once('../classes/business/userBusinessService.php');
	include_once('../classes/business/addressBusinessService.php');
	
	include_once('../classes/business/bottleBusinessService.php');
	include_once('../classes/business/bootBusinessService.php');
	include_once('../classes/business/lidBusinessService.php');
	
	// Start the session if its not started
	if(!isset($_SESSION)) {
	    include 'session.php';
	}
	
    // Security check to protected pages
	if(!isset($_SESSION['userId']) || $_SESSION['userId'] == 1) {
        header("Location: loginPage.php");
    }

    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html')

    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php');
    
    if(isset($_POST['orderId'])) {
        $id = $_POST['orderId'];
    }
    else {
        include('errorPage.php');
    }
    
    // Create an instance of orderBusinessService
    $orderService = new orderBusinessService();
    // Call getOrderFromId in the orderBusinessService and set to variable
    $order = $orderService->getOrderFromId($id);
    
    $products = $orderService->getOrderProducts($id);
    
    // Create an instance of userBusinessService
    $userService = new userBusinessService();
    // Call getUserFromId in the userBusinessService and set to variable
    $user = $userService->getUserFromId($order->getUserId());
    
    // Create an instance of addressBusinessService
    $addressService = new addressBusinessService();
    // Call getAddressFromId in the addressBusinessService and set to variable
    $address = $addressService->getAddressFromId($order->getShippingId());
    
        
    ?> 
 
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <!-- Header -->
                <div class="block-heading">
                    <h2 class="text-info">Order #<?php echo $order->getOrderNumber()?></h2>
                </div>
                
                <form>
                    <div align=right>
                		<a href="ordersPage.php"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                    </div>
                    
                	<table align="center">
                		<tr>
                			<td><p style="color: gray">Name:</p></td>
                			<td><p><?php echo $user->getFirstName() . " " . $user->getLastName()?></p></td>
                		</tr>
						<tr>
							<td style="padding-right: 20px"><p style="color: gray">Shipping:</p></td>
							<td><p><?php echo $address->getStreetAddress() . "<br>" . $address->getCity() . ", " . $address->getState() . "<br>" . $address->getZipCode() . " " . $address->getCountry()?></p></td>
						</tr>
						<tr>
							<td><p style="color: gray">Cost:</p></td>
							<td><p><?php echo "$" . $order->getCost()?></p></td>
						</tr>
						<tr>
							<td><p style="color: gray">Date:</p></td>
							<td><p><?php echo $order->getDate()?></p></td>
						</tr>
						
						<?php 
						
						$index = 0;
						
						// Iterate through the array of products
						foreach ($products as $product) {
						    
						    // Increment index
						    $index++;
						
						    // If the product is a bottle
						    if($product[1] == "bottle") {
						        // Create instance of bottleBusinessService and call getBottleFromId
						        $bottleService = new bottleBusinessService();
						        $productItem = $bottleService->getBottleFromId($product[0]);
						    }
						    // If the product is a boot
						    else if($product[1] == "boot") {
						        // Create instance of bootBusinessService and call getBootFromId
						        $bootService = new bootBusinessService();
						        $productItem = $bootService->getBootFromId($product[0]);
						    }
						    // If the product is a lid
						    else if ($product[1] == "lid") {
						        // Create instance of lidBusinessService and call getLidFromId
						        $lidService = new lidBusinessService();
						        $productItem = $lidService->getLidFromId($product[0]);
						        
						    }
						
						    // If its the first item, add products title
						    if($index == 1) { ?>

								<tr>
									<td><p style="color: gray">Product(s):</p></td>
									<td><p><?php echo $productItem->getName() . "<br><i>" . $productItem->getSize() . " - " . $productItem->getColor() . "</i>"?></p></td>
								</tr>
								<tr>
						    		<td></td>
									<td><img class="img-fluid d-block mx-auto" src="<?php echo $productItem->getPhoto()?>" height=220px width=175px></td>
								</tr>

						    <?php } else { ?>
						    
						    	<tr>
						    		<td></td>
									<td><p><?php echo $productItem->getName() . "<br><i>" . $productItem->getSize() . " - " . $productItem->getColor() . "</i>"?></p></td>
								</tr>
								<tr>
						    		<td></td>
									<td><img class="img-fluid d-block mx-auto" src="<?php echo $productItem->getPhoto()?>" height=220px width=175px></td>
								</tr>
						    
						    <?php }
						}
						?>
					</table>
            	</form>
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

