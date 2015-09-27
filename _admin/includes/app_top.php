<?php
//common for all the sections
session_start();
require_once('../includes/configure.php');
require_once('../includes/functions.php');
require_once('../includes/constants.php');
require_once('includes/getdata.php'); 
require_once('../cache/data.php');
$st=get('st');
$sort= get('sort');
?>