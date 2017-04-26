<?php 
/* ---------------------------------------------------------------------------
 * filename    : rateattraction.php
 * author      : Kyle Daly
 * description : This file allows a user to Rate and comment on any of the attractions from a list of all the current attractions
 * ---------------------------------------------------------------------------
 */
session_start();
	require 'database.php';

	if ( !empty($_POST)) {
		$scoreError = null;
		
		
	
	
		// keep track post values
		$id = $_POST['id'];
		$attraction_id = $_POST['attraction_id'];
		$score = $_POST['score'];
		$comment = $_POST['comment'];

		
		// validate input
		$valid = true;
		if (empty($score)){
		$scoreError = 'Please enter a rating between 1 and 100';
		$valid = false;
		echo $scoreError;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO ratings (id,attraction_id,score,comment) VALUES(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($id,$attraction_id,$score,$comment));
			Database::disconnect();
			header("location: rateattraction.php");
		}
		else{
			echo $scoreError;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/6585CDAF-F615-8442-B34E-CBDADD8FB490/main.js" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="http://gc.kis.v2.scr.kaspersky-labs.com/094BF8DDADBC-E43B-2448-516F-FADC5856/abn/main.css"/><script src="js/bootstrap.min.js"></script>
<style type="text/css">

</style>
	</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Rate An Attraction</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="rateattraction.php" method="post">
				
					  <div class="control-group">
					    <label class="control-label">Select Your Username</label>
					    <div class="controls">
							<?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM customers';
							echo "<select class='form-control' name='id' id='id'>";
								foreach ($pdo->query($sql) as $row) {
									echo "<option value='" . $row['id'] . " '> " .'' .$row['customer_name'] . "</option>";
								}
							echo "</select>";
							Database::disconnect();
						?>
					  </div> <!-- end control group -->
					  
					  <div class="control-group">
					    <label class="control-label">Select An attraction</label>
					    <div class="controls">
							<?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM attractions';
							echo "<select class='form-control' name='attraction_id' attraction_id='attraction_id'>";
								foreach ($pdo->query($sql) as $row) {
									echo "<option value='" .$row['attraction_id'] . " '> " .'' .$row['attraction_name'] . "</option>";
								}
							echo "</select>";
							Database::disconnect();
						?>
					  </div> <!-- end control group -->
										  
						<div class="rating">
						<label class="control-label">Leave A Score (1-100)</label>
					    <div class="controls">
						<input type="text" name="score" class="textInput">
						</div>


					    <label class="control-label">Leave A Comment</label>
					    <div class="controls">
						<input type="text" name="comment" class="textInput">
						</div>
						</div>



					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Confirm</button>
						  <a class="btn" href="home.php">Back</a>
						</div>
						

					</form>
				</div>
				
    </div> <!-- /container -->

	
  </body>
</html>