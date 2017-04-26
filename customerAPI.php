<?php
/* ---------------------------------------------------------------------------
 * filename    : customerAPI.php
 * author      : Kyle Daly
 * description : This file gathers all usernames from the database and outputs in JSON format 
 * ---------------------------------------------------------------------------
 */
include 'database.php';
$pdo = Database::connect();
if($_GET['id'])
	$sql = "SELECT * FROM customers WHERE id=" . $_GET['id']; 
else
	$sql = "SELECT * FROM customers";

$arr = array();
foreach ($pdo->query($sql) as $row) {
array_push($arr, $row['customer_name']);
}
Database::disconnect();
//print_r($arr);
echo '{"name":' . json_encode($arr) . '}';
?>