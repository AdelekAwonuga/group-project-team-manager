<?php
ob_start();
session_start();
if(strlen($_SESSION['admin_id'])==0)
    {   
header('location:index.php');
	}
	include("../include/connection.php");
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
            <li class="active"><a href="swap_group_result_feedback.php">Swap Group Result Feedback</a></li>
          </ul>
        </li>
		<!--report drop down end-->
        <li><a href="assign_groups.php">Assign Group</a></li>
        <li><a href="upload_file_requirement.php">Upload File Requirement</a></li>
        <li><a href="change_password.php">Change Password</a></li>
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
<div class="row" style="margin-top:6%;margin-bottom:17%;">
<div class="col-sm-6 col-sm-offset-3">
<form class="form-horizontal" role="form">
<?php 
$query=mysqli_query($conn,"select * from feedback");
while($row=mysqli_fetch_array($query))
{
?>
  <div class="form-group">
  <p>&nbsp;&nbsp;&nbsp;Sent to <?php echo $row['student_id'];?></p>
    <div class="col-sm-10">
      <textarea  class="form-control" cols="60">
	  <?php echo $row['message'];?>
	  </textarea>
	  <p class="text-right"><?php echo $row['sent_date'];?></p>
    </div>
  </div>
<?php } ?>
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
