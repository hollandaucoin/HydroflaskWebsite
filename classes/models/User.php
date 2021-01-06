<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc user - This is a class that acts as a user object
 */

class User {

    // Initialize properties
    private $id = 0;
    private $firstName = "";
    private $lastName = "";
    private $username = "";
    private $password = "";
    private $email = "";
    private $phoneNumber = "";
    private $role = "Customer";
    
    
    /**
     * Constructor method used to instantiate an instance of User object
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $username
     * @param $password
     * @param $email
     * @param $phoneNumber
     */
    public function __construct($id, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role) {
        
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->role = $role;
    }
    
    
    /**
     * Getters and setters for properties
     */
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

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

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getRole() {
        return $this->role;
    }
    
    public function setRole($role) {
        $this->role = $role;
    }
}

