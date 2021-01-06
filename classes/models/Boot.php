<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc Boot - This is a class that acts as a boot object
 */

class Boot {
    
    // Initialize properties
    private $id = 0;
    private $size = "";
    private $name = "";
    private $description = "";
    private $price = 0.0;
    private $photo = "";
    private $color = "";
    

    /**
     * Constructor method used to instantiate an instance of Boot object
     * @param int - $id
     * @param String - $size
     * @param String - $name
     * @param String - $description
     * @param decimal - $price
     * @param String - $photo
     * @param String - $color
     */
    public function __construct($id, $size, $name, $description, $price, $photo, $color) {
        
        $this->id = $id;
        $this->size = $size;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->photo = $photo;
        $this->color = $color;
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
    
    public function getSize() {
        return $this->size;
    }
    
    public function setSize($size) {
        $this->size = $size;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function getPhoto() {
        return $this->photo;
    }
    
    public function setPhoto($photo) {
        $this->photo = $photo;
    }
    
    public function getColor() {
        return $this->color;
    }
    
    public function setColor($color) {
        $this->color = $color;
    }
}

