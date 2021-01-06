<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc order - This is a class that acts as an order object
 */

class Order implements JsonSerializable {

    // Initialize properties
    private $id = 0;
    private $orderNumber = 0;
    private $date = "";
    private $userId = 0;
    private $shippingId = 0;
    private $cost = 0;
    
    
    /**
     * Constructor method used to instantiate an instance of Order object
     * @param $id
     * @param $orderNumber
     * @param $date
     * @param $userId
     * @param $shippingId
     * @param $cost
     */
    public function __construct($id, $orderNumber, $date, $userId, $shippingId, $cost) {
        
        $this->id = $id;
        $this->orderNumber = $orderNumber;
        $this->date = $date;
        $this->userId = $userId;
        $this->shippingId = $shippingId;
        $this->cost = $cost;
    }
    
    
    /**
     * Method from JsonSerializable
     * {@inheritDoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize() {
        return get_object_vars($this);
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
    
    public function getOrderNumber() {
        return $this->orderNumber;
    }

    public function setOrderNumber($orderNumber) {
        $this->orderNumber = $orderNumber;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getShippingId() {
        return $this->shippingId;
    }

    public function setShippingId($shippingId) {
        $this->shippingId = $shippingId;
    }

    public function getCost() {
        return $this->cost;
    }

    public function setCost($cost) {
        $this->cost = $cost;
    }
}

