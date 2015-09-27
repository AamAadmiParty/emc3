<?php
include("includes/app_top.php");
$t=cleanQuery($_POST['t']);
$getid=cleanQuery($_POST['id']);
if($t!="" && $getid!="")
{
$idstring='id';
$status2=return_field($t,$idstring,$getid,'status2');
$status2 = ($status2== 1) ? 2 : 1;
$query = "update ".$t." set status2=".$status2." where ".$idstring."=".$getid;
mysqli_query($mysqli, $query);
print $status2;
}
?>