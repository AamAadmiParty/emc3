<?php 
include('configure.php');
include('functions.php');

$name=cleanQuery($_GET['name']);
$lastname=cleanQuery($_GET['lastname']);
$email=cleanQuery($_GET['email']);
$membernumber=ismember1($firstname,$lastname,$email);
if($membernumber!='')
echo "VEP Member";
else 
echo "";
?>
