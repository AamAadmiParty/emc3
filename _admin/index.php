<?php
session_start();
include("includes/app_top.php");

if(isset($_SESSION["admin"]))
  {
    header("location:states.php");
    exit();
}
else
{
    header("location:login.php");
    exit();
}
?> 
