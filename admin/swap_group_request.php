<?php
ob_start();
session_start();
if(strlen($_SESSION['admin_id'])==0)
    {   
header('location:index.php');
	}
	include("../include/connection.php");
	if(isset($_GET['std']))
	{
		$std=$_GET['std'];
		$gid=$_GET['g'];
		$swap_group=$_GET['swap'];
		$group_id_query=mysqli_query($conn,"select * from groups where group_name='$swap_group'");
		$fetch_id=mysqli_fetch_array($group_id_query);
		$swap_group_id=$fetch_id['group_id'];
		$feedback="Congratulation Your Request has been proccessed to swap to group ".$swap_group ;
		$date=date("Y-m-d");
       $update_group=mysqli_query($conn,"update processed_group_student set group_id='$swap_group_id' where student_id='$std'");
	   if($update_group)
	   {
		   $delete_request=mysqli_query($conn,"delete from swap_request where student_id='$std' and group_id='$gid' and swap_group='$swap_group'");
		   $insert_feedback=mysqli_query($conn,"insert into feedback(student_id,group_id,swap_group,message,sent_date,action) values('$std','$gid','$swap_group','$feedback','$date','1')");
		   $delete_comment=mysqli_query($conn,"delete from member_comment where s_student_id='$std' and group_id='$gid'");
	   $delete_comment2=mysqli_query($conn,"delete from member_comment where r_student_id='$std' and group_id='$gid'");
	   $delete_uploads=mysqli_query($conn,"delete from uploads where student_id='$std' and group_id='$gid'");
	   if($delete_request&&$insert_feedback&&$delete_comment&&$delete_comment2&&$delete_uploads)
	   {
		   header("location:swap_group_request.php?msg=Student Processed Successfully");
	   }
	   else
	   {
		   header("location:swap_group_request.php?msg=Student Previous Group Data Not Deleted ");
	   }
	   }
	   else
	   {
		   header("location:swap_group_request.php?msg=Not procsess");
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
        <li><a href="dashboard.php">Home</a></li>
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
            <li class="active"><a href="swap_group_request.php">Swap Group Project Request</a></li>
            <li><a href="swap_group_result_feedback.php">Swap Group Result Feedback</a></li>
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
<div class="row" style="margin-top:6%;margin-bottom:12%;">
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
                                            <th>Student Id</th>
											<th>Student Name </th>
											<th>Student Group Project</th>
											<th>Swap Project Request</th>
											<th>swap Group Project Feedback</th>
											<th>Processed Group Student</th>
											<th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($conn,"select * from swap_request inner join student on swap_request.student_id=student.student_id inner join groups on swap_request.group_id=groups.group_id
");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
										    <td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['student_id']);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo htmlentities($row['group_name']);?></td>
											<td><?php echo htmlentities($row['swap_group']);?></td>
                                           <td> <a href="feedback.php?std=<?php echo $row['student_id'];?>&swap=<?php echo $row['swap_group'];?>&g=<?php echo $row['group_id'];?>">
<button class="btn btn-primary"><i class="fa fa-envelope "></i> Send Feedback</button> </a></td>
                                        <td> <a href="swap_group_request.php?std=<?php echo $row['student_id'];?>&swap=<?php echo $row['swap_group'];?>&g=<?php echo $row['group_id'];?>">
<button class="btn btn-primary"><i class="fa fa-envelope "></i> Process Student</button> </a></td>
                                       
                              <td><?php echo htmlentities($row['swap_date']);?></td>
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
<script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/DT_bootstrap.js"></script>
<link href="assets/DT_bootstrap.css" rel="stylesheet" />
</body>
</html>
