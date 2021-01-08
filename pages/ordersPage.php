<!--

@author Holland Aucoin
@name Hydroflask Website
@desc ordersPage - This is a page that shows a user's orders, or the admin can see all orders

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Orders</title>

	<?php
	
	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Include the orderBusinessService to create an instance
	include_once('../classes/business/orderBusinessService.php');
	
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
    
    // Create instance of orderBusinessService
    $orderService = new orderBusinessService();

    // If an admin is logged in
    if (isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") {
        
        // If the cost variable is set
        if(isset($_GET['cost'])) {
            // Call getOrdersByCost in the orderBusinessService and set to $orders
            $orders = $orderService->getOrdersByCost();
        }
        // If the date variables are set
        else if(isset($_POST['startDate']) && isset($_POST['endDate'])) {
            // Call getOrdersLimitDate in the orderBusinessService and set to $orders
            $orders = $orderService->getOrdersLimitDate($_POST['startDate'], $_POST['endDate']);
        }
        else {
            // Call getOrders in the orderBusinessService and set to $orders (by date)
            $orders = $orderService->getOrders();
        }
    }
    // Else, a regular customer is logged in
    else {
        if(isset($_GET['cost'])) {
            // Call getUserOrdersByCost in the orderBusinessService and set to $orders
            $orders = $orderService->getUserOrdersByCost();
        }
        // If the date variables are set
        else if(isset($_POST['startDate']) && isset($_POST['endDate'])) {

            // Call getUserOrdersLimitDate in the orderBusinessService and set to $orders
            $orders = $orderService->getUserOrdersLimitDate($_POST['startDate'], $_POST['endDate']);
        }
        else {
            // Call getUserOrders in the orderBusinessService and set to $orders (by date)
            $orders = $orderService->getUserOrders();
        }
    }
    
    // Get today's date
    $today = date("Y-m-d");

    ?>
    
	<main class="page blog-post-list">
        <section class="clean-block clean-blog-list dark">
            <div class="container">
            
            <?php if(isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") { ?>
            		<br>
                    <a href="ordersJSON.php"><button class="btn btn-primary" style="float: right">Export Orders</button></a>
            <?php } ?>

                <div class="block-heading">
                    <h2 class="text-info">Orders</h2>
                </div>
                <form action="ordersPage.php" method="POST">
                    <div align="left" style="float: left; padding-left: 15px; padding-top: 15px">
                        <input type="date" id="start" name="startDate" value="2020-01-01" min="2020-01-01" max="<?php echo $today ?>">
                    	<input type="date" id="start" name="endDate" value="<?php echo $today ?>" min="2020-01-01" max="<?php echo $today ?>">
                    	<input type="submit" class="btn btn-outline-primary btn-sm" style="float: right; margin-left: 5px" value="Search">
                    </div>
                </form>
                <div align="right" style="float: right; padding-right: 15px; padding-top: 15px">
                	<a href="ordersPage.php"><button class="btn btn-outline-primary btn-sm" style="float: right">Date</button></a>
                	<a href="ordersPage.php?cost=set"><button class="btn btn-outline-primary btn-sm" style="float: right; margin-right: 5px">Cost</button></a>
                	<h6 style="float: right; padding-top: 5px; padding-right: 15px">Order By:</h6>
                </div>
                <div class="block-content">
                	<div align="center">
                        <?php if(isset($_POST['startDate']) && isset($_POST['endDate'])) { ?>
                			<h6>Showing orders from <?php echo $_POST['startDate'] . " to " . $_POST['endDate']?></h6><br>
               			<?php } ?>
               		</div>
                	<!-- Top bar of titles for each column -->
                    <div class="clean-blog-post" style="padding-bottom:30px">
                        <div class="row" align="center">
                            <div class="col-lg-7 col-xl-5">
                                <h3>Order Number</h3>
                            </div>
                            <div class="col">
                            	<h3>Date</h3>
                            </div>
                            <div class="col">
                            	<h3>Price</h3>
                            </div>
                            <div class="col-xl-2">
                            	<h3>Details</h3>
                            </div>
                        </div>
                        <hr style="height: 0.5px; background-color: black">
                    </div>
                
                <?php 
                
                // Create index to tell when it is the last item in the array of orders
                $index = 0;
                
                // For each order in the array of orders
                foreach ($orders as $order) { 
                
                    // Separate the date into an array
                    $dateArray = explode(" ", $order->getDate());

                    // Incredement index
                    $index++;
                ?>
                    <form action="orderDetailsPage.php" method="POST">
                        <div class="clean-blog-post" style="padding-bottom:30px">
                            <div class="row" align="center">
                                <div class="col-lg-7 col-xl-5">
                                	<!-- Hidden orderId variable being passed to orderDetailsPage to get corresponding details -->
                                    <input type="hidden" name="orderId" id="orderId" value="<?php echo $order->getId() ?>">
                                    <input type="submit" class="buttonlink" style="color: black; font-size: 24px" value="<?php echo "#" . $order->getOrderNumber() ?>">
                                </div>
                                <div class="col" style="padding: 0px">
                                	<div class="info"><span class="text-muted" style="font-size: 16px"><?php echo $dateArray[1] ?></span></div>
                                	<div class="info"><span class="text-muted" style="font-size: 16px"><?php echo $dateArray[0] ?></span></div>
                                </div>
                                <div class="col"><h6><?php echo "$" . $order->getCost() ?></h6></div>
                                <div class="col-xl-2"><input class="btn btn-outline-primary" type="submit" value="See More"></div>
                            </div>
                            	<!-- If its not the last item, add a horizontal line -->
                            	<?php if($index != count($orders)) { ?>
                            		<hr style="padding-bottom: 0px">
                                <?php }?>
                        </div>
                    </form>
                    
                <?php 
                
                }
                
                if(count($orders) == 0){
                    echo "There are no orders that match the dates entered.";
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


