<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc adminUserHandler - This file is to handle the process of an admin adding, editing, and deleting a user
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
if(!isset($_SESSION['userId']) || $_SESSION['userRole'] != "Admin") {
    header("Location: loginPage.php");
}

// Create instance of userBusinessService
$userService = new userBusinessService();

// If the add POST is set
if(isset($_POST['add'])) {
    
    // Retrieve variables from POST
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $username = strtolower(trim($_POST['username']));
    $password = trim($_POST['password']);
    $email = strtolower(trim($_POST['email']));
    $phoneNumber = trim($_POST['phoneNumber']);
    $role = $_POST['role'];
    
    // Create instance of User with a null id (for adding)
    $user = new User(NULL, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role);
    
    // Call addUser method in userBusinessService and set to variable
    $userResults = $userService->addUser($user);
}
// If the edit POST is set
else if(isset($_POST['edit'])) {
    
    // Retrieve variables from POST
    $id = $_POST['id'];
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $username = strtolower(trim($_POST['username']));
    $password = trim($_POST['password']);
    $email = strtolower(trim($_POST['email']));
    $phoneNumber = trim($_POST['phoneNumber']);
    $role = $_POST['role'];
    
    // Create instance of User with variables
    $user = new User($id, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role);
    
    // Call editUser method in userBusinessService and set to variable
    $userResults = $userService->editUser($user);
}
// If the delete POST is set
else if(isset($_POST['delete'])) {

    // Get the existing user's id from POST
    $id = $_POST['id'];
    
    // DELETE ALL DATABASE ITEMS CONNECTED TO THIS USER -----------------------------------------------------------------------------------------
    
    
    // Call deleteUserFromId method in userBusinessService and set to variable
    $userResults = $userService->deleteUserFromId($id);
}


// If userResults is 1 or true, add, edit, or delete was successful
if($userResults == 1 || $userResults == true) {

    // Navigate back to manageUsersPage with offset being 0
    $_GET['offset'] = 0;
    include('manageUsersPage.php');
    
}
// If userResults is -1, adding unsuccessful (username already registered)
else if ($userResults == -1 && isset($_POST['add'])){
    // Set message and navigate back to addUserPage page
    $message = "Username already exists, please try again.";
    include('addUserPage.php');
}
// If userResults is -2, adding unsuccessful (email already registered)
else if ($userResults == -2 && isset($_POST['add'])){
    // Set message and navigate back to addUserPage page
    $message = "Email has already been registered to another account, please try again.";
    include('addUserPage.php');
}

// If userResults is -1, editing unsuccessful (username already registered)
else if ($userResults == -1 && isset($_POST['edit'])){
    // Set message and navigate back to editUserPage page
    $message = "Username already exists, please try again.";
    include('editUserPage.php');
}
// If userResults is -2, editing unsuccessful (email already registered)
else if ($userResults == -2 && isset($_POST['edit'])){
    // Set message and navigate back to editUserPage page
    $message = "Email has already been registered to another account, please try again.";
    include('editUserPage.php');
}
// Something else went wrong
else {
    include ('errorPage.php');
}

