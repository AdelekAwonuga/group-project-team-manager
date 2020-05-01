<?php
session_start();
include("../include/connection.php");
if(isset($_POST['verify']))
{
	//student query
	$email=mysqli_escape_string($conn,$_POST['email']);
	$query =mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");
			$row = mysqli_fetch_array($query);
			$num_row = mysqli_num_rows($query);
	//check user
			if( $num_row > 0 ) { 
		$_SESSION['recovered_id']=$row['id'];
		header('location:change_passwords.php');
		}
		 else{ 
				$msg="incorrect email";
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Forgot password</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

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
	if(isset($_GET['msg']))
	{ echo "<div class='alert alert-primary text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Incorrect Credential</strong>
</div>
";}
	?>

<div class="row" style="background:#5F9EA0; height:8em;">
<div class="col-sm-12">
<h4 class="text-center text-uppercase">Group Project Team Manager</h4>
<h5 class="text-center text-uppercase">Admin Password Recovery</h5>
</div>
</div>
<div class="row" style="margin-top:10%;margin-bottom:15%;">
<div class="col-sm-8">
<form class="form-horizontal col-sm-offset-4" role="form" method="post">
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10"> 
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
    </div>
  </div>
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-12 col-sm-10">
      <button type="submit" class="btn btn-default" style="background:#5F9EA0;" name="verify">Verify</button>
    </div>
  </div>
</form>
<div class="col-sm-offset-8 col-sm-10">
<p><a href="index.php"><span style="color:#333;font-size:18px;">Back</span></a></p>
</div>
</div>
</div>
<div class="row" style="background:#5F9EA0;height:4em; padding-top:2%;">
<div class="col-sm-7 text-right">
<p>&copy;2020 All right Reserved</p>
</div>
</div>
</body>
</html>
