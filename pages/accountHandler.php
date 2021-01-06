<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc accountHandler - This file is to handle the process of an editting a user's account
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

// Security check to keep page protected from regular users
if(!isset($_SESSION['userId'])) {
    header("Location: loginPage.php");
}

// Create instance of userBusinessService
$userService = new userBusinessService();
    
// Retrieve variables from POST
$id = $_POST['id'];
$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$username = strtolower(trim($_POST['username']));
$password = trim($_POST['password']);
$email = strtolower(trim($_POST['email']));
$phoneNumber = trim($_POST['phoneNumber']);
$role = $userService->getUserFromId($id)->getRole();

// Create instance of User with variables
$user = new User($id, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role);

// Call editUser method in userBusinessService and set to variable
$userResults = $userService->editUser($user);


// If userResults is 1 edit was successful
if($userResults == 1) {

    // Navigate back to manageUsersPage with edit being false
    $_GET['edit'] = "false";
    include('accountPage.php');
    
}
// If userResults is -1, editing unsuccessful (username already registered)
else if ($userResults == -1){
    // Set message and navigate back to account page  with edit being true
    $message = "Username already exists, please try again.";
     $_GET['edit'] = "true";
    include('accountPage.php');
}
// If userResults is -2, editing unsuccessful (email already registered)
else if ($userResults == -2){
    // Set message and navigate back to account page with edit being true
    $message = "Email has already been registered to another account, please try again.";
    $_GET['edit'] = "true";
    include('accountPage.php');
}
// Something else went wrong
else {
   include('errorPage.php'); 
}

