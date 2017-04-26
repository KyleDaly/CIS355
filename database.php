<?php
/* ---------------------------------------------------------------------------
 * filename    : database.php
 * author      : Kyle Daly
 * description : This file contains the various functions needed for the website to function. Such as displaying the lists and getting info from the database
 * ---------------------------------------------------------------------------
 */
class Database 
{
	private static $dbName = 'kddaly' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'kddaly';
	private static $dbUserPassword = '627168';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
	
	public function displayListTableContents()
	{
		$pdo = Database::connect();
		$sql = 'SELECT id,customer_name,customer_email,customer_mobile FROM customers ORDER BY id DESC';
		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['customer_name'] . '</td>';
			echo '<td>'. $row['customer_email'] . '</td>';
			echo '<td>'. $row['customer_mobile'] . '</td>';
			echo '<td><a class="btn" href=customer_read.php?id='.$row['id'].'">READ</a><a class="btn" href=customer_update.php?id='.$row['id'].'">UPDATE</a><a class="btn" href=customer_delete.php?id='.$row['id'].'">DELETE</a></td>';
			echo '<tr>';
		}
		Database::disconnect();
	}
	public function displayListTableContents2()
	{
		$pdo = Database::connect();
		$sql = 'SELECT attraction_id,attraction_name,attraction_type,attraction_capacity FROM attractions ORDER BY attraction_id DESC';
		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['attraction_name'] . '</td>';
			echo '<td>'. $row['attraction_type'] . '</td>';
			echo '<td>'. $row['attraction_capacity'] . '</td>';
			echo '<td><a class="btn" href=attraction_read.php?attraction_id='.$row['attraction_id'].'">READ</a><a class="btn" href=attraction_update.php?attraction_id='.$row['attraction_id'].'">UPDATE</a><a class="btn" href=attraction_delete.php?attraction_id='.$row['attraction_id'].'">DELETE</a></td>';
			echo '<tr>';
		}
		Database::disconnect();
	}
	
	public function displayListHeading()
	{
		echo '<div class=container><div class=row><h3>PHP CRUD GRID</h3></div><div class=row><p><a class="btn
		btn-success"href=customer_create.php>Create</a><div class=row><p><a class="btn
		btn-success"href=login.php>Login</a><div class=row><p><a class="btn
		btn-success"href=home.php>Attractions</a><div class=row><p><a class="btn
		btn-success"href=customerAPI.php>JSON</a><table class="table
		table-bordered table-striped"><thead><tr><th>Name<th>Email
		Address<th>Mobile Number<th>Action<tbody>';
	}
	
		public function displayListHeading2()
	{
		echo '<div class=container><div class=row><h3>Attractions Page</h3></div><div class=row><p><a class="btn
		btn-success"href=attraction_create.php>Create</a><div class=row><p><a class="btn
		btn-success"href=login.php>Login</a><div class=row><p><a class="btn
		btn-success"href=register.php>Register New User</a><div class=row><p><a class="btn
		btn-success"href=customerspage.php>Customers</a><table class="table
		table-bordered table-striped"><thead><tr><th>Name<th>Type<th>
		Capacity<th>Action<tbody>';
	}
	
	public function importBootstrap()
	{
		echo '<!DOCTYPE html><html lang=en><meta
		charset=utf-8><link href=
		https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css
		rel=stylesheet><script src=
		https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js></script>';
	}
	
	public function displayListFooting()
	{
		echo '</tbody></table></div></div></body></html>';
	}
	
	public function displayListScreen()
	{
		Database::importBootstrap();
		Database::displayListHeading();
		Database::displayListTableContents();
		Database::displayListFooting();
	}
	public function displayListScreen2()
	{
		Database::importBootstrap();
		Database::displayListHeading2();
		Database::displayListTableContents2();
		Database::displayListFooting();
	}
}
?>