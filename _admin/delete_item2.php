<?php
include("includes/app_top.php");
$t=cleanQuery($_POST['t']);
$getid=cleanQuery($_POST['id']);
if($t!="" && $getid!="")
{
$query = "update ".$t." set userid=0,contactdate='',iscalled=0, vote=0, comments='' where id=".$getid;
mysqli_query($mysqli, $query);
$msg='<div class="success">Removed User from Contact Status Successfully</div>';
}
?>