<!--

@author Holland Aucoin
@name Hydroflask Website
@desc discountsPage - This is a page that allows the admin to add and delete discounts

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Discounts</title>

	<?php
	
	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Include the orderBusinessService to create an instance
	include_once('../classes/business/discountBusinessService.php');
	
	// Start the session if its not started
	if(!isset($_SESSION)) {
	    include 'session.php';
	}
	
    // Security check to protected pages
	if(!isset($_SESSION['userId']) || $_SESSION['userRole'] != "Admin") {
        header("Location: loginPage.php");
    }

    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html')

    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php');
    
    // Create instance of discountBusinessService
    $discountService = new discountBusinessService();

    // Call getDiscounts in the discountBusinessService and set to $discounts
    $discounts = $discountService->getDiscounts();

    ?>
    
	<main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Discounts</h2>
                </div>
                <form action="addDiscountPage.php">
                    <div align="right" style="float: right; padding-right: 20px; padding-top: 20px">
                    	<a href=""><input class="btn btn-outline-primary" type="submit" style="float: right; font-size: 20px" value="+"></a>
                    </div>
                </form>
                <div class="block-content">
                	<!-- Top bar of titles for each column -->
                    <div class="clean-blog-post" style="padding-bottom:30px">
                        <div class="row" align="center">
                            <div class="col-lg-7 col-xl-5">
                                <h3>Name</h3>
                            </div>
                            <div class="col">
                            	<h3>Code</h3>
                            </div>
                            <div class="col">
                            	<h3>Amount</h3>
                            </div>
                            <div class="col">
                            	
                            </div>
                        </div>
                        <hr style="height: 0.5px; background-color: black">
                    </div>
                
                <?php 
                
                // Create index to tell when it is the last item in the array of discounts
                $index = 0;
                
                // For each discount in the array of discounts
                foreach ($discounts as $discount) { 

                    // Incredement index
                    $index++;
                ?>
                    <form onsubmit="return confirm('Are you sure you want to delete this discount?')" action="discountHandler.php" method="POST">
                        <div class="clean-blog-post" style="padding-bottom:30px">
                            <div class="row" align="center">
                                <div class="col-lg-7 col-xl-5">
                                	<!-- Hidden discountId variable being passed to discountHandler to get delete corresponding discount -->
                                    <input type="hidden" name="discountId" id="discountId" value="<?php echo $discount->getId() ?>">
                                    <input type="hidden" name="delete" id="delete" value="delete">
                                    
                                    <p style="color: black; font-size: 20px"><?php echo $discount->getName() ?></p>
                                </div>
                                <div class="col" style="padding: 0px">
                                	<div class="info"><span class="text-muted" style="font-size: 18px"><?php echo $discount->getDiscountCode() ?></span></div>
                                </div>
                                <div class="col"><p style="font-size: 18px"><?php echo "$" . $discount->getAmount() ?></p></div>
                                <div class="col-xl-2"><input class="btn btn-outline-primary" type="submit" value="X"></div>
                            </div>
                            	<!-- If its not the last item, add a horizontal line -->
                            	<?php if($index != count($discounts)) { ?>
                            		<hr style="padding-bottom: 0px">
                                <?php }?>
                        </div>
                    </form>
                    
                <?php 
                
                }
                
                // If there are no discounts
                if(count($discounts) == 0){
                    echo "There are no current discounts";
                }
                
                ?>
                
                
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


