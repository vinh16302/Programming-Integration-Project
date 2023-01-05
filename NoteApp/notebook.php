<?php include('includes/session.php')?>
<?php include('includes/config.php')?>

<?php
if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $sql = "DELETE FROM notes where note_id = ".$delete;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('Note removed Successfully');</script>";
      echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
  }
}

 if(isset($_POST['submit'])){
        
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $note=mysqli_real_escape_string($conn,$_POST['note']);

        date_default_timezone_set("Africa/Accra");
        $time_now = date("h:i:sa");

        // make sql query
        $query = "INSERT INTO notes(user_id,title,note,time_in) 
        VALUES('$session_id','$title','$note','$time_now')";

        if(mysqli_query($conn, $query))
        {
          echo "<script>alert('Note Added Successfully');</script>";
        }
        
        else
        {
            //failure
            echo 'query error: '. mysqli_error($conn);
        }
    }

    $query = "SELECT note_id,title,note,time_in FROM notes WHERE user_id = \"$session_id\" ";

    if(mysqli_query($conn, $query)){

        // get the query result
        $result = mysqli_query($conn, $query);

        // fetch result in array format
        $notesArray= mysqli_fetch_all($result , MYSQLI_ASSOC);

        // print_r($notesArray);

    }
    
    else
    {
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

  <h2>Add Note</h2>
  <form method="POST">
    <div class="form-group">
      <label>Title</label>
      <input name="title" type="text" placeholder="Title">
    </div>

    <div class="form-group">
      <label>Note</label>
      <textarea name="note" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......"></textarea>
    </div>

    <div class="m-t-lg">
      <button class="btn btn-sm btn-default" name="submit" type="submit">Save</button>
    </div>
  </form>

  <h2 style = "text-transform:uppercase;"><b>Note Details</b></h2>

  
  <?php foreach($notesArray as $note)
  { ?>
    <h3 style = "text-transform:uppercase;"><b> <?php echo $note['title'] ?></b></h3>
    <p><?php echo substr($note['note'], 0, 200)?></p>
    <small> <?php echo $note['time_in']; echo "</br>"; ?></small>

  <a href="edit_note.php?edit=<?php echo $note['note_id'];?>"><button type="button"  title="Show">Edit<i></i></button></a>
  <a href="notebook.php?delete=<?php echo $note['note_id'];?>"><button type="button" title="Remove"><i>Delete</i></button></a>
   
  <?php 
  } ?>


</body>
</html>