<DOCTYPE html>
<html>
	<head>
		<title>Hero Bar</title>
		<link rel="stylesheet" href="style.css">
	</head>
<body>

<?php

	$check = "";
	session_start();
//	$_GLOBALS['state1']=2;
//	echo "state = " .$_SESSION['test'];
	$state= $_SESSION['state'];
//	if($state == $check){
//		$state =2;
//	}

  if($state == 0){
	include "header1.php";
   }
   else if($state == 1){
   	include "header1.php";
   }
   else if($state == 2){
   	include "header.php";
   }
//  echo "state = ". $state; 
 	$msg = "Welcome to Heroes Bar!";
 	$msg = "We Offer The Newest Information For You!";
?>

	<form method="post" id="Select">
 
  	<h2>Welcome to Heroes Bar!</h2>
 	  <h2>We Offer The Newest Information For You!</h2>
	
  <fieldset>
 
		<legend>Choose One:</legend>
   
        <div>
            <img class = "news_logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgoN5hHGhaPP5bYktD6xOrTUj7093cb7T7Pu-j4WMFgQOZjDao&s" alt="news" />
            <img class = "hero_logo" src="https://i.ebayimg.com/images/g/fKUAAOSw50JbSTNV/s-l300.jpg" />
        </div>
   
    <p>
      <news_button>
        <input type="button" value="News!" onclick="location='news.php'" />
      </news_button>
      
      <hero_button>
        <input type="button" value="Heroes!" onclick="location='hero.php'" />
      </hero_button>
    </p>
	</fieldset>

	</form>


	</body>
</html>
