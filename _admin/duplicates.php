<?php
include("includes/app_top.php");

checkAdminLogin();
checkState();

$query="SELECT contact, id, count(id) as cnt FROM contacts where (catid=5 or catid=4) and iscalled=0 GROUP BY contact HAVING cnt > 1";
echo $query;
                  


                        $result2 = mysqli_query($mysqli, $query);
echo "<br/>".mysqli_num_rows($result2);
                                          while ($row2 = mysqli_fetch_assoc($result2))
                                          {

//mysqli_query($mysqli,"DELETE FROM contacts WHERE id=".$row2['id']);
}
?>
