<!--

@author Holland Aucoin
@name Hydroflask Website
@desc confirmationPage - This is a page that gives the user a confirmation after register or submitted a contact form

-->

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Confirmation</title>

	<?php 
	
	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Set message1 and message2 to log out messages (messages cant be sent through header method), and they will change if necessary
	$message1 = "Logout successful!";
	$message2 = "You have been logged out of your account, press the button below to continue back to the site.<br><br>Thanks for visiting!";
	
	// Start the session if its not started
	if(!isset($_SESSION)) {
	    include 'session.php';
	}

	// If the 'name' variable has been set through POST, set $message1 and $message2 (otherwise messages are sent from registrationHandler)
    if(isset($_POST['name'])) {
        $message1 = "Submission Successful!";
        $message2 = "Thank you for your submission " . $_POST['name'] . ". The HydroFlask team should be getting back to you shortly. Press the button to continue.";
    }
    // If the 'registered' variable has been set through GET, set $message1 and $message2 
    else if(isset($_GET['registered'])) {
        $message1 = "Registration successful!";
        $message2 = "Welcome to HydroFlask, press the button below to continue.";
    }

    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html');
    
    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php')?>
    
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
            	<!-- Heading -->
                <div class="block-heading">
                    <h2 class="text-info"><?php echo $message1?></h2>
                </div>
                <!-- Form -->
                <form action="homePage.php">
                	<p align=center><?php echo $message2?></p>
					<br>
                    <button class="btn btn-primary btn-block" type="submit" name="submit">Continue</button>
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
