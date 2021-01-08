<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc bottleDataService - This is a class to perform the persistence logic of bottles to the database
 */

// Include dbConnection to allow for inheritance, and Bottle to create an instance
include_once('dbConnection.php');
include_once('../classes/models/Bottle.php');

class bottleDataService extends dbConnection {
    
    /**
     * Method to get all bottles from the database
     * @return Bottle[] - $bottles
     */
    protected function getAllBottles() {

        // Create array and index for results
        $bottles = array();
        $index = 0;
        
        // Create SQL statement
        $sql = "SELECT * FROM BOTTLES";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
   
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['BOTTLE_ID'];
            $size = $row['SIZE'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $price = $row['PRICE'];
            $photo = $row['PHOTO'];
            $color = $row['COLOR'];
            $volume = $row['VOLUME'];
            $height = $row['HEIGHT'];
            $weight = $row['WEIGHT'];
            
            // Create new instance of bottle with variables
            $bottle = new Bottle($id, $size, $name, $description, $price, $photo, $color, $volume, $height, $weight);
            
            // Put each instance of bottle at index of bottles array, increment index
            $bottles[$index] = $bottle;
            $index++;
        }
        
        // Return array of Bottle objects
        return $bottles;
    }
    
    
    /**
     * Method to get an offset of bottles from the database
     * @param int - $offset
     * @return Bottle[] - $bottles
     */
    protected function getAllBottlesOffset(int $offset) {
        
        // Create array and index for results
        $bottles = array();
        $index = 0;
        
        // Create SQL statement using the $offset variables
        $sql = "SELECT * FROM BOTTLES ORDER BY BOTTLE_ID LIMIT 12 OFFSET " . $offset;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['BOTTLE_ID'];
            $size = $row['SIZE'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $price = $row['PRICE'];
            $photo = $row['PHOTO'];
            $color = $row['COLOR'];
            $volume = $row['VOLUME'];
            $height = $row['HEIGHT'];
            $weight = $row['WEIGHT'];
            
            // Create new instance of bottle with variables
            $bottle = new Bottle($id, $size, $name, $description, $price, $photo, $color, $volume, $height, $weight);
            
            // Put each instance of bottle at index of bottles array, increment index
            $bottles[$index] = $bottle;
            $index++;
        }
        
        // Return array of Bottle objects
        return $bottles;
    }
    
    
    /**
     * Method to add a bottle into the database
     * @param Bottle - $bottle
     * @return boolean - $createStatus
     */
    protected function createBottle(Bottle $bottle) {
        
        // Adjust photo variable so its correct in database
        $photo = "../assets/img/products/" . $bottle->getPhoto();
        
        // Create SQL statement using the all of the bottle details to add to the database
        $sql = "INSERT INTO BOTTLES (SIZE, NAME, DESCRIPTION, PRICE, PHOTO, COLOR, VOLUME, HEIGHT, WEIGHT)
                VALUES ('" . $bottle->getSize() . "', '" . $bottle->getName() . "', '" . $bottle->getDescription() . "', '" . $bottle->getPrice() . 
                "', '" . $photo . "', '" . $bottle->getColor() . "', '" . $bottle->getVolume() . "', '" . $bottle->getHeight() . "', '" . $bottle->getWeight() . "')";
                
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            $createStatus = true;
        }
        else {
            $createStatus =  false;
        }
        
        // Return createStatus
        return $createStatus;
    }
    
    
    /**
     * Method to get a bottle given the id
     * @param int - $id
     * @return Bottle - $bottle
     */
    protected function getBottleById(int $id) {

        // Create SQL statement using the $id variable
        $sql = "SELECT * FROM BOTTLES WHERE BOTTLE_ID = '" . $id . "'";
        
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
        $volume = $row['VOLUME'];
        $height = $row['HEIGHT'];
        $weight = $row['WEIGHT'];
        
        // Create new instance of bottle with variables
        $bottle = new Bottle($id, $size, $name, $description, $price, $photo, $color, $volume, $height, $weight);
        
        // Return instance of bottle
        return $bottle;
    }
    
    
    /**
     * Method to get the bottles that match the parameter
     * @param String - $sqlStatement
     * @param int - $offset
     * @return Bottle[] - $bottles
     */
    protected function searchBottles(String $sqlStatement, int $offset) {
       
        // Create array and index for results
        $bottles = array();
        $index = 0;
        
        // Create SQL statement using the $sqlStatement variable to get an offset of bottles
        $sql = "SELECT * FROM BOTTLES" . $sqlStatement . " ORDER BY BOTTLE_ID LIMIT 12 OFFSET " . $offset;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
            
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each row from array
            $id = $row['BOTTLE_ID'];
            $size = $row['SIZE'];
            $name = $row['NAME'];
            $description = $row['DESCRIPTION'];
            $price = $row['PRICE'];
            $photo = $row['PHOTO'];
            $color = $row['COLOR'];
            $volume = $row['VOLUME'];
            $height = $row['HEIGHT'];
            $weight = $row['WEIGHT'];
            
            // Create new instance of bottle with variables
            $bottle = new Bottle($id, $size, $name, $description, $price, $photo, $color, $volume, $height, $weight);
            
            // Put each instance of bottle at index of bottles array, increment index
            $bottles[$index] = $bottle;
            $index++;
        }
        
        // Return array of Bottle objects
        return $bottles;
        
    }
    
    
    /**
     * Method to get the bottles that match the parameter
     * @param String - $sqlStatement
     * @return Bottle[] - $bottles
     */
    protected function searchBottlesCount(String $sqlStatement) {
        
        // Create index for results
        $index = 0;
        
        // Create SQL statement using the $sqlStatement variable
        $sql = "SELECT * FROM BOTTLES" . $sqlStatement;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // While there are results, increment index
        while($row = $results->fetch_assoc()) {
            
            $index++;
        }
        
        // Return count of bottles
        return $index;
    }
    
    
    /**
     * Method to update a bottle within the database
     * @param Bottle - $bottle
     * @return boolean - $updateStatus
     */
    protected function updateBottle(Bottle $bottle) {
        
        // Adjust photo variable so its correct in database
        $photo = "../assets/img/products/" . $bottle->getPhoto();
        
        // Create SQL statement using the $id variable to set the database columns accordingly
        $sql = "UPDATE BOTTLES SET SIZE = '" . $bottle->getSize() . "', NAME = '" . $bottle->getName() . "', DESCRIPTION = '" . $bottle->getDescription() . 
                "', PRICE = '" . $bottle->getPrice() . "', PHOTO = '" . $photo . "', COLOR = '" . $bottle->getColor() . "', VOLUME = '" . 
                $bottle->getVolume() . "', HEIGHT = '" . $bottle->getHeight() . "', WEIGHT = '" . $bottle->getWeight() . "' WHERE BOTTLE_ID = " . $bottle->getId();
        
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
     * Method to delete a bottle from the database
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    protected function deleteBottleById(int $id) {
        
        // Create SQL statement using the $id variable to delete
        $sql = "DELETE FROM BOTTLES WHERE BOTTLE_ID = '" . $id . "'";
        
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

