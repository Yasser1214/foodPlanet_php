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
	<title> Your Receipt ! </title>
</head>

<body>
	<table id="read" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Id</th>
			    <th>Items</th>
			    <th>Promotion</th>
			    <th>Price</th>
			    <th>Means of Payment</th>
			    <th>Order n°</th>
  			</tr>
  		</thead>
	 	<tbody>

		    <tr>
		    	<td><?php echo $last['id']; ?></td>
		    	<td><?php echo $last['items']; ?></td>
		    	<td><?php echo $last['promotion']; ?></td>
		    	<td><?php echo $last['price']; ?></td>
		    	<td><?php echo $last['means']; ?></td>
		    	<td><?php echo $last['ord']; ?></td>
		    </tr>

	 	</tbody>
 	</table>

 	<button id="print" onclick="window.print()">Print This Page</button>

 	<div>

 		<h2>Register or connect to benefit from our loyalty program  </h2>

 		<button type="submit" name="registration" id="registration" value="register" onclick="Validate()">Register</button>

 		<button type="submit" name="connection" id="connection" value="connect" onclick="Validate()">Connect</button>
 	
	 	<form method="POST" action="read.php">

	 		<div id="registration-form" style="display: none;">

		 		<label>email : </label>
		 		<input type="email" name="email-register" id="email-register">

		 		<label>password : </label>
		 		<input type="text" name="password-register" id="password-register">

		 		<button type="submit" name="submit-registration" id="submit-registration" value="registered" onclick="Validate()">Validate</button>

	 		</div>

	 		<div id="connection-form" style="display: none;"> 

		 		<label>email : </label>
		 		<input type="email" name="email-connect" id="email-connect">

		 		<label>password : </label>
		 		<input type="text" name="password-connect" id="password-connect">

		 		<label id="rating-label">How do you find our service last time ? </label>
		 		<input type="radio" name="rating" id="rating" value="5" checked><label>Excellent</label>
		 		<input type="radio" name="rating" id="rating" value="4"><label>Good</label>
		 		<input type="radio" name="rating" id="rating" value="3"><label>Pretty good</label>
		 		<input type="radio" name="rating" id="rating" value="2"><label>Average</label>
		 		<input type="radio" name="rating" id="rating" value="1"><label>Not good</label>
		 		<input type="radio" name="rating" id="rating" value="0"><label>A shame</label>

		 		<button type="submit" name="submit-connection" id="submit-connection" value="connected" onclick="Validate()">Validate</button> 

	 		</div> 

	    </form>

    </div>

</body>

</html>