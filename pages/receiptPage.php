<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc receiptPage - This is a page that gives the user a receipt confirmation of their order

-->

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Order Confirmation</title>

	<?php 
	
	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Include the bottleBusinessService to create an instance
	include_once('../classes/business/userBusinessService.php');
	
	// Start the session if its not started
	if(!isset($_SESSION)) {
	    include 'session.php';
	}
	
	// Create an instance of orderDataService, passing in the database connection
	$userService = new userBusinessService();
	// Call getUserFromId method in userBusinessService
	$user = $userService->getUserFromId($_SESSION['userId']);

    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html');
    
    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php')?>
    
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
            	<!-- Heading -->
                <div class="block-heading">
                    <h2 class="text-info"><?php echo "Order #". $_SESSION['orderNumber'] ." Successful!" ?></h2>
                </div>
                <!-- Form -->
                <form action="homePage.php">
                	<p align=center><?php echo "Thank you for your order " . $user->getFirstName() . "! <br>You will receive a confirmation email at <b>" . $user->getEmail() . 
                	"</b>. If you have any questions or concerns about your order please <a href='contactPage.php'>contact us</a> as soon as possible. You can also find
                        your order details in the 'Orders' page in your account."?></p>
					<br>
                    <button class="btn btn-primary btn-block" type="submit" name="submit">Continue</button>
                </form>
            </div>
        </section>
    </main>
    
    <?php 
    
    // Unset session variables
    unset($_SESSION['address']);
    unset($_SESSION['billing']);
    unset($_SESSION['card']);
    unset($_SESSION['orderNumber']);
    unset($_SESSION['discount']);
    unset($_SESSION['discountCode']);
    
    ?>
    
    <!-- Include the footer page fragment -->
    <footer class="page-footer dark">
		<?php include_once('../fragments/footer.html')?>
    </footer>
    
    <!-- Include the scripts page fragment -->
    <?php include_once('../fragments/scripts.html')?>

</body>
</html>