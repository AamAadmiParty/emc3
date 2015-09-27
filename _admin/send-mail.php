<?php 
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Send Mail";
checkAdminLogin();
checkState();
$getid=getid('id');$mid=getid('mid');$aid=getid('aid'); 
$aa="";
if($action=='send')
{
$email=cleanQuery($_POST['emailfrom']);
$esubject = $_POST['subject2'];
$emailtext = "<div style='font-family:Trebuchet MS; font-size:13px;'>".$_POST['description']."</div>";
$text = $_POST['emails'];
$list = split("[\n\t\r,]+", $text);
# This sends the email to the addresses entered
$no=count($list);
$emailtext=str_replace("'", "\'", $emailtext);		
$emailtext=str_replace('\"', '"', $emailtext);		
require 'includes/mailer.php'; 
for($i=0; $i < $no; $i++) { 
sendmail($email,"Aam Aadmi Party",$list[$i],$esubject,$emailtext);
//$aa=@mail("$list[$i]", $esubject, $emailtext, "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8");
} 
//if($aa)
tep_redirect(tep_href_link($pagename,'action1=success'));
//else
//tep_redirect(tep_href_link($pagename,'action1=err'));
//echo $esubject.'<br/>'.$emailtext;
}

?>
<?php include("includes/styles.php");?>
<?php include("includes/ckeditor.php");
?>
<script type="text/javascript">
 function validate(form)
  {
    if(form.email.value=="") { alert("Please enter email to");form.email.focus(); return false;  }			
    if(form.subject2.value=="") { alert("Please enter subject");form.subject2.focus(); return false;  }			
  }
</script>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text12" align="center">
                 <tr><td> 
                  
<div class="pageHeadingBlock ">
                    <div class="grayBackground">
                    <h3 class="title">Send Mail</h3>
                    </div>
  </div>
  <table width="100%" border="0"  cellpadding="0" cellspacing="0" align="center">
                     <tr>
                       <td><div id="messages"><?php
if($action1=="success") { echo '<div class="alert alert-success">Mail(s) has been sent.</div>';}
if($action1=="err") { echo '<div class="alert alert-error">Something Error. Mail has not sent.</div>';}?></div></td>
                     </tr>
                     <tr>
                       <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text9">
                           <tr>
                             <td><?php 
					$emails=""; 
					 				  
					if($mid!='')$emails=return_field('users','id',$mid,'email');	
					if($aid!='')$emails=return_field('admins','id',$aid,'email');
					
?>
                                 <form action="<?php echo $pagename;?>?action=send" method="post"  enctype="multipart/form-data" name="frmadd" id="frmadd" onSubmit="return validate(this)">
                                   <div  >
                                     <table width="100%" border="0" cellspacing="0" cellpadding="3" class="text9" align="center">
                                       <tr>
                                         <td align="right">Email From : </td>
                                         <td><input name="emailfrom" type="text"  id="emailfrom" style="width:250px" value="<?php echo $adminemail; ?>" /></td>
                                       </tr>
                                       <tr valign="top">
                                         <td height="69" align="right">Email To :&nbsp;</td>
                                         <td><textarea name="emails" rows="4"  id="emails" style="width:350px"><?php echo $emails; ?></textarea>
                                             <br />
                                           [ If multiple mails, separate by (,) comma ] </td>
                                       </tr>
                                       
                                       <tr valign="top">
                                         <td width="32%" height="59" align="right">Subject :&nbsp;</td>
                                         <td width="68%"><textarea name="subject2"  id="subject2" style="width:350px"></textarea>                                         </td>
                                       </tr>
                                       <tr>
                                         <td colspan="2" align="center">
                                        <textarea cols="80" id="description" name="description"  rows="10"></textarea>
                                             <script type="text/javascript">
						 CKEDITOR.replace( 'description',{ contentsCss : '../css/editor.css'}); 
                       </script>                                         </td>
                                       </tr>
                                       <tr>
                                         <td>&nbsp;</td>
                                         <td><input type="submit" name="register" value="Submit" id="Button1" class="btn btn-primary" />
                                           <a href="javascript:history.back(-1)" class="btn btn-inverse" >Cancel</a></td>
                                       </tr>
                                     </table>
                                   </div>
                                 </form></td>
                           </tr>
                       </table></td>
                     </tr>
                     <tr>
                       <td align="center">&nbsp;</td>
                     </tr>
                   </table> 
<?php include("includes/footer.php");?> 
</body>
</html>