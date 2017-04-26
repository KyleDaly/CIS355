<?php 
/* ---------------------------------------------------------------------------
 * filename    : attraction_read.php
 * author      : Kyle Daly
 * description : This file allows a user to veiw a specific attracion and all its information, including: Name,type,capacity and average rating
 * ---------------------------------------------------------------------------
 */
session_start();
	require 'database.php';
	$attraction_id = null;
	if ( !empty($_GET['attraction_id'])) {
		$attraction_id = $_REQUEST['attraction_id'];
	}
	
	if ( null==$attraction_id ) {
		header("Location: home.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM attractions where attraction_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($attraction_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
		    			<h3>Read an Attraction</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['attraction_name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Type</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['attraction_type'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Capacity</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['attraction_capacity'];?>
						    </label>
					    </div>
					  </div>
					  
					  	<div class="control-group">
					    <label class="control-label">Average Score</label>
					    <div class="controls">
					      	<label class="checkbox">
							<?php

		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT avg(score) AS avg FROM ratings where attraction_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($attraction_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();

							echo $data['avg'];?>
						    </label>
					    </div>
					  </div>
					  
					  
				<div class='control-group col-md-6'>
					<div class="controls ">
					<?php 
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM attractions where attraction_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($attraction_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
					if ($data['filesize'] > 0) 
						echo '<img  height=15%; width=45%; src="data:image/jpeg;base64,' . 
							base64_encode( $data['filecontent'] ) . '" />'; 
					else 
						echo 'No photo on file.';
					?><!-- converts to base 64 due to the need to read the binary files code and display img -->
					</div>
</div>
				
					    <div class="form-actions">
						  <a class="btn" href="home.php">Back</a>
						    <a class="btn" href="rateattraction.php">Rate an Attraction</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>