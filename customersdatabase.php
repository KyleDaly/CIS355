<?php
class Database 
{
	public function displayListTableContents()
	{
		$pdo = Database::connect();
		$sql = 'SELECT * FROM customers ORDER BY id DESC';
		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['name'] . '</td>';
			echo '<td>'. $row['email'] . '</td>';
			echo '<td>'. $row['mobile'] . '</td>';
			echo '<td><a class="btn" href=read.php?id='.$row['id'].'">READ</a></td>';
			echo '<tr>';
		}
		Database::disconnect();
	}
	public function displayListTableContents()
	{
		$pdo = Database::connect();
		$sql = 'SELECT * FROM customers ORDER BY id DESC';
		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['name'] . '</td>';
			echo '<td>'. $row['email'] . '</td>';
			echo '<td>'. $row['mobile'] . '</td>';
			echo '<td><a class="btn" href=read.php?id='.$row['id'].'">READ</a></td>';
			echo '<tr>';
		}
		Database::disconnect();
	}
	
	public function displayListHeading()
	{
		echo '<div class=container><div class=row><h3>PHP CRUD GRID</h3></div><div class=row><p><a class="btn
		btn-success"href=customer_create.php>Create</a><table class="table
		table-bordered table-striped"><thead><tr><th>Name<th>Email
		Address<th>Mobile Number<th>Action<tbody>';
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
}
?>