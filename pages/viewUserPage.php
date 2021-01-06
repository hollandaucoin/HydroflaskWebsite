<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc addUserPage - This is a page that allows an admin user to edit a user to the website

-->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - View User</title>
    
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
    
    // Get the userId through POST request
    $userId = $_GET['id'];
    
    // Create instance of userBusinessService
    $userService = new userBusinessService();
    // Call getUserFromId method in userBusinessService and set to variable
    $user = $userService->getUserFromId($userId);
    
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
                    <h2 class="text-info"><?php echo $user->getFirstName() . " " . $user->getLastName()?></h2>
                </div>
                
                <form action="editUserPage.php" method="POST" style="padding-bottom: 0px">
                
                	<div align=right>
            			<a href="manageUsersPage.php?offset=0"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                	</div>
                
                    <!-- Hidden attribute to tell the editUserPage the users id -->
                	<input type="hidden" name="id" id="id" value="<?php echo $user->getId()?>">
                
                    <div class="form-group"><label><b>First Name:</b> <?php echo $user->getFirstName()?></label></div>
                    <div class="form-group"><label><b>Last Name:</b> <?php echo $user->getLastName()?></label></div>
                    <div class="form-group"><label><b>Username:</b> <?php echo $user->getUsername()?></label></div>
                    <div class="form-group"><label><b>Password:</b> <?php echo $user->getPassword()?></label></div>
                    <div class="form-group"><label><b>Email:</b> <?php echo $user->getEmail()?></label></div>
                    <div class="form-group"><label><b>Phone Number:</b> <?php echo $user->getPhoneNumber()?></label></div>
                    <div class="form-group"><label><b>Role:</b> <?php echo $user->getRole()?></label></div>
                    <br>
                
                	<button class="btn btn-primary btn-block" type="submit">Edit</button>
                </form>
                	
            	<form onsubmit="return confirm('Are you sure you want to delete this user?')" action="adminUserHandler.php" method=POST style="border-color: white; border-width: 10px; padding:0rem 2.5rem; padding-bottom: 40px">
            	   <!-- Hidden attribute to tell the adminUserHandler the users id and that the action is deletion -->
                	<input type="hidden" name="id" id="id" value="<?php echo $user->getId()?>">
            		<input type="hidden" name="delete" id="delete" value="delete">
            		<button class="btn btn-primary btn-block">Delete</button>
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