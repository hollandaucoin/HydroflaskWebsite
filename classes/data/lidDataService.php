<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc lidDataService - This is a class to perform the persistence logic of lids to the database
 */

// Include dbConnection to allow for inheritance, and Lid to create an instance
include_once('dbConnection.php');
include_once('../classes/models/Lid.php');

class lidDataService extends dbConnection {
    
    /**
     * Method to get all lids from the database
     * @return Lid[] - $lids
     */
    protected function getAllLids() {
        
        // Create array and index for results
        $lids = array();
        $index = 0;

        // Create SQL statement
        $sql = "SELECT * FROM LIDS";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
   
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['LID_ID'];
            $size = $row['SIZE'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $price = $row['PRICE'];
            $photo = $row['PHOTO'];
            $color = $row['COLOR'];
            
            // Create new instance of lid with variables
            $lid = new Lid($id, $size, $name, $description, $price, $photo, $color);
            
            // Put each instance of lid at index of lids array, increment index
            $lids[$index] = $lid;
            $index++;
        }
        
        // Return array of Lid objects
        return $lids;
    }
    
    
    /**
     * Method to get an offset of lids from the database
     * @param int - $offset
     * @return Lid[] - $lids
     */
    protected function getAllLidsOffset(int $offset) {
        
        // Create array and index for results
        $lids = array();
        $index = 0;
        
        // Create SQL statement using the $offset variables
        $sql = "SELECT * FROM LIDS ORDER BY LID_ID LIMIT 12 OFFSET " . $offset;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['LID_ID'];
            $size = $row['SIZE'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $price = $row['PRICE'];
            $photo = $row['PHOTO'];
            $color = $row['COLOR'];
            
            // Create new instance of lid with variables
            $lid = new Lid($id, $size, $name, $description, $price, $photo, $color);
            
            // Put each instance of lid at index of lids array, increment index
            $lids[$index] = $lid;
            $index++;
        }
        
        // Return array of Lid objects
        return $lids;
    }
    
    
    /**
     * Method to add a lid into the database
     * @param Lid - $lid
     * @return boolean - $createStatus
     */
    protected function createLid(Lid $lid) {
        
        // Adjust photo variable so its correct in database
        $photo = "../assets/img/products/" . $lid->getPhoto();
        
        // Create SQL statement using the all of the lid details to add to the database
        $sql = "INSERT INTO LIDS (SIZE, NAME, DESCRIPTION, PRICE, PHOTO, COLOR) VALUES ('" . $lid->getSize() . "', '" . $lid->getName() . "', '" . 
                $lid->getDescription() . "', '" . $lid->getPrice() . "', '" . $photo . "', '" . $lid->getColor() . "')";
        
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            $createStatus = true;
        }
        else {
            $createStatus = false;
        }
        
        // Return createStatus
        return $createStatus;
    }
    
    
    /**
     * Method to get a lid given the id
     * @param int - $id
     * @return Lid - $lid
     */
    protected function getLidById(int $id) {

        // Create SQL statement using the $type variable
        $sql = "SELECT * FROM LIDS WHERE LID_ID = '" . $id . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // Fetch the resulted row as an associative array and set to variable
        $row = $results->fetch_assoc();
        
        // Get the variables of resulted row array
        $size = $row['SIZE'];
        $name = $row['NAME'];
        $description = $row['DESCRIPTION'];
        $price = $row['PRICE'];
        $photo = $row['PHOTO'];
        $color = $row['COLOR'];
        
        // Create new instance of lid with variables
        $lid = new Lid($id, $size, $name, $description, $price, $photo, $color);
        
        // Return instance of lid
        return $lid;
    }
    
    
    /**
     * Method to get the lids that match the parameter
     * @param String - $sqlStatement
     * @param int - $offset
     * @return Lid[] - $lids
     */
    protected function searchLids(String $sqlStatement, int $offset) {
        
        // Create array and index for results
        $lids = array();
        $index = 0;
        
        // Create SQL statement using the $sqlStatement variable to get an offset of lids
        $sql = "SELECT * FROM LIDS" . $sqlStatement . " ORDER BY LID_ID LIMIT 12 OFFSET " . $offset;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);

        // If there are results that matched the search parameter
        if($results->num_rows > 0) {
            
            // While there are results, fetch a resulted row as an associative array and set to variable
            while($row = $results->fetch_assoc()) {
                
                // Get the variables of each resulted row array
                $id = $row['LID_ID'];
                $size = $row['SIZE'];
                $name = $row['NAME'];
                $description = $row['DESCRIPTION'];
                $price = $row['PRICE'];
                $photo = $row['PHOTO'];
                $color = $row['COLOR'];
                
                // Create new instance of lid with variables
                $lid = new Lid($id, $size, $name, $description, $price, $photo, $color);
                
                // Put each instance of lid at index of lids array, increment index
                $lids[$index] = $lid;
                $index++;
            }
           
        }
        
        // Return array of Lid objects
        return $lids;
    }
    
    
    /**
     * Method to get the lids that match the parameter
     * @param String - $sqlStatement
     * @return int - $index
     */
    protected function searchLidsCount(String $sqlStatement) {
        
        // Create index for results
        $index = 0;
        
        // Create SQL statement using the $sql variable
        $sql = "SELECT * FROM LIDS" . $sqlStatement;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, increment index
        while($row = $results->fetch_assoc()) {
            
            $index++;
        }
        
        // Return count of lids
        return $index;
    }
    
   
    /**
     * Method to update a lid within the database
     * @param boolean - $updateStatus
     */
    protected function updateLid(Lid $lid) {
        
        // Adjust photo variable so its correct in database
        $photo = "../assets/img/products/" . $lid->getPhoto();
        
        // Create SQL statement using the $id variable
        $sql = "UPDATE LIDS SET SIZE = '" . $lid->getSize() . "', NAME = '" . $lid->getName() . "', DESCRIPTION = '" . $lid->getDescription() .
                "', PRICE = '" . $lid->getPrice() . "', PHOTO = '" . $photo . "', COLOR = '" . $lid->getColor() . "' WHERE LID_ID = " . $lid->getId();
        
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
     * Method to delete a lid from the database
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    protected function deleteLidById(int $id) {
        
        // Create SQL statement using the $id variable
        $sql = "DELETE FROM LIDS WHERE LID_ID = '" . $id . "'";
        
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
    
    
}

