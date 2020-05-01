<?php
session_start();
include("../include/connection.php");
if(isset($_POST['login']))
{
	
	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$password=mysqli_real_escape_string($conn,md5($_POST['password']));
			//admin query
			$query=mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");
			$row_admin = mysqli_fetch_array($query);
			$num_row_admin = mysqli_num_rows($query);
	//check user
	if( $num_row_admin > 0 ) { 
		$_SESSION['admin_id']=$row_admin['id'];
		$_SESSION['user']=$username;
		header('location:dashboard.php');
		}
		 else{ 
				$msg="Incorrect Username or Password";
		}
		mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<style>
body{
	background:url("../images.jpg");
	background-repeat:none;
	background-size:cover;
}
</style>
</head>
<body>
<div class="container-fluid">
<?php
						
  if(isset($msg))
	{ echo "<div class='alert alert-primary text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$msg."</strong>
</div>
";}
if(isset($_GET['cmsg']))
	{ echo "<div class='alert alert-primary text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Password Changed</strong>
</div>
";}
		?>

<div class="row" style="background:#5F9EA0; height:8em;">
<div class="col-sm-12">
<h4 class="text-center text-uppercase">Group Project Team Manager</h4>
<h5 class="text-center text-uppercase">Admin Login</h5>
</div>
</div>
<div class="row" style="margin-top:10%;margin-bottom:12%;">
<div class="col-sm-6 col-sm-offset-3">
<form class="form-horizontal col-sm-offset-2" role="form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password" required>
    </div>
  </div>
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-8 col-sm-10">
      <button type="submit" class="btn btn-default col-sm-8" style="background:#5F9EA0;" name="login">Login</button>
    </div>
  </div>
</form>
<div class="col-sm-offset-7 col-sm-10">
<p><a href="forget_password.php"><span style="color:#333;font-size:18px;">Forgotten password?</span></a></p>
</div>
</div>
</div>
<div class="row" style="background:#5F9EA0;height:4em; padding-top:2%;">
<div class="col-sm-7 text-right">
<p>&copy;2020 All Right Reserved</p>
</div>
</div>
</body>
</html>
