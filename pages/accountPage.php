<!--

@author Holland Aucoin
@name Hydroflask Website
@desc accountPage - This is a page that shows a user's account details

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Account</title>

	<?php
	
	// Error reporting support
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
	
	// Include the userBusinessService to create an instance
	include_once('../classes/business/userBusinessService.php');
	
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
    
    // Create an instance of userBusinessService
    $userService = new userBusinessService();
    // Call getUserFromId in the userBusinessService and set to variable
    $user = $userService->getUserFromId($_SESSION['userId']);
    
    // If the edit GET is set, set to variable
    if(isset($_GET['edit'])) {
        $edit = $_GET['edit'];
    }
    // Else, set it to false
    else {
        $edit = "false";
    }
    
    // If edit variable is true, display fields for edit
    if($edit == "true") {
        
    ?> 
    
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <!-- Header -->
                <div class="block-heading">
                    <h2 class="text-info">Account Information</h2>
                </div>
                                	
                <!-- Form to edit an account's information, sends to adminUserHandler -->
                <form action="accountHandler.php" method="POST">
                    <div align=right>
                		<a href="accountPage.php?edit=false"><button class="btn btn-outline-primary" type="button" style="text-align:center; height:30px; width:30px; padding-top: 3px; padding-right: 20px">X</button></a>
                    </div>
                    
                    <!-- Hidden attribute of user id for the accountHandler to edit the user -->
                    <input type="hidden" name="id" id="id" value="<?php echo $user->getId()?>">
                    
                    <!-- If the message variable is set, display it (error) -->   
                    <?php if(isset($message)) {
				        ?><p align=center><?php echo $message?></p><?php
				    }
				    ?>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="first name" name="firstName" id="firstName" value="<?php echo $user->getFirstName()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="last name" name="lastName" id="lastName" value="<?php echo $user->getLastName()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="username" name="username" id="username" value="<?php echo $user->getUsername()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="password" name="password" id="password" value="<?php echo $user->getPassword()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="email" placeholder="email" name="email" id="email" value="<?php echo $user->getEmail()?>" required></div>
                    <div class="form-group"><input class="form-control item" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="phone number (ex: 123-456-7890)" name="phoneNumber" id="phoneNumber" value="<?php echo $user->getPhoneNumber()?>" required></div>
                    
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Save</button>
               </form>
            </div>
        </section>
    </main>
       
       <?php
    }
    
    // If edit variable is false, display uneditable fields
    else {
        
        // Get length of password and create empty variable for protected password
        $passwordLength = strlen($user->getPassword());
        $passwordProtected = "";
        
        // Iterate through and create protected password as length of password
        for ($i = 0; $i < $passwordLength; $i++) {
            $passwordProtected = $passwordProtected . "*";
        }
        
        ?>
    
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <!-- Header -->
                <div class="block-heading">
                    <h2 class="text-info">Account Information</h2>
                </div>
                
                <form>
                	<table align="center">
                		<tr>
                			<td style="padding-right: 20px"><p style="color: gray">First Name:</p></td>
                			<td><p><?php echo $user->getFirstName()?></p></td>
                		</tr>
						<tr>
							<td><p style="color: gray">Last Name:</p></td>
							<td><p><?php echo $user->getLastName()?></p></td>
						</tr>
						<tr>
							<td><p style="color: gray">Username:</p></td>
							<td><p><?php echo $user->getUsername()?></p></td>
						</tr>
						<tr>
							<td><p style="color: gray">Password:</p></td>
							<td><p><?php echo $passwordProtected?></p></td>
						</tr>
						<tr>
							<td><p style="color: gray">Email:</p></td>
							<td><p><?php echo $user->getEmail()?></p></td>
						</tr>
						<tr>
							<td><p style="color: gray">Phone:</p></td>
							<td><p><?php echo $user->getPhoneNumber()?></p></td>
						</tr>
					</table>
                  
                    <br>
                    <a href="accountPage.php?edit=true"><button class="btn btn-primary btn-block" type="button">Edit</button></a>
            	</form>
            </div>
        </section>
    </main>
       
    <?php
    
    }
    
    ?>

    <!-- Include the footer page fragment -->
    <footer class="page-footer dark">
		<?php include_once('../fragments/footer.html')?>
    </footer>
    
    <!-- Include the scripts page fragment -->
    <?php include_once('../fragments/scripts.html')?>

</body>
</html>

