<?php
include("includes/app_top.php");
$t=cleanQuery($_POST['t']);
$getid=cleanQuery($_POST['id']);
if($t!="" && $getid!="")
{
$idstring='id';
$status2=return_field($t,$idstring,$getid,'ishome');
$status2 = ($status2== 0) ? 1 : 0;
$query = "update ".$t." set ishome=".$status2." where ".$idstring."=".$getid;
mysqli_query($mysqli, $query);
$msg='<div class="alert alert-success">Changed Home Video Status</div>';
print $msg;
}
?>