<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc lidBusinessService - This is a class to perform the business logic of lids between the presentation and persistence layers
 */

// Include lidsDataService to allow for inheritance
include_once('../classes/data/lidDataService.php');

class lidBusinessService extends lidDataService {

    /**
     * Method to get all of the lids
     * @return Lid[] - $lids
     */
    public function getLids() {
        
        // Call getAllLids method in lidDataService and set to variable
        $lids = $this->getAllLids();
        
        // Return array of lids
        return $lids; 
    }
    
    
    /**
     * Method to get an offset of lids
     * @param int - $offset
     * @return Lid[] - $lids
     */
    public function getLidsOffset(int $offset) {
        
        // Call getAllLidsOffset method in lidDataService and set to variable
        $lids = $this->getAllLidsOffset($offset);
        
        // Return array of lids
        return $lids;
    }
    
    
    /**
     * Method to add a lid (named product to match other business services)
     * @param Lid - $lid
     * @return boolean - $addStatus
     */
    public function addProduct(Lid $lid) {
        
        // Call createLid method in lidDataService and set to variable
        $addStatus = $this->createLid($lid);
        
        // Return the lid add status boolean
        return $addStatus;
        
    }
    
    
    /**
     * Method to get a lid given the id
     * @param int - $id
     * @return Lid - $lid
     */
    public function getLidFromId(int $id) {
        
        // Call getLidById method in lidDataService and set to variable
        $lid = $this->getLidById($id);
       
        // Return the lid object
        return $lid;
    }
    
    
    /**
     * Method to get the lids that match the parameter
     * @param String - $sql
     * @param int - $offset
     * @return Lid[] - $lids
     */
    public function getLidsSearch(String $sql, int $offset) {
        
        // Call searchLids method in lidDataService and set to variable
        $lids = $this->searchLids($sql, $offset);
        
        // Return array of lids
        return $lids;
    }
    
    
    /**
     * Method to get the number of lids that match the sql parameter
     * @param String - $sql
     * @return int - $count
     */
    public function getLidsSearchCount(String $sql) {
        
        // Call searchLidsCount method in lidDataService and set to variable
        $count = $this->searchLidsCount($sql);
        
        // Return count of lids
        return $count;
    }
    
    
    /**
     * Method to edit a lid (named product to match other business services)
     * @param Lid - $lid
     * @return boolean - $editStatus
     */
    public function editProduct(Lid $lid) {
        
        // Call updateLid method in lidDataService and set to variable
        $editStatus = $this->updateLid($lid);
        
        // Return the edit status boolean
        return $editStatus;
    }
    
    
    /**
     * Method to delete a lid (named product to match other business services)
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    public function deleteProductFromId($id) {
        
        // Call deleteLidById method in lidDataService and set to variable
        $deleteStatus = $this->deleteLidById($id);
        
        // Return the delete status boolean
        return $deleteStatus;
    }
    
}

