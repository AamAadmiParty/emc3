<?php
include("includes/app_top.php");
$t=cleanQuery($_POST['t']);
$getid=cleanQuery($_POST['id']);
if($t!="" && $getid!="")
{
$query = mysqli_query($mysqli,"DELETE FROM ".$t." WHERE id=".$getid);
print '<div class="success">Deleted Successfully!</div>';
}
?>