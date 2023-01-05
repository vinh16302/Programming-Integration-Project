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
  <h1 class="text-center">Note app</h1>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</header>

<body>
  <div class="container">
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
 
  <div style="margin-left:550px; margin-bottom:20px">
  <h2>Add Note</h2>
  <form method="POST">
    <div class="form-group">
      <label class="fw-bold">Title</label>
      <input name="title" type="text" placeholder="Title">
    </div>

    <div class="form-group">
      <label class="fw-bold">Note</label>
      <textarea name="note" rows="8" data-minwords="8" data-required="true" placeholder="Take a Note ......"></textarea>
    </div>

    <div style="margin-left:100px" class="m-t-lg">
      <button class="btn btn-warning btn-default" name="submit" type="submit">Save</button>
    </div>
  </form>
  </div>
  
    <div>

    </div>
  <h2 style = "text-transform:uppercase;text-align:center"><b>Note Details</b></h2>

  
  <?php foreach($notesArray as $note)
  { ?>
  <div class="card">
    <div class="card-header">
    <h3 style = "text-transform:uppercase;"><b> <?php echo $note['title'] ?></b></h3>
    </div>
    <div class="card-body">
    <p><?php echo substr($note['note'], 0, 200)?></p>
    <small> <?php echo $note['time_in']; echo "</br>"; ?></small>
    </div>
    <div class="card-footer">
    <a href="edit_note.php?edit=<?php echo $note['note_id'];?>"><button type="button" class="btn btn-primary"  title="Show">Edit<i></i></button></a>
  <a href="notebook.php?delete=<?php echo $note['note_id'];?>"><button type="button" class="btn btn-danger" title="Remove"><i>Delete</i></button></a>
    </div>
  </div>
    
    

  
   
  <?php 
  } ?>
  </div>
 

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>
