<!--

@author Holland Aucoin
@name Hydroflask Website
@desc accountPage - This is a page that shows a user's account details

-->

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>HydroFlask - Error</title>

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
    <?php include_once('../fragments/navbar.php'); ?>
    
		<div class="errorPage">
			<table>
				<tr>
					<td width="75%"><h2>HydroFlask - Error</h2></td>
					<td width="25%" rowspan="2"> <img src="../assets/img/main/errorImage.png" align="right" alt="Error Image" height="75" width="75"/> </td>
				</tr>
				<tr>
					<td><p>We have seem to run into a problem processing your request! Please go back and try again!</p></td>
				</tr>
			</table>
		</div>

    
    <!-- Include the scripts page fragment -->
    <?php include_once('../fragments/scripts.html')?>

</body>
</html>

