<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc userCredentials - This is a class that acts as a userCredential object
 */

class UserCredentials {
    
    // Initialize properties
    private $username = "";
    private $password = "";

    
    /**
     * Constructor method used to instantiate an instance of UserCredential object
     * @param $username
     * @param $password
     */
    public function __construct($username, $password) {
        
        $this->username = $username;
        $this->password = $password;
    }
    
    
    /**
     * Getters and settters for properties
     */
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    
    
}

