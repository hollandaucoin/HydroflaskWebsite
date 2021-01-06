<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc manageUsersPage - This is a page that shows all of the users for the admin to manage

-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Users</title>
    
    <?php 
    
    // Error reporting support
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // Include the productsBusinessService to create an instance
    include_once('../classes/business/userBusinessService.php');
    
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
	<?php include_once('../fragments/navbar.php');?>
    
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
            	<!-- Heading -->
                <div class="block-heading">
                    <h2 class="text-info">Users</h2>
                    </div>
                    
                        <div align=right>
                    		<a href="addUserPage.php"><button class="btn btn-primary" style="width: 120px; height: 50px" type="button">Add New</button></a>
                    		<br><br>
                    	</div>
                    
                <div class="content">
                    <div class="row">
                        <!-- Products grid -->
                        <div class="col-md-12">
                            <div class="products" style="padding-left:30px">
                                <div class="row no-gutters">
                                
                                <?php 
                                
                                // If the offset variable isn't set or is set to 0
                                if(!isset($_GET['offset']) || $_GET['offset'] == 0 || $_POST['offset'] == 0) {
                                    $offset = 0;
                                }
                                // Else, set the offset variable using GET
                                else {
                                    $offset = $_GET['offset'];
                                }
                                
                                // Create instance of userBusinessService
                                $userService = new userBusinessService();
                                // Call getUsersOffset method in userBusinessService and set to variable
                                $users = $userService->getUsersOffset($offset);
                                
                                // For each user in users, create display the item in grid
                                foreach($users as $user) {
                                    
                                ?>
        							
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class="clean-product-item">

                                                <div class="product-name">
<!--                                                 	<form action="viewUserPage.php" method="POST"> -->
                                            	        <!-- User ID variable needed on viewUserPage (hidden) -->
                                            			<!-- <input type="hidden" name="id" id="id" value="<?php //echo $user->getId()?>"> -->
                                            			
    													<a href="viewUserPage.php?id=<?php echo $user->getId()?>" class="imagehover"><h5><b><?php echo $user->getFirstName() . " " . $user->getLastName()  . " " ?></b></h5></a>
<!--                                                 	</form> -->
                                                	
                                                	<i><?php echo $user->getUsername()?></i>
                                                	<form onsubmit="return confirm('Are you sure you want to delete this user?')" action="adminUserHandler.php" method=POST>
    		                                       		<div align=right style="float: right">
    		                                       		    <!-- Hidden attribute to tell the adminUserHandler the users id and that the action is deletion -->
    		                                       			<input type="hidden" name="id" id="id" value="<?php echo $user->getId()?>">
            											 	<input type="hidden" name="delete" id="delete" value="delete">
            											 	
                                                        	<input class="btn btn-outline-primary btn-lg" type="submit" value="Delete">
    		                                       		</div>
    		                                       	</form>
                                                	<form action="editUserPage.php" method="POST">
                                                	    <!-- User ID variable needed on editUserPage (hidden) -->
                                            			<input type="hidden" name="id" id="id" value="<?php echo $user->getId()?>">
                                            			
                                                    	<div align=right style="float: right; padding-bottom: 30px; padding-right: 5px">
                                                        	<input class="btn btn-outline-primary btn-lg" style="width: 100px" type="submit" value="Edit">
                                                        	</div>
    		                                       	</form>
                                                </div> 
                                                
	                                    </div>
                                    </div>
                                    
                                    <?php 

                                    }
                                    
                                    ?>
                                    </div>
                                </div>
                                <!-- Create bar of buttons at the bottom for pagination -->
                                <nav>
                                    <ul class="pagination">
                                    
                                    <?php 
                                    
                                    // Get the number of total bottles
                                    $countBottles = count($userService->getUsers());
                                    
                                    // Get the number of buttons needed
                                    $countButtons = (int)($countBottles / 12) + 1;
                                    
                                    // Iterate through to create required number of buttons
                                    for ($i = 0; $i < $countButtons; $i++) {
                                        // If the current offset equals the button (x12) being created, set button to active
                                        if($_GET['offset'] == $i * 12) { ?>
                                            <li class="page-item active"><a class="page-link" href="manageUsersPage.php?offset=<?php echo ($i * 12)?>"><?php echo ($i + 1)?></a></li>
                                    <?php }
                                        // Else, set button to not active
                                        else { ?>
                                            <li class="page-item"><a class="page-link" href="manageUsersPage.php?offset=<?php echo ($i * 12)?>"><?php echo ($i + 1)?></a></li>
                                    <?php }
                                    }
                                    
                                    ?>
                                             
                                     </ul>
                                </nav>
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

