<?php
session_start();
include('includes/config.php');
if(isset($_POST['signup']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);

	$query = mysqli_query($conn,"select * from register where email = '$email'")or die(mysqli_error());
	$count = mysqli_num_rows($query);

	if ($count > 0){ ?>
	 <script>
	 alert('Data Already Exist');
	</script>
	<?php
      }else{
        mysqli_query($conn,"INSERT INTO register(fullName, email, password) VALUES('$name','$email','$password')         
		") or die(mysqli_error()); ?>
		<script>alert('Records Successfully  Added');</script>;
		<script>
		window.location = "index.php"; 
		</script>
		<?php   }

}

?>

<!DOCTYPE html>
<html lang="en" class="bg-dark">
	<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
	<div style="background-image:url('includes/1.png');  height:1280px">
	<section id="content" class="m-t-lg wrapper-md animated fadeInDown" style="padding:60px">
    <div style="width:500x;height:500px"  class="container aside-xxl p-5">
      <!-- <a class="navbar-brand block">NoteApp</a> -->
      <section class="panel panel-default p-5 m-t-lg bg-white">
        <header class="panel-heading text-center">
          <strong class="fs-1">Sign up</strong>
        </header>
        <form name="signup" method="POST">
          <div class="panel-body wrapper-lg">
          	 <div class="form-group mt-2">
	            <label class="control-label fw-bold">Name</label>
	            <input name="name" type="text" placeholder="Type your name" class="form-control input-lg">
	          </div>
	          <div class="form-group mt-2">
	            <label class="control-label fw-bold">Email</label>
	            <input name="email" type="email" placeholder="test@example.com" class="form-control input-lg">
	          </div>
	          <div class="form-group mt-2">
	            <label class="control-label fw-bold">Password</label>
	            <input name="password" type="password" id="inputPassword" placeholder="Type a password" class="form-control input-lg">
	          </div>
	          <div class="line line-dashed"></div>
	          <button name="signup" type="submit" class="btn btn-primary btn-block mt-2">Sign up</button>
	          <div class="line line-dashed"></div>
	          <p class="text-muted text-center"><small>Already have an account?</small></p>
	          <a style="margin-left:530px" href="index.php" class="btn btn-success btn-block">Login</a>
          </div>
        </form>
      </section>
    </div>
  </section>
	</div>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>
