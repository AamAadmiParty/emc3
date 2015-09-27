<?php

include("includes/app_top.php");

$vcode= get('vcode');
 $query="select * from users where confirmation='".$vcode."'"; 		  
		$res=mysqli_query($mysqli,$query); 
         $row=mysqli_fetch_assoc($res);
if(mysqli_num_rows($res) > 0)
{
if($row['status2']==0)
{		 
$email=$row['email'];
$query2="update users set status2=1, lastlogin= '". $date."' where id=".$row['id'];
mysqli_query($mysqli,$query2); 

$sql2= "select * from email_templates where id=3";
        $res2= mysqli_query($mysqli,$sql2);
        $row2= mysqli_fetch_assoc($res2);
					
		$esubject = $row2['subject'];
		$esubject = str_replace("[NAME]",$name,$esubject); 
		$esubject = str_replace("[SITENAME]",$sitename,$esubject);
		
		$emailtext = $row2['description'];
		$emailtext = str_replace("[NAME]",$name,$emailtext);		
		$emailtext = str_replace("[EMAIL]",$email,$emailtext);	
		$emailtext = str_replace("[SITEURL]",'http://emc3.aamaadmiparty.org/delhi/',$emailtext);
		$emailtext = str_replace("[SITENAME]",$sitename,$emailtext);	
		$emailtext = str_replace("[ADMINEMAIL]",$adminemail,$emailtext);												
		$emailtext = str_replace("[SOCIAL_ICONS_MAIL]",$socialicons_mail,$emailtext);														

require 'includes/mailer.php';
sendmail('','',$email,$esubject,$emailtext);			
//@mail($email, $esubject, $emailtext, "From: $adminemail\r\nReply-to: $adminemail\r\nContent-type: text/html; charset=us-ascii");	
$_SESSION["user"]=$row['name'];	   
$_SESSION["userid"]=$row['id'];	
$_SESSION['useremail']=$row['email'];   		  
header("location:details.php");
exit();
}
else
{
 tep_redirect(tep_href_link('login.php','action1=err2'));
}
}
else
{
 tep_redirect(tep_href_link('login.php','action1=err1'));
}
?>
