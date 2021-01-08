<!--

@author Holland Aucoin
@name Hydroflask Website
@desc registrationPage - This is a page that allows a user to register

-->

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Registration</title>

    <!-- Include the stylesheets page fragment -->
	<?php include_once('../fragments/stylesheets.html');?>
</head>

<body>
	<!-- Navigation bar -->
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="../index.php"><img src="../assets/img/main/hydrologo.png" height="35px" width="28px" style="padding-bottom:8px">  H Y D R O F L A S K</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="loginPage.php">L O G I N</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <!-- Header -->
                <div class="block-heading">
                    <h2 class="text-info">Registration</h2>
                </div>
                <!-- Form to register, sends to registrationHandler -->
                <form action="registrationHandler.php" method="POST">
                    <?php if(isset($message)) {
				        ?><p align=center><?php echo $message?></p><?php
				    }
				    ?>	
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="first name" name="firstName" id="firstName" required></div>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="last name" name="lastName" id="lastName" required></div>
                    <div class="form-group"><input class="form-control item" type="text" minlength="3" maxlength="25" placeholder="username" name="username" id="username" required></div>
                    <div class="form-group"><input class="form-control item" type="password" minlength="3" maxlength="25" placeholder="password" name="password" id="password" required></div>
                    <div class="form-group"><input class="form-control item" type="email" placeholder="email" name="email" id="email" required></div>
                    <div class="form-group"><input class="form-control item" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="phone number (ex: 123-456-7890)" name="phoneNumber" id="phoneNumber" required></div>
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                    <br>
                    <p align=center>Already have an account? <a href="loginPage.php">Login</a></p>
               </form>
            </div>
        </section>
    </main>
    <!-- Include the footer page fragment -->
    <footer class="page-footer dark">
		<?php include_once('../fragments/footer.html')?>
    </footer>
    
    <!-- Include the scripts page fragment -->
    <?php include_once('../fragments/scripts.html')?>

</body>
</html>
