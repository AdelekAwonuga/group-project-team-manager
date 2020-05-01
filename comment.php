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
	$comment=mysqli_real_escape_string($conn,$_POST['comment']);
	$r_student_id=mysqli_real_escape_string($conn,$_POST['sname']);
	$s_student_id=$_SESSION['student_id'];
	$my_group=mysqli_query($conn,"select * from processed_group_student where student_id='$s_student_id'");
    $fetch_group=mysqli_fetch_array($my_group);
    $group=$fetch_group['group_id'];
	$date=date("Y-m-d");
     $query=mysqli_query($conn,"insert into member_comment(s_student_id,r_student_id,group_id,s_comment,date_of_comment) values('$s_student_id','$r_student_id','$group','$comment','$date')");
	if($query)
	{
		$msg="Sent";
	}
	else
	{
		$msg="Not Sent";
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
		<li class="active"><a href="comment.php">Member Comment</a></li>
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
<div class="row" style="margin-top:4%;margin-bottom:12%;">
<div class="col-sm-6">
<p class="text-center"><strong>SEND COMMENT</strong></p>
<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Student Name:</label>
    <div class="col-sm-8">
      <select  class="form-control" id="name" name="sname" required>
	  <?php
$id=$_SESSION['student_id'];
$my_group=mysqli_query($conn,"select * from processed_group_student where student_id='$id'");
$fetch_group=mysqli_fetch_array($my_group);
$group=$fetch_group['group_id'];
$sql=mysqli_query($conn,"select * from processed_group_student inner join student on processed_group_student.student_id=student.student_id inner join groups on processed_group_student.group_id=groups.group_id where processed_group_student.group_id='$group'");
while($row=mysqli_fetch_array($sql))
{
	if($row['student_id']==$id)
		  {
			  continue;
		  }
?>
 <option value="<?php echo $row['student_id'];?>"><?php echo $row['name'];?></option>
<?php } ?>
	  </select>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-2" for="comment">Comment:</label>
    <div class="col-sm-8">
      <textarea class="form-control" id="comment" name="comment" cols="50" required>
	  </textarea>
    </div>
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-8 col-sm-10">
      <button type="submit" class="btn btn-default col-sm-8" style="background:#5F9EA0;" name="add">Submit</button>
    </div>
  </div>
  </form>
</div>
<div class="col-sm-6">
<p class="text-center"><strong>RECEIVE COMMENT</strong></p>
<form class="form-horizontal" role="form" method="post">
<?php 
$rid=$_SESSION['student_id'];
$receive=mysqli_query($conn,"select * from member_comment where r_student_id='$rid'");
while($fetch_receive=mysqli_fetch_array($receive))
{
?>
  <div class="form-group">
    <div class="col-sm-8">
	<?php 
	$sender=$fetch_receive['s_student_id'];
	$sn=mysqli_query($conn,"select * from student where student_id='$sender'");
	$f=mysqli_fetch_array($sn);
	echo "<p class='text-left'> Sent By ".$f['name']."</p>";?>
      <textarea class="form-control" id="file" disabled>
	  <?php echo $fetch_receive['s_comment'];?>
	  </textarea>
	  <?php echo "<p class='text-right'>".$fetch_receive['date_of_comment']."</p>";?>
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
