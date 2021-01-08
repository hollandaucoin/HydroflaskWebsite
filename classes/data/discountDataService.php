<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc discountDataService - This is a class to perform the persistence logic on the discount table in the database
 */

// Include dbConnection to allow for inheritance, and Discount to create an instance
include_once('dbConnection.php');
include_once('../classes/models/Discount.php');

class discountDataService extends dbConnection {
    
    /**
     * Method to get the discount amount if it is in the database
     * @param String - $discountCode
     * @return double - $discount
     */
    protected function checkDiscountCode(String $discountCode) {
        
        // Create SQL statement using the discount code to check if that code is valid
        $sqlCheck = "SELECT AMOUNT FROM DISCOUNTS WHERE DISCOUNT_CODE = '" . $discountCode . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sqlCheck);
        
        // If there was one user found, set the results to variable as an array
        if($results->num_rows == 1) {
            $row = $results->fetch_assoc();
            // Get the amount and set to variable
            $discount = $row["AMOUNT"];
            
            // Set discount and discountCode session variables
            $_SESSION['discount'] = $discount;
            $_SESSION['discountCode'] = $discountCode;
            // Return the amount
            return $discount;
        }
        // The code is invalid
        else {
            // Set the discount to 0
            $discount = 0;
            // Set discountCode session variable
            $_SESSION['discount'] = $discount;
            // Return discount
            return $discount;
        }
    }
    
    
    /**
     * Method to delete a used discount code from the database
     * @param String - $discountCode
     * @return boolean - $removeStatus
     */
    protected function removeUsedDiscount(String $discountCode) {
        
        // Delete the discount code (only can be used once)
        $sqlDelete = "DELETE FROM DISCOUNTS WHERE DISCOUNT_CODE = '" . $discountCode . "'";
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sqlDelete)) {
            $removeStatus = true;
        }
        else {
            $removeStatus = false;
        }
        
        // Return removeStatus
        return $removeStatus;
    }
    
    
    /**
     * Method to get all of the discounts in the database
     * @return Discount[] - $discounts
     */
    protected function getAllDiscounts() {
        
        // Create array and index for results
        $discounts = array();
        $index = 0;
        
        // Create SQL statement to select all discounts
        $sql = "SELECT * FROM DISCOUNTS";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['DISCOUNT_ID'];
            $name = $row['NAME'];
            $discountCode = $row['DISCOUNT_CODE'];
            $amount = $row['AMOUNT'];
            
            // Create new instance of discount with variables
            $discount = new Discount($id, $name, $discountCode, $amount);
            
            // Put each instance of discount at index of discounts array, increment index
            $discounts[$index] = $discount;
            $index++;
        }
        
        // Return array of Discount objects
        return $discounts;
    }
    
   
    /**
     * Method to add a discount to the database
     * @param Discount - $discount
     * @return int - $discountAdd
     */
    protected function addNewDiscount(Discount $discount) {
        // Create SQL statement using the discountCode to get if that discountCode is already in the database
        $sqlCheckCode = "SELECT * FROM DISCOUNTS WHERE DISCOUNT_CODE = '" . $discount->getDiscountCode() . "'";
        // Use the connect method dbConnection and query the SQL string
        $codeResults = $this->connect()->query($sqlCheckCode);
        
        // If the discountCode check return results, set $discountAdd to -1 for error messaging (unsuccessul)
        if($codeResults->num_rows > 0) {
            $discountAdd = -1;
        }
        // Else, add the user to the database
        else {
            // Create SQL statement using the all of the user's details to add to the database
            $sql = "INSERT INTO DISCOUNTS (NAME, DISCOUNT_CODE, AMOUNT) VALUES ('" . $discount->getName() . "', '" . $discount->getDiscountCode() . 
                    "', '" . $discount->getAmount() . "')";
                    
                    // Use the connect method dbConnection and query the SQL string
            if($this->connect()->query($sql)) {
                // Set $discountAdd to 1 (successful)
                $discountAdd = 1;
            }
            else {
                $discountAdd = 0;
            }
        }
        
        // Return discountAdd
        return $discountAdd;
    }
    
    
    /**
     * Method for the admin to delete a discount
     * @param int - $id
     * @return int - $discountDelete
     */
    protected function deleteDiscountId(int $id) {
        
        // Delete the discount code (only can be used once)
        $sqlDelete = "DELETE FROM DISCOUNTS WHERE DISCOUNT_ID = '" . $id . "'";
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sqlDelete)) {
            $discountDelete = 1;
        }
        else {
            $discountDelete = 0;
        }
        
        // Return discountDelete
        return $discountDelete;
    }
    
}

