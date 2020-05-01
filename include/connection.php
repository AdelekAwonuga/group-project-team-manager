<?php
$dbserver="localhost";
$dbuser="root";
$dbpassword="";
$db="team";
$conn=mysqli_connect($dbserver,$dbuser,$dbpassword,$db);
if(!$conn)
{
	echo "cannot connect to database";
}

	
?>