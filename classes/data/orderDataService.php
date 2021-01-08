<?php

/**
 * @author Holland Aucoin
 * @name Hydroflask Website
 * @desc orderDataService - This is a class to perform the persistence logic on the order table in the database
 */

// Include Order to create an instance
include_once('../classes/models/Order.php');

class orderDataService {
    
    private $conn;
    
    // Constructor taking in connection
    public function __construct($conn) {
        $this->conn = $conn;
    }
   
    /**
     * Method to add an order to the database
     * @param Order - $order
     * @return boolean - $addStatus
     */
    public function addOrder(Order $order) {

        // Create SQL statement using the all of the order details to add to the database
        $sql = "INSERT INTO ORDERS (ORDER_NUMBER, DATE, USER_ID, SHIPPING_ID, COST) VALUES ('" . $order->getOrderNumber() . "', '" . 
            date("Y-m-d H:i:s") . "', '" . $_SESSION["userId"] . "', '" . $order->getShippingId() . "', '" . $order->getCost() . "')";

        // Use the connect method dbConnection and query the SQL string
        if($this->conn->query($sql)) {

            // Get the auto-incremented id and set to the order's id
            $id = $this->conn->insert_id;
            $order->setId($id);
            
            // Set addStatus to true
            $addStatus = true;
        }
        // Else query failed, set addStatus to false
        else {
            $addStatus = false;
        }
        
        // Return addStatus
        return $addStatus;
    }
    
    
    /**
     * Method to add the products of an order to the database
     * @param Order - $order
     * @param Cart[] - $carts
     * @return boolean - $addStatus
     */
    public function addOrderProducts(Order $order, $carts) {
        
        // Create boolean for addStatus and set to true
        $addStatus = true;
        
        // Foreach cart (product) in carts, insert the product into database
        foreach($carts as $cart) {

            // Create SQL statement using the order and cart variables
            $sql = "INSERT INTO ORDERED_PRODUCTS (ORDER_ID, PRODUCT_ID, PRODUCT_TYPE) VALUES ('" . $order->getId() . "', '" .  
            $cart->getProductId() . "', '" . $cart->getProductType() . "')";

            // If the query failed
            if(!$this->conn->query($sql)) {

                // Set addStatus to false
                $addStatus = false;
                break;
            }
        }
        
        // Return true
        return $addStatus;
    }
    
    
    /**
     * Method to get all of the orders in the database
     * @return Order[] - $orders
     */
    public function getAllOrders() {
        
        // Create array and index for results
        $orders = array();
        $index = 0;
        
        // Create SQL statement
        $sql = "SELECT * FROM ORDERS ORDER BY DATE";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['ORDER_ID'];
            $orderNumber = $row['ORDER_NUMBER'];
            $date = $row['DATE'];
            $userId = $row['USER_ID'];
            $shippingId = $row['SHIPPING_ID'];
            $cost = $row['COST'];
            
            // Create new instance of order with variables
            $order = new Order($id, $orderNumber, $date, $userId, $shippingId, $cost);
            
            // Put each instance of order at index of orders array, increment index
            $orders[$index] = $order;
            $index++;
        }
        
        // Return array of Order objects
        return $orders;
    }
    
    
    /**
     * Method to get an order givent the id
     * @param int - $id
     * @return Order - $order
     */
    public function getOrderById(int $id) {
        
        // Create SQL statement using the $id variable
        $sql = "SELECT * FROM ORDERS WHERE ORDER_ID = '" . $id . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // Fetch the resulted row as an associative array and set to variable
        $row = $results->fetch_assoc();
        
        // Get the variables of resulted row array
        $orderNumber = $row['ORDER_NUMBER'];
        $date = $row['DATE'];
        $userId = $row['USER_ID'];
        $shippingId = $row['SHIPPING_ID'];
        $cost = $row['COST'];
        
        // Create new instance of order with variables
        $order = new Order($id, $orderNumber, $date, $userId, $shippingId, $cost);
        
        // Return instance of order
        return $order;
    }
    
    
    /**
     * Method to get all orders in the database from the current user
     * @return Order[] - $orders
     */
    public function getAllUserOrders() {
        
        // Create array and index for results
        $orders = array();
        $index = 0;
        
        // Create SQL statement using userId session
        $sql = "SELECT * FROM ORDERS WHERE USER_ID = '" . $_SESSION['userId'] . "' ORDER BY DATE";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['ORDER_ID'];
            $orderNumber = $row['ORDER_NUMBER'];
            $date = $row['DATE'];
            $userId = $row['USER_ID'];
            $shippingId = $row['SHIPPING_ID'];
            $cost = $row['COST'];
            
            // Create new instance of order with variables
            $order = new Order($id, $orderNumber, $date, $userId, $shippingId, $cost);
            
            // Put each instance of order at index of orders array, increment index
            $orders[$index] = $order;
            $index++;
        }
        
        // Return array of Order objects
        return $orders; 
    }
    
    
    /**
     * Method to get all orders in the database, ordered by cost
     * @return Order[] - $orders
     */
    public function getAllOrdersByCost() {
        
        // Create array and index for results
        $orders = array();
        $index = 0;
        
        // Create SQL statement
        $sql = "SELECT * FROM ORDERS ORDER BY COST DESC";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['ORDER_ID'];
            $orderNumber = $row['ORDER_NUMBER'];
            $date = $row['DATE'];
            $userId = $row['USER_ID'];
            $shippingId = $row['SHIPPING_ID'];
            $cost = $row['COST'];
            
            // Create new instance of order with variables
            $order = new Order($id, $orderNumber, $date, $userId, $shippingId, $cost);
            
            // Put each instance of order at index of orders array, increment index
            $orders[$index] = $order;
            $index++;
        }
        
        // Return array of Order objects
        return $orders;
    }
    
    
    /**
     * Method to get all orders in the database, ordered by cost, of the current user
     * @return Order[] - $orders
     */
    public function getAllUserOrdersByCost() {
        
        // Create array and index for results
        $orders = array();
        $index = 0;
        
        // Create SQL statement using userId session
        $sql = "SELECT * FROM ORDERS WHERE USER_ID = '" . $_SESSION['userId'] . "' ORDER BY COST DESC";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['ORDER_ID'];
            $orderNumber = $row['ORDER_NUMBER'];
            $date = $row['DATE'];
            $userId = $row['USER_ID'];
            $shippingId = $row['SHIPPING_ID'];
            $cost = $row['COST'];
            
            // Create new instance of order with variables
            $order = new Order($id, $orderNumber, $date, $userId, $shippingId, $cost);
            
            // Put each instance of order at index of orders array, increment index
            $orders[$index] = $order;
            $index++;
        }
        
        // Return array of Order objects
        return $orders;
    }
    
    
    /**
     * Method to get the orders that fall within the date parameters passed
     * @param String - $startDate
     * @param String - $endDate
     * @return Order[] - $orders
     */
    public function getAllOrdersLimitDate($startDate, $endDate) {
        
        // Create array and index for results
        $orders = array();
        $index = 0;
        
        // Change endDate to include the full day by adding time factor
        $endDate = $endDate . " 23:59:59";
        
        // Create SQL statement
        $sql = "SELECT * FROM ORDERS WHERE DATE BETWEEN '" . $startDate . "' AND '" . $endDate . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['ORDER_ID'];
            $orderNumber = $row['ORDER_NUMBER'];
            $date = $row['DATE'];
            $userId = $row['USER_ID'];
            $shippingId = $row['SHIPPING_ID'];
            $cost = $row['COST'];
            
            // Create new instance of order with variables
            $order = new Order($id, $orderNumber, $date, $userId, $shippingId, $cost);
            
            // Put each instance of order at index of orders array, increment index
            $orders[$index] = $order;
            $index++;
        }
        
        // Return array of Order objects
        return $orders;
    }
    
    
    /**
     * Method to get all the orders within the date parameters passed of the current user
     * @param String - $startDate
     * @param String - $endDate
     * @return Order[] - $orders
     */
    public function getAllUserOrdersLimitDate($startDate, $endDate) {
        
        // Create array and index for results
        $orders = array();
        $index = 0;
        
        // Change endDate to include the full day by adding time factor
        $endDate = $endDate . " 23:59:59";
        
        // Create SQL statement using userId session
        $sql = "SELECT * FROM ORDERS WHERE USER_ID = '" . $_SESSION['userId'] . "' AND DATE BETWEEN '" . $startDate . "' AND '" . $endDate . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $id = $row['ORDER_ID'];
            $orderNumber = $row['ORDER_NUMBER'];
            $date = $row['DATE'];
            $userId = $row['USER_ID'];
            $shippingId = $row['SHIPPING_ID'];
            $cost = $row['COST'];
            
            // Create new instance of order with variables
            $order = new Order($id, $orderNumber, $date, $userId, $shippingId, $cost);
            
            // Put each instance of order at index of orders array, increment index
            $orders[$index] = $order;
            $index++;
        }
        
        // Return array of Order objects
        return $orders;
    }
    
    
    /**
     * Method to get the products of an order
     * @param int - $orderId
     * @return String[][] - $products
     */
    public function getProductsByOrder(int $orderId) {
        
        // Create array and index for results
        $products = array();
        $index = 0;
        
        // Create SQL statement using order id
        $sql = "SELECT * FROM ORDERED_PRODUCTS WHERE ORDER_ID = '" . $orderId . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->conn->query($sql);
        
        // While there are results, fetch a resulted row as an associative array and set to variable
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each resulted row array
            $productId = $row['PRODUCT_ID'];
            $type = $row['PRODUCT_TYPE'];
            
            // Create new array of product details
            $product = array($productId, $type);
            
            // Put each product array at index of products array, increment index
            $products[$index] = $product;
            $index++;
        }
        
        // Return array of product arrays
        return $products;
    }
}

