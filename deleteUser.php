<?php
	require_once("classes/ApplicationClass.php");
    $Obj = new ApplicationClass();
	$id = mysql_real_escape_string($_GET['id']);
	$result = $Obj->delete("users", "userid='$id'");
	if($result) {
			$_SESSION['message'] = 'User deleted successfully';
			header("Location: index.php");
		}	
		else $_SESSION['message'] = 'Error while adding';
?>