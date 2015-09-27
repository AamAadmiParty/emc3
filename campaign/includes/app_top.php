<?php
error_reporting(E_ERROR);
ini_set("display_errors", 1);
ini_set("session.cookie_lifetime",3600);
ini_set("session.gc_maxlifetime", 3600);
//common for all the sections
session_start();

$_SESSION['campaign'] = "call4delhi";
if(isset($_GET["campaign"]))
{
    $_SESSION['campaign'] = htmlspecialchars($_GET["campaign"]);
}
else if (!isset($_SESSION['campaign']))
{
    header("location:../index.php");
    exit();
}
    
require_once('../includes/configure.php');
require_once('../includes/functions.php');
require_once('includes/constants.php');
?>
