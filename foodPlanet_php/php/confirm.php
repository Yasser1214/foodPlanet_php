<?php


session_start();

if (!$_SESSION['loaded']) /* only if page is not refreshed yet */
{
	require_once 'create.php';
	echo "first generation of the page";
} else {
	require_once 'connect.php';
	$sql = "SELECT * FROM $dbname.running_orders;";
    $result = $conn->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $list = $row['items'];
    $price = $row['price'];
    $promo = $row['promotion'];
    echo "page refreshed";
}

/* creation of the session wich exists now if the page is refreshed */
$_SESSION['loaded'] = true; 


?>


<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title> foodPlanet - Confirmation </title>
		<link rel="icon" type="image/png" href="../pictures/foodplanet.png">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
        <script type="text/javascript" src="../js/jQuery/jquery-3.6.0.slim.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
	</head>

	<body>

		<header>
            <h1 class="brand"> Welcome to <span class="food">food</span><span class="planet">Planet</span> <img id="logo" src="../pictures/foodplanet.png"> </h1> 
        </header>
        <div class="bar"></div>

        <div>
	        <form method="POST" action="../index.php" id="user-button">
	            <input type="submit" name="connected" id="connected" value='<?php echo $_SESSION['user']; ?>'>
	            <p style="font-size: 11px; margin-left: 15px; color: #900000;">click on to disconnect</p>
	        </form>

	        <form method="POST" action="../index.php" id="home-button">
				<input type="submit" name="home" value="HOME">
			</form>
		</div>

        <div id="confirmation-wrapper">
			<div id="confirmation">
	            <label> Items : </label>
				<p> <?php echo $list ?> </p>
				<label> Total <span style="color: #900000; font-weight: bold;">*</span> : </label>
				<p> <?php echo $price." (promo : ".$promo.") " ?> </p>
				<p id="footnote"> 
					* including all taxes 
				</p>
	        </div>
        </div>

        <form method="POST" action="read.php" id="payment-form">

        	<div id="payment-options">

        		<label for="pay">Choose a means of payement :</label>
				<select id="pay" name="pay" required="required">
				    <option value="">--Please choose an option--</option>
				    <option value="electron">Electron</option>
				    <option value="visa">Visa</option>
				    <option value="credit-card">Credit Card</option>
				    <option value="prepaid-card">Prepaid Card</option>
				</select>

				<label for="card-num">Card number : </label>
				<input type="number" name="card-num" min="1000000000000000" max="9999999999999999" required="required">
				<label for="expiration-date">Expiration date : </label>
				<input type="month" name="expiration-date" min="<?= date('Y-m'); ?>" required="required">
				<label for="crypto">Visual cryptogram : </label>
				<input type="number" name="crypto" min="100" max="999" required="required">

        	</div>

        	<input type="submit" name="submit-confirmation" value="Confirm order">

        </form>

	</body>

	<footer>
            <div class="bar"></div>
            <p> © 2021 foodPlanet Inc. All rights reserved. </p>
    </footer>

</html>