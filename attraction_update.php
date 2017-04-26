<?php 
	/* ---------------------------------------------------------------------------
 * filename    : attraction_update.php
 * author      : Kyle Daly
 * description : This file allows for the updating of information about the attractions
 * ---------------------------------------------------------------------------
 */
	require 'database.php';

	$attraction_id = null;
	if ( !empty($_GET['attraction_id'])) {
		$attraction_id = $_REQUEST['attraction_id'];
	}
	
	if ( null==$attraction_id ) {
		header("mobile: attractions.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$NameError = null;
		$TypeError = null;
		$CapacityError = null;
		
		// keep track post values
		$Name = $_POST['attraction_name'];
		$Type = $_POST['attraction_type'];
		$Capacity = $_POST['attraction_capacity'];
		
		// validate input
		$valid = true;
		if (empty($Name)) {
			$NameError = 'Please enter name';
			$valid = false;
		}
		
		if (empty($Type)) {
			$TypeError = 'Please enter type';
			$valid = false;
		} 
		
		if (empty($Capacity)) {
			$mobileError = 'Please enter capacity';
			$valid = false;
		}
		
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE attractions  set attraction_name = ?, attraction_type = ?, attraction_capacity =? WHERE attraction_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Name,$Type,$Capacity,$attraction_id));
			Database::disconnect();
			header("mobile: attractions.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM attractions where attraction_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($attraction_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Name = $data['attraction_name'];
		$Type = $data['attraction_type'];
		$Capacity = $data['attraction_capacity'];
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
		    			<h3>Update an Attraction</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="attraction_update.php?attraction_id=<?php echo $attraction_id?>" method="post">
					  <div class="control-group <?php echo !empty($NameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="attraction_name" type="text"  placeholder="Name" value="<?php echo !empty($Name)?$Name:'';?>">
					      	<?php if (!empty($NameError)): ?>
					      		<span class="help-inline"><?php echo $NameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($TypeError)?'error':'';?>">
					    <label class="control-label">Type</label>
					    <div class="controls">
					      	<input name="attraction_type" type="text" placeholder="Type" value="<?php echo !empty($Type)?$Type:'';?>">
					      	<?php if (!empty($TypeError)): ?>
					      		<span class="help-inline"><?php echo $TypeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($CapacityError)?'error':'';?>">
					    <label class="control-label">Capacity</label>
					    <div class="controls">
					      	<input name="attraction_capacity" type="text"  placeholder="Capacity" value="<?php echo !empty($Capacity)?$Capacity:'';?>">
					      	<?php if (!empty($CapacityError)): ?>
					      		<span class="help-inline"><?php echo $CapacityError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					<div class="control-group <?php echo !empty($pictureError)?'error':'';?>">
					
					<label class="control-label">Picture</label>
					<div class="controls">
						<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
						<input name="userfile" type="file" id="userfile">
						
					</div>
					</div>	
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="home.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>