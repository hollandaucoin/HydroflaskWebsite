<!--

@author Holland Aucoin
@name Hydroflask Website
@desc addUserPage - This is a page that allows an admin user to edit a user to the website

-->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Edit User</title>
    
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
    $userId = $_POST['id'];
    
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
                    <h2 class="text-info">Edit User</h2>
                </div>
                                	
                <!-- Form to add a new user, sends to adminUserHandler -->
                <form action="adminUserHandler.php" method="POST">
                    <div align=right>
                		<a href="manageUsersPage.php?offset=0"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                    </div>
                    
                    <!-- Hidden attribute to tell the adminUserHandler to edit the user -->
                    <input type="hidden" name="edit" id="edit" value="edit">
                    <input type="hidden" name="id" id="id" value="<?php echo $user->getId()?>">
                    
                    <?php if(isset($message)) {
				        ?><p align=center><?php echo $message?></p><?php
				    }
				    ?>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="first name" name="firstName" id="firstName" value="<?php echo $user->getFirstName()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="last name" name="lastName" id="lastName" value="<?php echo $user->getLastName()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="username" name="username" id="username" value="<?php echo $user->getUsername()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="password" minlength="3" maxlength="25" placeholder="password" name="password" id="password" value="<?php echo $user->getPassword()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="email" placeholder="email" name="email" id="email" value="<?php echo $user->getEmail()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="phone number (ex: 123-456-7890)" name="phoneNumber" id="phoneNumber" value="<?php echo $user->getPhoneNumber()?>" required></div>
                    <div align="center">
                    	<label style="padding-right:20px">Role:</label>
                    	<input type="radio" name="role" id="role" value="Customer" required>Customer
                    	<input type="radio" name="role" id="role" value="Admin">Admin
                    </div>
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
