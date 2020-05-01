<?php
ob_start();
session_start();
if(strlen($_SESSION['admin_id'])==0)
    {   
header('location:index.php');
	}
	else
	{
	include("../include/connection.php");
	if(isset($_POST['change']))
	{
		$password=mysqli_real_escape_string($conn,$_POST['password']);
	    $cpassword=mysqli_real_escape_string($conn,$_POST['cpassword']);
		if($password!=$cpassword)
		{
			$msg="password not match";
		}
		else
		{
			$admin=$_SESSION['admin_id'];
			$npassword=mysqli_real_escape_string($conn,md5($_POST['password']));
			$query=mysqli_query($conn,"update admin set password='$npassword' where id='$admin'");
			if($query)
			{
				$msg="Password Changed";
			}
			else
			{
				$msg="Password Not Changed";
			}
		}
	}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin|Dashboard</title>
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

		?>
<div class="row" style="background:#5F9EA0; height:8em;">
<div class="col-sm-12">
<h4 class="text-center text-uppercase">Group Project Team Manager</h4>
<h5 class="text-center text-uppercase">Admin Dashboard</h5>
</div>
</div>
<!--begin of nav bar-->
<div class="row">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 		
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li ><a href="dashboard.php">Home</a></li>
		<!--view dropdown begin-->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">View <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="registered_student.php">Registered Student</a></li>
            <li><a href="student_project_indicator.php">Student Project indicator</a></li>
            <li><a href="file_upload_requirement.php">File Upload Requirement</a></li>
			<li><a href="processed_group_students.php">Processed Group Students</a></li>
          </ul>
        </li>
		<!--view drop down end-->
        <!--report dropdown begin-->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Group Swap<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="swap_group_request.php">Swap Group Project Request</a></li>
            <li><a href="swap_group_result_feedback.php">Swap Group Result Feedback</a></li>
          </ul>
        </li>
		<!--report drop down end-->
        <li><a href="assign_groups.php">Assign Group</a></li>
        <li><a href="upload_file_requirement.php">Upload File Requirement</a></li>
        <li class="active"><a href="change_password.php">Change Password</a></li>
      <li><a href="help.php">Help</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
</nav>
</div>
</div>
<!--End of nav bar-->
<div class="row" style="margin-top:10%;margin-bottom:12%;">
<div class="col-sm-6 col-sm-offset-3">
<form class="form-horizontal" role="form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="password">New Password:</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="pasword" name="password" placeholder="Enter New Password" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="password2">Confirm Password:</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="password2" name="cpassword" placeholder="Confirm Password" required>
    </div>
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-8 col-sm-10">
      <button type="submit" class="btn btn-default col-sm-8" style="background:#5F9EA0;" name="change">Change Password</button>
    </div>
  </div>
  </form>
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
