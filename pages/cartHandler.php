<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc cartHandler - This file is to handle the process of a user adding, editing, and deleting a product from their cart
 */


// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Check if discountCode post is set
if(isset($_POST['discountCode'])) {
    
    // Include the discountBusinessService to create an instance
    include_once('../classes/business/discountBusinessService.php');
    
    // Create instance of discountBusinessService
    $discountService = new discountBusinessService();
    
    
    // Call checkDiscount method in cartBusinessService to verify and apply
    $discountService->checkDiscount($_POST['discountCode']);
    
    if($_SESSION["discount"] > 0) {
        header("Location: cartPage.php");
    }
    else {
        unset($_SESSION['discount']);
        header("Location: cartPage.php");
    }
}

// Include the cartBusinessService to create an instance
include_once('../classes/business/cartBusinessService.php');

// Create instance of cartBusinessService
$cartService = new cartBusinessService();

// Get the product type and id through POST method
$type = $_POST['type'];
$id = $_POST['id'];

// If the product is a bottle
if($type == "bottle") {
    
    // Include the Bottle model and the bottleBusinessService to create an instance
    include_once('../classes/models/Bottle.php');
    include_once('../classes/business/bottleBusinessService.php');
    
    // Create instance of bottleBusinessService
    $productService = new bottleBusinessService();
    
}
// If the product is a boot
else if($type == "boot") {
    
    // Include the Boot model and the bootBusinessService to create an instance
    include_once('../classes/models/Boot.php');
    include_once('../classes/business/bootBusinessService.php');
    
    // Create instance of bootBusinessService
    $productService = new bootBusinessService();
}
// If the product is a lid
else if($type == "lid") {
    
    // Include the Lid model and the lidBusinessService to create an instance
    include_once('../classes/models/Lid.php');
    include_once('../classes/business/lidBusinessService.php');
    
    // Create instance of lidBusinessService
    $productService = new lidBusinessService();
}


// If the add variable is set from POST
if(isset($_POST['add'])) {

    // If the product is a bottle
    if($type == "bottle") {
        // Get bottle object from getBottleFromId method
        $product = $productService->getBottleFromId($id);
    }
    // If the product is a boot
    else if($type == "boot") {
        // Get boot object from getBootFromId method
        $product = $productService->getBootFromId($id);
    }
    // If the product is a lid
    else if($type == "lid") {
        // Get bottle object from getLidFromId method
        $product = $productService->getLidFromId($id);
    }

    // Call addToCart method in the according business service and set to variable
    $productResults = $cartService->addProductToCart($product, $type);
}

// If the edit variable is set from POST
else if(isset($_POST['edit'])) {
   
    // Retrieve variable from POST
    $quantity = $_POST['number'];
    
    // Call editProduct method in the according business service and set to variable
    $productResults = $cartService->updateQuantity($id, $quantity);
}
// If the delete variable is set from POST
else if(isset($_POST['delete'])) {
    
    // Call deleteProductFromId method the according business service and set to variable
    $productResults = $cartService->deleteCartItemById($id);
}


// If productResults is 1, add, edit, or delete was successful
if($productResults == true) {
    header("Location: cartPage.php");  
}
// Something else went wrong
else {
    include('errorPage.php');
}

