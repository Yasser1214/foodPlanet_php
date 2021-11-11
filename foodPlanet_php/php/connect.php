<?php

$dbhost = "localhost";
$dbuser = "";
$dbpass = "";
$dbname = "";

$conn = new mysqli($dbhost, $dbuser, $dbpass);

if ($conn->connect_error) {

  die("Connection failed : " . $conn->connect_error);
  echo "\n";

} else {

  echo "Connected Succesfully ! \n";

}

?>