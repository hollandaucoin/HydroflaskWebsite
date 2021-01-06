<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc logoutHandler - This file is to handle the process of a user logging out by ending the session and sending them to the confirmation page
 */

// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//Start session
session_start();

// End session
session_destroy();

// Navigate to confirmation page using header to refresh nav bar
header("Location: confirmationPage.php");
