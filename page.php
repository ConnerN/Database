<?php
	session_start();
	$_SESSION['test']="abc";
	$state = $_SESSION['state'];
 if($state != 1 && $state != 0){
  $state = 2;
  }

	$content = array(
		"Home" => "index.php",
		"Account" => "account.php",
		"Hero" => "hero.php",
		"News" => "news.php",
    "Sign Up" => "signup.php",
    "Log In" => "login.php");

?>
