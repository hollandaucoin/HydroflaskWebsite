<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc bottleBusinessService - This is a class to perform the business logic of bottles between the presentation and persistence layers
 */

// Include bottleDataService to allow for inheritance
include_once('../classes/data/bottleDataService.php');

class bottleBusinessService extends bottleDataService {

    /**
     * Method to get all of the bottles
     * @return Bottle[] - $bottles
     */
    public function getBottles() {
        
        // Call getAllBottles method in bottleDataService and set to variable
        $bottles = $this->getAllBottles();
        
        // Return array of bottles
        return $bottles; 
    }
    
    
    /**
     * Method to get an offset of bottles
     * @param int - $offset
     * @return Bottle[] - $bottles
     */
    public function getBottlesOffset(int $offset) {
        
        // Call getAllBottlesOffset method in bottleDataService and set to variable
        $bottles = $this->getAllBottlesOffset($offset);
        
        // Return array of bottles
        return $bottles;
    }
    
    
    /**
     * Method to add a bottle (named product to match other business services)
     * @param Bottle - $bottle
     * @return int - $addStatus
     */
    public function addProduct(Bottle $bottle) {
        
        // Call createBottle method in bottleDataService and set to variable
        $addStatus = $this->createBottle($bottle);
        
        // Return the bottle add status int
        return $addStatus;
        
    }
     
    
    /**
     * Method to get a bottle given the id
     * @param int - $id
     * @return Bottle - $bottle
     */
    public function getBottleFromId(int $id) {
        
        // Call getBottleById method in bottleDataService and set to variable
        $bottle = $this->getBottleById($id);
       
        // Return the bottle object
        return $bottle;
    }
    
    
    /**
     * Method to get the offset of bottles that match the sql parameter
     * @param String - $sql
     * @param int - $offset
     * @return Bottle[] - $bottles
     */
    public function getBottlesSearch(String $sql, int $offset) {
        
        // Call searchBottles method in bottleDataService and set to variable
        $bottles = $this->searchBottles($sql, $offset);
        
        // Return array of bottles
        return $bottles;
    }
    
    
    /**
     * Method to get the number of bottles that match the sql parameter
     * @param String - $sql
     * @return int - $count
     */
    public function getBottlesSearchCount(String $sql) {
        
        // Call searchBottlesCount method in bottleDataService and set to variable
        $count = $this->searchBottlesCount($sql);
        
        // Return count of bottles
        return $count;
    }
    
    
    /**
     * Method to edit a bottle (named product to match other business services)
     * @param Bottle - $bottle
     * @return boolean - $editStatus
     */
    public function editProduct(Bottle $bottle) {
        
        // Call updateBottle method in bottleDataService and set to variable
        $editStatus = $this->updateBottle($bottle);
        
        // Return the edit status boolean
        return $editStatus;
    }
    
    
    /**
     * Method to delete a bottle (named product to match other business services)
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    public function deleteProductFromId(int $id) {
        
        // Call deleteBottleById method in bottleDataService and set to variable
        $deleteStatus = $this->deleteBottleById($id);
        
        // Return the delete status boolean
        return $deleteStatus;
    }
 
    
}

