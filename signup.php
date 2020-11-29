<!DOCTYPE html>

<?php
		$currentpage="signup";
?>
<html>
	<head>
		<title>Sign In</title>
		<link rel="stylesheet" href="style.css">
	</head>
<body>

<?php
	session_start();
	include "header.php";
	$msg = "Add new user";

	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
 
 	if ($_SERVER["REQUEST_METHOD"] == "POST") {


		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$userpassword = mysqli_real_escape_string($conn, $_POST['userpassword']);
	

		$queryIn = "SELECT * FROM User where username='$username' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a User with username $username<p>";
		} 
    else {
		
		$query = "INSERT INTO User (username, userpassword) VALUES ('$username', '$userpassword')";

			if(mysqli_query($conn, $query)){
				$msg =  "User added successfully.<p>";
			} else{
				echo "ERROR: Could not insert the user $query. " . mysqli_error($conn);
			}
		} 
}
 
 mysqli_close($conn);

?>

	<form method="post" id="addUser">
	<fieldset>
		<legend>User Info:</legend>

		<p>
			<label for="Username">User Name:</label>
			<input type="text" class="required" name="username" id="username">
		</p>
		<p>
			<label for="Userpassword">Password:</label>
			<input type="password" class="required" name="userpassword" id="userpassword">
      
    </p> 
    
    
    <p>
		<input type = "submit"  value = "Sign Up" />
    </p>
    
	</fieldset>


	</form>
</body>
