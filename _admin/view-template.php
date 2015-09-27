<?php
include_once("includes/app_top.php");
$getid = getid('id') ;

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Template</title>
</head>
<body style="margin:0; padding:0">
<?php 
	$query2="select * from email_templates where id=".$getid; 
		$res2=mysqli_query($mysqli,$query2);
		 $row2=mysqli_fetch_assoc($res2);
$emailtext = $row2['description'];
		$emailtext = str_replace("[HEADING]",$row2['heading'],$emailtext);		
		$emailtext = str_replace("[SITEURL]",$siteurl,$emailtext);
		$emailtext = str_replace("[SITENAME]",$sitename,$emailtext);		 	
		$emailtext = str_replace("[SOCIAL_ICONS_MAIL]",$socialicons_mail,$emailtext);		
							  
echo '<h1 style="font-size:26px;font-weight:normal; line-height:30px; margin:0;padding:0; color:#252525; text-align:center">'.$row2['heading'].'</h1>'.$emailtext;?>
</body></html>
