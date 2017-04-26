<?php
/* ---------------------------------------------------------------------------
 * filename    : login.php
 * author      : Kyle Daly
 * description : This file allows an existing user to login
 * ---------------------------------------------------------------------------
 */
session_start(); 
$db=mysqli_connect("localhost","kddaly","627168","kddaly") or die ("connection error");
if(isset($_POST['login_btn']))
{
	
	$customer_email = $_POST['customer_email'];
	$password = $_POST['password'];
	$sql="SELECT * FROM customers WHERE customer_email='$customer_email' AND password='$password'";
	$result = mysqli_query($db,$sql);
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION['message']="You are now Logged In";
		$_SESSION['customer_email']=$customer_email;
		echo 'login sucessful';
		header("location:home.php");
	}
	else
	{
		$_SESSION['message']="Username and Password combination incorrect";
	}
}
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

		<div class="span10 offset1">

			<div class="row">
				<h3>Customer Login</h3>
			</div>

			<form class="form-horizontal" action="login.php" method="post">
								  
				<div class="control-group">
					<label class="control-label">Username (Email)</label>
					<div class="controls">
						<input name="customer_email" type="text"  placeholder="me@email.com" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="not your SVSU password, please" required> 
					</div>	
				</div> 

				<div class="form-actions">
					<button type="submit" name="login_btn" class="btn btn-success">Sign in</button>
			  <a class="btn btn-primary" href="register.php">Register New User</a>
				</div>			
				<br />
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>