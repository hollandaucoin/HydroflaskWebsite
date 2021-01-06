<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc cartBusinessService - This is a class to perform the business logic of carts between the presentation and persistence layers
 */

// Include cartDataService to allow for inheritance
include_once('../classes/data/cartDataService.php');

class cartBusinessService extends cartDataService {
    
    /**
     * Method to add a product to a cart given the type
     * @param (Bottle, Boot, or Lid) - $product
     * @param String - $type
     * @return boolean - $addStatus
     */
    public function addProductToCart($product, String $type) {
        
        // Call addToCart method in cartDataService and set to variable
        $addStatus = $this->addToCart($product, $type);
        
        // Return the add status boolean
        return $addStatus;
    }
    
    
    /**
     * Method all items in a users cart
     * @return Cart[] - $carts
     */
    public function getCart() {
        
        // Call getCartItems method in cartDataService and set to variable
        $carts = $this->getCartItems();
        
        // Return the array of cart objects
        return $carts;
    }
    
    
    /**
     * Method to update the quantity of a product in a cart
     * @param int - $id
     * @param int - $quantity
     * @return boolean - $updateStatus
     */
    public function updateQuantity(int $id, int $quantity) {
        
        // Call updateProductQuantity method in cartDataService and set to variable
        $updateStatus = $this->updateProductQuantity($id, $quantity);
        
        // Return the update status boolean
        return $updateStatus;
    }
    
    
    /**
     * Method to delete a product within a cart
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    public function deleteCartItemById(int $id) {
        
        // Call deleteCartItem method in cartDataService and set to variable
        $deleteStatus = $this->deleteCartItem($id);
        
        // Return the delete status boolean
        return $deleteStatus;
    }
    
    
    /**
     * Method to clear a cart given the user id
     * @param int - $id
     * @return boolean - $clearStatus
     */
    public function clearCart(int $id) {
        
        // Call clearDefaultCart method in cartDataService and set to variable
        $clearStatus = $this->clearDefaultCart($id);
        
        // Return the delete status boolean
        return $clearStatus;
    }
    
    
    /**
     * Method to update the items in a cart to a specific user
     * @return boolean - $updateStatus
     */
    public function updateItemsToUserId() {
        
        // Call updateProductUserId method in cartDataService and set to variable
        $updateStatus = $this->updateProductUserId();
        
        // Return the update status boolean
        return $updateStatus;
    }
    
}

