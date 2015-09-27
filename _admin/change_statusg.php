<?php
include("includes/app_top.php");
$t=cleanQuery($_POST['t']);
$getid=cleanQuery($_POST['id']);
if($t!="" && $getid!="")
{
$idstring='id';
$statusg=return_field($t,$idstring,$getid,'genuine');
$statusg = ($statusg== 1) ? 0 : 1;
$query = "update ".$t." set genuine=".$statusg." where ".$idstring."=".$getid;
mysqli_query($mysqli, $query);
print $statusg;
}
?>