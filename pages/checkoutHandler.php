<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc checkoutHandler - This file is to handle the process out a user submitting their personal, shipping, and card information
 */


// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Include User, UserCredentials, userBusinessService, Address, and addressBusinessService to create instances
include_once('../classes/models/User.php');
include_once('../classes/models/UserCredentials.php');
include_once('../classes/business/userBusinessService.php');
include_once('../classes/models/Address.php');
include_once('../classes/business/addressBusinessService.php');
include_once('../classes/business/cartBusinessService.php');

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Boolean set true that will change if login/registration fails
$success = true;

// If the userId is set to 1
if(isset($_SESSION["userId"]) && $_SESSION['userId'] == 1) {
    // Get the information submitted through the form to create object
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    
    $streetAddress = $_POST['streetAddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    $country = $_POST['country'];
    $role = "Customer";
    
    // Create User object using the variables from post
    $user = new User(null, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role);

    // Create instance of userBusinessService
    $userService = new userBusinessService();
    // Call registerUser method in userBusinessService and set to variable
    $userAdd = $userService->registerUser($user);
    
    // If the user add is successful
    if($userAdd == 1) {
        // Create instance of cartBusinessService
        $cartService = new cartBusinessService();
        // Call updateItemsToUserId method in cartBusinessService to assign those products to their account
        $cartService->updateItemsToUserId();
    }
    // If the user add returns -1 (account already exists)
    else if($userAdd == -1) {
        // Create new UserCredential model using the username and password that match an account
        $userCredentials = new UserCredentials($username, $password);
        // Call loginUser in UserBusinessService and pass in userCredentials to log the user in
        $userService->loginUser($userCredentials);
        
        // Create instance of cartBusinessService
        $cartService = new cartBusinessService();
        // Call updateItemsToUserId method in cartBusinessService to assign those products to their account
        $cartService->updateItemsToUserId();
    }
    // If the user add returns -2 (username already exists)
    else if($userAdd == -2) {
        // Set success to false to not execute remainder of code
        $success = false;
        
        // Set message for checkout page error
        $message = "Username already exists, please try again.";
        // Navigate to the orderReviewPage
        include('checkoutPage.php');
    }
    // If the user add returns -3 (email already exists)
    else if($userAdd == -3) {
        // Set success to false to not execute remainder of code
        $success = false;
        
        // Set message for checkout page error
        $message = "Email already exists, please try again.";
        // Navigate to the orderReviewPage
        include('checkoutPage.php');
    }
    // Something else went wrong
    else {
        include('errorPage.php');
    }
}
// The user is logged in so session is set to their id
else {
    
    // Get the information submitted through the form
    $streetAddress = $_POST['streetAddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];
    $country = $_POST['country'];
  
}

// If the login/registration was successful
if($success == true) {
    
    // Create Address object using the variables from post
    $address = new Address(null, $_SESSION['userId'], $streetAddress, $city, $state, $zipCode, $country);
    
    // Create instance of addressBusinessService
    $addressService = new addressBusinessService();
    
    // If the checkUserShipping method is false (address already isn't in the database)
    if($addressService->checkUserShipping($address) == false) {
        
        // Call addUserAddress method in addressBusinessService to add the address
        $addressService->addUserAddress($address);
    }
    
    // Get all of the information submitted through the form
    $billingStreetAddress = $_POST['billingStreetAddress'];
    $billingCity = $_POST['billingCity'];
    $billingState = $_POST['billingState'];
    $billingZipCode = $_POST['billingZipCode'];
    $billingCountry = $_POST['billingCountry'];
    
    // Create Address object using the variables from post
    $billing = new Address(null, $_SESSION['userId'], $billingStreetAddress, $billingCity, $billingState, $billingZipCode, $billingCountry);
    
    // Create cardInfo array and store variables from post in it
    $cardInfo = array();
    $cardInfo[0] = $_POST['cardHolder'];
    $cardInfo[1] = $_POST['cardNumber'];
    $cardInfo[2] = $_POST['month'];
    $cardInfo[3] = $_POST['year'];
    $cardInfo[4] = $_POST['cvc'];
    
    // Set session variables to the address obejct, billing address object, and cardInfo array created
    $_SESSION['address'] = $address;
    $_SESSION['billing'] = $billing;
    $_SESSION['card'] = $cardInfo;
    
    // Navigate to the orderReviewPage
    include('orderReviewPage.php');
}
// Something else went wrong
else {
    include('errorPage.php');
}


