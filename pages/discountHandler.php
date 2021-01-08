<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc discountHandler - This file is to handle the process of a user entering a discount, and the admin adding/deleting a discount
 */


// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Include the discountBusinessService to create an instance
include_once('../classes/business/discountBusinessService.php');
include_once('../classes/models/Discount.php');

// Create instance of discountBusinessService
$discountService = new discountBusinessService();

// Check if discountCode post is set - coming from cart
if(isset($_POST['discountEntered'])) {
    
    // Call checkDiscount method in discountBusinessService to verify and apply
    $discountService->checkDiscount($_POST['discountEntered']);
    
    if($_SESSION["discount"] > 0) {
        $message = "Discount applied!";
        include("cartPage.php");
    }
    else {
        unset($_SESSION['discount']);
        $message = "Invalid code, please try again.";
        include("cartPage.php");
    }
}
// Check if add post is set - coming from admin discounts page
else if (isset($_POST["add"])) {
    
    // Get the discount variables from post
    $name = $_POST["name"];
    $discountCode = $_POST["discountCode"];
    $amount = $_POST["amount"];
    
    // Create Discount object using the variables
    $discount = new Discount(null, $name, $discountCode, $amount);
    
    // Call addDiscount method in discountBusinessService
    $discountResults = $discountService->addDiscount($discount);
    
    // If discountResults is true or 1, add or delete was successful
    if ($discountResults == 1) {
        include("discountsPage.php");
    }
    // If discountResults is -1, discount code already exists
    else if($discountResults == -1) {
        // Set message and navigate back to addDiscountPage
        $message = "Discount with that code already exists, please try again.";
        include('addDiscountPage.php');
    }
    // Something else went wrong, display error page
    else {
        include('errorPage.php');
    }
}
// Check if delete post is set - coming from admin discounts page
else if (isset($_POST["delete"])) {
    
    // Get discountId from post
    $id = $_POST["discountId"];
    
    // Call deleteDiscount method in discountBusinessService and set to variable
    $discountResults = $discountService->deleteDiscount($id);
    
    // If discountResults is true or 1, add or delete was successful
    if ($discountResults == 1) {
        include("discountsPage.php");
    }
    // Something else went wrong, display error page
    else {
        include('errorPage.php');
    }
}

