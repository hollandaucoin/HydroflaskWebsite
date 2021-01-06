<!--

@author Holland Aucoin and Andrei Yanovich
@name Hydroflask Website
@desc checkoutPage - This is a page that prompt the user for their checkout information

-->


<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>HydroFlask - Checkout</title>

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
	
	// If the user is logged in to their account
	if(isset($_SESSION["userId"]) && $_SESSION["userId"] > 1) {
	    
	    // Create instance of userBusinessService
	    $userService = new userBusinessService();
	    // Call getUserFromId method in userBusinessService using session variable and set to variable
	    $user = $userService->getUserFromId($_SESSION["userId"]);
	    
	    // Set variables to attributes of the user retrieved above (for autofill)
	    $firstName = $user->getFirstName();
	    $lastName = $user->getLastName();
	    $username = $user->getUsername();
	    $password = $user->getPassword();
	    $email = $user->getEmail();
	    $phoneNumber = $user->getPhoneNumber();
	}
	// The user is not logged in to an account, set variables to empty
	else {
	    $firstName = "";
	    $lastName = "";
	    $username = "";
	    $password = "";
	    $email = "";
	    $phoneNumber = "";
	}

    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html')

    ?>

</head>
<body>
	<!-- Custom navbar to ensure user checks out-->
    	<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container">
        	<a class="navbar-brand logo"><img src="../assets/img/main/hydrologo.png" height="35px" width="28px" style="padding-bottom:8px">  H Y D R O F L A S K</a>
        </div>
    </nav>
    
	<main class="page payment-page">
		<section class="clean-block payment-form dark">
			<div class="container">
				<div class="block-heading">
					<h2 class="text-info">Checkout</h2>
				</div>
				<form action="checkoutHandler.php" method=POST>
					<div class="card-details">	
				
				<?php if(isset($message)) {
				    ?><p align=center><?php echo $message?></p><?php
				}
				?>	
						<h3 class="title">User Account</h3>
						<div class="form-row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">First Name</label>
									<input class="form-control" type="text" minlength="3" maxlength="25" name="firstName" id="firstName" value="<?php echo $firstName?>" placeholder="First Name" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Last Name</label>
									<input class="form-control" type="text" minlength="3" maxlength="25" name="lastName" id="lastName" value="<?php echo $lastName?>" placeholder="Last Name" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Username</label>
									<input class="form-control" type="text" minlength="3" maxlength="25" name="username" id="username" value="<?php echo $username?>" placeholder="Username" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Password</label>
									<input class="form-control" type="password" minlength="3" maxlength="25" name="password" id="password" value="<?php echo $password?>" placeholder="Password" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Email</label>
									<input class="form-control" type="email" minlength="3" maxlength="25" name="email" id="email" value="<?php echo $email?>" placeholder="Email" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Phone Number</label>
									<input class="form-control" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength="12" name="phoneNumber" id="phoneNumber" value="<?php echo $phoneNumber?>" placeholder="Phone (ex: 123-456-7890)" required>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card-details">
						<h3 class="title">Shipping Information</h3>
						<div class="form-row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="card-holder">Street Address</label>
									<input class="form-control" type="text" minlength="3" maxlength="100" name="streetAddress" id="streetAddress" placeholder="Street Address" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">City</label>
									<input class="form-control" type="text" minlength="3" maxlength="25" name="city" id="city" placeholder="City" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">State</label>
									<input class="form-control" type="text" minlength="2" maxlength="25" name="state" id="state" placeholder="State" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Zip Code</label>
									<input class="form-control" type="text" minlength="5" maxlength="5" name="zipCode" id="zipCode" placeholder="Zip Code" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Country</label>
									<input class="form-control" type="text" minlength="3" maxlength="25" name="country" id="country" placeholder="Country" required>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card-details">
						<h3 class="title">Credit Card Details</h3>
						<div class="form-row">
							<div class="col-sm-7">
								<div class="form-group">
									<label for="card-holder">Card Holder</label>
									<input class="form-control" type="text" minlength="5" maxlength="50" name="cardHolder" id="cardHolder" placeholder="Card Holder" required>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label>Expiration date</label>
									<div class="input-group expiration-date">
										<input class="form-control" type="text" minlength="2" maxlength="2" name="month" id="month" placeholder="MM" required>
										<input class="form-control" type="text" minlength="2" maxlength="2" name="year" id="year" placeholder="YY" required>
									</div>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="form-group">
									<label for="card-number">Card Number</label>
									<input class="form-control" type="text" type="text" minlength="16" maxlength="16" name="cardNumber" id="cardNumber" placeholder="Card Number" required>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label for="cvc">CVC</label><input class="form-control" type="text" minlength="3" maxlength="3" name="cvc" id="cvc" placeholder="CVC" required>
								</div>
							</div>
						</div>
					</div>
					
					<div class="card-details">
						<h3 class="title">Billing Address</h3>
						<div class="form-row">
							<div class="col-sm-12">
							    <!-- Checkbox to see if billing address is same as shipping -->
								<div align="right">
									<input type="checkbox" id="billingAddressCheck" name="billingAddressCheck" value="billingAddressCheck" onclick="autofill()">
									<label for="billingAddressCheck">Same as Shipping</label><br>
								</div>
								
								<div class="form-group">
									<label for="card-holder">Street Address</label>
									<input class="form-control" type="text" minlength="3" maxlength="100" name="billingStreetAddress" id="billingStreetAddress" placeholder="Street Address" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">City</label>
									<input class="form-control" type="text" minlength="3" maxlength="25" name="billingCity" id="billingCity" placeholder="City" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">State</label>
									<input class="form-control" type="text" minlength="2" maxlength="25" name="billingState" id="billingState" placeholder="State" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Zip Code</label>
									<input class="form-control" type="text" minlength="5" maxlength="5" name="billingZipCode" id="billingZipCode" placeholder="Zip Code" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="card-holder">Country</label>
									<input class="form-control" type="text" minlength="3" maxlength="25" name="billingCountry" id="billingCountry" placeholder="Country" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<button class="btn btn-primary btn-block" type="submit">Review Order</button>
								</div>
							</div>
						</div>
					</div>
					
				</form>
			</div>
		</section>
	</main>
	
		<script>
		// Javascript function that handles the checkbox for the billing address
    	function autofill() {
        	  // If the checkbox is checked, the user wants the billing address to be the same as the shipping address
    		  if (document.getElementById('billingAddressCheck').checked) {

        		// Get each of the input values filled out in the shipping address
    		    var billingStreetAddress = document.getElementById('streetAddress');
    		    var billingCity = document.getElementById('city');
    		    var billingState = document.getElementById('state');
    		    var billingZipCode = document.getElementById('zipCode');
    		    var billingCountry = document.getElementById('country');

    		    // Set the billing address input values of variables retrieved from the shipping address
     		    document.getElementById('billingStreetAddress').value = billingStreetAddress.value;
     		    document.getElementById('billingCity').value = billingCity.value;
     		    document.getElementById('billingState').value = billingState.value;
     		    document.getElementById('billingZipCode').value = billingZipCode.value;
     		    document.getElementById('billingCountry').value = billingCountry.value;    
    		  } 
    		  // Else the checkbox is unchecked, the user wants a different billing address
    		  else {
        		  // Set each of the input fields to empty
    			  document.getElementById('billingStreetAddress').value = "";
    			  document.getElementById('billingCity').value = "";
    			  document.getElementById('billingState').value = "";
    			  document.getElementById('billingZipCode').value = "";
    			  document.getElementById('billingCountry').value = "";
    		  }
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