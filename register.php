<?php
/* ---------------------------------------------------------------------------
 * filename    : register.php
 * author      : Kyle Daly
 * description : This file allows a user to create and account on the website
 * ---------------------------------------------------------------------------
 */
// from: https://www.youtube.com/watch?v=lGYixKGiY7Y

session_start();
//connect to database
$db=mysqli_connect("localhost","kddaly","627168","kddaly");
if(isset($_POST['register_btn']))
{
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
	$customer_mobile = $_POST['customer_mobile'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];  
     if($password==$password2)
     {           //Create User
            $sql="INSERT INTO customers(customer_name,customer_email,customer_mobile,password) VALUES('$customer_name','$customer_email','$customer_mobile','$password')";
            mysqli_query($db,$sql);  
            $_SESSION['message']="You are now logged in"; 
            $_SESSION['customer_email']=$customer_email;
            header("location:home.php");  //redirect home page
    }
    else
    {
      $_SESSION['message']="The two password do not match";   
     }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register , login and logout user php mysql</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">
    <h1>Register New User</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="register.php">
  <table>
     <tr>
           <td>Name : </td>
           <td><input type="text" name="customer_name" class="textInput"></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="customer_email" class="textInput"></td>
     </tr>
	      <tr>
           <td>Mobile : </td>
           <td><input type="mobile" name="customer_mobile" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td>Password again: </td>
           <td><input type="password" name="password2" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
  
</table>
					  <div class="form-actions">
						  <a class="btn" href="home.php">Back</a>
						</div>
</form>
</body>
</html>