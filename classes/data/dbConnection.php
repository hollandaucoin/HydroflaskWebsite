<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc dbConnection - This is a class to establish a connection to the database
 */

class dbConnection {
    
    // Initialize properties
    private $host = "";
    private $username = "";
    private $password = "";
    private $dbname = "";
 

    /**
     * Method to make connection to the database
     * @return mysqli
     */
    public function connect() {
        
        // Set all the properties
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "ecommerce";
        
        // Connect to database
        $this->dbConnect = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        // If there is an error
        if($this->dbConnect->connect_error) {
            die("Connection Error: " . $this->dbConnect->connect_error);
        }
        // Return the connection
        else {
            return $this->dbConnect;
        } 
    }
    

    /**
     * Method to set the session to the userId
     * @param int - $id
     */
    public function setUserId($id) {
        
        // Start the session if its not started
        if(!isset($_SESSION)) {
            include 'session.php';
        }
        
        $_SESSION["userId"] = $id;
    }
    

    /**
     * Method to get the session variable (userId)
     * @return $_SESSION["userId"]
     */
    public function getUserId() {
        return $_SESSION["userId"];
    }
    
    
    /**
     * Method to set the session to the user role
     * @param String - $role
     */
    public function setUserRole($role) {
        
        // Start the session if its not started
        if(!isset($_SESSION)) {
            include 'session.php';
        }
        
        $_SESSION["userRole"] = $role;
    }
    
    
    /**
     * Method to get the session variable (user role)
     * @return $_SESSION["userRole"]
     */
    public function getUserRole() {
        return $_SESSION["userRole"];
    }
    
    
    /**
     * Method to set the session to the username
     * @param String - $username
     */
    public function setUsername($username) {
        
        // Start the session if its not started
        if(!isset($_SESSION)) {
            include 'session.php';
        }
        
        $_SESSION["username"] = $username;
    }
    
    
    /**
     * Method to get the session variable (username)
     * @return $_SESSION["username"]
     */
    public function getUsername() {
        return $_SESSION["username"];
    }
    
}

