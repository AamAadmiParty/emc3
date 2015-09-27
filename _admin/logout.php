<?php
include("includes/app_top.php");
session_destroy();
header("location:login.php");
?>