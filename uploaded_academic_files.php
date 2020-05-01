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
            <li><a href="file_upload_requirement.php">Member Comment</a></li>
			<li class="active"><a href="uploaded_academic_files.php">Uploaded Academic files</a></li>
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
<div class="row" style="margin-top:2%;margin-bottom:12%;">
<p class="text-center text-uppercase"><strong>All Uploaded Files</strong></p>
 <!--    Bordered Table  -->
                <div class="col-md-10 col-sm-offset-1">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table" id="example" cellpadding="0" cellspacing="0" border="0">
                                    <thead>
                                        <tr>
										<th>#</th>
                                            <th>Student ID</th>
											<th>Student Name </th>
											<th>File Name</th>
											<th>Date</th>
											<th>Download</th>
											 </tr>
                                    </thead>
                                    <tbody>
<?php
$id=$_SESSION['student_id'];
$my_group=mysqli_query($conn,"select * from processed_group_student where student_id='$id'");
$fetch_group=mysqli_fetch_array($my_group);
$group=$fetch_group['group_id'];
$sql=mysqli_query($conn,"select * from uploads inner join student on uploads.student_id=student.student_id inner join groups on uploads.group_id=groups.group_id
where uploads.group_id='$group' order by uploads_id desc");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
										    <td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['student_id']);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
                                         <td><?php echo htmlentities($row['file_name']);?></td>
										 <td><?php echo htmlentities($row['dates_upload']);?></td>
										 <td> <a href="uploads/<?php echo $row['file_name']; ?>">
<button class="btn btn-primary"><i class="fa fa-envelope "></i> Download</button> </a>                                        

                                            </td>
                                        </tr>
<?php 
$cnt++;
}  ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    

</div>
                     <!--  End  Bordered Table  -->
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
