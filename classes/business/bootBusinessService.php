<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc bootBusinessService - This is a class to perform the business logic of boots between the presentation and persistence layers
 */

// Include bootDataService to allow for inheritance
include_once('../classes/data/bootDataService.php');

class bootBusinessService extends bootDataService {

    /**
     * Method to get all of the boots
     * @return Boot[] - $boots
     */
    public function getBoots() {
        
        // Call getAllBoots method in bootDataService and set to variable
        $boots = $this->getAllBoots();
        
        // Return array of boots
        return $boots; 
    }
    
    
    /**
     * Method to get an offset of boots
     * @param int - $offset
     * @return Boot[] - $boots
     */
    public function getBootsOffset(int $offset) {
        
        // Call getAllBootsOffset method in bootDataService and set to variable
        $boots = $this->getAllBootsOffset($offset);
        
        // Return array of boots
        return $boots;
    }
    
    
    /**
     * Method to add a boot (named product to match other business services)
     * @param Boot - $boot
     * @return boolean - $addStatus
     */
    public function addProduct(Boot $boot) {
        
        // Call createBoot method in bootDataService and set to variable
        $addStatus = $this->createBoot($boot);
        
        // Return the boot add status boolean
        return $addStatus;
        
    }
    
    
    /**
     * Method to get a boot given the id
     * @param int - $id
     * @return Boot - $boot
     */
    public function getBootFromId(int $id) {
        
        // Call getBootById method in bootDataService and set to variable
        $boot = $this->getBootById($id);
       
        // Return the boot object
        return $boot;
    }
    
    
    /**
     * Method to get the boots that match the parameter
     * @param String - $sql
     * @param int - $offset
     * @return Boot[] - $boots
     */
    public function getBootsSearch(String $sql, int $offset) {
        
        // Call searchBoots method in bootDataService and set to variable
        $boots = $this->searchBoots($sql, $offset);
        
        // Return array of boots
        return $boots;
    }
    
    
    /**
     * Method to get the number of boots that match the sql parameter
     * @param String - $sql
     * @return int - $count
     */
    public function getBootsSearchCount(String $sql) {
        
        // Call searchBootsCount method in bootDataService and set to variable
        $count = $this->searchBootsCount($sql);
        
        // Return count of boots
        return $count;
    }
    
    
    /**
     * Method to edit a boot (named product to match other business services)
     * @param Boot - $boot
     * @return boolean - $editStatus
     */
    public function editProduct(Boot $boot) {
        
        // Call updateBoot method in bootDataService and set to variable
        $editStatus = $this->updateBoot($boot);
        
        // Return the edit status boolean
        return $editStatus;
    }
    
    
    /**
     * Method to delete a boot (named product to match other business services)
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    public function deleteProductFromId(int $id) {
        
        // Call deleteBootById method in bootDataService and set to variable
        $deleteStatus = $this->deleteBootById($id);
        
        // Return the delete status boolean
        return $deleteStatus;
    }
    
}

