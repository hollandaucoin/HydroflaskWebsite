<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc addressDataService - This is a class to perform the persistence logic on the address table in the database
 */

// Include dbConnection to allow for inheritance, and Address to create an instance
include_once('dbConnection.php');
include_once('../classes/models/Address.php');

class addressDataService extends dbConnection {
    
    /**
     * Method to verify is an address is already in the database
     * @param Address - $address
     * @return boolean - $addressCheck
     */
    protected function checkForAddress(Address $address) {
        
        // Create SQL statement to select all rows that match the passed address attributes
        $sql = "SELECT * FROM ADDRESS WHERE USER_ID = '" . $_SESSION["userId"] . "' AND STREET_ADDRESS = '" . $address->getStreetAddress() . "' AND CITY = '"
            . $address->getCity() . "' AND STATE = '" . $address->getState() . "' AND ZIP_CODE = '" . $address->getZipCode() . "' AND COUNTRY = '" . $address->getCountry() . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // If the results contains rows set addressCheck to true (address is in database)
        if($results->num_rows > 0) {
            
            $row = $results->fetch_assoc();
            
            // Get the id from database and set it
            $id = $row['ADDRESS_ID'];
            $address->setId($id);
            
            $addressCheck = true;
        }
        // Else, set addressCheck to false (address is not in database)
        else {
            $addressCheck = false;
        }
        
        // Return addressCheck boolean
        return $addressCheck;
    }
    
    
    /**
     * Method to add an address to the database
     * @param Address - $address
     * @return boolean - $addStatus
     */
    protected function addAddress(Address $address) {
        
        // Create SQL statement using the all of the address details to add to the database
        $sql = "INSERT INTO ADDRESS (USER_ID, STREET_ADDRESS, CITY, STATE, ZIP_CODE, COUNTRY) VALUES ('" . $address->getUserId() . "', '" . 
            $address->getStreetAddress() . "', '" . $address->getCity() . "', '" . $address->getState() . "', '" . $address->getZipCode() . "', '" . 
            $address->getCountry() . "')";
        
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            
            // Create SQL statement to select all rows that match the passed address attributes
            $sqlId = "SELECT ADDRESS_ID FROM ADDRESS WHERE USER_ID = '" . $_SESSION["userId"] . "' AND STREET_ADDRESS = '" . $address->getStreetAddress() . "' AND CITY = '"
                . $address->getCity() . "' AND STATE = '" . $address->getState() . "' AND ZIP_CODE = '" . $address->getZipCode() . "' AND COUNTRY = '" . $address->getCountry() . "'";
                
                // Use the connect method dbConnection and query the SQL string
                $results = $this->connect()->query($sqlId);
                    
                $row = $results->fetch_assoc();
              
                
                // Get the id from database and set it
                $id = $row['ADDRESS_ID'];
                $address->setId($id);
            
                // Set add status to true
                $addStatus = true;
        }
        else {
            // Set add status to false
            $addStatus = false;
        }
        
        // Return addStatus
        return $addStatus;
    }
    
    
    /**
     * Method to get the address given the id
     * @param int - $id
     * @return Address - $address
     */
    protected function getAddressById(int $id) {
        
        // Create SQL statement to select the row that matches the addressId
        $sql = "SELECT * FROM ADDRESS WHERE ADDRESS_ID = '" . $id . "'";
            
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // Fetch the resulted row as an associative array and set to variable
        $row = $results->fetch_assoc();
        
        // Get the variables of resulted row array
        $userId = $row['USER_ID'];
        $streetAddress = $row['STREET_ADDRESS'];
        $city = $row['CITY'];
        $state = $row['STATE'];
        $zipCode = $row['ZIP_CODE'];
        $country = $row['COUNTRY'];
        
        // Create new instance of address with variables
        $address = new Address($id, $userId, $streetAddress, $city, $state, $zipCode, $country);
        
        // Return instance of address
        return $address;
    }
    
}

