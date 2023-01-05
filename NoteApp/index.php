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

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
  <div style="background-image:url('includes/1.png');  height:1000px">
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp p-5" style="padding:60px">    
    <div style="width:500x;height:500px" class="container aside-xxl p-5">
      <!-- <a class="navbar-brand block">NoteApp</a> -->
      <section class="panel panel-default p-5 bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong class="fs-1">Log in</strong>
        </header>
        <form name="signin" method="post">
          <div class="panel-body wrapper-lg">
          	<div class="form-group mt-2">
            <label class="control-label fw-bold">Email</label>
            <input name="email" type="email" placeholder="youremail@gmail.com" class="form-control input-lg">
          </div>
          <div class="form-group mt-2">
            <label class="control-label fw-bold">Password</label>
            <input name="password" type="password" id="inputPassword" placeholder="Password" class="form-control input-lg">
          </div>
          <div class="line line-dashed"></div>
          <button name="signin" type="submit" class="btn btn-primary btn-block mt-2">Login</button>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small></p>
          <a style="margin-left:490px" href="signup.php" class="btn btn-success btn-block">Create an account</a>
          </div>
        </form>
      </section>
    </div>
    </div>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>
