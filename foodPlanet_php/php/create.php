<?php
 

 ############ Connect DataBase and create tables if not exists ############


require_once 'session.php';;
require_once 'database.php';


############ Create data ############


if (isset($_POST['submit-registration'])) {


    $username = $_POST['username-register'];
    $address = $_POST['address-register'];
    $zipcode = $_POST['zipcode-register'];
    $email = $_POST['email-register'];
    $password = $_POST['password-register'];
    $status = "new";
    $visits = 1;
    $rating = "";


    ### session variable to keep the id of the current user to fill his 'clients-id' col with the "receipt foreign key" after order confirmation ###


    $_SESSION['registration'] = $email; 


    ### if the client exists notify him else register him ###


    $sql = "SELECT * FROM $dbname.clients_id";

    if(empty($sql)) {
        $emptyTable = 1;
    } else {
        $emptyTable = 0;
        $alreadyExist = 0;
        $result = $conn->query($sql);

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            if($row['username'] == $username || $row['email'] == $email) {
                $alreadyExist++;
                echo "<script language='javascript'> alert(\"There is already an account for this email, please connect\"); </script>";
            } 
        } 
    }

    if ($emptyTable == 1 || $alreadyExist == 0) {
        $sql = "INSERT INTO $dbname.clients_id (username, address, zip_code, email, password, status, visits, last_rating) VALUES ('$username', '$address', '$zipcode', '$email', MD5('$password'), '$status', '$visits', '$rating')";
        $result = $conn->query($sql); 

        if($result) {
            echo "Registration done ";

            ### variable to know if the user is authentified ###

           $_SESSION['authentification'] = 1;
           $_SESSION['user'] = $username; /* to have the username on all the pages */

        } else {
            die("Registration failed : " . $conn->connect_error);
        }
    }


}


if (isset($_POST['submit-connection'])) {


    $email = $_POST['email-connect'];
    $password = $_POST['password-connect'];
    $password = md5($password);
    $rating = $_POST['rating'];


    ### session variable to keep the id of the current user to fill his 'clients-id' col with the "receipt foreign key" after order confirmation ###


    $_SESSION['connection'] = $email; 


    ### if the client exists add one to his number of visits and change his last_purchase else notify him ###


    $sql = "SELECT * FROM $dbname.clients_id";

    if(empty($sql)) {
        $emptyTable = 1;
    } else {
        $emptyTable = 0;
        $alreadyExist = 0;
        $result = $conn->query($sql);

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            if($row['email'] == $email && $row['password'] == $password) {
                $alreadyExist++;
                $row['visits']++;
                $visits = $row['visits'];
                $status = "old";

                ### variable to know if the user is authentified ###

                $_SESSION['authentification'] = 1;
                $_SESSION['user'] = $row['username']; /* to have the username on all the pages */

                $sql1 = "UPDATE $dbname.clients_id SET status = '$status', visits = '$visits', last_rating = '$rating' WHERE email = '$email'";
                $result1 = $conn->query($sql1);

                if($result1) {
                    echo "Connection done ";
                } else {
                    die("Connection failed : " . $conn->connect_error);
                }
            } 
        } 
    }

    if ($emptyTable == 1 || $alreadyExist == 0) {
        echo "<script> alert(\"There is no account belonging to those identifiers, please register if you want to order on our website\") </script>";
    } 


}


function is_logged() : bool {
    if(isset($_SESSION['authentification'])) {
        return true;
    } else {
        return false;
    }
}

$promo = 'no';
$promo_value = 0.2;

    
if (isset($_POST['submit-selection'])) {


    ### promo var ###


    $code = $_POST['promotion'];
    $apply_promo = $_POST['apply-promotion'];


    if($code == 'tastyWorld' && $apply_promo == 'yes') {
        $promo = '- '.strval($promo_value*100).' %';
    }    


    ### items var ###


    $items_m = [];
    $items_s = [];
    $items_a = [];
    $items_d = [];


    ### menus var ###


    $menu = $_POST['menu']; /* string array for menu's items */
    $nb_m = $_POST['nb-menu']; /* string array for menu's amount of each item */
    $price_m = [5.5, 6.5, 7.5]; /* int array for menu's price of each item */
    $total_m = []; /* int array for menu's price of each item multiply by his amount */

    if($menu) {
        $nb_m = array_filter($nb_m); /* delete null values */
        sort($nb_m); /* reorder indexes */

        $maxi = count($menu);
        for($i = 0; $i < $maxi; $i++) {
            $items_m[$i] = $nb_m[$i]." * ".$menu[$i];

            if($menu[$i] == "ham-menu") {
                $total_m[$i] = intval($nb_m[$i])*$price_m[0];
            }
            else if($menu[$i] == "cheese-menu") {
                $total_m[$i] = intval($nb_m[$i])*$price_m[1];
            }
            else if($menu[$i] == "tower-menu") {
                $total_m[$i] = intval($nb_m[$i])*$price_m[2];
            }
        }
    }


    ### sandwichs var ###


    $sand = $_POST['sand']; 
    $nb_s = $_POST['nb-sand']; 
    $price_s = [2.5, 3.5, 4.5]; 
    $total_s = []; 

    if($sand) {
        $nb_s = array_filter($nb_s);
        sort($nb_s);

        $maxi = count($sand);
        for($i = 0; $i < $maxi; $i++) {
            $items_s[$i] = $nb_s[$i]." * ".$sand[$i];

            if($sand[$i] == "hamburger") {
                $total_s[$i] = intval($nb_s[$i])*$price_s[0];
            }
            else if($sand[$i] == "cheeseburger") {
                $total_s[$i] = intval($nb_s[$i])*$price_s[1];
            }
            else if($sand[$i] == "towerburger") {
                $total_s[$i] = intval($nb_s[$i])*$price_s[2];
            }
        }
    }


    ### accompaniments var ###


    $accomp = $_POST['accomp']; 
    $nb_a = $_POST['nb-accomp']; 
    $price_a = [1.5, 1.5, 1.5]; 
    $total_a = []; 

    if($accomp) {
        $nb_a = array_filter($nb_a);
        sort($nb_a);

        $maxi = count($accomp);
        for($i = 0; $i < $maxi; $i++) {
            $items_a[$i] = $nb_a[$i]." * ".$accomp[$i];

            if($accomp[$i] == "fries") {
                $total_a[$i] = intval($nb_a[$i])*$price_a[0];
            }
            else if($accomp[$i] == "potatoes") {
                $total_a[$i] = intval($nb_a[$i])*$price_a[1];
            }
            else if($accomp[$i] == "corn") {
                $total_a[$i] = intval($nb_a[$i])*$price_a[2];
            }
        }
    }


    ### drinks var ###


    $drink = $_POST['drink']; 
    $nb_d = $_POST['nb-drink']; 
    $price_d = [1, 1.2, 1.2, 1.2]; 
    $total_d = []; 

    if($drink) {
        $nb_d = array_filter($nb_d);
        sort($nb_d);

        $maxi = count($drink);
        for($i = 0; $i < $maxi; $i++) {
            $items_d[$i] = $nb_d[$i]." * ".$drink[$i];

            if($drink[$i] == "water") {
                $total_d[$i] = intval($nb_d[$i])*$price_d[0];
            }
            else if($drink[$i] == "coca") {
                $total_d[$i] = intval($nb_d[$i])*$price_d[1];
            }
            else if($drink[$i] == "lipton") {
                $total_d[$i] = intval($nb_d[$i])*$price_d[2];
            }
            else if($drink[$i] == "schweppes") {
                $total_d[$i] = intval($nb_d[$i])*$price_d[3];
            }
        }
    }


    ### param. calculation ###


    $items = array_merge($items_m, $items_s, $items_a, $items_d);
    $list = implode(", ", $items);

    $price = array_sum(array_merge($total_m, $total_s, $total_a, $total_d));
    if($promo != 'no' ) {
        $price = $price-($promo_value*$price);
    }
    $price = strval($price)." €";


    ### variables storage in intermediate table ###


    $sql = "INSERT INTO $dbname.running_orders (items, price, promotion) VALUES ('$list', '$price', '$promo')";
    $result = $conn->query($sql);


} 


if (isset($_POST['submit-confirmation'])) {


    ### variables recovery from intermediate table ###


    $sql = "SELECT * FROM $dbname.running_orders;";
    $result = $conn->query($sql);

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $last = $row;
    } 

    $row = $result->fetch_array(MYSQLI_ASSOC);

    $list = $last['items'];
    $price = $last['price'];
    $promo = $last['promotion'];
    $means = $_POST['pay'];


    ### orders insertion ###


    $sql = "INSERT INTO $dbname.orders (items) VALUES ('$list')";
    $result = $conn->query($sql);

    if($result) {
        echo "Order Sent ";
    } else {
        die("Order failed : " . $conn->connect_error);
    }


    ### receipts insertion ###


    $id_ord = mysqli_insert_id($conn); ### give the id of the last insertion so of the last row of 'orders' table

    $sql = "INSERT INTO $dbname.receipts (items, promotion, price, means, ord) VALUES ('$list', '$promo', '$price', '$means', '$id_ord')";
    $result = $conn->query($sql); 

    if($result) {
        echo "Receipt Sent ";
    } else {
        die("Receipt failed : " . $conn->connect_error);
    }


    ### extraction of receipt id ###


    $id_receipt = mysqli_insert_id($conn); /* usefull for 'clients_id' insertions, see $id_ord for details */

    $sql = "SELECT * FROM $dbname.running_orders";
    $result = $conn->query($sql);

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $max_id = $row['id']; /* get the last id of 'running_orders' table */
    } 

    $sql = "UPDATE $dbname.running_orders SET receipt_id = '$id_receipt' WHERE id = '$max_id'";
    $result = $conn->query($sql); 


    ### payement_infos insertion ###


    $card_num = $_POST['card-num'];
    $exp = $_POST['expiration-date'];
    $crypto = $_POST['crypto'];

    $sql = "INSERT INTO $dbname.payment_id (means, card_num, exp, crypto) VALUES ('$means', '$card_num', '$exp', '$crypto')";
    $result = $conn->query($sql); 

    if($result) {
        echo "Payment informations Sent ";
    } else {
        die("Payment failed : " . $conn->connect_error);
    }


    ### updating clients_id with 'last_purchase' after confirmation of order ###


    if (isset($_SESSION['registration'])) { /* recovering $email of the current session */
        $email_r = $_SESSION['registration'];  
    } 
    elseif (isset($_SESSION['connection'])) {
        $email_c = $_SESSION['connection']; 
    }
    
    if (isset($email_r)) {
        ### Registration case
        $sql = "UPDATE $dbname.clients_id SET last_purchase = '$id_receipt' WHERE email = '$email_r'";
        $result = $conn->query($sql); 

        if($result) {
            echo "informations Sent ";
        } else {
            die("Validation failed : " . $conn->connect_error);
        }
    } 
    elseif (isset($email_c)) {
        ### Connection case
        $sql = "UPDATE $dbname.clients_id SET last_purchase = '$id_receipt' WHERE email = '$email_c'";
        $result = $conn->query($sql); 

        if($result) {
            echo "informations Sent ";
        } else {
            die("Validation failed : " . $conn->connect_error);
        }
    }
        

}
 
   
if (isset($_POST['home']) || isset($_POST['connected'])) {


    ### cleaning and reset of intermediate tables ###


    $sql = "TRUNCATE TABLE $dbname.running_orders";
    $result = $conn->query($sql); 

    $sql = "TRUNCATE TABLE $dbname.payment_id";
    $result = $conn->query($sql); 

    if (isset($_SESSION['registration'])) {
        unset($_SESSION['registration']);
        unset($_SESSION['authentification']);
        unset($_SESSION['user']);
    } else if (isset($_SESSION['connection'])) {
        unset($_SESSION['connection']);
        unset($_SESSION['authentification']);
        unset($_SESSION['user']);
    }
    

}


?>