<?php
session_start();
include("include/connection.php");
if(isset($_POST['add']))
	{
		$sname=mysqli_real_escape_string($conn,$_POST['sname']);
	   $student_id=mysqli_real_escape_string($conn,$_POST['student_id']);
	   $email=mysqli_real_escape_string($conn,$_POST['email']);
	   $password=mysqli_real_escape_string($conn,md5($_POST['password']));
	   //check whether student id already added  by admin
	   $query =mysqli_query($conn,"SELECT * FROM student WHERE student_id='$student_id'");
			$row = mysqli_fetch_array($query);
			$num_row = mysqli_num_rows($query);
			//check whether student email already registered
		$query2 =mysqli_query($conn,"SELECT * FROM student WHERE  email='$email'");
			$row2 = mysqli_fetch_array($query2);
			$num_row2 = mysqli_num_rows($query2);
			//check whether student  already registered
		$query3 =mysqli_query($conn,"SELECT * FROM student WHERE  student_id='$student_id' AND status='1'");
			$row3 = mysqli_fetch_array($query3);
			$num_row3 = mysqli_num_rows($query3);
			if($num_row>0)
			{
					if( $num_row2 > 0 ) { 
		$msg="email  already registered?";
		}
		 else{ 
		 if( $num_row3 > 0 ) { 
		$msg="You have  already registered?";
		}
		else{
			$query4=mysqli_query($conn,"update student set email='$email',password='$password',status='1',name='$sname' where student_id='$student_id'");
		 if($query4)
		 {
				$msg="Registered Successfully";
		 }
		 else{
			 $msg="Not Register";
		 }
		}
		}
			}
			else
			{
				$msg="Your Student ID is Not Added COntact Administrator";
			}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign Up</title>
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
<h5 class="text-center text-uppercase">Student Sign Up</h5>
</div>
</div>
<div class="row" style="margin-top:5%;margin-bottom:5%;">
<div class="col-sm-8">
<form class="form-horizontal col-sm-offset-4" role="form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="sname">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="sname" name="sname" placeholder="Enter Student Name" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10"> 
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="student">Student id:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" name="student_id" id="student" placeholder="Enter Student Id" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter Password" required>
    </div>
  </div>
  
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-12 col-sm-10">
      <button type="submit" class="btn btn-default"style="background:#5F9EA0;" name="add">Register</button>
    </div>
  </div>
</form>
<div class="col-sm-offset-8 col-sm-10">
<p><a href="index.php"><span style="color:#333;font-size:18px;">Back</span></a></p>
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
