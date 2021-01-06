<?php

// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Include the orderBusinessService to create an instance
include_once('../classes/business/orderBusinessService.php');

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Security check to protected pages
if(!isset($_SESSION['userId']) || $_SESSION['userId'] == 1) {
    header("Location: loginPage.php");
}

// Create instance of orderBusinessService
$orderService = new orderBusinessService();
// Call getOrders in orderBusinessService and set to $orders
$orders = $orderService->getOrders();

// Serialize the array of User to JSON
$myJSON = json_encode($orders, JSON_PRETTY_PRINT);

// Set content type to better format json
header('Content-Type: application/json');

// Echo JSON encoded array
echo $myJSON;