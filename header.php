<?php		
	$user = $_GET['user'];
	session_start();
	$content = array(
		"Home" => "index.php",
		"Account" => "account.php",
		"Hero" => "hero.php",
		"News" => "news.php",
    "Sign Up" => "signup.php",
    "Log In" => "login.php");
?>
<header> 
  <em>Heroes Bar<span id="username"><?php echo $user;?></span>!</em>
</header>
<nav>
	<ul>
	<?php
		foreach ($content as $page => $location){
			echo "<li><a href='$location?user=".$user."' ".($page==$currentpage?" class='active'":"").">".$page."</a></li>";			
		}
	?>
	</ul>
</nav>
