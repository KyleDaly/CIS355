<?php
session_start();
$email = $_POST['customer_email'];
$password = $_POST['password'];
$loginApproved = false;
//find record with username

include 'database.php';
$pdo = Database::connect();
$sql = 'SELECT * FROM customers WHERE customer_email = "' . $email. '"';
foreach ($pdo->query($sql) as $row) {
   if (0 == strcmp(trim($row['password']), trim($password))){
	   $loginApproved = true;
	   $_SESSION['userid'] = $row['id'];
	   echo "THIS WORKS?";
	   }
	else echo "THIS NEEDS TO WORK";
}
Database::disconnect();
echo $_SESSION['userid'];
echo $_POST['customer_email'];
echo $_POST['password'];
header("Location: login.php");
?>