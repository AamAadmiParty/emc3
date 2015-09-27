<?php
include("includes/app_top.php");
$campaign = $_SESSION['campaign'];
session_destroy();
header("location:index.php?campaign=$campaign");
?>