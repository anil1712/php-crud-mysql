<?php
	require_once("classes/ApplicationClass.php");
    $Obj = new ApplicationClass();
	$users = $Obj->fetchAll("users");
	$num = count($users);
	if(isset($_SESSION['message'])) {
		$message = $_SESSION['message'];
		unset($_SESSION['message']);
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
		<br><p><a href="addUser.php">Add New User</a></p><br>
		<?php 
			if($num<=0) echo '<h3>No User Added</h3><br>';
			else {	
		?>
			<table class="table table-bordered">
				<tr>
					<th>ID</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>DOB</th>
					<th>Email</th>
					<th colspan="2">Action</th>
				</tr>
				<?php 
					foreach($users as $user) {	 
				?>
				<tr>
					<td><?php echo $user['userid']; ?></td>
					<td><?php echo $user['firstname']; ?></td>
					<td><?php echo $user['lastname']; ?></td>
					<td><?php echo $user['dob']; ?></td>
					<td><?php echo $user['email']; ?></td>
					<td><a href="editUser.php?id=<?php echo $user['userid']; ?>" title="Edit User"><i class="icon-pencil"></i></a></td>
					<td><a href="deleteUser.php?id=<?php echo $user['userid']; ?>" title="Delete User"><i class="icon-trash"></i></a></td>
				</tr>
		<?php 
			}
		?>
			<table>
		<?php	
		} ?>
		<br><p><a href="addUser.php">Add New User</a></p><br>
		<?php require_once("includes/footer.php"); ?>
	</body>
</html>