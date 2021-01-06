<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc address - This is a class that acts as a address object
 */

class Address {

    // Initialize properties
    private $id = 0;
    private $userId = 0;
    private $streetAddress = "";
    private $city = "";
    private $state = "";
    private $zipCode = "";
    private $country = "";
    
    
    /**
     * Constructor method used to instantiate an instance of Address object
     * @param int - $id
     * @param int - $userId
     * @param String - $streetAddress
     * @param String - $city
     * @param String - $state
     * @param int - $zipCode
     * @param String - $country
     */
    public function __construct($id, $userId, $streetAddress, $city, $state, $zipCode, $country) {
        
        $this->id = $id;
        $this->userId = $userId;
        $this->streetAddress = $streetAddress;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->country = $country;
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

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getStreetAddress() {
        return $this->streetAddress;
    }
    
    public function setStreetAddress($streetAddress) {
        $this->streetAddress = $streetAddress;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }
    
    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }
    
}

