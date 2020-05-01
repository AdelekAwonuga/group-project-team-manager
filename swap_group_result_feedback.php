<?php
ob_start();
session_start();
if(strlen($_SESSION['student_id'])==0)
    {   
header('location:index.php');
	}
	else
	{
	include("include/connection.php");
	if(isset($_POST['add']))
	{
	$id=$_SESSION['student_id'];
$query=mysqli_query($conn,"select * from processed_group_student where student_id='$id'");
$fetch=mysqli_fetch_array($query);
if($fetch>0)
{
	$group_id=$fetch['group_id'];
	$date=date("Y-m-d");
	$File=$_FILES["files"]["name"];
	$tmp_dir=$_FILES["files"]["tmp_name"];
	$upload_dir="uploads/";
	$fileExt = strtolower(pathinfo($File,PATHINFO_EXTENSION)); // get file extension
			// rename uploading file
			$userfile = rand(1000,1000000).".".$fileExt;
			move_uploaded_file($tmp_dir,$upload_dir.$userfile);
	$ret=mysqli_query($conn,"INSERT INTO `uploads`(`student_id`, `group_id`, `file_name`, `dates_upload`) VALUES ('$id','$group_id','$userfile','$date')");
if($ret)
{
$msg="File Added !!";
}
else
{
  $msg="Error :File Not Add";
}
}
else
{
	$msg="Error : You have not been assign to any group contact administrator";
}	
	}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Student|Dashboard</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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
<h5 class="text-center text-uppercase">Student Dashboard</h5>
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
        <li><a href="dashboard.php">Home</a></li>
		<!--view dropdown begin-->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">View <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="group_status.php">Group Status</a></li>
            <li><a href="project_members.php">Project Members</a></li>
			<li><a href="uploaded_academic_files.php">Uploaded Academic files</a></li>
          <li><a href="student_group_project_assigned.php">Student Group Project Assigned</a></li>
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
                <li><a href="Processed_Group_Students.php">Processed Group Students</a></li>
		<li><a href="comment.php">Member Comment</a></li>
        <li><a href="change_password_student.php">Change Password</a></li>
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
$id=$_SESSION['student_id'];
$query=mysqli_query($conn,"select * from feedback where student_id='$id'");
while($row=mysqli_fetch_array($query))
{
?>
  <div class="form-group">
  <p>&nbsp;&nbsp;&nbsp;Request to swap to Group <strong><?php echo $row['swap_group'];?></strong></p>
    <div class="col-sm-10">
      <textarea  class="form-control" cols="60" disabled>
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
