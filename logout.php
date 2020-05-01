<?php
ob_start();
session_start();
$_SESSION['student_id']=="";
$_SESSION['name']=="";
session_unset();
header("location:index.php");
?>