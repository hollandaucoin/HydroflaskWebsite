<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc cartDataService - This is a class to perform the persistence logic on the cart table in the database
 */

// Include dbConnection to allow for inheritance, and Cart to create an instance
include_once('dbConnection.php');
include_once('../classes/models/Cart.php');

class cartDataService extends dbConnection {
    
    /**
     * Method to add a product to a cart using the product type and id
     * @param (Bottle, Boot, or Lid) - $product
     * @param String - $type
     * @return boolean - $addStatus
     */
    protected function addToCart($product, String $type) {
        
        // If the user isn't logged in (session variable not set), set userId session variable to 0 and userRole session variable to temp
        if(!isset($_SESSION["userId"])) {
            $_SESSION["userId"] = 1;
            $_SESSION["userRole"] = "temp";
        }
        
        // Create SQL statement using the product details to check if that product has already been added to the cart
        $sqlCheck = "SELECT * FROM CART WHERE USER_ID = '" . $_SESSION["userId"] . "' AND PRODUCT_ID =  '" . $product->getId() . "'
                    AND PRODUCT_TYPE = '" . $type . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sqlCheck);
        
        // If the results of the select SQL statement have no results
        if($results->num_rows == 0) {
            
            // Create SQL statement using the product details to add to the database
            $sql = "INSERT INTO CART (USER_ID, PRODUCT_ID, PRODUCT_TYPE, QUANTITY)
                VALUES ('" . $_SESSION["userId"] . "', '" . $product->getId() . "', '" . $type . "', '1')";
            
            // Use the connect method dbConnection and query the SQL string
            if($this->connect()->query($sql)) {
                $addStatus = true;
            }
            else {
                $addStatus = false;
            }
        }
        // Else, the select statement had results (product already added to cart of user) then update quantity
        else {
            
            // Create SQL statement using the $id variable to update quantity of a product
            $sqlUpdate = "UPDATE CART SET QUANTITY = QUANTITY + 1 WHERE USER_ID = '" . $_SESSION["userId"] . 
                            "' AND PRODUCT_ID =  '" . $product->getId() . "' AND PRODUCT_TYPE = '" . $type . "'";
            
            // Use the connect method dbConnection and query the SQL string
            if($this->connect()->query($sqlUpdate)) {
                $addStatus =  true;
            }
            else {
                $addStatus = false;
            }
        }
        
        return $addStatus;
    }
    
    
    /**
     * Method to get all of the cart items of a user
     * @return Cart[] - $carts
     */
    protected function getCartItems() {
        
        // Create array and index for results
        $carts = array();
        $index = 0;
        
        // If the user isn't logged in (session variable not set), set userId session variable to 0 and userRole session variable to temp
        if(!isset($_SESSION["userId"])) {
            $_SESSION["userId"] = 1;
            $_SESSION["userRole"] = "temp";
        }
        
        // Create SQL statement to select cart items of user
        $sql = "SELECT * FROM CART WHERE USER_ID = '" . $_SESSION["userId"] . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['CART_ID'];
            $userId = $row['USER_ID'];
            $productId = $row['PRODUCT_ID'];
            $productType = $row['PRODUCT_TYPE'];
            $quantity = $row['QUANTITY'];
            
            // Create new instance of cart with variables
            $cart = new Cart($id, $userId, $productId, $productType, $quantity);
            
            // Put each instance of cart at index of carts array, increment index
            $carts[$index] = $cart;
            $index++;
        }
        
        // Return array of Cart objects
        return $carts;
    }
    
    
    /**
     * Method to update the quantity of a product within a cart
     * @param int  - $id
     * @param int - $quantity
     * @return boolean - $updateStatus
     */
    protected function updateProductQuantity(int $id, int $quantity) {
        
        // Create SQL statement using the $quantity and $id variables
        $sql = "UPDATE CART SET QUANTITY = '" . $quantity . "' WHERE CART_ID = '" . $id . "'";
        
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            $updateStatus = true;
        }
        else {
            $updateStatus = false;
        }
        
        // Return updateStatus
        return $updateStatus;
    }
    
    
    /**
     * Method to delete an item from a cart
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    protected function deleteCartItem(int $id) {
        
        // Create SQL statement using the $id variable
        $sql = "DELETE FROM CART WHERE CART_ID = '" . $id . "'";
        
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            $deleteStatus = true;
        }
        else {
            $deleteStatus = false;
        }
        
        // Return deleteStatus
        return $deleteStatus;
    }
    
    
    /**
     * Method to clear a cart given the user's id
     * @param int - $id
     * @return boolean - $clearStatus
     */
    protected function clearDefaultCart(int $id) {
        
        // Create SQL statement using the $id variable
        $sql = "DELETE FROM CART WHERE USER_ID = '" . $id . "'";
        
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            $clearStatus = true;
        }
        else {
            $clearStatus = false;
        }
        
        // Return clearStatus
        return $clearStatus;
    }
    
    
    /**
     * Method to update the user id of a product in a cart to the user currently signed in
     * @return boolean - $updateStatus
     */
    protected function updateProductUserId() {
        
        // Create SQL statement using the id session variable
        $sql = "UPDATE CART SET USER_ID = '" . $_SESSION['userId'] . "' WHERE USER_ID = '1'";
        
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            $updateStatus = true;
        }
        else {
            $updateStatus = false;
        }
        
        // Return updateStatus
        return $updateStatus;
    }
    
    
}

