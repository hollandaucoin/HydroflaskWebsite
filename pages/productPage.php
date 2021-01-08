<!--

@author Holland Aucoin
@name Hydroflask Website
@desc productPage - This is a page that shows the details of a single product

-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Product</title>
    
    <?php 
    
    // Error reporting support
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // Start the session if its not started
    if(!isset($_SESSION)) {
        include 'session.php';
    }
    
    // Get the productType and productId through POST request
    $productType = $_POST['type'];
    $productId = $_POST['id'];
    
    // If the product type is a bottle
    if($productType == "bottle") {
        
        // Include the bottleBusinessService to create an instance
        include_once('../classes/business/bottleBusinessService.php');
        
        // Create instance of bottleBusinessService
        $bottleService = new bottleBusinessService();
        // Call getBottleFromId method in bottleBusinessService and set to variable
        $product = $bottleService->getBottleFromId($productId);
        
    }
    // If the product type is a boot
    else if($productType == "boot") {
        
        // Include the bootBusinessService to create an instance
        include_once('../classes/business/bootBusinessService.php');
        
        // Create instance of bootBusinessService
        $bootService = new bootBusinessService();
        // Call getBootFromId method in bootBusinessService and set to variable
        $product = $bootService->getBootFromId($productId);
        
    }
    // If the product type is a lid
    else if($productType == "lid") {
        
        // Include the lidBusinessService to create an instance
        include_once('../classes/business/lidBusinessService.php');
        
        // Create instance of lidBusinessService
        $lidService = new lidBusinessService();
        // Call getLidFromId method in lidBusinessService and set to variable
        $product = $lidService->getLidFromId($productId);
        
    }
    
    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html');
    
    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
	<?php include_once('../fragments/navbar.php');?>
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container"><br><br>
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery">
                                    <div class="sp-wrap">
                                    <a href="<?php echo $product->getPhoto()?>"><img class="img-fluid d-block mx-auto" src="<?php echo $product->getPhoto()?>"></a>
                                    <a href="../assets/img/details/coupleBeach.jpg"><img class="img-fluid d-block mx-auto" src="../assets/img/details/coupleBeach.jpg"></a>
                                    <a href="../assets/img/details/pinkBike.jpg"><img class="img-fluid d-block mx-auto" src="../assets/img/details/pinkBike.jpg"></a></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info"><br><br>
                                    <h3><?php echo $product->getSize() . "<br><b>" . $product->getName() . "</b> - " ?><i><?php echo $product->getColor()?></i></h3>
                                    <br><hr width=500px>
                                    
                                    <?php //if($productType == "bottle") {?>
  <!--                                    <div class="rating" style="color: black">Colors: <img class="imagehover" src="../assets/img/details/Black.png"/><img class="imagehover" src="../assets/img/details/Cobalt.png"/>
<!--                                     								<img class="imagehover" src="../assets/img/details/Fog.png"/><img class="imagehover" src="../assets/img/details/Hibiscus.png"/> -->
<!--                                     								<img class="imagehover" src="../assets/img/details/Olive.png"/><img class="imagehover" src="../assets/img/details/Pacific.png"/> -->
<!--                                     								<img class="imagehover" src="../assets/img/details/Spearmint.png"/><img class="imagehover" src="../assets/img/details/Stone.png"/> -->
<!--                                     								<img class="imagehover" src="../assets/img/details/Sunflower.png"/><img class="imagehover" src="../assets/img/details/Watermelon.png"/> -->
<!--                                     								<img class="imagehover" src="../assets/img/details/White.png"/></div> -->
                                    <?php //} ?>
                                    
                                    <div align="right">Free shipping on orders <br> of $30 or more!</div>
                                    
                                    <div class="price">
                                        <h3>$<?php echo $product->getPrice()?></h3>
                                    </div>
                                    
                                    <?php if(isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") {?>
                                    	        
                                    	        <form action="editProductPage.php" method="POST">
                                            	    <!-- Product ID and type variables needed on editProductPage (hidden) -->
                                        			<input type="hidden" name="type" id="type" value="<?php echo $productType?>">
                                        			<input type="hidden" name="id" id="id" value="<?php echo $product->getId()?>">
                                        			
                                                	<div align=center style="float: left; padding-left: 5px; padding-bottom: 5px; padding-top: 30px">
                                                    	<input class="btn btn-outline-primary btn-lg" style="width: 100px" type="submit" value="Edit">
                                                    	</div>
		                                       	</form>
		                                       	<form onsubmit="return confirm('Are you sure you want to delete this?')" action="adminProductHandler.php" method=POST>
		                                       		<div align=center style="float: left; padding-bottom: 30px; padding-left: 5px; padding-top: 30px">
		                                       		    <!-- Hidden attributes to tell the adminHandler the product id, type, and that the action is deletion -->
                                        				<input type="hidden" name="type" id="type" value="<?php echo $productType?>">
                                        				<input type="hidden" name="delete" id="delete" value="delete">
                                        				<input type="hidden" name="id" id="id" value="<?php echo $product->getId()?>">
        											 	
                                                    	<input class="btn btn-outline-primary btn-lg" type="submit" value="Delete">
		                                       		</div>
		                                       	</form>
		                                       	<br><br><br><br>
		                                       	
                                    <?php } else { ?>
                                    	<form action="cartHandler.php" method="POST">
                                	            <!-- Product ID and type variables needed in cartHandler (hidden) -->
                                    			<input type="hidden" name="type" id="type" value="<?php echo $productType?>">
                                    			<input type="hidden" name="id" id="id" value="<?php echo $product->getId()?>">
                                    			<input type="hidden" name="add" id="add" value="add">
                                    			
                                    			<input class="btn btn-primary" style="height: 55px ; width: 150px" type="submit" value="Add to Cart">
										</form><br><br>
                                    <?php } ?>
                                    
                                    <div class="summary">
                                        <h5>Product Benefits</h5>
                                        <p><?php echo $product->getDescription()?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($productType == "bottle") {?>
                    <div class="product-info">
                        <div>
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" id="description-tab" href="#description">Features</a></li>
                                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" id="specifications-tabs" href="#specifications">Specifications</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane active fade show description" role="tabpanel" id="description">
                                    <p>Keeping your fluid intake on the upside is easy when you’ve got this portable travel buddy. Whether you’re headed to the gym or a quick 
                                    jaunt across town, you can easily take your refreshment with you. See it's feaures below!</p>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <figure class="figure"><img class="img-fluid figure-img" src="../assets/img/details/feature1.png"></figure>
                                        </div>
                                        <div class="col-md-7">
                                            <h4><b>TempShield™</b></h4>
                                            <p>Our unique double wall vacuum insulation protects temperature for hours. Cold drinks stay icy cold and hot drinks stay piping hot so you can stay refreshed for any adventure.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 right">
                                            <h4><b>Pro-Grade Stainless Steel</b></h4>
                                            <p>Made with 18/8 pro-grade stainless steel to ensure pure taste and no flavor transfer - and the durable construction stands up for whatever life brings.</p>
                                        </div>
                                        <div class="col-md-5">
                                            <figure class="figure"><img class="img-fluid figure-img" src="../assets/img/details/feature2.png"></figure>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <figure class="figure"><img class="img-fluid figure-img" src="../assets/img/details/feature3.png"></figure>
                                        </div>
                                        <div class="col-md-7">
                                            <h4><b>Proprietary Powder Coat</b></h4>
                                            <p>Our proprietary powder coat means an easy-grip, sweat-free, and extra-durable bottle that you can take anywhere.</p>
                                        </div>
                                    </div>
                                    <div align="center"><br>
                                    	<a href="bottlesPage.php?offset=0"><button class="btn btn-outline-primary btn-lg" type="button">Shop More</button></a>
                                    </div>
                                </div>
                                <div class="tab-pane fade show specifications" role="tabpanel" id="specifications">
                                    <div class="table-responsive table-bordered">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="stat">Size</td>
                                                    <td><?php echo $product->getSize()?></td>
                                                </tr>
                                                <tr>
                                                    <td class="stat">Volume</td>
                                                    <td><?php echo $product->getVolume()?> mL</td>
                                                </tr>
                                                <tr>
                                                    <td class="stat">Height</td>
                                                    <td><?php echo $product->getHeight()?>"</td>
                                                </tr>
                                                <tr>
                                                    <td class="stat">Weight</td>
                                                    <td><?php echo $product->getWeight()?> oz</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
