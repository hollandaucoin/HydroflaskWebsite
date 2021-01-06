<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc editProductPage - This is a page that allows an admin to edit a product

-->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Edit Product</title>
    
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

    // Get the type and productId through POST request
    $type = $_POST['type'];
    $productId = $_POST['id'];
    
    // If the product is a bottle
    if($type == "bottle") {
        
        // Include the bottleBusinessService to create an instance
        include_once('../classes/business/bottleBusinessService.php');
        // Create instance of bottleBusinessService
        $productService = new bottleBusinessService();
        // Call getBottleFromId method in bottleBusinessService and set to variable
        $product = $productService->getBottleFromId($productId);
    }
    // If the product is a boot
    else if($type == "boot") {
        
        // Include the bootBusinessService to create an instance
        include_once('../classes/business/bootBusinessService.php');
        // Create instance of bootBusinessService
        $productService = new bootBusinessService();
        // Call getBootFromId method in bootBusinessService and set to variable
        $product = $productService->getBootFromId($productId);
    }
    // If the product is a lid
    else if($type == "lid") {
        
        // Include the lidBusinessService to create an instance
        include_once('../classes/business/lidBusinessService.php');
        // Create instance of lidBusinessService
        $productService = new lidBusinessService();
        // Call getLidFromId method in lidBusinessService and set to variable
        $product = $productService->getLidFromId($productId);
    }

    
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
                    <h2 class="text-info">Edit <?php echo $type?></h2>
                </div>
                                	
                <!-- Form to add a new user, sends to adminProductHandler -->
                <form action="adminProductHandler.php" method="POST">
                    <div align=right>
                    	<?php if ($type == "bottle") { ?>
                				<a href="bottlesPage.php?offset=0"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                   		<?php }
                   		       else if ($type == "boot") { ?>
                   		       <a href="bootsPage.php?offset=0"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                   		<?php }
                   		       else if ($type == "lid") { ?>
                   		       <a href="lidsPage.php?offset=0"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                   		<?php } ?>
                    </div>
                    
                    <!-- Hidden attribute to tell the adminProductHandler to edit the product, the id and the type -->
                    <input type="hidden" name="edit" id="edit" value="edit">
                    <input type="hidden" name="id" id="id" value="<?php echo $product->getId()?>">
                    <input type="hidden" name="type" id="type" value="<?php echo $type?>">
                    
                    <div class="form-group" style="padding-top: 10px"><input class="form-control item" type="text" maxlength="100" placeholder="name" name="name" id="name" value="<?php echo $product->getName()?>" required></div>
                    <div class="form-group"><textarea class="form-control item" rows="5" cols="100" placeholder="description" name="description" id="description" required><?php echo $product->getDescription()?></textarea></div>
                    <div class="form-group"><input class="form-control item" type="number" step="0.01" placeholder="price" name="price" id="price" value="<?php echo $product->getPrice()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="text" placeholder="color" name="color" id="color" value="<?php echo $product->getColor()?>" required></div>
                    
                    <?php if ($type == "bottle") { ?>
                    	<div class="form-group"><input class="form-control item" type="number" placeholder="volume (mL)" name="volume" id="volume" value="<?php echo $product->getVolume()?>" required></div>
                    	<div class="form-group"><input class="form-control item" type="number" step="0.01" placeholder="height (inches)" name="height" id="height" value="<?php echo $product->getHeight()?>" required></div>
                    	<div class="form-group"><input class="form-control item" type="number" step="0.01" placeholder="weight (oz.)" name="weight" id="weight" value="<?php echo $product->getWeight()?>" required></div>             

                        <div align="center">
                        	<label style="padding-right:20px">Size:</label>
                        	<input type="radio" name="size" id="size" value="18oz." required>18oz.
                        	<input type="radio" name="size" id="size" value="21oz.">21oz.
                        	<input type="radio" name="size" id="size" value="24oz.">24oz.
                        	<input type="radio" name="size" id="size" value="32oz.">32oz.
                        	<input type="radio" name="size" id="size" value="40oz.">40oz.
                        	<input type="file" name="photo" id="photo" required>
                        </div>
                    
                     <?php } else { ?> 
                    
                    	<div align="center">
                        	<label style="padding-right:20px">Size:</label>
                        	<input type="radio" name="size" id="size" value="Standard" required>Standard
                        	<input type="radio" name="size" id="size" value="Wide">Wide
                        	<input type="file" name="photo" id="photo" required>
                        </div>
                    
                    <?php }?>
                    
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Save</button>
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