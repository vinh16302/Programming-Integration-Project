<?php
session_start();
include('includes/config.php');
if(isset($_POST['signin']))
{
	$email=$_POST['email'];
	$password=md5($_POST['password']);

	$sql ="SELECT * FROM register where email ='$email' AND password ='$password'";
	$query= mysqli_query($conn, $sql);
	$count = mysqli_num_rows($query);
	if($count > 0)
	{
		while ($row = mysqli_fetch_assoc($query)) {
		   $_SESSION['alogin']=$row['user_ID'];
		   echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
		}

	} 
	else{
	  
	  echo "<script>alert('Invalid Details');</script>";

	}

}

?>

<!DOCTYPE html>
<html lang="en" class="bg-dark">
<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block">NoteApp</a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong>Log in</strong>
        </header>
        <form name="signin" method="post">
          <div class="panel-body wrapper-lg">
          	<div class="form-group">
            <label class="control-label">Email</label>
            <input name="email" type="email" placeholder="youremail@gmail.com" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input name="password" type="password" id="inputPassword" placeholder="Password" class="form-control input-lg">
          </div>
          <div class="line line-dashed"></div>
          <button name="signin" type="submit" class="btn btn-primary btn-block">Login</button>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small></p>
          <a href="signup.php" class="btn btn-default btn-block">Create an account</a>
          </div>
        </form>
      </section>
    </div>
  </section>
  
</body>
</html>