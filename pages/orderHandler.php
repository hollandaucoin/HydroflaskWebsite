<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc orderHandler - This file is to handle the process out a user submitting an order
 */


// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Include Order and orderBusinessService to create instances
include_once('../classes/models/Order.php');
include_once('../classes/models/Address.php');
include_once('../classes/business/orderBusinessService.php');
include_once('../classes/business/cartBusinessService.php');
include_once('../classes/business/discountBusinessService.php');

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Get the total submitted through the form and address from sesion
$finalTotal = $_POST['total'];
$address = $_SESSION['address'];

// Create instance of cartBusinessService
$cartService = new cartBusinessService();
// Call getCart method in cartBusinessService and set to variable
$carts = $cartService->getCart();

// Generate random 9 digit number for order number, set to session to be accessed in receipt
$orderNumber = rand(100000000, 999999999); 
$_SESSION['orderNumber'] = $orderNumber;

// Create order object
$order = new Order(null, $orderNumber, null, $_SESSION['userId'], $address->getId(), $finalTotal);

// Create instance of orderBusinessService
$orderService = new orderBusinessService();

// Call addUserOrder method in orderBusinessService
$addStatus = $orderService->addUserOrder($order, $carts);

// If the addUserOrder was succesful
if ($addStatus == true) {
    
    // Create instance of cartBusinessService
    $cartService = new cartBusinessService();
    // Clear the cart of products because they were successfully purchased
    $cartService->clearCart($_SESSION['userId']);
    
    // If the session variable of discountCode is set
    if(isset($_SESSION['discountCode'])) {
        // Create instance of discountBusinessService
        $discountService = new discountBusinessService();
        // Call removeDiscount method in discountBusinessService to remove used discount code
        $discountService->removeDiscount($_SESSION['discountCode']);
    }
    
    // Navigate to the receiptPage
    include('receiptPage.php');  
}
else {
    // Something else went wrong
    include('errorPage.php'); 
}


