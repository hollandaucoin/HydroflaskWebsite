<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc bootDataService - This is a class to perform the persistence logic of boots to the database
 */

// Include dbConnection to allow for inheritance, and Boot to create an instance
include_once('dbConnection.php');
include_once('../classes/models/Boot.php');

class bootDataService extends dbConnection {
    
    /**
     * Method to get all boots from the database
     * @return Boot[] - $boots
     */
    protected function getAllBoots() {
        
        // Create array and index for results
        $boots = array();
        $index = 0;

        // Create SQL statement
        $sql = "SELECT * FROM BOOTS";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
   
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['BOOT_ID'];
            $size = $row['SIZE'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $price = $row['PRICE'];
            $photo = $row['PHOTO'];
            $color = $row['COLOR'];
            
            // Create new instance of boot with variables
            $boot = new Boot($id, $size, $name, $description, $price, $photo, $color);
            
            // Put each instance of boot at index of boots array, increment index
            $boots[$index] = $boot;
            $index++;
        }
        
        // Return array of Boot objects
        return $boots;
    }
    
    
    /**
     * Method to get an offset of boots from the database
     * @param int - $offset
     * @return Boot[] - $boots
     */
    protected function getAllBootsOffset(int $offset) {
        
        // Create array and index for results
        $boots = array();
        $index = 0;
        
        // Create SQL statement using the $offset variables
        $sql = "SELECT * FROM BOOTS ORDER BY BOOT_ID LIMIT 12 OFFSET " . $offset;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['BOOT_ID'];
            $size = $row['SIZE'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $price = $row['PRICE'];
            $photo = $row['PHOTO'];
            $color = $row['COLOR'];
            
            // Create new instance of boot with variables
            $boot = new Boot($id, $size, $name, $description, $price, $photo, $color);
            
            // Put each instance of boot at index of boots array, increment index
            $boots[$index] = $boot;
            $index++;
        }
        
        // Return array of Boot objects
        return $boots;
    }
    
    
    /**
     * Method to add a boot into the database
     * @param Boot - $boot
     * @return boolean
     */
    protected function createBoot(Boot $boot) {
        
        // Adjust photo variable so its correct in database
        $photo = "../assets/img/products/" . $boot->getPhoto();
        
        // Create SQL statement using the all of the boot details to add to the database
        $sql = "INSERT INTO BOOTS (SIZE, NAME, DESCRIPTION, PRICE, PHOTO, COLOR) VALUES ('" . $boot->getSize() . "', '" . $boot->getName() . 
        "', '" . $boot->getDescription() . "', '" . $boot->getPrice() . "', '" . $photo . "', '" . $boot->getColor() . "')";
        
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
     * Method to get a boot given the id
     * @param int - $id
     * @return Boot - $boot
     */
    protected function getBootById($id) {

        // Create SQL statement using the $id variable
        $sql = "SELECT * FROM BOOTS WHERE BOOT_ID = '" . $id . "'";
        
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
        
        // Create new instance of boot with variables
        $boot = new Boot($id, $size, $name, $description, $price, $photo, $color);
        
        // Return instance of boot
        return $boot;
    }
    
    
    /**
     * Method to get the boots that match the parameter given
     * @param String - $sqlStatement
     * @param int - $offset
     * @return Boot[] - $boots
     */
    protected function searchBoots(String $sqlStatement, int $offset) {
        
        // Create array and index for results
        $boots = array();
        $index = 0;
        
        // Create SQL statement using the $sqlStatement and get offset of boots
        $sql = "SELECT * FROM BOOTS" . $sqlStatement . " ORDER BY BOOT_ID LIMIT 12 OFFSET " . $offset;

        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);

        // If there are results that matched the search parameter
        if($results->num_rows > 0) {
            
            // While there are results, fetch a resulted row as an associative array and set to variable
            while($row = $results->fetch_assoc()) {
                
                // Get the variables of each resulted row array
                $id = $row['BOOT_ID'];
                $size = $row['SIZE'];
                $name = $row['NAME'];
                $description = $row['DESCRIPTION'];
                $price = $row['PRICE'];
                $photo = $row['PHOTO'];
                $color = $row['COLOR'];
                
                // Create new instance of boot with variables
                $boot = new Boot($id, $size, $name, $description, $price, $photo, $color);
                
                // Put each instance of boot at index of boots array, increment index
                $boots[$index] = $boot;
                $index++;
            }
           
        }
 
        // Return array of Boot objects
        return $boots;
    }
    
    
    /**
     * Method to get the boots that match the parameter
     * @param String - $sqlStatement
     * @return int - $index
     */
    protected function searchBootsCount(String $sqlStatement) {
        
        // Create index for results
        $index = 0;
        
        // Create SQL statement using the $sql variable
        $sql = "SELECT * FROM BOOTS" . $sqlStatement;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, increment index
        while($row = $results->fetch_assoc()) {
            
            $index++;
        }
        
        // Return count of boots
        return $index;
    }
    
   
    /**
     * Method to update a boot within the database
     * @param Boot - $boot
     * @return boolean - $updateStatus
     */
    protected function updateBoot(Boot $boot) {
        
        // Adjust photo variable so its correct in database
        $photo = "../assets/img/products/" . $boot->getPhoto();
        
        // Create SQL statement using the $id variable to set the database columns accordingly
        $sql = "UPDATE BOOTS SET SIZE = '" . $boot->getSize() . "', NAME = '" . $boot->getName() . "', DESCRIPTION = '" . $boot->getDescription() .
        "', PRICE = '" . $boot->getPrice() . "', PHOTO = '" . $photo . "', COLOR = '" . $boot->getColor() . "' WHERE BOOT_ID = " . $boot->getId();
        
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
     * Method to delete a boot from the database
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    protected function deleteBootById(int $id) {
        
        // Create SQL statement using the $id variable to delete
        $sql = "DELETE FROM BOOTS WHERE BOOT_ID = '" . $id . "'";
        
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

