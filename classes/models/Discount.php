<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc discount - This is a class that acts as a discount object
 */

class Discount {

    // Initialize properties
    private $id = 0;
    private $name = "";
    private $discountCode = "";
    private $amount = 0;
    
    
    /**
     * Constructor method used to instantiate an instance of Discount object
     * @param int - $id
     * @param String - $name
     * @param String - $discountCode
     * @param double - $amount
     */
    public function __construct($id, $name, $discountCode, $amount) {
        
        $this->id = $id;
        $this->name = $name;
        $this->discountCode = $discountCode;
        $this->amount = $amount;
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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDiscountCode() {
        return $this->discountCode;
    }
    
    public function setDiscountCode($discountCode) {
        $this->discountCode = $discountCode;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }
    
}

