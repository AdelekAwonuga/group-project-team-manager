<?php
ob_start();
session_start();
if(strlen($_SESSION['recovered_id'])==0)
    {   
header('location:forget_password.php?msg=login');
	}
	include("../include/connection.php");
if(isset($_POST['change']))
{
	//admin query
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$cpassword=mysqli_real_escape_string($conn,$_POST['cpassword']);
	$admin_id=$_SESSION['recovered_id'];
	if($password==$cpassword)
	{
		$md5p=mysqli_real_escape_string($conn,md5($_POST['password']));
		$query =mysqli_query($conn,"UPDATE admin SET password='$md5p' WHERE id='$admin_id'");
			if($query)
		 {
                   session_unset();
				   header("location:index.php?cmsg=1");
				   
		 }
		 else{
			 $msg="Password not Changed";
		 }
	}
	else{
		$msg="Password Not Match";
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Change password</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
<?php
						
  if(isset($msg))
	{ echo "<div class='alert alert-primary text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$msg."</strong>
</div>
";}
		?>

<div class="row" style="background:#5F9EA0; height:8em;">
<div class="col-sm-12">
<h4 class="text-center text-uppercase">Group Project Team Manager</h4>
<h5 class="text-center text-uppercase">Admin Password Recovery</h5>
</div>
</div>
<div class="row" style="margin-top:10%;margin-bottom:10%;">
<div class="col-sm-8">
<?php
$admin_ids=$_SESSION['recovered_id'];
$query2 =mysqli_query($conn,"SELECT * FROM admin WHERE id='$admin_ids'");
			$row2 = mysqli_fetch_array($query2);
		echo "<p class='text-center text-danger'>Your Username is ".$row2['username']."</p>";
?>
<form class="form-horizontal col-sm-offset-4" role="form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">New Password:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="username" name="password" placeholder="Enter New Password" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="cpassword" id="pwd" placeholder="Confirm password" required>
    </div>
  </div>
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-12 col-sm-10">
      <button type="submit" class="btn btn-default" name="change">Verify</button>
    </div>
  </div>
</form>
<div class="col-sm-offset-8 col-sm-10">
<p><a href="index.php">Back</a></p>
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
