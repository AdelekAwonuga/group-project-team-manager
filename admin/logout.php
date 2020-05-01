<?php
ob_start();
session_start();
$_SESSION['admin_id']=="";
$_SESSION['user']=="";
session_unset();
header("location:index.php");
?>