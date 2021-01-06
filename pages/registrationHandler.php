<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc registrationHandler - This file is to handle the process of a user registering by connecting to the database and adding their account
 */


// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Include User and userBusinessService to create instances
include_once('../classes/models/User.php');
include_once('../classes/business/userBusinessService.php');

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Retrieve variables from POST
$id = NULL;
$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$username = strtolower(trim($_POST['username']));
$password = trim($_POST['password']);
$email = strtolower(trim($_POST['email']));
$phoneNumber = trim($_POST['phoneNumber']);
$role = "Customer";

// Create instance of User
$user = new User($id, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role);
// Create instance of userBusinessService
$userService = new userBusinessService();

// Call registerUser method in userBusinessService and set to variable
$userResults = $userService->registerUser($user);


// If userResults is 1, registration successful
if($userResults == 1) {

    // Set registered variable to true for confirmation page, and navigate
    $_GET['registered'] = true;
    include('confirmationPage.php');
    
}
// If userResults is -1, registration unsuccessful (user already registered)
else if ($userResults == -1){
    // Set message and navigate back to registration page
    $message = "Account with username and password already exists, please login instead.";
    include('registrationPage.php');
}
// If userResults is -2, registration unsuccessful (username already registered)
else if ($userResults == -2){
    // Set message and navigate back to registration page
    $message = "Username has already been registered to another account, please try again.";
    include('registrationPage.php');
}
// If userResults is -3, registration unsuccessful (email already registered)
else if ($userResults == -3){
    // Set message and navigate back to registration page
    $message = "Email has already been registered to another account, please try again.";
    include('registrationPage.php');
}
// Something else went wrong
else {
    include('errorPage.php');
}

