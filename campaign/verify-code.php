<?php include("includes/app_top.php");
$pagetitle2="Change Password";
$verifycode=get('vcode');

if($verifycode!='')
{
	$sql="select * from users where confirmation='$verifycode'";
	  $res= mysqli_query($mysqli,$sql);
	  if(mysqli_num_rows($res)>0)
	  {
	  if($row['status2']==2)
          tep_redirect(tep_href_link('login.php','action1=err3'));
	  	  
      $row=mysqli_fetch_assoc($res);	
	  $_SESSION["userid"]=$row['id'];
	  $_SESSION["user"]=$row['name'];
	  $_SESSION['email']=$row['email'];		
	  $_SESSION['categoryid']=return_field('settings','id',1,'category');
	  tep_redirect('change-password2.php');
	}	
	else
	{
	  tep_redirect(tep_href_link('login.php','action1=err4'));
	}
}
else
{
	  tep_redirect(tep_href_link('login.php','action1=err4'));
	} 	 
?>