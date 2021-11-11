<?php


require_once 'session.php';
require_once 'create.php';

$sql = "SELECT * FROM $dbname.receipts;";
$result = $conn->query($sql);

while($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$last = $row;
} 


?>


<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title> foodPlanet - Receipt </title>
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

    <div id="receipt-wrapper">
	    <div id="receipt">
	    	<h3 style="color: #008080; font-weight: bold; text-align: center; padding: 10px 0;"> Your receipt </h3>
			<p>Id...........................................<?php echo $last['id']; ?></p>
			<p>Items........................................<?php echo $last['items']; ?></p>
			<p>Promotion....................................<?php echo $last['promotion']; ?></p>
			<p>Price........................................<?php echo $last['price']; ?></p>
			<p>Means of Payment.............................<?php echo $last['means']; ?></p>
			<p>Order n°.....................................<?php echo $last['ord']; ?></p>
		</div>
	</div>
			    
 	<button id="print-button" onclick="window.print()"></button>

    <footer>
            <div class="bar"></div>
            <p> © 2021 foodPlanet Inc. All rights reserved. </p>
    </footer>

</body>

</html>