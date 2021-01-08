<!--

@author Holland Aucoin
@name Hydroflask Website
@desc bottlesPage - This is a page that shows all of the bottle products

-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Bottles</title>
    
    <?php 
    
    // Error reporting support
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // Include the bottleBusinessService to create an instance
    include_once('../classes/business/bottleBusinessService.php');
    
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
                    <h2 class="text-info">Bottles</h2>
                    </div>
        			
        			      <!-- If the user's role is admin, show the add new button -->
        			<?php if (isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") { ?>
                    	
                    	<form action="addProductPage.php" method="POST">
                                        		
                        	<input type="hidden" name="type" id="type" value="bottle">
                                        		
                            <div align=right>
                            	<input class="btn btn-primary" type="submit" style="width: 120px; height: 50px" value="Add New"><br><br>
                            </div>
                         </form>
                                           
                   	<?php } 
                   	      // Else, show the description
                   	      else { ?>
                   	
                   		<div align="center">
                    		<p style="width:80%">Our TempShield™ vacuum insulated stainless steel bottles keep cold drinks cold and hot drinks hot, hour after hour. 
                    		The Standard Mouth is ideal for sipping, while still accommodating ice cubes, and the Wide Mouth delivers full-on 
                    		refreshment for any adventure. Both versions feature the insulated Flex Cap, designed for ultimate portability and comfort.</p>
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
                                            <h3>Mouth</h3>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtermouth[]' id="formCheck-1" value="Standard"><label class="form-check-label" for="formCheck-1">Standard</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtermouth[]' id="formCheck-2" value="Wide"><label class="form-check-label" for="formCheck-2">Wide</label></div>
                                        </div>
                                        <div class="filter-item">
                                            <h3>Size</h3>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtersize[]' id="formCheck-3" value="18oz."><label class="form-check-label" for="formCheck-3">18oz.</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtersize[]' id="formCheck-4" value="21oz."><label class="form-check-label" for="formCheck-4">21oz.</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtersize[]' id="formCheck-5" value="24oz."><label class="form-check-label" for="formCheck-5">24oz.</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtersize[]' id="formCheck-6" value="32oz."><label class="form-check-label" for="formCheck-6">32oz.</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtersize[]' id="formCheck-7" value="40oz."><label class="form-check-label" for="formCheck-7">40oz.</label></div>
                                        </div>
                                        <div class="filter-item">
                                            <h3>Color</h3>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-8" value="Black"><label class="form-check-label" for="formCheck-8">Black</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-9" value="Cobalt"><label class="form-check-label" for="formCheck-9">Cobalt</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-10" value="Fog"><label class="form-check-label" for="formCheck-10">Fog</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-11" value="Hibiscus"><label class="form-check-label" for="formCheck-11">Hibiscus</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-12" value="Olive"><label class="form-check-label" for="formCheck-12">Olive</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-13" value="Pacific"><label class="form-check-label" for="formCheck-13">Pacific</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-14" value="Spearmint"><label class="form-check-label" for="formCheck-14">Spearmint</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-15" value="Stone"><label class="form-check-label" for="formCheck-15">Stone</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-16" value="Sunflower"><label class="form-check-label" for="formCheck-16">Sunflower</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-17" value="Watermelon"><label class="form-check-label" for="formCheck-17">Watermelon</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name='filtercolor[]' id="formCheck-18" value="White"><label class="form-check-label" for="formCheck-18">White</label></div>
                                        </div>
                                        
                                        <form action="filterHandler.php" id="form" method="POST">
                                            <input type='hidden' name='bottle' id='bottle'>
                                        	<input type='hidden' name='filtermouth' id='filtermouth'>
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
                                
                                // Create instance of bottleBusinessService
                                $bottleService = new bottleBusinessService();
                                
                                // If the filterSql POST is set
                                if(isset($_POST['filterSql'])) {
                                    $sql = $_POST['filterSql'];
                                    $bottles = $bottleService->getBottlesSearch($sql, $offset);
                                    
                                    if(count($bottles) == 0) {
   
                                        echo "<br><br>There are no results that match your filter. Please refine your search and try again.<br><br><br>
                                            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                                    }
                                }
                                // Else, filterSql POST is not set
                                else {
                                    // Call getBottlesOffset method in bottlesBusinessService and set to variable
                                    $bottles = $bottleService->getBottlesOffset($offset);
                                }
                                
                                // For each bottle in bottles, create display the item in grid
                                foreach($bottles as $bottle) {
                                    
                                ?>
                                	
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="clean-product-item">
                                        <!-- Form to send user to the product page and send needed variables -->
                                        <form action="productPage.php" method="POST">
                                        	<!-- Product type and ID variables needed on product page (hidden) -->
                                        	<input type="hidden" name="type" id="type" value="bottle">
                                        	<input type="hidden" name="id" id="id" value="<?php echo $bottle->getId()?>">
                                            <!--  -->
                                            <div class="image"><input type="image" class="img-fluid d-block mx-auto imagehover" src="<?php echo $bottle->getPhoto()?>" height=220px width=175px></div>
                                            <div class="product-name"><?php echo $bottle->getSize() . " " . $bottle->getName() . " - " ?><i><?php echo $bottle->getColor()?></i>
                                                <div class="price">
                                                    <h3>$<?php echo $bottle->getPrice()?></h3>
                                                </div>
                                            </div>
                                        </form>  
                                        
                                                        
                                        <!-- If the user is an admin, show edit and delete buttons -->
                                        <?php if (isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") { ?>
                                                
                                                <form action="editProductPage.php" method="POST">
                                            	    <!-- Bottle ID and type variables needed on editProductPage (hidden) -->
                                        			<input type="hidden" name="type" id="type" value="bottle">
                                        			<input type="hidden" name="id" id="id" value="<?php echo $bottle->getId()?>">
                                        			
                                                	<div align=center style="float: left; padding-left: 5px; padding-bottom: 5px">
                                                    	<input class="btn btn-outline-primary btn-lg" style="width: 100px" type="submit" value="Edit">
                                                    	</div>
		                                       	</form>
		                                       	<form onsubmit="return confirm('Are you sure you want to delete this bottle?')" action="adminProductHandler.php" method=POST>
		                                       		<div align=center style="float: left; padding-bottom: 30px; padding-left: 5px">
		                                       		    <!-- Hidden attributes to tell the adminHandler the product id, type, and that the action is deletion -->
                                        				<input type="hidden" name="type" id="type" value="bottle">
                                        				<input type="hidden" name="delete" id="delete" value="delete">
                                        				<input type="hidden" name="id" id="id" value="<?php echo $bottle->getId()?>">
        											 	
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
                                    
                                    // If the filterSql POST is set
                                    if(isset($_POST['filterSql'])) {
                                        $countBottles = $bottleService->getBottlesSearchCount($sql);
                                    }
                                    // Else, the filterSql POST is not set
                                    else {
                                        // Call getBottles method in bottlesBusinessService and set to variable
                                        $countBottles = count($bottleService->getBottles());
                                    }
                                   
                                    
                                    // Get the number of buttons needed
                                    if($countBottles % 12 == 0) {
                                        $countButtons = (int)($countBottles / 12);
                                    }
                                    else {
                                        $countButtons = (int)($countBottles / 12) + 1;
                                    }
                                    
                                    // Iterate through to create required number of buttons
                                    for ($i = 0; $i < $countButtons; $i++) {
                                        // If the current offset equals the button (x12) being created, set button to active
                                        if($_GET['offset'] == $i * 12) { ?>
                                            <li class="page-item active">
                                            	<a class="page-link" href="bottlesPage.php?offset=<?php echo ($i * 12)?>"><?php echo ($i + 1)?></a>
                                            </li>
                                    <?php }
                                        // Else, set button to not active
                                        else { ?>
                                            <li class="page-item">
                                            	<a class="page-link" href="bottlesPage.php?offset=<?php echo ($i * 12)?>"><?php echo ($i + 1)?></a>
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
		// JavaScript to apply filters of bottles
        function filter(){

            var mouthsFiltered = document.getElementById('filtermouth');
            ms='';

            var mouths = document.getElementsByName('filtermouth[]');

            for (var i = 0; i < mouths.length; i++) {

            	if(mouths[i].checked) {
                    ms = ms + mouths[i].value + ',';
            	}
            }
            
            var sizesFiltered = document.getElementById('filtersize');
            ss='';

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
            
            mouthsFiltered.value = ms;
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

