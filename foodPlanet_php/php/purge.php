<?php


require_once 'connect.php';

### The order or the querys is important because of the foreign keys ###

$sql1 = "TRUNCATE TABLE $dbname.clients_id;";
$sql2 = "TRUNCATE TABLE $dbname.receipts;";
$sql3 = "TRUNCATE TABLE $dbname.orders;";

if($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
	echo " Purge done ! ";
}


?>