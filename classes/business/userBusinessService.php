<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc userBusinessService - This is a class to perform the business logic of users between the presentation and persistence layers
 */

// Include userDataService to allow for inheritance
include_once('../classes/data/userDataService.php');

class userBusinessService extends userDataService {
   
    /**
     * Method to login a user given the username and password
     * @param UserCredentials - $userCredentials
     * @return boolean - $loginStatus
     */
    public function loginUser(UserCredentials $userCredentials) {
        
        // Call userAuthentication method in userDataService and set to variable
        $loginStatus = $this->userAuthentication($userCredentials);
        
        // Return the user login status boolean
        return $loginStatus;
    }
    
    
    /**
     * Method to register a user given their information
     * @param User - $user
     * @return int - $registerStatus
     */
    public function registerUser(User $user) {
        
        // Call userRegistration method in userDataService and set to variable
        $registerStatus = $this->userRegistration($user);
        
        // Return the user registration status int (determines what kind of error)
        return $registerStatus;
    }
    
    
    /**
     * Method for admin to add a new user given their information
     * @param User - $user
     * @return int - $addStatus
     */
    public function addUser(User $user) {
        
        // Call createUser method in userDataService and set to variable
        $addStatus = $this->createUser($user);
        
        // Return the user add status int (determines what kind of error)
        return $addStatus;
    }
    
    
    /**
     * Method to get a user given their ID
     * @param int - $id
     * @return User - $user
     */
    public function getUserFromId(int $id) {
        
        // Call getUserById method in userDataService and set to variable
        $user = $this->getUserById($id);
        
        // Return the user information array
        return $user;
    }
    
    
    /**
     * Method to get all of the users
     * @return User[] - $users
     */
    public function getUsers() {
        
        // Call getAllUsers method in userDataService and set to variable
        $users = $this->getAllUsers();
        
        // Return array of users
        return $users;
    }
    
    
    /**
     * Method to get an offset of users
     * @param int - $offset
     * @return User[] - $users
     */
    public function getUsersOffset(int $offset) {
        
        // Call getAllUsersOffset method in userDataService and set to variable
        $users = $this->getAllUsersOffset($offset);
        
        // Return array of users
        return $users;
    }
    
    
    /**
     * Method to edit a user
     * @param User - $user
     * @return int -  $editStatus
     */
    public function editUser(User $user) {
        
        // Call updateUser method in userDataService and set to variable
        $editStatus = $this->updateUser($user);
        
        // Return the edit status int (determines what kind of error)
        return $editStatus;
    }
    
    
    /**
     * Method to delete a user given their ID
     * @param int - $id
     * @return boolean - $deleteStatus
     */
    public function deleteUserFromId(int $id) {
        
        // Call deleteUserById method in userDataService and set to variable
        $deleteStatus = $this->deleteUserById($id);
        
        // Return the delete status boolean
        return $deleteStatus;
    }
    
}

