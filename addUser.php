<?php
	require_once("classes/ApplicationClass.php");
    $Obj = new ApplicationClass();
	if(isset($_SESSION['message'])) {
		$message = $_SESSION['message'];
		unset($_SESSION['message']);
	}	
	if(isset($_POST['addUser'])) {
		$firstname  = $_POST['firstname'];
		$lastname  = $_POST['lastname'];
		$email  = $_POST['email'];
		$date  = $_POST['date'];
		$month  = $_POST['month'];
		$year  = $_POST['year'];
		$dob = $year."-".$month."-".$date;
		$fields = array("firstname", "lastname", "email", "dob");
		$values = array("$firstname", "$lastname", "$email", "$dob");
		$table = "users";
		$result = $Obj->insert($fields, $values, $table);
		if($result) {
			$_SESSION['message'] = 'User added successfully';
			header("Location: addUser.php");
		}	
		else $_SESSION['message'] = 'Error while adding';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP CRUD APPLICATION </title>
		<!--Bootstrap and jQuery (Optional)-->
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	</head>
	<body class="container">	
		<?php require_once("includes/header.php"); ?>
		<?php if(isset($message)) {
				echo '
					<div class="alert">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>'.$message.'!</strong> 
					</div>
				';
			}
		?>
		<br><p><a href="index.php">List Users</a></p><br>
		<form class="form-horizontal" method="post" action="">
			<fieldset>
				<legend>Add New User</legend>
				<div class="control-group">
					<div class="control-label">First Name</div>
					<div class="controls"><input type="text" name="firstname" placeholder="First Name" class="input-xlarge"></div>
				</div>
				<div class="control-group">
					<div class="control-label">Last Name</div>
					<div class="controls"><input type="text" name="lastname" placeholder="Last Name" class="input-xlarge"></div>
				</div>
				<div class="control-group form-inline">
					<div class="control-label">DOB</div>
					<div class="controls">
						<select name="date" class="input-small">
							<option value="0">Date</option>
							<?php echo $Obj->fillDropDownValue(1, 31); ?>
						</select>						
						<select name="month" class="input-small">
							<option value="0">Month</option>
							<?php echo $Obj->fillDropDownValue(1, 12); ?>
						</select>
						<select name="year" class="input-small">
							<option value="0">Year</option>
							<?php echo $Obj->fillDropDownValue(1970, 2013); ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">Email</div>
					<div class="controls"><input type="email" name="email" placeholder="Email Id" class="input-xlarge"></div>
				</div>
				<div class="control-group">
					<div class="control-label">&nbsp;</div>
					<div class="controls">
						<button class="btn btn-primary" type="submit" name="addUser">ADD</button>
						<button class="btn" type="reset">Clear</button>
					</div>
				</div>
			</fieldset>
		</form>
		<br><p><a href="index.php">List User</a></p><br>
		<?php require_once("includes/footer.php"); ?>
	</body>
</html>