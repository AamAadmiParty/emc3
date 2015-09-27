<?php 
require_once('configure.php');
require_once('functions.php');

$firstname=cleanQuery($_GET['firstname']);
$lastname=cleanQuery($_GET['lastname']);
$email=cleanQuery($_GET['email']);
$membernumber=ismember1($firstname,$lastname,$email);
if($membernumber!='')
echo "TAGC Member";
else 
echo "";
?>
