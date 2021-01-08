<!--

@author Holland Aucoin
@name Hydroflask Website
@desc homePage - This is a page that the user lands on when visiting the website

-->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - Home</title>

    <?php 
    
    // Error reporting support
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    // Start the session if its not started
    if(!isset($_SESSION)) {
        include 'session.php';
    }
    
    // Include the stylesheets page fragment
    include_once('../fragments/stylesheets.html')
    
    ?>
</head>

<body>
	<!-- Include the navbar page fragment -->
    <?php include_once('../fragments/navbar.php')?>
    
    <!-- Hero section -->
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="background-image:url(&quot;../assets/img/main/mainhero.jpg&quot;);color:rgba(85, 85, 85, 0);height:825px">
            <div class="text">
                <h2 class="m-sm-auto" style="font-weight: 900; font-size: 50px">Colder. Hotter. Longer. Happier. HydroFlask.&nbsp;</h2>
                <br>
                <br>
                <br>
                <p>Find the perfect HydroFlask for any adventure.</p>
                <a href="bottlesPage.php"><button class="btn btn-outline-light btn-lg" type="button">Shop</button></a></div>
        </section>
        <!-- Information section -->
        <section class="clean-block clean-info dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">There's Something for Everyone.</h2>
                    <p style="width:80%">Whatever adventure you’re planning, we’re in. From cross-country skiing to stories by the campfire. From morning meetings to sunsets in the park.</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6"><img class="img-thumbnail" src="../assets/img/main/turquoiseRocks.jpg"></div>
                    <div class="col-md-6">
                        <h3>Let's Go!</h3>
                        <div class="getting-started-info">
                            <p>We’ll bring fuel worthy of the moment: wickedly hot coffee, just-out-of-the-cooler cold beverages or water that stays icy cold for hours.
                            Today is wide open. And we’re up for anything.</p>
                        </div><a href="bottlesPage.php?offset=0"><button class="btn btn-outline-primary btn-lg" type="button" >Shop Now</button></a></div>
                </div>
            </div>
        </section>
        <!-- Features section -->
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">The HydroFlask difference.</h2>
                    <p style="width:80%">It is the unique combination of temperature, taste, and transport that allows Hydro Flask to deliver hours of refreshment anytime, anywhere.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5 feature-box"><i class="icon-shield icon"></i>
                        <h4>Temperature</h4>
                        <p>TempShield™ double wall vacuum insulation eliminates condensation and keeps your beverage cold or hot for hours.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-drop icon"></i>
                        <h4>Taste</h4>
                        <p>Durable 18/8 pro-grade stainless steel construction won’t retain or transfer flavor.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-compass icon"></i>
                        <h4>Transport</h4>
                        <p>Our signature powder coat is easy to grip, sweat-free, and durable – so you can take your Hydro Flask anywhere.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-refresh icon"></i>
                        <h4>Lifetime Warranty</h4>
                        <p>We are so convinced that Hydro Flask is the best available that we guarantee every bottle with a limited lifetime warranty against manufacturer defects.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Slideshow section -->
        <section class="clean-block slider dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Adventure starts now.</h2>
                    <p style="width:80%">Every open trail brings new opportunity to explore—push past the familiar and keep going.</p>
                </div>
                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item"><img class="w-100 d-block" src="../assets/img/main/adventure1.jpg" alt="Slide Image"></div>
                        <div class="carousel-item active"><img class="w-100 d-block" src="../assets/img/main/adventure2.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="../assets/img/main/adventure3.jpg" alt="Slide Image"></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class=""></li>
                        <li data-target="#carousel-1" data-slide-to="1" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- Social media section -->
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Learn more. Do more.</h2>
                    <p style="width:80%">Every hour of engineering that goes into each HydroFlask product we make— it’s all for one thing: to be part of the moments that 
                    make life more fulfilling. Join us for every adventure by following Hydro Flask on social. Let’s Go!</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card clean-card text-center imagehover">
                        	<a href="https://www.instagram.com/hydroflask/"><img class="card-img-top w-100 d-block" src="../assets/img/social/social4.jpg"></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card clean-card text-center imagehover">
                        	<a href="https://www.instagram.com/hydroflask/"><img class="card-img-top w-100 d-block" src="../assets/img/social/social1.jpg"></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card clean-card text-center imagehover">
                        	<a href="https://www.instagram.com/hydroflask/"><img class="card-img-top w-100 d-block" src="../assets/img/social/social3.jpg"></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card clean-card text-center imagehover">
                        	<a href="https://www.instagram.com/hydroflask/"><img class="card-img-top w-100 d-block" src="../assets/img/social/social2.jpg"></a>
                        </div>
                    </div>
                </div>
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

