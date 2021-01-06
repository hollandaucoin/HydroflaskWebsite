<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc discountBusinessService - This is a class to perform the business logic of discounts between the presentation and persistence layers
 */

// Include discountDataService to allow for inheritance
include_once('../classes/data/discountDataService.php');

class discountBusinessService extends discountDataService {
    
    /**
     * Method to check if the discount code is valid
     * @param String - $discountCode
     * @return double - $discount
     */
    public function checkDiscount(String $discountCode) {
        
        // Call checkDiscountCode method in discountDataService and set to variable
        $discount = $this->checkDiscountCode($discountCode);
        
        // Return the discount
        return $discount;
    }
    
    
    /**
     * Method to remove a used discount code
     * @param String - $discountCode
     * @return boolean - $removeStatus
     */
    public function removeDiscount(String $discountCode) {
        
        // Call removeUsedDiscount method in discountDataService and set to variable
        $removeStatus = $this->removeUsedDiscount($discountCode);
        
        // Return the removeStatus
        return $removeStatus;
    }
    
    
    /**
     * Method to get all discounts
     * @return Discount[] - $discounts
     */
    public function getDiscounts() {
        
        // Call getAllDiscounts method in discountDataService and set to variable
        $discounts = $this->getAllDiscounts();
        
        // Return the discounts
        return $discounts;
    }
    
    
    /**
     * Method to add a new discount
     * @param Discount - $discount
     * @return boolean - $addStatus
     */
    public function addDiscount(Discount $discount) {
        
        // Call addNewDiscount method in discountDataService and set to variable
        $addStatus = $this->addNewDiscount($discount);
        
        // Return the addStatus
        return $addStatus;
    }
    
    
    /**
     * Method for an admin to delete discount
     * @param int - $discountId
     * @return boolean - $deleteStatus
     */
    public function deleteDiscount(int $discountId) {
        
        // Call deleteDiscountId method in discountDataService and set to variable
        $deleteStatus = $this->deleteDiscountId($discountId);
        
        // Return the deleteStatus
        return $deleteStatus;
    }
    
}

