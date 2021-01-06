<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc adminProductHandler - This file is to handle the process of an admin adding, editing, and deleting a product
 */


// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Security check to keep page protected from regular users
if(!isset($_SESSION['userId']) || $_SESSION['userRole'] != "Admin") {
    header("Location: loginPage.php");
}

// Get the product type through POST method
$type = $_POST['type'];

// If the type is bottle
if($type == "bottle") {
    
    // Include the Bottle model and the bottleBusinessService to create an instance
    include_once('../classes/models/Bottle.php');
    include_once('../classes/business/bottleBusinessService.php');
    
    // Create instance of bottleBusinessService
    $productService = new bottleBusinessService();
    
}
// If the type is boot
else if($type == "boot") {
    
    // Include the Boot model and the bootBusinessService to create an instance
    include_once('../classes/models/Boot.php');
    include_once('../classes/business/bootBusinessService.php');
    
    // Create instance of bootBusinessService
    $productService = new bootBusinessService();
}
// If the type is lid
else if($type == "lid") {
    
    // Include the Lid model and the lidBusinessService to create an instance
    include_once('../classes/models/Lid.php');
    include_once('../classes/business/lidBusinessService.php');
    
    // Create instance of lidBusinessService
    $productService = new lidBusinessService();
}


// If the add POST is set
if(isset($_POST['add'])) {
    
    // Retrieve variables from POST
    $size = $_POST['size'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $photo = $_POST['photo'];
    $color = trim($_POST['color']);
    
    // If the type is bottle
    if($type == "bottle") {
        
        // Get the extra variables for a bottle
        $volume = trim($_POST['volume']);
        $height = trim($_POST['height']);
        $weight = trim($_POST['weight']);
        
        // Create instance of Bottle with a null id (for adding)
        $product = new Bottle(NULL, $size, $name, $description, $price, $photo, $color, $volume, $height, $weight);
    }
    // If the type is boot
    else if($type == "boot") {
        
        // Create instance of Boot with a null id (for adding)
        $product = new Boot(NULL, $size, $name, $description, $price, $photo, $color);
    }
    // If the type is lid
    else if($type == "lid") {
        
        // Create instance of Lid with a null id (for adding)
        $product = new Lid(NULL, $size, $name, $description, $price, $photo, $color);
    }

    
    // Call addProduct method in the according business service and set to variable
    $productResults = $productService->addProduct($product);
}
// If the edit POST is set
else if(isset($_POST['edit'])) {
    
    // Retrieve variables from POST
    $id = $_POST['id'];
    $size = $_POST['size'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $photo = $_POST['photo'];
    $color = trim($_POST['color']);
    
    // If the type is bottle
    if($type == "bottle") {
        
        // Get the extra variables for a bottle
        $volume = trim($_POST['volume']);
        $height = trim($_POST['height']);
        $weight = trim($_POST['weight']);
        
        // Create instance of Bottle with a null id (for adding)
        $product = new Bottle($id, $size, $name, $description, $price, $photo, $color, $volume, $height, $weight);
    }
    // If the type is boot
    else if($type == "boot") {
        
        // Create instance of Boot with a null id (for adding)
        $product = new Boot($id, $size, $name, $description, $price, $photo, $color);
    }
    // If the type is lid
    else if($type == "lid") {
        
        // Create instance of Lid with a null id (for adding)
        $product = new Lid($id, $size, $name, $description, $price, $photo, $color);
    }
    
    // Call editProduct method in the according business service and set to variable
    $productResults = $productService->editProduct($product);
}
// If the delete POST is set
else if(isset($_POST['delete'])) {

    // Get the existing product id from POST
    $id = $_POST['id'];
    
    // Call deleteProductFromId method the according business service and set to variable
    $productResults = $productService->deleteProductFromId($id);
}


// If productResults is true, add, edit, or delete was successful
if($productResults == true) {

    // Navigate back to the according product page with offset being 0
    if($type == "bottle") {
        $_GET['offset'] = 0;
        include('bottlesPage.php');
    }
    else if ($type == "boot") {
        $_GET['offset'] = 0;
        include('bootsPage.php');
    }
    else if ($type == "lid") {
        $_GET['offset'] = 0;
        include('lidsPage.php');
    }
}
// Something went wrong
else {
    include('errorPage.php');
}

