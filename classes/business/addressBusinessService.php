<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc addressBusinessService - This is a class to perform the business logic of addresses between the presentation and persistence layers
 */

// Include addressDataService to allow for inheritance
include_once('../classes/data/addressDataService.php');

class addressBusinessService extends addressDataService {
    
    /**
     * Method to check if the inputted shipping address is already in the database
     * @param Address - $address
     * @return boolean - $shippingCheck
     */
    public function checkUserShipping(Address $address) {
        
        // Call checkForAddress method in addressDataService and set to variable
        $shippingCheck = $this->checkForAddress($address);
        
        // Return the shipping check boolean
        return $shippingCheck;
    }

    
    /**
     * Method to add a user's shipping address to the database
     * @param Address - $address
     * @return boolean - $addStatus
     */
    public function addUserAddress(Address $address) {
        
        // Call addAddress method in addressDataService and set to variable
        $addStatus = $this->addAddress($address);
        
        // Return the add status boolean
        return $addStatus;
    }
    
    
    /**
     * Method to get an address given the id
     * @param int - $id
     */
    public function getAddressFromId(int $id) {
       
        // Call getAddressById in addressDataService and set to variable
        $address = $this->getAddressById($id);
        
        // Return the order
        return $address;
    }
}

