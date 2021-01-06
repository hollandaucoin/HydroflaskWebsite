<?php

/**
 * @author Holland Aucoin and Andrei Yanovich
 * @name Hydroflask Website
 * @desc navbar - This is a page fragment to reuse and change the navigation bar
 */

// Start the session if its not started
if(!isset($_SESSION)) {
    include 'session.php';
}

// Get the username session if its set
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $usernameSpaced = "";
    
    // Loop to put spaces in between each letter of username for navbar
    for($i  = 0; $i < strlen($username); $i++) {
        $usernameSpaced .= $username[$i] . " ";
    }
}

// If the session is set, meaning the customer is logged in to the website
if(isset($_SESSION['userId']) && $_SESSION['userId'] > 1 && $_SESSION['userRole'] == "Customer") {

?>
	<!-- Logged in customer navigation bar -->
	<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo imagehover" href="homePage.php"><img src="../assets/img/main/hydrologo.png" height="35px" width="28px" style="padding-bottom:8px">  H Y D R O F L A S K</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">S H O P&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="../pages/bottlesPage.php?offset=0">B O T T L E S</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/lidsPage.php?offset=0">L I D S</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/bootsPage.php?offset=0">B O O T S</a></div>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../pages/aboutPage.php">A B O U T</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../pages/cartPage.php">C A R T</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><?php echo $usernameSpaced?>&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="../pages/accountPage.php">P R O F I L E</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/ordersPage.php">O R D E R S</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/contactPage.php">C O N T A C T</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/logoutHandler.php">L O G  O U T</a></div>
                </ul>
            </div>
        </div>
    </nav>
    
<?php 

}
// If the session is set to an admin account
else if(isset($_SESSION['userId']) && $_SESSION['userRole'] == "Admin") {
?>
	<!-- Admin account navigation bar -->
	<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo imagehover" href="homePage.php"><img src="../assets/img/main/hydrologo.png" height="35px" width="28px" style="padding-bottom:8px">  H Y D R O F L A S K</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">M A N A G E&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="../pages/manageUsersPage.php?offset=0">U S E R S</a>
                        									   <a class="dropdown-item" role="presentation" href="../pages/bottlesPage.php?offset=0">B O T T L E S</a>
                        									   <a class="dropdown-item" role="presentation" href="../pages/bootsPage.php?offset=0">B O O T S</a>
                        									   <a class="dropdown-item" role="presentation" href="../pages/lidsPage.php?offset=0">L I D S</a>
                        									   <a class="dropdown-item" role="presentation" href="../pages/discountsPage.php">D I S C O U N T S</a></div>
                        										
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../pages/ordersPage.php">O R D E R S</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><?php echo $usernameSpaced?>&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="../pages/accountPage.php">P R O F I L E</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/logoutHandler.php">L O G  O U T</a></div>
                </ul>
            </div>
        </div>
    </nav>
    

<?php 
    
}
// Else, the session is not set because the user is not logged in
else {
    
?>
	<!-- Random user navigation bar -->
	<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo imagehover" href="homePage.php"><img src="../assets/img/main/hydrologo.png" height="35px" width="28px" style="padding-bottom:8px">  H Y D R O F L A S K</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">S H O P&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="../pages/bottlesPage.php?offset=0">B O T T L E S</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/lidsPage.php?offset=0">L I D S</a>
                        										<a class="dropdown-item" role="presentation" href="../pages/bootsPage.php?offset=0">B O O T S</a></div>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../pages/aboutPage.php">A B O U T</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../pages/cartPage.php">C A R T</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../pages/loginPage.php">L O G I N</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../pages/registrationPage.php">R E G I S T E R</a></li>
                </ul>
            </div>
        </div>
    </nav>

<?php  
    
}
    
?>