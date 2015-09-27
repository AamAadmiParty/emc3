<?php 
include('../includes/configure.php');
include('../includes/functions.php');

$keyword=cleanQuery($_GET['keyword']);
$query="select * from constituency_details where constituency like '%". $keyword."%' limit 1";
			$res=mysqli_query($mysqli, $query);
			if(mysqli_num_rows($res)>0)
			{
              $row=mysqli_fetch_assoc($res);	
$msg='<br/><table width="100%" border="0" cellspacing="0" cellpadding="5">
<tr> <td  width="170"><strong>Constituency Name: </strong></td>
                <td>'.$row['constituency'].'</td>
              </tr>
<tr> <td  width="170"><strong>Helpline Number Holder : </strong></td>
                <td>'.$row['holder'].'</td>
              </tr>
              <tr> <td  ><strong>Constituency Helpline:</strong> </td>
                <td>'.$row['helpline'].'</td>
              </tr></table>';
			}
			else
			$msg="<p>No Constituency with this keyword</p>";
print $msg;
?>
