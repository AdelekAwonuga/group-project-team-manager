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
	if(isset($_POST['creates']))
	{
		$group=$_POST['group'];
		$numbers=mysqli_real_escape_string($conn,$_POST['numbers']);
		$query=mysqli_query($conn,"select * from groups where group_name='$group'");
		$fetch=mysqli_fetch_array($query);
		if($fetch>0)
		{
			$msg="Group Already Exist";
		}
		else
		{
			$query_insert_group=mysqli_query($conn,"insert into groups(group_name) values('$group')");
			$group_insert_id=mysqli_insert_id($conn);
			$num_loop=1;
			$query_select_student=mysqli_query($conn,"select * from student where grouped='0' order by rand() limit $numbers");
			while($fetch_student=mysqli_fetch_array($query_select_student))
			{
				$student_id=$fetch_student['student_id'];
				$date=date("Y-m-d");
				$query_insert_student=mysqli_query($conn,"insert into processed_group_student(student_id,group_id,date) values('$student_id','$group_insert_id','$date')");
			   if($query_insert_student)
				{
					$update_student_grouped=mysqli_query($conn,"update student set grouped='1' where student_id='$student_id'");
					$update_group=mysqli_query($conn,"update groups set no_in_group='$num_loop' where group_id='$group_insert_id'");
					$msg="Group Created and Student has been generated";
				}
				else
				{
					$query_delete_group=mysqli_query($conn,"delete from group where group_id='$group_insert_id'");
					$msg="Group not Created";
				}
				$num_loop++;
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
        <li class="active"><a href="assign_groups.php">Assign Group</a></li>
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
<div class="row" style="margin-top:10%;margin-bottom:12%;">
<div class="col-sm-6 col-sm-offset-3">
<form class="form-horizontal" role="form" method="post">
<div class="form-group">
    <label class="control-label col-sm-2" for="group">Group:</label>
    <div class="col-sm-8">
      <select  class="form-control" id="group" name="group" required>
	  <?php 
	  foreach(range('A','Z') as $alphabet)
	  {
		  echo "<option value=".$alphabet.">".$alphabet."</option>";
	  }
	  ?>
	  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="numbers">No of Student:</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="numbers" name="numbers" placeholder="Enter No of Student" required>
    </div>
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-8 col-sm-10">
      <button type="submit" class="btn btn-default col-sm-8" style="background:#5F9EA0;" name="creates">Create Group</button>
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
<?php mysqli_close($conn); ?>
</body>
</html>
