<?php
session_start();
session_destroy();
unset($_SESSION['customer_email']);
$_SESSION['message']="You are now logged out";
header("location:login.php");
?>