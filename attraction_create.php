<?php 
/* ---------------------------------------------------------------------------
 * filename    : attraction_create.php
 * author      : Kyle Daly
 * description : This file allows a user to create new attractions and set its information including a picture
 * ---------------------------------------------------------------------------
 */
session_start();
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$NameError = null;
		$TypeError = null;
		$CapacityError = null;
		$pictureError = null;
		
		// keep track post values
		$Name = $_POST['attraction_name'];
		$Type = $_POST['attraction_type'];
		$Capacity = $_POST['attraction_capacity'];
		$picture = $_POST['attraction_picture'];
		
		$filename = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$filesize = $_FILES['userfile']['size'];
		$filetype = $_FILES['userfile']['type'];
		$content = file_get_contents($tmpName);
		
		// validate input
		$valid = true;
		if (empty($Name)) {
			$NameError = 'Please enter name';
			$valid = false;
		}
		
		if (empty($Type)) {
			$TypeError = 'Please enter Type';
			$valid = false;
		} 
		
		if (empty($Capacity)) {
			$CapacityError = 'Please enter capacity';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO attractions (attraction_name,attraction_type,attraction_capacity,filename,filesize,filetype,filecontent) VALUES(?, ?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($Name,$Type,$Capacity,$filename,$filesize,$filetype,$content));
			Database::disconnect();
			header("location: home.php");
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
		    			<h3>Create an Attraction </h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="attraction_create.php" method="post" enctype="multipart/form-data">
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
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="home.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>