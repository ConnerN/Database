<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="style.css">
	</head>
<?php
	session_start();
//  $state = $_GLOBALS['state1'];
//  echo "state = " . $state;
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
//	echo"globals state= " . $_GLOBALS['state'];
      $_SESSION['state'] = 0;
//	echo"session state= " . $_SESSION['state'];

       header('Location: http://web.engr.oregonstate.edu/~wuxiaoy/cs340/end/index.php')or die("failed to head");
		} 
    else {
			echo "failed";
		} }
}


 
 mysqli_close($conn);

?>