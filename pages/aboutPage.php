<!-- 

@author Holland Aucoin
@name Hydroflask Website
@desc aboutPage - This is a page that explains the background of the HydroFlask company
 
-->

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HydroFlask - About</title>

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
        <section class="clean-block clean-hero" style="background-image:url(&quot;../assets/img/main/abouthero.jpg&quot;);color:rgba(85, 85, 85, 0);height:825px">
            <div class="text">
                <h2 class="m-sm-auto" style="font-weight: 900; font-size: 50px">We are HydroFlask.&nbsp;</h2>
                <br><br><br><br><br><br>
            </div>
        </section>
        <!-- Our Story section -->
        <section class="clean-block features">
            <div class="container">
                <div align="center">
                	<br><br><br>
                    <h2 class="text-info">Our Story</h2><br>
                    <p style="width:85%">Founded in 2009 in Bend, Oregon, HydroFlask is the award-winning leader in high-performance insulated products 
                    ranging from beverage and food flasks to the new Unbound Series Soft Coolers. Inspiring an active and joyful life on the go, HydroFlask 
                    innovations showcase TempShield double-wall vacuum insulation to lock in temperature, 18/8 stainless steel ensuring pure taste and 
                    durable, ergonomic design for the ultimate trusted sidekick.</p><br>
                    	<img src="../assets/img/main/hydrologo.png" height=200px width=200px><br><br>
                    <p style="width:85%">Always premium, always better than anything else we’ve ever used, 
                    and never lukewarm. From our original 18 ounce bottles to our award-winning soft coolers, we want you to love every HydroFlask product 
                    you ever own just as much as we loved perfecting it. Because for us it has never been just about making something, it has always been 
                    about making something awesome.</p>
                </div>
            </div>
        </section>
        <!-- Our Purpose section -->
        <section class="clean-block clean-info dark">
            <div class="container">
                <div align="center">
                    <br><br><br>
                    <h2 class="text-info">Our Purpose</h2><br>
                    <p style="width:85%">Parks represent a place we can all go to recreate, relax, or 
                    be inspired. From urban park excursions with our family to national park adventures in the backcountry, parks of all sizes help 
                    make us healthier, happier, and more fulfilled. Parks for All is our way of sharing the love we have for green spaces and ensuring 
                    these special places get the attention and protection they deserve.</p><br>
                    	<img src="../assets/img/main/parks.png" height=200px width=150px><br><br><br>
                    <p style="width:85%">Our goal is to support non-profit organizations focused on building, maintaining, restoring, and providing 
                    better access to parks. Since 2017, we have been doing just that. HydroFlask’s charitable giving program, Parks For All, supports 
                    the development, maintenance and accessibility of public green spaces so people everywhere can live healthier, happier and more 
                    fulfilled lives.</p>
                 </div>
            </div>
        </section>
        <!-- Bottom hero section -->
        <section class="clean-block clean-hero" style="background-image:url(&quot;../assets/img/main/letsgo.jpg&quot;);color:rgba(85, 85, 85, 0);height:825px"></section>
    </main>
    <!-- Include the footer page fragment -->
    <footer class="page-footer dark">
		<?php include_once('../fragments/footer.html')?>
    </footer>
    
    <!-- Include the scripts page fragment -->
    <?php include_once('../fragments/scripts.html')?>

</body>
</html>

