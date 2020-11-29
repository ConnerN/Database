<!DOCTYPE html>

<?php
		$currentpage="Logout";
?>
<html>
	<head>
		<title>Logout</title>
		<link rel="stylesheet" href="style.css">
	</head>
<body>

<?php
	session_start();
   	include "header.php";


	include 'connectvars.php';

   
	$error=0;
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}

  	echo "Logout Success";
	$_SESSION['state']=2;

 
 mysqli_close($conn);

?>

    </body>
 </html>
