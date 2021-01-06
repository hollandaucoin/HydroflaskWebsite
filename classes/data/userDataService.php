<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc userDataService - This is a class to perform the persistence logic of users to the database
 */

// Include dbConnection to allow for inheritance, and User to create an instance
include_once('dbConnection.php');
include_once('../classes/models/User.php');

class userDataService extends dbConnection {
    
    /**
     * Method to login a user within the database
     * @param UserCredentials - $usercredentials
     * @return boolean - $authenticationStatus
     */
    protected function userAuthentication(UserCredentials $userCredentials) {

        // Create SQL statement using the $username and $password variables
        $sql = "SELECT * FROM USERS WHERE USERNAME = '" . $userCredentials->getUsername() . "' AND PASSWORD = '" . $userCredentials->getPassword() . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
            
        // If there was one user found, set the results to variable as an array
        if($results->num_rows == 1) {
            $row = $results->fetch_assoc();
            
            // Set the userId, user role, and username as the session variables
            $this->setUserId($row["USER_ID"]);
            $this->setUserRole($row["ROLE"]);
            $this->setUsername($row["USERNAME"]);
            
            // Set authenticationStatus to true (successful)
            $authenticationStatus = true;
        }
        // Else, set authenticationStatus to false (unsuccessful)
        else {
            $authenticationStatus = false;
        }
        
        // Return authenticationStatus
        return $authenticationStatus;
    }
    
    
    /**
     * Method to register a user to the database
     * @param User - $user
     * @return int - $registrationStatus
     */
    protected function userRegistration(User $user) {
        
        // Create SQL statement using the $username and password variables to get if this user has an account
        $sqlCheckUser = "SELECT * FROM USERS WHERE USERNAME = '" . $user->getUsername() . "' AND PASSWORD = '" . $user->getPassword() . "'";
        // Use the connect method dbConnection and query the SQL string
        $userResults = $this->connect()->query($sqlCheckUser);
        
        // Create SQL statement using the $username variable to see if that username is already registered to an account
        $sqlCheckUsername = "SELECT * FROM USERS WHERE USERNAME = '" . $user->getUsername() . "'";
        // Use the connect method dbConnection and query the SQL string
        $usernameResults = $this->connect()->query($sqlCheckUsername);
        
        // Create SQL statement using the $email variable to see if that email is already registered to an account
        $sqlCheckEmail = "SELECT * FROM USERS WHERE EMAIL = '" . $user->getEmail() . "'";
        // Use the connect method dbConnection and query the SQL string
        $emailResults = $this->connect()->query($sqlCheckEmail);
       
        
        // If the user check return results, set registrationStatus to -1 for error messaging (unsuccessul)
        if($userResults->num_rows > 0) {
            $registrationStatus = -1;
        }
        // If the username check return results, set registrationStatus to -2 for error messaging (unsuccessul)
        else if($usernameResults->num_rows > 0) {
            $registrationStatus = -2;
        }
        // If the email check return results, set registrationStatus to -3 for error messaging (unsuccessul)
        else if($emailResults->num_rows > 0) {
            $registrationStatus = -3;
        }
        // Else, add the user to the database
        else {
            // Create SQL statement using the all of the user's details to add to the database
            $sql = "INSERT INTO USERS (FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, EMAIL, PHONE_NUMBER, ROLE) 
                    VALUES ('" . $user->getFirstName() . "', '" . $user->getLastName() . "', '" . $user->getUsername() . "', '" . $user->getPassword() . "', '" . 
                                $user->getEmail() . "', '" . $user->getPhoneNumber() . "', '" . $user->getRole() . "')";
            
            // Use the connect method dbConnection and query the SQL string
            if($this->connect()->query($sql)) {
                
                $id = "SELECT USER_ID FROM USERS WHERE USERNAME = '" . $user->getUsername() . "' AND PASSWORD = '" . $user->getPassword() . "'";
                $results = $this->connect()->query($id);
                
                // Set the results to variable as an array
                $userId = $results->fetch_assoc();
                
                // Get variables from retrieved array
                $id = $userId["USER_ID"];
                
                // Set id variable of user
                $user->setId($id);
                
                // Set the userId, user role, and username as the session variables
                $this->setUserId($user->getId());
                $this->setUserRole($user->getRole());
                $this->setUsername($user->getUsername());
                
                // Set registrationStatus to 1 (successful)
                $registrationStatus = 1;
            }
            else {
                $registrationStatus = 0;
            } 
        }
        
        // Return registrationStatus
        return $registrationStatus;
    }
    
    
    /**
     * Method to register a user to the database
     * @param User - $user
     * @return int - $createStatus 
     */
    protected function createUser(User $user) {
        
        // Create SQL statement using the $username variable to get if that username is already registered to an account
        $sqlCheckUsername = "SELECT * FROM USERS WHERE USERNAME = '" . $user->getUsername() . "'";
        // Use the connect method dbConnection and query the SQL string
        $usernameResults = $this->connect()->query($sqlCheckUsername);
        
        // Create SQL statement using the $email variable to get if that email is already registered to an account
        $sqlCheckEmail = "SELECT * FROM USERS WHERE EMAIL = '" . $user->getEmail() . "'";
        // Use the connect method dbConnection and query the SQL string
        $emailResults = $this->connect()->query($sqlCheckEmail);
        
        // If the username check return results, set createStatus to -1 for error messaging (unsuccessul)
        if($usernameResults->num_rows > 0) {
            $createStatus = -1;
        }
        // If the email check return results, set createStatus to -2 for error messaging (unsuccessul)
        else if($emailResults->num_rows > 0) {
            $createStatus = -2;
        }
        // Else, add the user to the database
        else {
            // Create SQL statement using the all of the user's details to add to the database
            $sql = "INSERT INTO USERS (FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, EMAIL, PHONE_NUMBER, ROLE)
                    VALUES ('" . $user->getFirstName() . "', '" . $user->getLastName() . "', '" . $user->getUsername() . "', '" . $user->getPassword() . "', '" .
                    $user->getEmail() . "', '" . $user->getPhoneNumber() . "', '" . $user->getRole() . "')";
                    
                    // Use the connect method dbConnection and query the SQL string
                    if($this->connect()->query($sql)) {
                        // Set createStatus to 1 (successful)
                        $createStatus = 1;
                    }
                    else {
                        $createStatus = 0;
                    }
        }
        
        // Return createStatus
        return $createStatus;
    }
    
    
    /**
     * Method to get a user from the database given the userId
     * @param int - $id
     * @return User - $currentUser
     */
    protected function getUserById(int $id) {
        
        // Create SQL statement using the $id variable
        $sql = "SELECT * FROM USERS WHERE USER_ID = '" . $id . "'";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
       
        // Set the results to variable as an array
        $userInformation = $results->fetch_assoc();

        // Get variables from retrieved array
        $firstName = $userInformation["FIRST_NAME"];
        $lastName = $userInformation["LAST_NAME"];
        $username = $userInformation["USERNAME"];
        $password = $userInformation["PASSWORD"];
        $email = $userInformation["EMAIL"];
        $phoneNumber = $userInformation["PHONE_NUMBER"];
        $role = $userInformation["ROLE"];
        
        // Create a new user with the information from the query
        $currentUser = new User($id, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role);

        // Return the current user
        return $currentUser; 
    }
    
    
    /**
     * Method to get all bottles from the database
     * @return User[] - $users
     */
    protected function getAllUsers() {
        
        // Create array and index for results
        $users = array();
        $index = 0;
        
        // Create SQL statement
        $sql = "SELECT * FROM USERS";
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // If there are results return them
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each row from array
            $id = $row['USER_ID'];
            $firstName = $row['FIRST_NAME'];
            $lastName = $row['LAST_NAME'];
            $username = $row['USERNAME'];
            $password = $row['PASSWORD'];
            $email = $row['EMAIL'];
            $phoneNumber = $row['PHONE_NUMBER'];
            $role = $row['ROLE'];
            
            // Create new instance of user with variables
            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phoneNumber,  $role);
            
            // Put each instance of user at index of users array
            $users[$index] = $user;
            $index++;
        }
        
        // Return array of User objects
        return $users;
    }
    
    
    /**
     * Method to get an offset of users from the database
     * @param int - $offset
     * @return User[] - $users
     */
    protected function getAllUsersOffset(int $offset) {
        
        // Create array and index for results
        $users = array();
        $index = 0;
        
        // Create SQL statement
        $sql = "SELECT * FROM USERS ORDER BY USER_ID LIMIT 10 OFFSET " . $offset;
        
        // Use the connect method dbConnection and query the SQL string
        $results = $this->connect()->query($sql);
        
        // If there are results return them
        while($row = $results->fetch_assoc()) {
            
            // Get the variables of each row from array
            $id = $row['USER_ID'];
            $firstName = $row['FIRST_NAME'];
            $lastName = $row['LAST_NAME'];
            $username = $row['USERNAME'];
            $password = $row['PASSWORD'];
            $email = $row['EMAIL'];
            $phoneNumber = $row['PHONE_NUMBER'];
            $role = $row['ROLE'];
            
            // Create new instance of user with variables
            $user = new User($id, $firstName, $lastName, $username, $password, $email, $phoneNumber, $role);
            
            // Put each instance of user at index of users array
            $users[$index] = $user;
            $index++;
        }
        
        // Return array of User objects
        return $users;
    }
    
    
    /**
     * Method to update a user within the database
     * @param User - $user
     * @return int - $updateStatus
     */
    protected function updateUser(User $user) {
        
        // Create SQL statement using the $username variable to get if that username is already registered to an account
        $sqlCheckUsername = "SELECT * FROM USERS WHERE USERNAME = '" . $user->getUsername() . "' AND USER_ID != '" . $user->getId() . "'";
        // Use the connect method dbConnection and query the SQL string
        $usernameResults = $this->connect()->query($sqlCheckUsername);
        
        // Create SQL statement using the $email variable to get if that email is already registered to an account
        $sqlCheckEmail = "SELECT * FROM USERS WHERE EMAIL = '" . $user->getEmail() . "' AND USER_ID != '" . $user->getId() . "'";
        // Use the connect method dbConnection and query the SQL string
        $emailResults = $this->connect()->query($sqlCheckEmail);
        
        // If the username check return results, set updateStatus to -1 for error messaging (unsuccessul)
        if($usernameResults->num_rows > 0) {
            $updateStatus = -1;
        }
        // If the email check return results, set updateStatus to -2 for error messaging (unsuccessul)
        else if($emailResults->num_rows > 0) {
            $updateStatus = -2;
        }
        // Else, add the user to the database
        else {
            // Create SQL statement using the $id variable
            $sql = "UPDATE USERS SET FIRST_NAME = '" . $user->getFirstName() . "', LAST_NAME = '" . $user->getLastName() . "',
                    USERNAME = '" . $user->getUsername() . "', PASSWORD = '" . $user->getPassword() . "', EMAIL = '" . $user->getEmail() . "',
                    PHONE_NUMBER = '" . $user->getPhoneNumber() . "', ROLE = '" . $user->getRole() . "' WHERE USER_ID = " . $user->getId();
            
            // Use the connect method dbConnection and query the SQL string
            if($this->connect()->query($sql)) {
                // Set updateStatus to 1 (successful)
                $updateStatus = 1;
            }
            else {
                $updateStatus = 0;
            }
        }
        
        // Return updateStatus
        return $updateStatus;
    }
    
    
    /**
     * Method to delete a user from the database
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    protected function deleteUserById(int $id) {
        
        // Create SQL statement using the $id variable
        $sql = "DELETE FROM USERS WHERE USER_ID = '" . $id . "'";
        
        // Use the connect method dbConnection and query the SQL string
        if($this->connect()->query($sql)) {
            $deleteStatus = true;
        }
        else {
            $deleteStatus = false;
        }
        
        // Return deleteStatus
        return $deleteStatus;
    }
    
    
    
}

