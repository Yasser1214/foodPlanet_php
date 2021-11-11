<?php


############ Used to destroy the session variable 'loaded' after we quit the page confirm.php ############

session_start();
unset($_SESSION['loaded']);


?>