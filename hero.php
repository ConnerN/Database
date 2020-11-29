<!DOCTYPE html>
<?php
		$currentpage="Hero";

?>
<html>
	<head>
		<title>Hero</title>
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


	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

	$query = "SELECT * FROM Hero ";
	
	$result = mysqli_query($conn, $query);
	if (!$result) { 
		die("Query to show fields from table failed");
	}

	if(mysqli_num_rows($result) > 0){
        echo "<h1>Hero</h1>";  
		echo "<table id='t01' border='1'>";
        echo "<thead>";
			echo "<tr>";
			echo "<th>Name</th>";
			echo "<th>Story</th>";
      if($state == 0){
		    echo "<th>  </th>";
		    echo "<th>  </th>";
        }
			echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
		
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['hero_name'] . "</td>";
            echo "<td>" . $row['hero_story'] . "</td>";
            if($state == 0){
	            echo "<td><a href = hero.php?edit=".$row['hero_name'].">Edit</a></td>";
	            echo "<td><a href = hero.php?delete=".$row['hero_name'].">Delete</a></td>";
            }
            echo "</tr>";
        }
        
        
        	if(isset($_GET['delete'])){
		      $delete_hero = $_GET['delete'];
		      mysqli_query($conn, "DELETE FROM Hero WHERE hero_name = '$delete_hero'");

	        }
                 
        
        
         	if (isset($_POST['update'])){
		            $id = 0;
            	 	$edit_title=0;
		            $hero_name = mysqli_real_escape_string($conn,$_POST['hero_name']);
                $hero_story = mysqli_real_escape_string($conn,$_POST['hero_story']);

		            mysqli_query($conn, "UPDATE Hero SET hero_story = '$hero_story' WHERE hero_name = '$hero_name'") or die("failed update");
          		  $hero_name = "";
	            	$hero_story = "";


	}
	        if(isset($_GET['edit'])){		
        	  	$edit_state = true;
	          	$hero_name =$_GET['edit'];
          		$id = $_GET['edit'];
          		$rec = mysqli_query($conn,"SELECT * FROM Hero WHERE hero_name = '$hero_name' ") or die("failed select");
          		$record = mysqli_fetch_array($rec);
          		$hero_name = $record['hero_name'];
          		$hero_story = $record['hero_story'];
             echo $hero_story;

	}


        
        echo "</tbody>";                            
        echo "</table>";

        mysqli_free_result($result);
    } else{
		echo "<p class='lead'><em>No records were found.</em></p>";
    } 
	mysqli_close($conn);
?>

<?php

	$msg = "Add new hero";

	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
 
 	if (isset($_POST['add'])) {


		$hero_name = mysqli_real_escape_string($conn, $_POST['hero_name']);
		$hero_story = mysqli_real_escape_string($conn, $_POST['hero_story']);
	

		$queryIn = "SELECT * FROM Hero where hero_name='$hero_name' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a Hero with hero name $hero_name<p>";
		} else {
		
		$query = "INSERT INTO Hero (hero_name, hero_story) VALUES ('$hero_name','$hero_story')";

			if(mysqli_query($conn, $query)){
				$msg =  "Hero added successfully.<p>";
			} else{
				echo "ERROR: Could not insert the hero $query. " . mysqli_error($conn);
			}
		} 
}
 
 mysqli_close($conn);

?>

 <?php if($state == 0):?>
	<form method="post" id="addHero">
	<fieldset>
		<legend>Hero Add:</legend>

		<p>
			<label for="hero_name">Hero Name:</label>
			<input type="text" class="required" name="hero_name" id="hero_name" value = "<?php echo $hero_name; ?>">
		</p>
		<p>
			<label for="hero_story">Hero Story:</label>
			<input type="text" class="required" name="hero_story" id="hero_story" value = "<?php echo $hero_story; ?>">
      
    </p> 
    
    
       <p>	
	        <?php if($edit_state == false):?>
                <input type = "submit"  name = "add" id = "add" value = "Add" />
	        <?php else:?>
                <input type = "submit" name="update" id= "update" value = "Update"/>
	        <?php endif?>
       </p>
    
	</fieldset>
   <?php endif?>


</body>

</html>
