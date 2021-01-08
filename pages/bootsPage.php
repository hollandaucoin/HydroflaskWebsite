<!--

@author Holland Aucoin
@name Hydroflask Website
@desc bootsPage - This is a page that shows all of the boot products

-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Boots</title>
    
    <?php 
    
    // Error reporting support
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // Include the bootBusinessService to create an instance
    include_once('../classes/business/bootBusinessService.php');
    
    // Start the session if its not started
    if(!isset($_SESSION)) {
        include 'session.php';
    }
    
    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html');
    
    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
	<?php include_once('../fragments/navbar.php');?>
    
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <!-- Heading -->
                <div class="block-heading">
                    <h2 class="text-info">Boots</h2>
                    </div>
                    
                    <!-- If the user's role is admin, show the add new button -->
        			<?php if (isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") { ?>
                    	
                    	<form action="addProductPage.php" method="POST">
                                        		
                        	<input type="hidden" name="type" id="type" value="boot">
                                        		
                            <div align=right>
                            	<input class="btn btn-primary" type="submit" style="width: 120px; height: 50px" value="Add New"><br><br>
                            </div>
                         </form>
                                           
                   	<?php } 
                   	      // Else, show the description
                   	      else { ?>
                   	
                   		<div align="center">
                    		<p style="width:80%">We have everything you need to keep your Hydro Flask collection fresh. From our popular Wide Mouth Straw 
                    		Lid and insulated Flex Caps to our protective Bottle Boots and Tag Along bottle slings, we have you covered.</p>
        				</div>
        				
                   	<?php } ?>
        			
                <div class="content">
                                
                <!-- If the message variable is set, display it (error) -->                    
                <?php if(isset($message)) { ?>
                	<br>
                	<p align=center><?php echo "<b>" . $message . "</b>"?></p>
                <?php } ?>	
                
                    <div class="row">
                        <!-- Side panel of category selection -->
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <div class="filters">
                                    <div align="center"><h3>Filter by Attribute</h3><br></div>
                                    <div class="filter-item">
                                        <h3>Size</h3>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtersize[]' id="formCheck-1" value="Standard"><label class="form-check-label" for="formCheck-1">Standard</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtersize[]' id="formCheck-2" value="Wide"><label class="form-check-label" for="formCheck-2">Wide</label></div>
                                    </div>
                                    <div class="filter-item">
                                        <h3>Color</h3>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-3" value="Black"><label class="form-check-label" for="formCheck-3">Black</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-4" value="Cobalt"><label class="form-check-label" for="formCheck-4">Cobalt</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-5" value="Olive"><label class="form-check-label" for="formCheck-5">Olive</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-6" value="Stone"><label class="form-check-label" for="formCheck-6">Stone</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-7" value="Sunflower"><label class="form-check-label" for="formCheck-7">Sunflower</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-8" value="Watermelon"><label class="form-check-label" for="formCheck-8">Watermelon</label></div>
                                    </div>
                                                                            
                                    <form action="filterHandler.php" id="form" method="POST">
                                        <input type='hidden' name='boot' id='boot'>
                                    	<input type='hidden' name='filtersize' id='filtersize'>
                                    	<input type='hidden' name='filtercolor' id='filtercolor'>
                                    	<div align="center"><input type='button' class="btn btn-primary btn-block" value='Filter' style="width: 70%" onclick='filter()'></div>
                            		</form>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Products grid -->
                        <div class="col-md-9">
                            <div class="products">
                                <div class="row no-gutters">
                                
                                <?php 
                                
                                // If the offset variable isn't set or is set to 0
                                if(!isset($_GET['offset']) || $_GET['offset'] == 0) {
                                    $offset = 0;
                                }
                                // Else, set the offset variable using GET
                                else {
                                    $offset = $_GET['offset'];
                                }
                                
                                // Create instance of bootBusinessService
                                $bootService = new bootBusinessService();
                                
                                // If the filterSql POST is set
                                if(isset($_POST['filterSql'])) {
                                    $sql = $_POST['filterSql'];
                                    $boots = $bootService->getBootsSearch($sql, $offset);
                                    
                                    if(count($boots) == 0) {
                                        
                                        echo "<br><br>There are no results that match your filter. Please refine your search and try again.<br><br><br>
                                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                                    }
                                }
                                // Else, filterSql POST is not set
                                else {
                                    // Call getBootsOffset method in bootBusinessService and set to variable
                                    $boots = $bootService->getBootsOffset($offset);
                                }
                                
                                // For each boot in boots, create display the item in grid
                                foreach($boots as $boot) {
                                    
                                ?>
                                
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">

                                                <!-- Form to send user to the product page and send needed variables -->
                                                <form action="productPage.php" method="POST">
                                                	<!-- Product type and ID variables needed on product page (hidden) -->
                                                	<input type="hidden" name="type" id="type" value="boot">
                                                	<input type="hidden" name="id" id="id" value="<?php echo $boot->getId()?>">
                                                    <!--  -->
                                                    <div class="image"><input type="image" class="img-fluid d-block mx-auto imagehover" src="<?php echo $boot->getPhoto()?>" height=220px width=175px></div>
                                                    <div class="product-name"><?php echo $boot->getSize() . " " . $boot->getName() . " - " ?><i><?php echo $boot->getColor()?></i>
                                                        <div class="price">
                                                            <h3>$<?php echo $boot->getPrice()?></h3>
                                                        </div>
                                                    </div>
                                                </form>
                                                        
                                                <!-- If the user is an admin, show edit and delete buttons -->
                                                <?php if (isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") { ?>
                                                
                                                <form action="editProductPage.php" method="POST">
                                            	    <!-- Boot ID and type variables needed on editProductPage (hidden) -->
                                        			<input type="hidden" name="type" id="type" value="boot">
                                        			<input type="hidden" name="id" id="id" value="<?php echo $boot->getId()?>">
                                        			
                                                	<div align=center style="float: left; padding-left: 5px; padding-bottom: 5px">
                                                    	<input class="btn btn-outline-primary btn-lg" style="width: 100px" type="submit" value="Edit">
                                                    	</div>
		                                       	</form>
		                                       	<form onsubmit="return confirm('Are you sure you want to delete this boot?')" action="adminProductHandler.php" method=POST>
		                                       		<div align=center style="float: left; padding-bottom: 30px; padding-left: 5px">
		                                       		    <!-- Hidden attributes to tell the adminHandler the product id, type, and that the action is deletion -->
                                        				<input type="hidden" name="type" id="type" value="boot">
                                        				<input type="hidden" name="delete" id="delete" value="delete">
                                        				<input type="hidden" name="id" id="id" value="<?php echo $boot->getId()?>">
        											 	
                                                    	<input class="btn btn-outline-primary btn-lg" type="submit" value="Delete">
		                                       		</div>
		                                       	</form>
                                                
                                                <?php } ?>
                                                
                                        </div>
                                    </div>
                                    
                                 <?php 

                                 }
                                    
                                 ?>
                                    
                                 </div>
                                 <!-- Create bar of buttons at the bottom for pagination -->
                                 <nav>
                                    <ul class="pagination">
                                    
                                    <?php 
                                    
                                    // Get the number of total boots
                                    if(isset($_POST['filterSql'])) {
                                        $countBoots = $bootService->getBootsSearchCount($sql);
                                    }
                                    else {
                                        // Call getBoots method in bootsBusinessService and set to variable
                                        $countBoots = count($bootService->getBoots());
                                    }
                                   
                                    
                                    // Get the number of buttons needed
                                    if($countBoots % 12 == 0) {
                                        $countButtons = (int)($countBoots / 12);
                                    }
                                    else {
                                        $countButtons = (int)($countBoots / 12) + 1;
                                    }
                                    
                                    // Iterate through to create required number of buttons
                                    for ($i = 0; $i < $countButtons; $i++) {
                                        // If the current offset equals the button (x12) being created, set button to active
                                        if($_GET['offset'] == $i * 12) { ?>
                                            <li class="page-item active">
                                            	<a class="page-link" href="bootsPage.php?offset=<?php echo ($i * 12)?>"><?php echo ($i + 1)?></a>
                                            </li>
                                    <?php }
                                        // Else, set button to not active
                                        else { ?>
                                            <li class="page-item">
                                            	<a class="page-link" href="bootsPage.php?offset=<?php echo ($i * 12)?>"><?php echo ($i + 1)?></a>
                                            </li>
                                    <?php }
                                    }
                                    
                                    ?>
                                    
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
    	// JavaScript to apply filters of boots
        function filter(){

            var sizesFiltered = document.getElementById('filtersize');
            var ss='';

            var sizes = document.getElementsByName('filtersize[]');

            for (var i = 0; i < sizes.length; i++) {

            	if(sizes[i].checked) {
                    ss = ss + sizes[i].value + ',';
            	}
            }

            var colorsFiltered = document.getElementById('filtercolor');
            cs='';

            var colors = document.getElementsByName('filtercolor[]');
            
            for (var i = 0; i < colors.length; i++) {

            	if(colors[i].checked) {
                    cs = cs + colors[i].value + ',';
            	}
            }
            
            sizesFiltered.value = ss;
            colorsFiltered.value = cs;
            
            document.getElementById('form').submit();
        }
    </script>
    
    
    <!-- Include the footer page fragment -->
    <footer class="page-footer dark">
        <?php include_once('../fragments/footer.html')?>
    </footer>
    
    <!-- Include the scripts page fragment -->
	<?php include_once('../fragments/scripts.html')?>
	
</body>
</html>
