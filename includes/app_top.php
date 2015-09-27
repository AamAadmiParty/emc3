<?php
error_reporting(E_ERROR);
ini_set("display_errors", 1);
//common for all the sections
header("location:delhi");
session_start();

require_once('includes/configure.php');
require_once('includes/functions.php');
require_once('includes/constants.php');
require_once('includes/getdata.php'); 
require_once('cache/data.php');
?>
