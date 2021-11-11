<?php
 

require_once 'connect.php';


############ Create DataBase ############


$sql = "CREATE DATABASE " . $dbname;

if ($conn->query($sql) === TRUE) {

  echo "Database created successfully \n";

} else {

  echo "Error creating database: " . $conn->error. "\n";

}


############ Create Tables ############


/* what the cook receives if order is validated */
$sql1 = "CREATE TABLE IF NOT EXISTS $dbname.orders
(
id 		INT AUTO_INCREMENT,
PRIMARY KEY (id),
items 	VARCHAR(255)
);";

/* what the client receives at end of the operations */
$sql2 = "CREATE TABLE IF NOT EXISTS $dbname.receipts
(
id 		INT AUTO_INCREMENT,
PRIMARY KEY (id),
items 	VARCHAR(255),
promotion VARCHAR(50),
price 	VARCHAR(50),
means   VARCHAR(50),
ord   INT,
FOREIGN KEY (ord) REFERENCES orders(id)
);";

/* running order before the client confirmation */
$sql3 = "CREATE TABLE IF NOT EXISTS $dbname.running_orders
(
id    INT AUTO_INCREMENT,
PRIMARY KEY (id),
items   VARCHAR(255),
price   VARCHAR(50),
promotion   VARCHAR(50),
receipt_id  INT
);";

/* payment informations */
$sql4 = "CREATE TABLE IF NOT EXISTS $dbname.payment_id
(
id    INT AUTO_INCREMENT,
PRIMARY KEY (id),
means   VARCHAR(50),
card_num   VARCHAR(50),
exp   VARCHAR(50),
crypto   VARCHAR(50)
);";

/* client informations */
$sql5 = "CREATE TABLE IF NOT EXISTS $dbname.clients_id
(
id    INT AUTO_INCREMENT,
PRIMARY KEY (id),
username    VARCHAR(50),
address    VARCHAR(50),
zip_code    VARCHAR(10),
email   VARCHAR(50),
password   VARCHAR(32),
status   VARCHAR(4),
visits   INT,
last_rating   VARCHAR(5),
last_purchase INT,
FOREIGN KEY (last_purchase) REFERENCES receipts(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE && $conn->query($sql5) === TRUE) {

  echo "Tables created successfully \n";

} else {

  echo "Error creating Tables: " . $conn->error. "\n";

}


?>