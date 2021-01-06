<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc Cart - This is a class that acts as a cart object
 */

class Cart {
    
    // Initialize properties
    private $id = 0;
    private $userId = null;
    private $productId = 0;
    private $productType = "";
    private $quantity = 0;

    
    /**
     * Constructor method used to instantiate an instance of Cart object
     * @param int - $id
     * @param int - $userId
     * @param int - $productId
     * @param String - $productType
     * @param int - $quantity
     */
    public function __construct($id, $userId, $productId, $productType, $quantity) {
        
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->productType = $productType;
        $this->quantity = $quantity;
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

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getProductType() {
        return $this->productType;
    }
    
    public function setProductType($productType) {
        $this->productType = $productType;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

}

