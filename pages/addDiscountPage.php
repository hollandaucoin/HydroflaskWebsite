<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc addDiscountPage - This is a page that allows an admin user to add a discount code

-->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Add Discount</title>
    
    <?php 
    
    // Error reporting support
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // Start the session if its not started
    if(!isset($_SESSION)) {
        include 'session.php';
    }
    
    // Security check to keep page protected from regular users
    if(!isset($_SESSION['userId']) || $_SESSION['userRole'] != "Admin") {
        header("Location: loginPage.php");
    }
    
    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html');
    
    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php')?>
    
	<main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <!-- Header -->
                <div class="block-heading">
                    <h2 class="text-info">Add Discount</h2>
                </div>
                                	
                <!-- Form to add a new discount, sends to discountHandler -->
                <form action="discountHandler.php" method="POST">
                    <div align=right>
                		<a href="discountsPage.php"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                    </div>
                    
                    <!-- Hidden attribute to tell the discountHandler to add the product and the type -->
                    <input type="hidden" name="add" id="add" value="add">
                    
                    <!-- If the message variable is set, display it (error) -->                    
                    <?php if(isset($message)) {
				        ?><p align=center><?php echo $message?></p><?php
				          }
				    ?>	
                    
                    <div class="form-group" style="padding-top: 10px"><input class="form-control item" type="text" maxlength="100" placeholder="name" name="name" id="name" required></div>
                    <div class="form-group"><input class="form-control item" type="text" placeholder="discount code" name="discountCode" id="discountCode" required></textarea></div>
                    <div class="form-group"><input class="form-control item" type="number" step="0.01" placeholder="amount" name="amount" id="amount" required></div>
                    
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Add</button>
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