<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc filterHandler - This file is to handle the process of converting the user's search filters into a SQL statement
 */

// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// If bottles are being filtered
if(isset($_POST['bottle'])) {
    
    // Get the passed strings of the filters
    $mouthFilterString = $_POST['filtermouth'];
    $sizeFilterString = $_POST['filtersize'];
    $colorFilterString = $_POST['filtercolor'];
    
    // Convert string filters into array by "," splitting
    $mouthFilter = explode(",", $mouthFilterString);
    $sizeFilter = explode(",", $sizeFilterString);
    $colorFilter = explode(",", $colorFilterString);
    
    // Get the count of the filter arrays
    $mouthCount = count($mouthFilter) - 1;
    $sizeCount = count($sizeFilter) - 1;
    $colorCount = count($colorFilter) - 1;
    
    // Begin the SQL statement with 'where' clause
    $sql = " WHERE";
    
    $filterMessage = "";
    
    // If there are filters for the mouth
    if($mouthCount > 0) {
        // Add '(name like' to SQL statement
        $sql = $sql . " (NAME LIKE ";
        
        // For loop to iterate through each item in  array
        for($i = 0; $i < $mouthCount; $i++) {
            // Add the item to the SQL statement within like parameters
            $sql = $sql . "'%" . $mouthFilter[$i] . "%'";
            // If its not the last item add an 'or name like'
            if($i != $mouthCount - 1) {
                $sql = $sql . " OR NAME LIKE ";
            }
            $filterMessage = $filterMessage . $mouthFilter[$i] . ", ";
        }
        // If there are size or color filters
        if($sizeCount > 0 || $colorCount > 0){
            // Add ') and' to the SQL statement
            $sql = $sql . ") AND ";
        }
        // Else, end this filter in statement with ')'
        else {
            $sql = $sql . ")";
        }
    }
    
    // If there are filters for the size
    if($sizeCount > 0) {
        // Add '(size like' to SQL statement
        $sql = $sql . " (SIZE LIKE ";
        
        // For loop to iterate through each item in  array
        for($i = 0; $i < $sizeCount; $i++) {
            // Add the item to the SQL statement within like parameters
            $sql = $sql . "'%" . $sizeFilter[$i] . "%'";
            // If its not the last item add an 'or size like'
            if($i != $sizeCount - 1) {
                $sql = $sql . " OR SIZE LIKE ";
            }
            $filterMessage = $filterMessage . $sizeFilter[$i] . ", ";
        }
        // If there are color filters
        if($colorCount > 0){
            // Add ') and' to the SQL statement
            $sql = $sql . ") AND ";
        }
        // Else, end this filter in statement with ')'
        else {
            $sql = $sql . ")";
        }
    }
    
    // If there are filters for the count
    if($colorCount > 0) {
        // Add '(color like' to SQL statement
        $sql = $sql . " (COLOR LIKE ";
        
        // For loop to iterate through each item in  array
        for($i = 0; $i < $colorCount; $i++) {
            // Add the item to the SQL statement within like parameters
            $sql = $sql . "'%" . $colorFilter[$i] . "%'";
            // If its not the last item add an 'or color like'
            if($i != $colorCount - 1) {
                $sql = $sql . " OR COLOR LIKE ";
            }
            $filterMessage = $filterMessage . $colorFilter[$i] . ", ";
        }
        // End filter in statement with ')'
        $sql = $sql . ")";
    }
    
    // If there are no filters set SQL statement to empty (no 'where') to get all products
    if($mouthCount == 0 && $sizeCount == 0 && $colorCount == 0) {
        $sql = "";
    }
    
    if($filterMessage != "") {
        $filterMessage = "Filtered by: " . $filterMessage;
        $filterMessage = rtrim($filterMessage, ", ");
    }
    
    // Navigate to the bottlesPage with GET and POST variables
    $_POST['filterSql'] = $sql;
    $_GET['offset'] = 0;
    $message = $filterMessage;
    include('bottlesPage.php');
}
// If boots are being filtered
else if(isset($_POST['boot'])) {
    
    // Get the passed strings of the filters
    $sizeFilterString = $_POST['filtersize'];
    $colorFilterString = $_POST['filtercolor'];
    
    // Convert string filters into array by "," splitting
    $sizeFilter = explode(",", $sizeFilterString);
    $colorFilter = explode(",", $colorFilterString);
    
    // Get the count of the filter arrays
    $sizeCount = count($sizeFilter) - 1;
    $colorCount = count($colorFilter) - 1;
    
    // Begin the SQL statement with 'where' clause
    $sql = " WHERE";
    
    $filterMessage = "";
    
    // If there are filters for the size
    if($sizeCount > 0) {
        // Add '(size like' to SQL statement
        $sql = $sql . " (SIZE LIKE ";
        
        // For loop to iterate through each item in  array
        for($i = 0; $i < $sizeCount; $i++) {
            // Add the item to the SQL statement within like parameters
            $sql = $sql . "'%" . $sizeFilter[$i] . "%'";
            // If its not the last item add an 'or size like'
            if($i != $sizeCount - 1) {
                $sql = $sql . " OR SIZE LIKE ";
            }
            $filterMessage = $filterMessage . $sizeFilter[$i] . ", ";
        }
        // If there are color filters
        if($colorCount > 0){
            // Add ') and' to the SQL statement
            $sql = $sql . ") AND ";
        }
        // Else, end this filter in statement with ')'
        else {
            $sql = $sql . ")";
        }
    }
    
    // If there are filters for the count
    if($colorCount > 0) {
        // Add '(color like' to SQL statement
        $sql = $sql . " (COLOR LIKE ";
        
        // For loop to iterate through each item in  array
        for($i = 0; $i < $colorCount; $i++) {
            // Add the item to the SQL statement within like parameters
            $sql = $sql . "'%" . $colorFilter[$i] . "%'";
            // If its not the last item add an 'or color like'
            if($i != $colorCount - 1) {
                $sql = $sql . " OR COLOR LIKE ";
            }
            $filterMessage = $filterMessage . $colorFilter[$i] . ", ";
        }
        // End filter in statement with ')'
        $sql = $sql . ")";
    }
    
    // If there are no filters set SQL statement to empty (no 'where') to get all products
    if($sizeCount == 0 && $colorCount == 0) {
        $sql = "";
    }
    
    if($filterMessage != "") {
        $filterMessage = "Filtered by: " . $filterMessage;
        $filterMessage = rtrim($filterMessage, ", ");
    }
    
    // Navigate to the bootsPage with GET and POST variables
    $_POST['filterSql'] = $sql;
    $_GET['offset'] = 0;
    $message = $filterMessage;
    include('bootsPage.php');
}
// If lids are being filtered
else if(isset($_POST['lid'])) {
    
    // Get the passed strings of the filters
    $mouthFilterString = $_POST['filtermouth'];
    $colorFilterString = $_POST['filtercolor'];
    
    // Convert string filters into array by "," splitting
    $mouthFilter = explode(",", $mouthFilterString);
    $colorFilter = explode(",", $colorFilterString);
    
    // Get the count of the filter arrays
    $mouthCount = count($mouthFilter) - 1;
    $colorCount = count($colorFilter) - 1;
    
    // Begin the SQL statement with 'where' clause
    $sql = " WHERE";
    
    $filterMessage = "";
    
    // If there are filters for the mouth
    if($mouthCount > 0) {
        // Add '(name like' to SQL statement
        $sql = $sql . " (NAME LIKE ";
        
        // For loop to iterate through each item in  array
        for($i = 0; $i < $mouthCount; $i++) {
            // Add the item to the SQL statement within like parameters
            $sql = $sql . "'%" . $mouthFilter[$i] . "%'";
            // If its not the last item add an 'or name like'
            if($i != $mouthCount - 1) {
                $sql = $sql . " OR NAME LIKE ";
            }
            $filterMessage = $filterMessage . $mouthFilter[$i] . ", ";
        }
        // If there are size or color filters
        if($sizeCount > 0 || $colorCount > 0){
            // Add ') and' to the SQL statement
            $sql = $sql . ") AND ";
        }
        // Else, end this filter in statement with ')'
        else {
            $sql = $sql . ")";
        }
    }
    
    // If there are filters for the count
    if($colorCount > 0) {
        // Add '(color like' to SQL statement
        $sql = $sql . " (COLOR LIKE ";
        
        // For loop to iterate through each item in  array
        for($i = 0; $i < $colorCount; $i++) {
            // Add the item to the SQL statement within like parameters
            $sql = $sql . "'%" . $colorFilter[$i] . "%'";
            // If its not the last item add an 'or color like'
            if($i != $colorCount - 1) {
                $sql = $sql . " OR COLOR LIKE ";
            }
            $filterMessage = $filterMessage . $colorFilter[$i] . ", ";
        }
        // End filter in statement with ')'
        $sql = $sql . ")";
    }
    
    // If there are no filters set SQL statement to empty (no 'where') to get all products
    if($mouthCount == 0 && $colorCount == 0) {
        $sql = "";
    }
    
    if($filterMessage != "") {
        $filterMessage = "Filtered by: " . $filterMessage;
        $filterMessage = rtrim($filterMessage, ", ");
    }
    
    // Navigate to the lidsPage with GET and POST variables
    $_POST['filterSql'] = $sql;
    $_GET['offset'] = 0;
    $message = $filterMessage;
    include('lidsPage.php');
}
// Something else went wrong
else {
    include('errorPage.php');
}

