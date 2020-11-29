<!DOCTYPE html>

<html>
	<head>
		<title>Account</title>
		<link rel="stylesheet" href="style.css">
	</head>
<body>

<?php

	session_start();

	$state = $_SESSION['state'];

  if($state == 0){
	include "header1.php";
   }
   else if($state == 1){
   	include "header1.php";
   }
   else if($state == 2){
   	include "header.php";
   }


	$msg = "Account";

	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
 
 	if(isset($_POST['change_pwd'])) {


		$username = $_SESSION['username'];
		$userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);	

		mysqli_query($conn, "UPDATE User SET password = '$userpassword' WHERE username = '$username'");
		$_SESSION['username']="";}
 
 mysqli_close($conn);

?>

	<form method="post" id="loginUser">
	<fieldset>
		<legend>Operation:</legend>
   
		<p>
			<label for="userpassword">New Password:</label>
			<input type="text" class="required" name="userpassword" id="userpassword">
      
    </p> 
   
   <p>
		<input type = "submit" id = "change_pwd" name = "change_pwd"  value = "Change Password" />
   </p>

	</fieldset>


 
	</form>
