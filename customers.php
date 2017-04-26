<?php
session_start();          //REQUIRED FOR EVERY PHP FILE
//if userid is not set, then call login()
if (empty($SESSION['userid'])){
login();
 exit();
}
// enables user to login
function login() {
	echo '<form action="demo_form.php" method="post">';
	echo '<p>Username (email):';
	echo '<input type="text" name="customer_email"><br>';
	echo '<p>Password';
	echo '<input type="password" name="password"><br>';
	echo '<input type="submit" value="Submit">';
	echo '</form>';
}
include 'database.php';
include 'customers.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>Customers</h3>
    		</div>
			<div class="row">
				<p>
					<a href="customer_create.php" class="btn btn-success">Create a User</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Name</th>
		                  <th>Email Address</th>
		                  <th>Mobile Number</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM customers ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['customer_name'] . '</td>';
							   	echo '<td>'. $row['customer_email'] . '</td>';
							   	echo '<td>'. $row['customer_mobile'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="customer_read.php?id='.$row['id'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="customer_update.php?id='.$row['id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="customer_delete.php?id='.$row['id'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>