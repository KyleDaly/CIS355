<?php 
/* ---------------------------------------------------------------------------
 * filename    : attraction_delete.php
 * author      : Kyle Daly
 * description : This file allows a user to delete an attraction
 * ---------------------------------------------------------------------------
 */
	require 'database.php';
	$attraction_id = 0;
	
	if ( !empty($_GET['attraction_id'])) {
		$attraction_id = $_REQUEST['attraction_id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$attraction_id = $_POST['attraction_id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM attractions  WHERE attraction_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($attraction_id));
		Database::disconnect();
		header("Location: attraction_delete.php");
		
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
		    			<h3>Delete an Attraction</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="attraction_delete.php" method="post">
	    			  <input type="hidden" name="attraction_id" value="<?php echo $attraction_id;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="home.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>