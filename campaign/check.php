<?php 
session_start();

if(isset($_GET['scode']))
{
$scode=$_GET['scode'];
if($scode!=$_SESSION['security_code'])
{
echo '<div class="error" style="width:160px; margin:0">Incorrect Security Code</div>';
}
}
?>
