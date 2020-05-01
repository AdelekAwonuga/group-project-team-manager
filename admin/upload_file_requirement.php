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
	if(isset($_POST['add']))
	{
		$File = $_FILES['files']['name'];
		$tmp_dir = $_FILES['files']['tmp_name'];
		$fileSize = $_FILES['files']['size'];
		$upload_dir = '../uploads/'; // upload directory
	
			$fileExt = strtolower(pathinfo($File,PATHINFO_EXTENSION)); // get file extension
			$valid_extensions = array('doc','docx','pdf'); // valid extensions
			// rename uploading file
			$userfile = rand(1000,1000000).".".$fileExt;
			if(in_array($fileExt, $valid_extensions)){
			if($fileSize < 800000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userfile);
				}
				else{
					$fmsg = "Sorry, your file is too large.";
				}
                     }
			else{
				$f2msg = "Sorry, only Doc,Docx and Pdf are allowed.";	     			
			}
			if(!isset($fmsg) && !isset($f2msg))
		{
         $group_id=$_POST['group'];
		 $date=date("Y-m-d");
		 $upload_file=$userfile;
			$query=mysqli_query($conn,"INSERT INTO group_file_requirement(file_name,group_id,date_sent) VALUES('$upload_file','$group_id','$date')");
			if($query)
	{
		$msg="File uploaded";
		
	}
	else
	{
		
		$msg="File not uploaded";
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
if(isset($fmsg))
	{ echo "<div class='alert alert-primary text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$fmsg."</strong>
</div>
";}
if(isset($f2msg))
	{ echo "<div class='alert alert-primary text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$f2msg."</strong>
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
        <li class="active"><a href="upload_file_requirement.php">Upload File Requirement</a></li>
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
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label class="control-label col-sm-2" for="group">Group:</label>
    <div class="col-sm-8">
      <select  class="form-control" id="group" name="group" required>
	  <?php 
	    $query=mysqli_query($conn,"select * from groups");
		while($fetch=mysqli_fetch_array($query))
		{
		  echo "<option value=".$fetch['group_id'].">".$fetch['group_name']."</option>";
		}
	  ?>
	  </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="file">File:</label>
    <div class="col-sm-8">
      <input type="file" class="form-control" id="file" name="files" accept=".doc,.docx,.pdf" required>
    </div>
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-8 col-sm-10">
      <button type="submit" class="btn btn-default col-sm-8" style="background:#5F9EA0;" name="add">Add File</button>
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
