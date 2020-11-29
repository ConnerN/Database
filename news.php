

<?php
		$currentpage="News";
?>
<html>
	<head>
		<title>News</title>
		<link rel="stylesheet" href="style.css">
	</head>
<body>



<?php
	
	session_start();
	$state = $_SESSION['state'];

	$check = "";

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
  $edit_state=false;  
 	$title = "";
	$author = "";
	$date = "";
	$content = "";
  
 	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

	$query = "SELECT * FROM News ";
 
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
 
	if(mysqli_num_rows($result) > 0){
       echo "<h1>News</h1>";  
		   echo "<table id='t01' border='1'>";
       echo "<thead>";
			 echo "<tr>";
			 echo "<th>Title</th>";
			 echo "<th>Author</th>";
			 echo "<th>Date</th>";
			 echo "<th>Content</th>";
     if($state == 0){
			 echo "<th>  </th>";
			 echo "<th>  </th>";
        }
			 echo "</tr>";
       echo "</thead>";
       echo "<tbody>";
		
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['title']."</td>";
   			    echo "<td>" . $row['author'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['content'] . "</td>";
            if($state == 0){
	          echo "<td><a href = news.php?edit=".$row['title'].">Edit</a></td>";
	          echo "<td><a href = news.php?delete=".$row['title'].">Delete</a></td>";
                     }
            echo "</tr>";
        }
        
        	if(isset($_GET['delete'])){
		      $delete_title = $_GET['delete'];
		      mysqli_query($conn, "DELETE FROM News WHERE title = '$delete_title'");
	        }
        
        
        	if (isset($_POST['update'])){
		            $id = 0;
            	 	$edit_title=0;
		            $title = mysqli_real_escape_string($conn,$_POST['title']);
                $author = mysqli_real_escape_string($conn,$_POST['author']);
                $date = mysqli_real_escape_string($conn,$_POST['date']);
                $content = mysqli_real_escape_string($conn,$_POST['content']);  
		            mysqli_query($conn, "UPDATE News SET author = '$author', date = '$date', content = '$content' WHERE title = '$title'") or die("failed update");
          		  $title = "";
	            	$author = "";
            		$date = "";
		            $content ="";

	}
	        if(isset($_GET['edit'])){		
        	  	$edit_state = true;
	          	$title =$_GET['edit'];
          		$id = $_GET['edit'];
          		$rec = mysqli_query($conn,"SELECT * FROM News WHERE title = '$title' ") or die("failed select");
          		$record = mysqli_fetch_array($rec);
          		$title = $record['title'];
          		$author = $record['author'];
        	  	$date = $record['date'];
        	  	$content = $record['content'];

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

	include 'connectvars.php'; 
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
 
 		if (isset($_POST['add'])) {


		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$content = mysqli_real_escape_string($conn, $_POST['content']);

		$queryIn = "SELECT * FROM News where title='$title' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a News with title $title<p>";
		} else {
		
			$query = "INSERT INTO News (title, author, date, content) VALUES ('$title', '$author', '$date', '$content')";
			if(mysqli_query($conn, $query)){
				$msg =  "News added successfully.<p>";
			} else{
				echo "ERROR: Could not insert the news $query. " . mysqli_error($conn);
			}
		} 
}
 
 mysqli_close($conn);

?>


  
  <?php if($state == 0):?>
	<form method="post" id="addNews" >
   
	<fieldset>
    <input type ="hidden" name="id" value"<?php echo $id?>"> 
		<legend>Add News:</legend>

		<p>
			<label for="title">News title:</label>
			<input type="text" class="required" name="title" id="title" value = "<?php echo $title; ?>">
		</p>
   
		<p>
			<label for="author">Author:</label>
			<input type="text" class="required" name="author" id="author" value = "<?php echo $author; ?>">
    </p> 
    
    <p>
			<label for="data">Date:</label>
			<input type="text" class="required" name="date" id="date" value = "<?php echo $date; ?>">
    </p> 
    
    <p>
			<label for="content">Content:</label>
			<input type="text" class="required" name="content" id="content" value = "<?php echo $content; ?>">
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
  
  
  <?php
  
 	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}	

	$query = "SELECT * FROM Comment ";
 
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
 
	if(mysqli_num_rows($result) > 0){
       echo "<h2>Comment</h2>";  
		   echo "<table id='t01' border='1'>";
       echo "<thead>";
			 echo "<tr>";
			 echo "<th>Comment</th>";
			 echo "<th>Nickname</th>";
     if($state == 0){
			 echo "<th>  </th>";
        }
			 echo "</tr>";
       echo "</thead>";
       echo "<tbody>";
		
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['commnet']."</td>";
   			    echo "<td>" . $row['nickname'] . "</td>";

            if($state == 0){
	          echo "<td><a href = news.php?delete=".$row['title'].">Delete</a></td>";
                     }
            echo "</tr>";
        }
        
        	if(isset($_GET['delete'])){
		      $delete_comment = $_GET['delete'];
		      mysqli_query($conn, "DELETE FROM Comment WHERE nickname = '$nickname'");
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

	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
 
 	if (isset($_POST['addcom'])) {


		$nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
		$comment = mysqli_real_escape_string($conn, $_POST['comment']);


		$queryIn = "SELECT * FROM Comment where nickname='$nickname' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a News with title $title<p>";
		} else {
		
		$query = "INSERT INTO Comment (nickname, commnet) VALUES ('$nickname', '$comment')";

			if(mysqli_query($conn, $query)){
				$msg =  "Comment added successfully.<p>";
			} else{
				echo "ERROR: Could not insert the comment $query. " . mysqli_error($conn);
			}
		} 
}
 
 mysqli_close($conn);

?>

  <?php if($state == 1):?>
	<form method="post" id="addComment">
   
	<fieldset>
		<legend>Add Comment:</legend>

		<p>
			<label for="Comment"> Comment:</label>
			<input type="text" class="required" name="comment" id="comment">
		</p>
   
		<p>
			<label for="Nickname">Nickname:</label>
			<input type="text" class="required" name="nickname" id="nickname">
    </p> 
        
    <p>
		<input type = "submit" id= addcom name = addcom value = "Add" />
    </p>
    
	</fieldset>
  <?php endif?>


</body>
</html>
