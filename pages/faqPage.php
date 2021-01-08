<!--

@author Holland Aucoin
@name Hydroflask Website
@desc faqPage - This is a page that shows the FAQ

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - FAQ</title>
    
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
    
	<main class="page faq-page">
		<section class="clean-block clean-faq dark">
			<div class="container">
				<!-- Heading -->
				<div class="block-heading">
					<h2 class="text-info">FAQ</h2>
					</div>
					<div align="center">
					<p style="width:80%">Thank you for choosing HydroFlask! Below is the answers to some of our frequently asked questions. If you couldn't find the
					answer you were looking for, be sure to <a href="contactPage.php">contact us</a> for more information.</p><br>
					</div>
				<div class="block-content">
				<!-- Heading -->
				<h3>Products</h3>
					<div class="faq-item">
						<h4 class="question">Why does my HydroFlask not have a registered trademark symbol?</h4>
						<div class="answer">
							<p>Newly produced Hydro Flasks do not feature a registered trademark symbol next to our logo. This decision was made 
							to enhance the presentation of the logo on our bottles. The absence or presence of a Hydro Flask registered trademark or 
							R symbol next to our logo is not an indicator of authenticity.</p>
						</div>
					</div>
					<div class="faq-item">
						<h4 class="question">How do I wash my bottle?</h4>
						<div class="answer">
							<p>Wash your flask with a bottle brush: Shop our cleaning accessories and use the Bottle Brush and Straw & Lid Cleaning 
							Set as frequently as possible.</p>
							<p>Use white distilled vinegar for cleaning: You can use household white distilled vinegar to help remove any stains or 
							discoloration on the inside of your flask. We recommend putting ½ cup of vinegar in your flask, gently swirling the vinegar 
							around to wash any affected areas, and let sit for 5 minutes. Rinse thoroughly with warm water and repeat if necessary.</p>
						</div>
					</div>
					<div class="faq-item">
						<h4 class="question">How do I wash my lid/straw?</h4>
						<div class="answer">
							<p>Wash your Hydro Flip Lid and Wide Straw Lid in the dishwasher: The Hydro Flip Lid and Wide Straw Lid are top-rack 
							dishwasher safe. The cap may last longer if it is hand washed, but if it needs to be deep cleaned, the dishwasher is 
							acceptable.</p>
						</div>
					</div>
				
				<!-- Heading -->
				<h3>Orders</h3>
					<div class="faq-item">
						<h4 class="question">How long will it take for my order to arrive?</h4>
						<div class="answer">
							<p>Orders placed before 9am PT for two-day delivery will be processed same day and arrive in two business days. If orders 
							are placed after 9am PT, they will be processed and shipped the next day, arriving on the third business day.</p>
							<p>For example, if an order is received before or by 9am PT on a Wednesday, you will receive your order by Friday. If the 
							order is placed after 9am PT on Wednesday, you can expect your order to be delivered on the following Monday.</p>
							<p>Please note, as with all of our shipping methods, two-day shipping estimates apply to business days only. If you place 
							an order on Friday, your order will arrive on Tuesday (order is placed before 9am PT) or Wednesday (order is placed after 
							9am PT) the following week.</p>
						</div>
					</div>
					<div class="faq-item">
						<h4 class="question">Can I ship to an international address?</h4>
						<div class="answer">
							<p>Unfortunately, no. Hydro Flask does not currently ship to international destinations.</p>
						</div>
					</div>
					<div class="faq-item">
						<h4 class="question">Can I ship my order to someone else or to a different address?</h4>
						<div class="answer">
							<p>Yes! Orders can be shipped to a different address other than the billing address. During the order process, you will 
							be asked first for a billing address, then you will be given an option to “Ship to this address” or “Ship to a different 
							address.” At that point, you can enter a different shipping address.</p>
						</div>
					</div>
					<div class="faq-item">
						<h4 class="question">Do I really get free shipping if I spend $30+?</h4>
						<div class="answer">
							<p>Yep, it's true! Hydro Flask offers free FedEx Ground shipping on qualified orders: $30+ subtotal or using a free 
							shipping discount code. Valid throughout the United States, including Alaska and Hawaii.</p>
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

