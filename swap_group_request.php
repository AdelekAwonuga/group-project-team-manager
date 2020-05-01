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
	if(isset($_POST['swap']))
	{
		$swap_group=$_POST['group'];
		$student_id=$_SESSION['student_id'];
		$sql=mysqli_query($conn,"select * from processed_group_student where student_id='$student_id'");
		$row=mysqli_fetch_array($sql);
		$student_group=$row['group_id'];
		$date=date("Y-m-d");
		$query=mysqli_query($conn,"insert into swap_request(student_id,group_id,swap_group,swap_date) values('$student_id','$student_group','$swap_group','$date')");
	 if($query)
	 { 
         header("location:swap_group_request.php?msg=Swap Request Sent");
	 }
	 else
	 {
		 header("location:swap_group_request.php?msg=Swap Request Not Sent");
		 
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
if(isset($_GET['msg']))
	{ echo "<div class='alert alert-primary text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$_GET['msg']."</strong>
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
            <li class="active"><a href="swap_group_request.php">Swap Group Project Request</a></li>
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
<div class="row" style="margin-top:8%;margin-bottom:16%;">
<div class="col-sm-6 col-sm-offset-3">
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="file">Group:</label>
    <div class="col-sm-8">
      <select  class="form-control" id="file" name="group" required>
	  <?php
	  $query=mysqli_query($conn,"select * from groups");
	  while($row=mysqli_fetch_array($query))
	  {
		  $my_id=$_SESSION['student_id'];
		  $my_gid=mysqli_query($conn,"select * from processed_group_student where student_id='$my_id'");
		  $fetch_my_group=mysqli_fetch_array($my_gid);
		  
		  if($row['group_id']==$fetch_my_group['group_id'])
		  {
			  continue;
		  }
	  ?>
	  <option value="<?php echo $row['group_name'];?>"><?php echo $row['group_name'];?></option>
	  <?php } ?>
	  </select>
    </div>
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-8 col-sm-10">
      <button type="submit" class="btn btn-default col-sm-8" style="background:#5F9EA0;" name="swap">Swap Group</button>
    </div>
  </div>
  </form>
</div>
</div>
<div class="row" style="background:#5F9EA0;height:4em; padding-top:2%;">
<div class="col-sm-7 text-right">
<p>&copy;2020 All right Reserved</p>
</div>
</div>
<script src="admin/vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="admin/assets/DT_bootstrap.js"></script>
<link href="admin/assets/DT_bootstrap.css" rel="stylesheet" />
<?php mysqli_close($conn); ?>
</body>
</html>
