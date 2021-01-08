<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc loginHandler - This file is to handle the process of a user logging in by connecting to the database and verifying their account
 */


// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Include User and userBusinessService to create instances
include_once('../classes/models/UserCredentials.php');
include_once('../classes/business/userBusinessService.php');

// Retrieve variables from POST
$username = strtolower(trim($_POST['username']));
$password = trim($_POST['password']);

// Create instance of User
$userCredentials = new UserCredentials($username, $password);

// Create instance of userBusinessService
$userService = new userBusinessService();
// Call loginUser method in userBusinessService and set to variable
$userResults = $userService->loginUser($userCredentials);

// If userResults is true, login successful and navigate to home page
if($userResults == true) {
    include('homePage.php');
}
// Else, login failed
else {
     //  Pass message to loginPage.php
     $message = "Incorrect username or password.";
     include('loginPage.php');
}

