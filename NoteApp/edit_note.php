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
  <h1  class="text-center">Note app</h1>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
</header>

<body>
  <div  class="text-center">
  <?php 
    $query= mysqli_query($conn,"select * from register where user_ID = '$session_id'")or die(mysqli_error());
    $row = mysqli_fetch_array($query);
  ?>
  <?php 
    echo'Hello '; 
    echo $row['fullName']; 
    echo "</br>";  
  ?>
  <a class="btn btn-warning" href="logout.php">Logout</a>

  <h2>Edit Note</h2>

  <form method="POST">
    <?php
	  $query = mysqli_query($conn,"select * from notes where note_id = '$get_id' ")or die(mysqli_error());
		$row = mysqli_fetch_array($query);
		?>

    <div class="form-group">
      <label class="fw-bold">Title</label>
      <input name="title" type="text" placeholder="Title"value="<?php echo $row['title']; ?>">
    </div>

    <div class="form-group">
      <label class="fw-bold">Note</label>
      <textarea name="note" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......"><?php echo $row['note']; ?></textarea>
    </div>

    <div class="m-t-lg"><button class="btn btn-primary btn-default" name="update" type="submit">Update Note</button></div>
    </form>
  </div>
  

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>
