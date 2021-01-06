<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc contactPage - This is a page that allows the user to submit a contact form

-->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Contact</title>
    
    <?php 
    
    // Error reporting support
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // Include the bottleBusinessService to create an instance
    include_once('../classes/business/userBusinessService.php');
    
    // Start the session if its not started
    if(!isset($_SESSION)) {
        include 'session.php';
    }
    
    // If the user is logged in to an account
    if(isset($_SESSION["userId"]) && $_SESSION["userId"] > 1) {
        
        // Create instance of userBusinessService
        $userService = new userBusinessService();
        // Call getUserFromId method in userBusinessService using session variable and set to variable
        $user = $userService->getUserFromId($_SESSION["userId"]);
        
        // Set variables to attributes of the user retrieved above (for autofill)
        $name = $user->getFirstName() . " " . $user->getLastName();
        $email = $user->getEmail();
        
    }
    // The user is not logged in to an account, set variables to empty
    else {
        $name = "";
        $email = "";
    }
    
    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html')
    
    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php')?>
    
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
            	<!-- Heading -->
                <div class="block-heading">
                    <h2 class="text-info">Contact Us</h2>
                    <p>If you have any questions or concerns, leave a note and we will get back to you within 24 hours.</p>
                </div>
                <!-- Form to take in  information -->
                <form action="confirmationPage.php" method="POST">
                    <div class="form-group"><label>Name</label><input class="form-control" type="text" name="name" id="name" value="<?php echo $name?>" required></div>
                    <div class="form-group"><label>Subject</label><input class="form-control" type="text" required></div>
                    <div class="form-group"><label>Email</label><input class="form-control" type="email" value="<?php echo $email?>" required></div>
                    <div class="form-group"><label>Message</label><textarea class="form-control" required></textarea></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Send</button></div>
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