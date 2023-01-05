<?php include('includes/session.php')?>
<?php include('includes/config.php')?>
<?php $get_id = $_GET['edit']; ?>
<?php

 //********************Updation********************
    if(isset($_POST['update'])){

        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);

        // make sql query
        $query = "UPDATE notes SET title=\"$title\",note=\"$note\",last_updated_at=CURRENT_TIMESTAMP WHERE note_id = \"$get_id\" ";

        if(mysqli_query($conn, $query)){
        	echo "<script>alert('Note Updated Successfully');</script>";
      		echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
        }else{
            //failure
            echo 'query error: '. mysqli_error($conn);
        }

    }

    //********************Selection********************
     $query = "SELECT note_id,title,note,time_in FROM notes WHERE note_id = \"$get_id\" ";

    if(mysqli_query($conn, $query)){

        // get the query result
        $result = mysqli_query($conn, $query);

        // fetch result in array format
        $notesArray= mysqli_fetch_all($result , MYSQLI_ASSOC);

        // print_r($notesArray);

    }else{
        //failure
        echo 'query error: '. mysqli_error($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<header>
  <h1>Note app</h1>
</header>

<body>
  <?php 
    $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
    $row = mysqli_fetch_array($query);
  ?>
  <?php 
    echo'Hello '; 
    echo $row['fullName']; 
    echo "</br>";  
  ?>
  <a href="logout.php">Logout</a>

  <h2>Edit Note</h2>

  <form method="POST">
    <?php
	  $query = mysqli_query($conn,"select * from notes where note_id = '$get_id' ")or die(mysqli_error());
		$row = mysqli_fetch_array($query);
		?>

    <div class="form-group">
      <label>Title</label>
      <input name="title" type="text" placeholder="Title"value="<?php echo $row['title']; ?>">
    </div>

    <div class="form-group">
      <label>Note</label>
      <textarea name="note" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......"><?php echo $row['note']; ?></textarea>
    </div>

    <div class="m-t-lg"><button class="btn btn-sm btn-default" name="update" type="submit">Update Note</button></div>
    </form>


</body>
</html>