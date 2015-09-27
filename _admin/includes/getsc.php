<?php
include("configure.php");

$q=$_GET["q"];
$ds = isset($_GET['sc']) ? $_GET['sc'] : '';
$sql="SELECT * FROM rsc WHERE catid = ".$q;
$result = mysqli_query($mysqli, $sql);
 if(mysqli_num_rows($result)> 0){
echo '<select name="subcat" id="subcat">';
while($row = mysqli_fetch_array($result))
  {
  echo "<option value=".$row['id'];
  if($ds==$row['id'])echo 'selected="selected"';
  echo '>';
  echo $row['scname'] . "</option>";
  }
echo "</select>"; 
}
?>