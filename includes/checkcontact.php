<?php 
include('configure.php');
include('functions.php');

$id=cleanQuery($_GET['id']);
$iscalled=cleanQuery($_GET['iscalled']);
$query = "update contacts set iscalled=".$iscalled."  where id=".$id;
mysqli_query($mysqli, $query);
$msg='<div class="success">Updated Call Status</div>';
print $msg;
?>
