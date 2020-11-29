<!DOCTYPE html>

<?php
		$currentpage="Login";
?>
<html>
	<head>
		<title>Login</title>
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

	include 'connectvars.php';

   
	$error=0;
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
 
 	if (isset($_POST['login'])){


		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);
	
    if(empty($username)){
      $error=1;echo"username is required.";
    }
    if(empty($userpassword)){
      $error=1;echo"password is required.";
    }
    if($error!=1){
		$resultIn = mysqli_query($conn, "SELECT * FROM User WHERE username = '$username'");
		$row = mysqli_fetch_array($resultIn);
		if($row['username']== $username && $row['userpassword']==$userpassword){
			echo "login success";

  			$_SESSION['state'] = 1;
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $userpassword;

		} 
    else {
			echo "failed";
		} 
  }
}

 	if (isset($_POST['manager'])){


		$managername = mysqli_real_escape_string($conn, $_POST['username']);
		$managerpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);
	
		if(empty($managername)){
      			$error=1;echo"Name is required.";
    		}
    		if(empty($managerpassword)){
      			$error=1;echo"Password is required.";
    		}
    		if($error!=1){
			$resultIn = mysqli_query($conn, "SELECT * FROM Manager WHERE managername = '$managername'");
			$row = mysqli_fetch_array($resultIn);
			if($row['managername']== $managername && $row['managerpassword']==$managerpassword){
				echo "login success";
      				$_SESSION['state'] = 0;
			} 
    			else {
				echo "failed";

				}   
	  	}
	}
 
 mysqli_close($conn);

?>

	<form method="post" id="loginUser"  >
	<fieldset>
		<legend>Login:</legend>

		<p>
			<label for="username">User Name:</label>
			<input type="text" class="required" name="username" id="username">
		</p>
		<p>
			<label for="userpassword">Password:</label>
			<input type="password" class="required" name="userpassword" id="userpassword">
		   </p>
   
		   <p>
		<input type = "submit" name = "login" id = "login" value = "User login" />
		   </p>
		   <p>
		<input type = "submit" name = "manager" id = "manager" value = "Administrator login" />
		   </p>

	</fieldset>


 
	</form>
 </html>
