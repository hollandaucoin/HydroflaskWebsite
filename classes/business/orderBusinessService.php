<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc orderBusinessService - This is a class to perform the business logic of orders between the presentation and persistence layers
 */

// Include orderDataService to allow for inheritance, and dbConnection to create an instance
include_once('../classes/data/orderDataService.php');
include_once('../classes/data/dbConnection.php');

class orderBusinessService {
   
    /**
     * Method to add a user's order information to the database in the Orders and Ordered Products tables
     * @param Order - $order
     * @param Cart[] - $carts
     * @return boolean
     */
    public function addUserOrder(Order $order, $carts) {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Turn off autocommit and begin tranaction
        $conn->autocommit(FALSE);
        $conn->begin_transaction();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        
        // Call addOrder and addOrderProducts in the orderService, set outcome to status variables
        $addOrderStatus = $orderService->addOrder($order);
        $addProductsStatus = $orderService->addOrderProducts($order, $carts);
        
        // If both queries were successful, commit and set status to true
        if($addOrderStatus == true && $addProductsStatus == true) {
            $conn->commit();
            return true;
        }
        // Else, both weren't successful, rollback and set status to false
        else {
            $conn->rollback();
            return false;
        }
        
        // Close connection
        $conn->close();
    }
    
    
    /**
     * Method to get all of the orders from the database (by date)
     * @return Order[] - $orders
     */
    public function getOrders() {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getAllOrders in orderDataService
        $orders = $orderService->getAllOrders();
        
        // Return array of orders
        return $orders;
    }
    
    
    /**
     * Method to get an order given the id
     * @param int - $id
     * @return Order - $order
     */
    public function getOrderFromId(int $id) {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getOrderById in orderDataService
        $order = $orderService->getOrderById($id);
        
        // Return the order
        return $order;
    }
    
    
    /**
     * Method to get all of the user's orders from the database (by date)
     * @return Order[] - $orders
     */
    public function getUserOrders() {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getAllUserOrders in orderDataService
        $orders = $orderService->getAllUserOrders();
        
        // Return array of orders
        return $orders;
    }
    
    
    /**
     * Method to get all of the orders from the database by cost
     * @return Order[] - $orders
     */
    public function getOrdersByCost() {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getAllOrdersByCost in orderDataService
        $orders = $orderService->getAllOrdersByCost();
        
        // Return array of orders
        return $orders;
    }
    
    
    /**
     * Method to get all of the user's orders from the database by cost
     * @return Order[] - $orders
     */
    public function getUserOrdersByCost() {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getAllUserOrdersByCost in orderDataService
        $orders = $orderService->getAllUserOrdersByCost();
        
        // Return array of orders
        return $orders;
    }
    
    
    /**
     * Method to get all of the orders from the database that fall in the dates
     * @param String - $startDate
     * @param String - $endDate
     * @return Order[] - $orders
     */
    public function getOrdersLimitDate($startDate, $endDate) {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getAllOrdersLimitDate in orderDataService
        $orders = $orderService->getAllOrdersLimitDate($startDate, $endDate);
        
        // Return array of orders
        return $orders;
    }
    
    
    /**
     * Method to get all of the user's orders from the database that fall in the dates
     * @param String - $startDate
     * @param String - $endDate
     * @return Order[] - $orders
     */
    public function getUserOrdersLimitDate($startDate, $endDate) {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getAllUserOrdersLimitDate in orderDataService
        $orders = $orderService->getAllUserOrdersLimitDate($startDate, $endDate);
        
        // Return array of orders
        return $orders;
    }
    
    
    /**
     * Method to get the products of an order
     * @param int - $id
     * @return String[] - $products
     */
    public function getOrderProducts(int $id) {
        
        // Make connection to database
        $db = new dbConnection();
        $conn = $db->connect();
        
        // Create an instance of orderDataService, passing in the database connection
        $orderService = new orderDataService($conn);
        // Call getProductsByOrder in orderDataService
        $products = $orderService->getProductsByOrder($id);
        
        // Return array of products
        return $products;
    }
    
}

